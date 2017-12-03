//const to = 'antoine.tetart98@gmail.com';
const to = 'emixmaxime@gmail.com';

const fs = require('fs');
const nodemailer = require('nodemailer');
const htmlToText = require('nodemailer-html-to-text').htmlToText;

const transporter = nodemailer.createTransport({
  dkim: {
    domainName: 'mxteaches.me',
    keySelector: 'default',
    privateKey: fs.readFileSync('/home/emix/keys/mxteaches.me/DKIM/dkim-private.key'),
  },
  port: 25,
  tls: { rejectUnauthorized: false },
});

transporter.use('compile', htmlToText());

const data = {
  from: 'inscription@mxteaches.me',
  to,
  subject: "Email de bienvenue pour les testeurs, merci à vous!",
  html: fs.readFileSync('./welcome.html')
};

transporter.sendMail(data, (err, info) => {
  console.log({ err, info });
});

