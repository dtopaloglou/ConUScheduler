<?php

require_once('../../../protected/models/LoginForm.php');
require_once('../../../protected/components/UserIdentity.php');
$yiit='../../../framework/yiit.php';
require_once($yiit);

class LoginFormTest extends CTestCase
{
    protected $fixture;
    protected function setUp() {
        $this->fixture = new LoginForm;
        $this->fixture->username = "erin";
        $this->fixture->password = "soen341";
        $this->fixture->rememberMe = "0";
    }

    protected function tearDown() {
    }

    public function testRules() {
        $stub = array(array('username, password', 'required'),
            array('rememberMe', 'boolean'),
            array('password', 'authenticate'));
        $results = $this->fixture->rules();
        $this->assertEquals($stub,$results);
    }

    public function testAttributeLabels() {
        $stub = array('rememberMe'=>'Remember me next time',);
        $results = $this->fixture->attributeLabels();

        $this->assertEquals($stub, $results);
    }

    public function testAuthenticate() {
        $stub = $this->getMockBuilder('UserIdentity')
            ->disableOriginalConstructor()
            ->getMock();
        $stub->expects($this->any())
            ->method('authenticate')
            ->will($this->returnValue('true'));
    }

    public function testLogin_2() {
        $stub = $this->getMockBuilder('LoginForm')
            ->disableOriginalConstructor()
            ->getMock();
        $stub->expects($this->any())
            ->method('login')
            ->will($this->returnValue('true'));
        $this->assertEquals('true', $stub->login());
    }
}

