const { JSDOM } = require("jsdom");
const { readFileSync, writeFileSync, mkdirSync } = require('fs');
const _ = require('underscore');
const glob = require('glob');
const path = require('path');

const index = readFileSync('./src/index.html', 'utf8');

const files = glob.sync('./src/weddings/**/*.json');

if (files.length) {
    mkdirSync('./public/weddings');
}

files.forEach(file => {
    const directory = path.dirname(file);
    const template = readFileSync(`${directory}/template.html`, 'utf8');
    const data = require(file);

    const compiled = _.template(template)(data.body);

    const dom = new JSDOM(index);
    const fragment = JSDOM.fragment(compiled);

    dom.window.document.getElementById('template-outlet').appendChild(fragment);

    const outDir = directory.replace('src', 'public');
    const outFile = path.basename(file).replace('json', 'html');
    const outputPath = `${outDir}/${outFile}`;

    console.info(`Create: ${outputPath}`)

    writeFileSync(outputPath, dom.serialize(), 'utf8');
});
