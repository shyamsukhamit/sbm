<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PagesModelTest extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->library("unit_test");
        $this->load->model("PagesModel");
    }
    
    public function index() 
    {
        $this->_createFailedEmpty();
    }
    
    private function _createSuccess()
    {
        $testname = "Create success";

        $test = new stdClass();

        $test->title = "TestPage1";
        $test->name = "testpage1";
        $test->data = "Hello world";

        $test_result = $this->PagesModel->create($test);

        $expected_result = true;
            
        echo $this->unit->run($test_result, $expected_result, $testname);
    }
    
    private function _createFailSameTitle()
    {
        $testname = "Create failed. The same title";

        $test = new stdClass();

        $test->title = "TestPage";
        $test->name = "testpage1";
        $test->data = "Hello world";

        $test_result = $this->PagesModel->create($test);

        $expected_result = false;
            
        echo $this->unit->run($test_result, $expected_result, $testname);
    }
    
    private function _createFailedSameName()
    {
        $testname = "Create failed. The same name";

        $test = new stdClass();

        $test->title = "TestPage1";
        $test->name = "testpage";
        $test->data = "Hello world";

        $test_result = $this->PagesModel->create($test);

        $expected_result = false;
            
        echo $this->unit->run($test_result, $expected_result, $testname);
    }
    
    private function _createFailedEmpty() {
        $testname = "Create failed. Failed";

        $test = new stdClass();

        $test->title = "";
        $test->name = "";
        $test->data = "";

        $test_result = $this->PagesModel->create($test);

        $expected_result = false;
            
        echo $this->unit->run($test_result, $expected_result, $testname);
    }
    
    public function _readSuccessOneById()
    {
        $testname = "Read Success. By Id";

        $test_result = $this->PagesModel->read_one([
            "id" => 1
        ]);

        echo $this->unit->run($test_result, "is_object", $testname);
    }
    
    public function _readFailed() {
        $testname = "Read Failed. By Id";

        $test_result = $this->PagesModel->read_one([
            "id" => 1000
        ]);

        echo $this->unit->run($test_result, "is_false", $testname);
    }
    
    public function _readSuccessAll()
    {
        $testname = "Read Succes. All";

        $test_result = $this->PagesModel->read_all();

        echo $this->unit->run($test_result, "is_array", $testname);
    }
    
    public function _readFailedAll()
    {
        $testname = "Read Failed. All";

        $test_result = $this->PagesModel->read_all();

        echo $this->unit->run($test_result, "is_false", $testname);
    }
 
    public function _updateSuccess()
    {
        $testname = "Update Success. All";

        $update = new stdClass();
        
        $update->id = 1;
        $update->title = "TestPage1";
        $update->name = "testpage1";
        
        $test_result = $this->PagesModel->update([
            "id" => 1
        ], $update);

        echo $this->unit->run($test_result, "is_true", $testname);
    }
    
    public function _updateFailed()
    {
        $testname = "Update Failed. All";

        $update = new stdClass();
        
        $update->id = 1;
        $update->title = "TestPage1";
        $update->name = "testpage1";
        
        $test_result = $this->PagesModel->update([
            "id" => 1
        ], $update);

        echo $this->unit->run($test_result, "is_false", $testname);
    }
    
    public function _deleteSuccess()
    {
        $testname = "Delete Success. By Id";

        $test_result = $this->PagesModel->delete([
            "id" => 2
        ]);

        echo $this->unit->run($test_result, "is_true", $testname);
    }
    
    public function _deleteFailed()
    {
        $testname = "Delete Failed. By Id";

        $test_result = $this->PagesModel->delete([
            "id" => 1
        ]);

        echo $this->unit->run($test_result, "is_false", $testname);
    }
}