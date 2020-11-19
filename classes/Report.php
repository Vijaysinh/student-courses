
<?php
class Report {
    private $_db,
            $_data;
    public function __construct($user = null) {
        $this->_db = DB::getInstance();
    }

    public function findAllStudentEnrolledCourses(){
        $sql = "SELECT * FROM `students_subscribed_course` a , students b , courses c where a.student_id=b.id and a.course_id=c.id";

        if(!$this->_db->query($sql,[])->error()) {
            return $this->_db->results();
        }
    }

    
}