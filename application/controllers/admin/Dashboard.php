<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->load->view("admin/header");
        $this->load->view("admin/menu", [
            "menu" => [
                [
                    "title" => "Dashboard",
                    "link" => base_url("index.php/admin/dashboard"),
                    "is_active" => true
                ],
                [
                    "title" => "Pages",
                    "link" => base_url("index.php/admin/pages"),
                    "is_active" => false
                ],
                [
                    "title" => "Services",
                    "link" => base_url("index.php/admin/Services"),
                    "is_active" => false
                ],
                [
                    "title" => "Partners",
                    "link" => base_url("index.php/admin/partners"),
                    "is_active" => false
                ],
                [
                    "title" => "Users",
                    "link" => base_url("index.php/admin/users"),
                    "is_active" => false
                ],
                [
                    "title" => "Workshops",
                    "link" => base_url("index.php/admin/workshops"),
                    "is_active" => false
                ],
                [
                    "title" => "Blogs",
                    "link" => base_url("index.php/admin/blogs"),
                    "is_active" => false
                ],
            ]
        ]);
        $this->load->view("admin/body");
        $this->load->view("admin/footer");
    }
}