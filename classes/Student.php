
<?php
class Student {
    private $_db,
            $_data;

    public function __construct($user = null) {
        $this->_db = DB::getInstance();
    }

    public function create($table,$fields = array()) {
        if(!$this->_db->insert($table, $fields)) {
            throw new Exception('Sorry, there was a problem creating record;');
        }
    }

    public function update($table,$fields = array(), $id = null) {
        if(!$id) {
            $id = $this->data()->id;
        }
        
        if(!$this->_db->update($table, $id, $fields)) {
            throw new Exception('There was a problem updating student');
        }
    }


    public function delete_record($table,$id = null) {
        if(!$this->_db->delete($table, $id)) {
            throw new Exception('There was a problem remove student');
        }
    }

    public function find($table,$userdata = null) {
        if($userdata) {
            $data = $this->_db->get($table, array('phone', '=', $userdata));
            if($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    public function findByID($table,$id = null) {
        if($id) {
            $data = $this->_db->get($table, array('id', '=', $id));
            if($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    public function findAll($table) {
        $data = $this->_db->getAll($table);
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

}