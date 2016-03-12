<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MailModel extends CI_Model
{
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function validate(stdClass $data)
    {
        $this->load->library("form_validation");
        
        $this->form_validation->set_data((array)$data);
        
        $this->form_validation->set_rules("name", "Your name", "required|max_length[100]|callback_validateAll");
        $this->form_validation->set_rules("email", "Your email", "required|max_length[150]|valid_email");
        $this->form_validation->set_rules("subject", "Email subject", "required|max_length[200]|callback_validateAll");
        $this->form_validation->set_rules("text", "Email text", "required|max_length[600]|callback_validateAll");
        
        return $this->form_validation->run();
    }
    
    public function validateAll($string)
    {
        if (
                !$this->_validatePhp($string) || 
                !$this->_validateJavaSript($string) || 
                !$this->_validateHtml($string)
        ) {
            $this->form_validation->set_message("validateHtml", "{field} are invalid");
            return false;
        }
        
        return true;
    }
    
    private function _validateHtml($data)
    {
        $this->load->library("HtmlValidator");
        $this->htmlvalidator->setHtml($data);
            
        return $this->htmlvalidator->validate();
    }
    
    private function _validatePhp($data)
    {
        return !preg_match("/\<\?php.*\?\>/", $data) && !preg_match("/\<\?php/", $data);
    }
    
    private function _validateJavaSript($data)
    {
        return !preg_match("/\<script\>.*\<\/script\>/", $data);
    }
    
    public function create(stdClass $object)
    {
        if (!$this->validate($object)) {
            return false;
        }
        
        return $this->db->insert("emails", $object);
    }
    
    public function update(array $where, stdClass $object)
    {
        if (!$this->validate($object)) {
            return false;
        }
        
        return $this->db->where($where)->update("emails", $object);
    }
    
    public function readOne(array $where)
    {
        $query = $this->db->select(["id", "email", "name", "subject", "text"])->where($where)->get("emails");
        
        if ($query->num_rows() === 0) {
            return false;
        }
        
        return $query->result()[0];
    }
    
    public function readAll()
    {
        $query = $this->db->select(["id", "email", "name", "subject", "text"])->get("emails");
        
        if ($query->num_rows() === 0) {
            return false;
        }
        
        return $query->result();
    }
    
    public function delete(array $where)
    {
        $this->db->where($where)->delete("emails");
        
        $result = $this->db->affected_rows();
        
        return boolval($result);
    }
}