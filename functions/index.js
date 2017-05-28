'use strict';

const functions = require('firebase-functions');
const nodemailer = require('nodemailer');
const gmailEmail = encodeURIComponent(functions.config().gmail.email);
const gmailPassword = encodeURIComponent(functions.config().gmail.password);
const mailTransport = nodemailer.createTransport(`smtps://${gmailEmail}:${gmailPassword}@smtp.gmail.com`);

exports.sendEmail = functions.database.ref('/emails/{uid}').onWrite(event => {
    const formSubmission = event.data.val();

    const email = {
        from: '"Dana Marino Design" <noreply@danamarinodesign.com>',
        to: 'danamarinodesign@gmail.com',
        subject: 'Design Web Submission',
        text: `Name: ${formSubmission.name}
           Email: ${formSubmission.email}
           Message: ${formSubmission.comments}`,
    };

    return mailTransport.sendMail(email);
});
