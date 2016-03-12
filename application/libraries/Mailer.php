<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Mailer
{
    private $instance;
    
    public function __construct()
    {
        $this->instance = new PHPMailer();
    }
    
    public function connect(array $config)
    {
        $this->instance->isSMTP();
        $this->instance->Host = $config['host'];
        $this->instance->SMTPAuth = true;
        $this->instance->Username = $config['username'];
        $this->instance->Password = $config['password'];
        $this->instance->SMTPSecure = 'tls';
        $this->instance->Port = $config['port'];
    }
    
    public function setFrom(array $data)
    {
        $this->instance->setFrom($data["email"], $data["name"]);
    }
    
    public function setTo(array $data)
    {
        $this->instance->addAddress($data["email"], $data["name"]);
    }
    
    public function setSubject($subject)
    {
        $this->instance->Subject = $subject;
    }
    
    public function setBody($body)
    {
        $this->instance->isHTML();
        $this->instance->Body = $body;
    }
    
    public function send()
    {
        return $this->instance->send();
    }
}