const { JSDOM } = require("jsdom");
const { readFileSync, writeFileSync } = require('fs');
const _ = require('underscore');
const glob = require('glob');
const path = require('path');

const index = readFileSync('./src/index.html', 'utf8');

const files = glob.sync('./public/weddings/**/*.html');

files.forEach(file => {
    const directory = path.dirname(file);
    const template = readFileSync(file, 'utf8');

    const fragment = JSDOM.fragment(template);

    const name = fragment.querySelector('header.special > h2').textContent.replace('Weddings: ', '');
    const description = fragment.querySelector('header.special > p').textContent;
    const featureImageTag = fragment.querySelector('div.image.feature > img');
    const featureImage = {
        src: featureImageTag.src,
        alt: featureImageTag.alt,
    };

    const images = [...fragment.querySelectorAll('.row img')].map(el => ({
        src: el.src,
        alt: el.alt,
    }));

    const eventDetails = [...fragment.querySelectorAll('section.details > div > ul > li')].map(el => ({
        title: el.textContent.split(':')[0],
        link: {
            href: el.querySelector('a').href,
            text: el.querySelector('a').textContent,
        },
    }));

    const body = {
        name,
        description,
        featureImage,
        images,
        eventDetails,
    };

    const outDir = directory.replace('public', 'src');
    const outFile = path.basename(file).replace('html', 'json');
    const outputPath = `${outDir}/${outFile}`;

    console.info(`Create: ${outputPath}`)

    writeFileSync(outputPath, JSON.stringify({body}, null, 4), 'utf8');
});
