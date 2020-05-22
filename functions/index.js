const functions = require('firebase-functions');
const { JSDOM } = require("jsdom");
const { readFileSync, existsSync } = require('fs');
const _ = require('underscore');
const path = require('path');

const dataExtension = '.page.json';

const encoding = 'utf8';

const srcDir = path.resolve(__dirname, '../src');
const rootFile = path.join(srcDir, 'root.html');
const fourOhFourConfig = path.join(srcDir, `404.page.json`);

const { compileTemplate } = require('../lib/compiler');

exports.compile = functions.https.onRequest(({ url }, response) => {
    const configPath = url === '/' ? 'index' : url.replace(/\/$/, '');
    let filePath = path.join(srcDir, `${configPath}${dataExtension}`);

    const compiled = compileTemplate(filePath);

    if (!compiled) {
        return response.status(404).send(compileTemplate(fourOhFourConfig));
    }

    console.info(`Compiled: ${configPath}`);
    return response.send(compiled)
});
