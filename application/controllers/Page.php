<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

defined("BASEPATH") or exit("No direct script access allowed");

class Page extends CI_Controller
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->load->view("client/header", [
            "title" => "SBM WebApp"
        ]);
        
        $this->load->view("client/menu");
        
        $this->load->view("client/body");
        
        $this->load->view("client/footer");
    }
}