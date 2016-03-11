<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PagesModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function create(stdClass $page)
    {
        foreach ($page as $field) {
            if (empty($field)) {
                return false;
            }
        }
        
        $isset = $this->db
                ->select("id")
                ->where("title", $page->title)
                ->or_where("name", $page->name)
                ->get("pages")->num_rows();
        
        if ($isset !== 0) {
            return false;
        }
        
        return $this->db->insert("pages", $page);
    }
    
    public function read_one(array $params)
    {
        $query = $this->db
                ->select(["id", "title", "name", "data"])
                ->where($params)
                ->limit(1)
                ->get("pages");
        
        
        if ($query->num_rows() === 0) {
            return false;
        }
        
        return $query->result()[0];
    }
    
    public function read_all()
    {
        $query = $this->db->select(["id" ,"title", "name", "data"])->get("pages");
        
        if ($query->num_rows() === 0) {
            return false;
        }
        
        return $query->result();
    }
    
    public function update(array $params, stdClass $page)
    {
        $isset = $this->db
                ->select("id")
                ->where("id !=", $page->id)
                ->group_start()
                    ->where("title", $page->title)
                    ->or_where("name", $page->name)
                ->group_end()
                ->get("pages")->num_rows();
        
        if ($isset !== 0) {
            return false;
        }
        
        return $this->db->where($params)->update("pages", $page);
    }
    
    public function delete(array $params)
    {
        $this->db->where($params)->delete("pages");
        
        $result = $this->db->affected_rows();
        
        return boolval($result);
    }
}