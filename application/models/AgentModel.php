<?php 
	class AgentModel extends CI_Model
	{
	    public function insert_user($data)
	    {
	        $this->db->insert('cc_agents', $data);  // Replace 'users' with your actual table name
	        return $this->db->insert_id();
	    }

	    public function GetAgent(){
	        $this->db->select('cc_agents.*,cc_groups.grp_name');
	        $this->db->join('cc_groups','cc_groups.id = cc_agents.grp_id');
	    	return $this->db->get('cc_agents')->result();
	    }
	    
	    public function GetUser(){
	        $this->db->select('mu_users.id , mu_users.u_name,cc_agents.plain_password , mu_users.role , cc_groups.grp_name,cc_agents.login_name,cc_agents.u_name as agent_name,cc_agents.u_enable');
	        $this->db->join('mu_users',',mu_users.user_id = cc_agents.id');
	        $this->db->join('cc_groups',',cc_groups.id = cc_agents.grp_id');
	        return $this->db->get('cc_agents')->result();
	    }
	    
	    public function update_mu_users($user_id, $data) {
    $this->db->where('id', $user_id); // Adjust column if not `id`
    return $this->db->update('mu_users', $data);
    }
    
    public function update_cc_agents($user_id, $data) {
        $this->db->where('id', $user_id); // Adjust column if needed
        return $this->db->update('cc_agents', $data);
    }
    public function update_mu_user_status($user_id, $status, $timestamp) {
    return $this->db->where('id', $user_id)
                    ->update('mu_users', [
                        'u_enable' => $status,
                        'user_status_change_at' => $timestamp
                    ]);
}

public function update_cc_agent_status($user_id, $status, $timestamp) {
    return $this->db->where('id', $user_id)
                    ->update('cc_agents', [
                        'u_enable' => $status,
                        'user_status_change_at' => $timestamp
                    ]);
}

	}

?>