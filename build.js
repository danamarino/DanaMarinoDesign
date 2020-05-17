const { JSDOM } = require("jsdom");
const { readFileSync, writeFileSync, mkdirSync, existsSync } = require('fs');
const _ = require('underscore');
const glob = require('glob');
const path = require('path');

const root = readFileSync('./src/index.html', 'utf8');

const files = glob.sync('./src/weddings/**/*.json');

files.forEach(file => {
    const directory = path.dirname(file);
    const data = require(file);
    const template = readFileSync(data.template, 'utf8');

    const compiledRoot = _.template(root)(data);
    const compiledTemplate = _.template(template)(data.body);

    const dom = new JSDOM(compiledRoot);
    const fragment = JSDOM.fragment(compiledTemplate);

    dom.window.document.getElementById('template-outlet').appendChild(fragment);

    const outDir = directory.replace('src', 'public');
    const outFile = path.basename(file).replace('json', 'html');
    const outputPath = `${outDir}/${outFile}`;

    if (!existsSync(outDir)) {
        mkdirSync(outDir);
    }

    console.info(`Create: ${outputPath}`)

    writeFileSync(outputPath, dom.serialize(), 'utf8');
});
