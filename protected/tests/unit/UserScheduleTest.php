<?php
require_once('../../../protected/models/UserSchedule.php');
$yiit='../../../framework/yiit.php';
require_once($yiit);

class UserScheduleTest extends CDbTestCase {
    protected $fixture;
    protected $db;

    protected function setUp() {
        $this->db = new CDbConnection('mysql:host=conuscheduler.ddns.net;dbname=soen341','soen341','soen341');
        $this->db->active=true;
        CActiveRecord::$db=$this->db;
        $this->fixture = new UserSchedule;
    }

    protected function tearDown() {
        if($this->db)
            $this->db->active=false;
    }

    public function testTableName() {
        $expected = 'user_schedule';
        $results = $this->fixture->tableName();
        $this->assertEquals($expected,$results);
    }

    public function testRules() {
        $expected = array(
            array('scheduleID, courseID, sectionID, subsectionID, year', 'required'),
            array('scheduleID, courseID, sectionID, subsectionID, year', 'numerical', 'integerOnly'=>true),
            array('ID, scheduleID, courseID, sectionID, subsectionID, year', 'safe', 'on'=>'search'),
        );
        $results = $this->fixture->rules();
        $this->assertEquals($expected,$results);
    }

    public function testRelations() {

        $expected = array(
            'scheduleID' => array(UserSchedule::BELONGS_TO, 'UserSchedules', 'ID')
        );
        $results = $this->fixture->relations();
        $this->assertEquals($expected,$results);
    }

    public function testAttributeLabels() {
        $expected = array(
            'ID' => 'ID',
            'scheduleID' => 'Schedule',
            'courseID' => 'Course',
            'sectionID' => 'Section',
            'subsectionID' => 'Subsection',
            'year' => 'Year',
        );
        $results = $this->fixture->attributeLabels();
        $this->assertEquals($expected, $results);
    }

    public function testSearch() {
        $stub = $this->getMockBuilder('CDbCriteria')
            ->disableOriginalConstructor()
            ->getMock();
        $stub->expects($this->any())
            ->method('compare')
            ->will($this->returnValue('true'));
    }

    public function testModel() {
        $stub = $this->getMockBuilder('UserSchedule')
                ->disableOriginalConstructor()
                ->getMock();
        $stub->expects($this->any())
            ->method('model')
            ->will($this->returnValue($this->fixture));
        $this->assertNotNull($stub);
    }
}
