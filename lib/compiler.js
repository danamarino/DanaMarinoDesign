const { JSDOM } = require("jsdom");
const { readFileSync, existsSync } = require('fs');
const _ = require('underscore');
const path = require('path');

const encoding = 'utf8';

const srcDir = path.resolve(__dirname, '../src');
const rootFile = path.join(srcDir, 'root.html');

exports.compileTemplate = (filePath) => {
    filePath = path.resolve(process.cwd(), filePath);


    if (!existsSync(filePath)) {
        return;
    }

 const root = readFileSync(rootFile, encoding);

    let data;

    try {
        data = require(filePath);
    } catch (e) {
        console.error(`${filePath} is not valid.`)
        return;
    }

    const templatePath = path.join(srcDir, data.template);

    if (!existsSync(templatePath)) {
        console.error(`ERROR: ${templatePath} does not exist.`);
        return;
    }

    const template = readFileSync(templatePath, encoding);

    const compiledRoot = _.template(root)(data);
    const compiledTemplate = _.template(template)(data.body);

    const dom = new JSDOM(compiledRoot, { runScripts: "outside-only" });
    const fragment = JSDOM.fragment(compiledTemplate);

    dom.window.document.getElementById('template-outlet').appendChild(fragment);

    return dom.serialize();
};
