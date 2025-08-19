<?php
class User_model extends CI_Model {

   public function get_user($username) {
    return $this->db->select('mu.*, ca.grp_id') // mu = mu_users alias, ca = cc_agents alias
        ->from('mu_users mu')
        ->join('cc_agents ca', 'ca.id = mu.user_id', 'left')
        ->where('mu.u_name', $username)
        ->get()
        ->row();
}

    
    public function log_agent_login($agent_id, $group_id)
    {
        $today = date('Y-m-d');
    
        $this->db->where('agent_id', $agent_id);
        $this->db->where('DATE(created_at)', $today);
        $this->db->where('u_enable', 't');
        $query = $this->db->get('mu_users');
    
        if ($query->num_rows() == 0) {
            $data = [
                'agent_id'   => $agent_id,
                'group_id'   => $group_id,
                'login_time' => date('Y-m-d H:i:s'),
                'status'     => '1', // you can make this configurable if needed
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('tbl_login_log', $data);
        }
    }

}
