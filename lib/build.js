const { readFileSync, writeFileSync, mkdirSync, existsSync, unlinkSync } = require('fs');
const _ = require('underscore');
const glob = require('glob');
const path = require('path');

const dataExtension = '.page.json';
const pageExtension = '.html';

const encoding = 'utf8';

const { compileTemplate } = require('./compiler');

function cleanPages() {
    const files = glob.sync(`./public/**/*${pageExtension}`);

    files.forEach(file => {
        cleanPage(file);
    });
}

function cleanPage(file) {
    if (existsSync(file)) {
        unlinkSync(file);
        console.info(`Deleted: ${file}`)
    }
}

function buildNewPages() {

    const files = glob.sync(`./src/**/*${dataExtension}`);

    files.forEach(config => {
        const compiled = compileTemplate(config);

        const directory = path.dirname(config);
        const outDir = directory.replace('src', 'public');
        const outFile = path.basename(config).replace(dataExtension, pageExtension);
        const outputPath = `${outDir}/${outFile}`;

        if (!existsSync(outDir)) {
            mkdirSync(outDir);
        }

        console.info(`Generate: ${outputPath}`)
        writeFileSync(outputPath, compiled, encoding);
    });
}


cleanPages();

if (!process.env.CLEAN_ONLY) {
    buildNewPages();
}

