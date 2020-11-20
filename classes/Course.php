
<?php
class Course {
    private $_db,
            $_data;
    

    public function __construct() {
        $this->_db = DB::getInstance();
        $this->table = 'courses';
    }

    public function create($fields = array()) {
        if(!$this->_db->insert($this->table, $fields)) {
            throw new Exception('Sorry, there was a problem creating record;');
        }
    }

    public function update($fields = array(), $id = null) {
        if(!$id) {
            $id = $this->data()->id;
        }
        if(!$this->_db->update($this->table, $id, $fields)) {
            throw new Exception('There was a problem updating');
        }
    }

    public function find($userdata = null) {
        if($userdata) {
            $data = $this->_db->get($this->table, array('id', '=', $userdata));
            if($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    public function findAll() {
        $data = $this->_db->getAll($this->table);
        if($data->count()) {
            $this->_data = $data->results();
            return true;
        }
        return false;
    }

    public function exists() {
        return (!empty($this->_data)) ? true : false;
    }

    public function data(){
        return $this->_data;
    }

    public function filter_course_by_student($student_id){
        $sql = "SELECT * FROM courses where id not in (select course_id from students_subscribed_course where student_id = $student_id)";
        if(!$this->_db->query($sql,[])->error()) {
            return $this->_db->results();
        }
    }

    public function delete_record($id = null) {
        if(!$this->_db->delete($this->table, $id)) {
            throw new Exception('There was a problem remove course');
        }
    }

    
}