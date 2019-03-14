<?php

namespace App\clases\general;

use Symfony\Component\DependencyInjection\Container;
use Doctrine\ORM\EntityManager;

class Email {

    protected $_em;
    protected $_container;

    /**
     *
     * @param EntityManager $manager
     * @param Container $container
     */
    public function __construct($mailer) {
       $this->_mailer = $mailer;
    }

    /**
     *
     * @param type $subject
     * @param type $from
     * @param type $to
     * @param type $body
     * @param type $encrypt
     * @param type $attach
     * @param type $encrypt_attach
     * @return type
     */
    public function sendEmail($subject, $body , $to = 'josecarlosduran@gmail.com',$from = 'myfinance@jcduranalcantara.com',$encrypt = 'text/html', $attach = null, $encrypt_attach = 'image/jpeg') {

        $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom($from)
                ->setTo($to)
                ->setBody($body, $encrypt)
        ;
        if ($attach != null) {
            $attachment = \Swift_Attachment::fromPath($attach, $encrypt_attach);
            $message->attach($attachment);
        }

          $respuesta = $this->_mailer->send($message, $errores);
          $retorno = array ("respuesta" => $respuesta,
                            "errores" => $errores);
       return $retorno;
    }

}
