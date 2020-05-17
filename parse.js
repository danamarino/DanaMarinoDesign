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

    const dom = new JSDOM(template);

    const pageTitle = dom.window.document.querySelector('title').textContent;
    const pageDescription = dom.window.document.querySelector('meta[name="description"]').getAttribute('content');

    const head = {
        title: pageTitle,
        description: pageDescription,
    };

    const name = dom.window.document.querySelector('header.special > h2').textContent.replace('Weddings: ', '');
    const description = dom.window.document.querySelector('header.special > p').textContent;
    const featureImageTag = dom.window.document.querySelector('div.image.feature > img');
    const featureImage = {
        src: featureImageTag.src,
        alt: featureImageTag.alt,
    };

    const images = [...dom.window.document.querySelectorAll('.row img')].map(el => ({
        src: el.src,
        alt: el.alt,
    }));

    const eventDetails = [...dom.window.document.querySelectorAll('section.details > div > ul > li')].map(el => ({
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

    writeFileSync(outputPath, JSON.stringify({
        head,
        body
    }, null, 4), 'utf8');
});
