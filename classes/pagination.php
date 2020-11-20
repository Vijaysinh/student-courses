<?php 
	
	class Pagination{

		private $db, $table, $total_records, $limit = 3, $col;
        
        public function __construct($table){
			$this->table = $table;
            $this->mydb = DB::getInstance();
			$this->set_total_records();
		}

		public function set_total_records(){

			$query  = "SELECT id FROM $this->table";
            $stmt = $this->mydb->getAll($this->table);
            $this->total_records = $stmt->count();
		}

		public function get_data(){
            $start = 0;
			if($this->current_page() > 1){
				$start = ($this->current_page() * $this->limit) - $this->limit;
			}
			return $this->mydb->get($this->table,[],$start, $this->limit);
        }
        
		public function is_search(){
			return isset($_GET['search']) ? $_GET['search'] : '';
		}

		public function current_page(){
			return isset($_GET['page']) ? (int)$_GET['page'] :1;
		}

		public function get_pagination_number(){
            return ceil($this->total_records / $this->limit);
		}

		public function prev_page(){
			return ($this->current_page() > 1) ? $this->current_page() : 1;
		}
		public function next_page(){
			return ($this->current_page() < $this->get_pagination_number()) ? $this->current_page()+1 : $this->get_pagination_number();
		}
		public function is_active_class($page){
			return ($page == $this->current_page()) ? 'active' : '';
		}
	}


 ?>
