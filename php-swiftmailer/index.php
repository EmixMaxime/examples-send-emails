<?php
require 'vendor/autoload.php';

$to = "emixmaxime@gmail.com";

/** Transport */
$transport = Swift_MailTransport::newInstance();

/** DKIM */
$privateKey = file_get_contents('/home/emix/keys/mxteaches.me/DKIM/dkim-private.key');
$signer = new Swift_Signers_DKIMSigner($privateKey, 'mxteaches.me', 'default');

/** Message */
$message = Swift_Message::newInstance();
$message->attachSigner($signer);

$message->setTo($to);
$message->setSubject('Email de bienvenue pour les testeurs, merci à vous!');

$message->setBody(dirname(__DIR__) . '/welcome.html', 'text/html');
//$message->addPart('plain text content', 'text/plain');

$message->setFrom('inscription@mxteaches.me');

/** Send  */
$mailer = Swift_Mailer::newInstance($transport);
$mailer->send($message);

echo 'done';

