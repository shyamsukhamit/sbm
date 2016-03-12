<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MailModelTest extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->library("unit_test");
        $this->load->model("MailModel");
    }
    
    public function index()
    {
        $this->_sendTest();
    }
    
    private function _validationSuccess()
    {
        $testname = "Validation Success";
        
        $testobject = new stdClass();
        
        $testobject->name = "John Doe";
        $testobject->email = "john@doe.com";
        $testobject->subject = "John Doe Subject";
        $testobject->text = "Hello world";
        
        $test_result = $this->MailModel->validate($testobject);
        
        $expected_result = true;
        
        echo $this->unit->run($test_result, $expected_result, $testname);
        
    }
    
    private function _validationFailedEmptyName()
    {
        $testname = "Validation Failed";
        
        $testobject = new stdClass();
        
        $testobject->name = "";
        $testobject->email = "john@doe.com";
        $testobject->subject = "John Doe Subject";
        $testobject->text = "Hello world";
        
        $test_result = $this->MailModel->validate($testobject);
        
        $expected_result = false;
        
        echo $this->unit->run($test_result, $expected_result, $testname);
        
    }
    
    private function _validationFailedInvalidEmail()
    {
        $testname = "Validation Failed | Invalid Email";
        
        $testobject = new stdClass();
        
        $testobject->name = "John Doe";
        $testobject->email = "john @doe.com";
        $testobject->subject = "John Doe Subject";
        $testobject->text = "Hello world";
        
        $test_result = $this->MailModel->validate($testobject);
        
        $expected_result = false;
        
        echo $this->unit->run($test_result, $expected_result, $testname);
        
    }
    
    private function _validationFailedTooMuchSymbols()
    {
        $testname = "Validation Failed | Too much symbols";
        
        $testobject = new stdClass();
        
        $testobject->name = "John Doe <b>Hello world Hello world Hello world Hello world Hello world Hello world Hello world Hello world Hello world Hello world Hello world Hello world Hello world Hello world Hello world Hello world Hello world Hello world Hello world Hello worldHello world Hello worldHello world Hello world Hello worldHello world</b>";
        $testobject->email = "john @doe.com";
        $testobject->subject = "John Doe Subject";
        $testobject->text = "Hello world";
        
        $test_result = $this->MailModel->validate($testobject);
       
        echo $this->unit->run($test_result, "is_false", $testname);
        
    }
    
    private function _validateHtmlFailedSimpleHtml()
    {
        $testname = "Validation Failed | Simple HTML in fields";
        
        $testobject = new stdClass();
        
        $testobject->name = "John Doe <b>Hello world</b>";
        $testobject->email = "john@doe.com";
        $testobject->subject = "John Doe Subject";
        $testobject->text = "Hello world";
        
        $test_result = $this->MailModel->validateHtml($testobject);
       
        echo $this->unit->run($test_result, "is_false", $testname);
    }
    
    private function _validatePhpFailed()
    {
        $testname = "Validation Failed | PHP in fields";
        
        $testobject = new stdClass();
        
        $testobject->name = "John Doe <?php echo \"Hello world\";?>";
        $testobject->email = "john@doe.com";
        $testobject->subject = "John Doe Subject";
        $testobject->text = "Hello world";
        
        $test_result = $this->MailModel->validatePhp($testobject);
       
        echo $this->unit->run($test_result, "is_false", $testname);
    }
    
    private function _validateJavascriptFailed()
    {
        $testname = "Validation Failed | JS in fields";
        
        $testobject = new stdClass();
        
        $testobject->name = "John Doe <script>alert(\"Hello world\");</script>";
        $testobject->email = "john@doe.com";
        $testobject->subject = "John Doe Subject";
        $testobject->text = "Hello world";
        
        $test_result = $this->MailModel->validateJavaSript($testobject);
       
        echo $this->unit->run($test_result, "is_false", $testname);
    }
    
    private function _validateTotalFailedHtml()
    {
        $testname = "Validation Failed | Simple HTML in fields";
        
        $testobject = new stdClass();
        
        $testobject->name = "John Doe <b>Hello world</b>";
        $testobject->email = "john@doe.com";
        $testobject->subject = "John Doe Subject";
        $testobject->text = "Hello world";
        
        $test_result = $this->MailModel->validate($testobject);
       
        echo $this->unit->run($test_result, "is_false", $testname);
    }
    
    private function _validateTotalFailedPHP()
    {
        $testname = "Validation Failed | Simple PHP in fields";
        
        $testobject = new stdClass();
        
        $testobject->name = "John Doe <?php echo \"Hello world\";?>";
        $testobject->email = "john@doe.com";
        $testobject->subject = "John Doe Subject";
        $testobject->text = "Hello world";
        
        $test_result = $this->MailModel->validate($testobject);
       
        echo $this->unit->run($test_result, "is_false", $testname);
    }
    
    private function _validateTotalFailedJavaScript()
    {
        $testname = "Validation Failed | Simple JavaScript in fields";
        
        $testobject = new stdClass();
        
        $testobject->name = "John Doe <script>alert(\"Hello world\");</script>";
        $testobject->email = "john@doe.com";
        $testobject->subject = "John Doe Subject";
        $testobject->text = "Hello world";
        
        $test_result = $this->MailModel->validate($testobject);
       
        echo $this->unit->run($test_result, "is_false", $testname);
    }
    
    private function _createSuccess()
    {
        $testname = "Validation Success | Create";
        
        $testobject = new stdClass();
        
        $testobject->name = "John Doe";
        $testobject->email = "john@doe.com";
        $testobject->subject = "John Doe Subject";
        $testobject->text = "Hello world";
        
        $test_result = $this->MailModel->create($testobject);
       
        echo $this->unit->run($test_result, "is_true", $testname);
    }
    
    private function _createFailed()
    {
        $testname = "Validation Failed | Create";
        
        $testobject = new stdClass();
        
        $testobject->name = "John Doe";
        $testobject->email = "john @doe.com";
        $testobject->subject = "John Doe Subject";
        $testobject->text = "Hello world";
        
        $test_result = $this->MailModel->create($testobject);
       
        echo $this->unit->run($test_result, "is_false", $testname);
    }
    
    private function _updateSuccess()
    {
        $testname = "Validation Success | Update";
        
        $testobject = new stdClass();
        
        $testobject->name = "John Doe";
        $testobject->email = "john@doe.com";
        $testobject->subject = "John Doe Subject";
        $testobject->text = "Hello world 1";
        
        $test_result = $this->MailModel->update([
            "id" => 1
        ], $testobject);
       
        echo $this->unit->run($test_result, "is_true", $testname);
    }
    
    private function _updateFailedInvalidData()
    {
        $testname = "Validation Failed | Update | Invalid Data";
        
        $testobject = new stdClass();
        
        $testobject->name = "John Doe <p>Hello world</p>";
        $testobject->email = "john@doe.com";
        $testobject->subject = "John Doe Subject";
        $testobject->text = "Hello world 1";
        
        $test_result = $this->MailModel->update([
            "id" => 1
        ], $testobject);
       
        echo $this->unit->run($test_result, "is_false", $testname);
    }
    
    private function _updateFailedInvalidId()
    {
        $testname = "Validation Failed | Update | Invalid Id";
        
        $testobject = new stdClass();
        
        $testobject->name = "John Doe";
        $testobject->email = "john@doe.com";
        $testobject->subject = "John Doe Subject";
        $testobject->text = "Hello world 1";
        
        $test_result = $this->MailModel->update([
            "id" => 12
        ], $testobject);
       
        echo $this->unit->run($test_result, "is_false", $testname);
    }
    
    private function _readOneSuccessById()
    {
        $testname = "Read Success | One by ID";
        
        $test_result = $this->MailModel->readOne([
            "id" => 1
        ]);
       
        echo $this->unit->run($test_result, "is_object", $testname);
    }
    
    private function _readOneFailedById()
    {
        $testname = "Read Failed | One by ID";
        
        $test_result = $this->MailModel->readOne([
            "id" => 12
        ]);
       
        echo $this->unit->run($test_result, "is_false", $testname);
    }
    
    private function _readAllSuccess()
    {
        $testname = "Read Suucess | All";
        
        $test_result = $this->MailModel->readAll();
       
        echo $this->unit->run($test_result, "is_array", $testname);
    }
    
    private function _deleteSuccess()
    {
        $testname = "Delete Suucess | All";
        
        $test_result = $this->MailModel->delete([
            "id" => 1
        ]);
       
        echo $this->unit->run($test_result, "is_true", $testname);
    }
    
    private function _deleteFailed()
    {
        $testname = "Delete Failed | All";
        
        $test_result = $this->MailModel->delete([
            "id" => 1
        ]);
       
        echo $this->unit->run($test_result, "is_false", $testname);
    }
    
    private function _sendTest()
    {
        $testname = "Send Success";
        
        $object = $this->MailModel->readOne([
            "id" => 2
        ]);
       
        $this->load->library("Mailer");
        
        $this->mailer->connect();
        $this->mailer->setFrom([
            "email" => $object->email,
            "name" => $object->name
        ]);
        $this->mailer->setTo([
            "email" => "snigoviyolexandr@gmail.com",
            "name" => "Olexandr Snigoviy"
        ]);
        
        $this->mailer->setSubject($object->subject);
        $this->mailer->setBody($object->text);
        
        $test_result = $this->mailer->send();
        
        echo $this->unit->run($test_result, "is_true", $testname);
    }
}