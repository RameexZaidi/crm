<?php 
	class Group_model extends CI_Model {

    protected $table = 'cc_groups';

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function get_all() {
        return $this->db->get($this->table)->result();
    }
}

?>