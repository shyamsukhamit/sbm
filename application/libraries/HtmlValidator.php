<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class HtmlValidator
{
    private $html;
    
    private $validatorInstance;
    
    public function __construct() 
    {
        $this->html = "";
        $this->validatorInstance = new HtmlValidator\Validator();
    }
    
    public function setHtml($html) 
    {
        if (!is_string($html)) {
            throw new InvalidArgumentException("Provided valud should has type String. Your type is " . gettype($html));
        }
        
        $this->html = $html;
    }
    
    public function validate()
    {
        if (empty($this->html)) {
            throw new LogicException("HTML field should not be empty when you tried to validate it.");
        }
        
        return !$this->validatorInstance->validateDocument($this->html)->hasErrors();
    }
}