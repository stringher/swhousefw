<?php
//require_once 'Zend/Loader/StandardAutoloader.php';

//$loader = new Zend\Loader\StandardAutoloader( array( 'autoregister_zf' => true));
//$loader->register( );

use Zend\Mail;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

$options = new SmtpOptions( array(
"name" => "gmail",
"host" => "smtp.gmail.com",
"port" => 587,
"connection_class" => "plain",
"connection_config" => array( "username" => "stringher@gmail.com",
"password" => "sinfronio@1984","ssl" => "tls" )
) );

$mail = new Mail\Message();
$mail->setBody('Hello there!');
$mail->setFrom('mail1@gmail.com', 'Accelular');
$mail->addTo('stringher@gmail', 'LEO');
$mail->addCC( 'stringher@gmail.com' );

$mail->setSubject('Hello today ' . date( "d-m-Y" ));

$transport = new SmtpTransport();
$transport->setOptions( $options );
$transport->send($mail);

?>