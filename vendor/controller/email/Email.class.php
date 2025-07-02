<?php

/** Defino o local da classes */
namespace vendor\controller\email;

/** Importação de classes */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email
{

    /** Parâmetros da classes */
    private $Email = null;

    private $html = null;
    private $data = null;
    private $subject = null;
    private $preferences = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->Email = new PHPMailer(true);

    }

    /** Envio de email */
    public function send(string $html, $data, string $subject, $preferences, string $pathFile, $name): void
    {

        /** Parâmetros de entrada */
        $this->html = $html;
        $this->data = $data;
        $this->subject = $subject;
        $this->preferences = $preferences;

        /** Configurações do servidor */
        $this->Email->isSMTP();
        $this->Email->Host = $this->preferences->host;
        $this->Email->SMTPAuth = true;
        $this->Email->Username = $this->preferences->username;
        $this->Email->Password = $this->preferences->password;
        $this->Email->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->Email->Port = $this->preferences->port;

        /** Destinatários */
        $this->Email->setFrom($this->preferences->username, utf8_decode($name . ' - Softwiki Tecnologia'));
        $this->Email->addAddress($this->data->email, $this->data->name_first . ' ' . $this->data->name_last);

        /** Conteúdo */
        $this->Email->isHTML(true);
        $this->Email->Subject = utf8_decode($this->subject);
        $this->Email->Body = utf8_decode($this->html);
        $this->Email->AltBody = 'Para visualizar essa mensagem acesse';
        $this->Email->AddAttachment($pathFile);

        /** Envio do email */
        $this->Email->Send();

    }

    /** Método construtor */
    public function __destruct()
    {

        $this->html = null;
        $this->data = null;
        $this->subject = null;
        $this->preferences = null;

    }

}
