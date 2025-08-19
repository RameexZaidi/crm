<?php 
    class LeadWorkingModel extends CI_Model{
        public function GetAssignedLead(){
            $this->db->select('cc_leads_a.* , cc_agents.u_name');
            $this->db->join('cc_agents','cc_agents.id = cc_leads_a.agent_id');
            $this->db->where('cc_leads_a.agent_id',$this->session->userdata('user_id'));
            return $this->db->get('cc_leads_a')->result();
        }
        
        
        public function GetAssignedLeadById($lead_id){
            $this->db->select('cc_leads_a.* , cc_agents.u_name');
            $this->db->join('cc_agents','cc_agents.id = cc_leads_a.agent_id');
            $this->db->where('cc_leads_a.agent_id',$this->session->userdata('user_id'));
            $this->db->where('cc_leads_a.id',$lead_id);
            return $this->db->get('cc_leads_a')->row_array();
        }
        
        public function get_users_by_role($role)
            {
                return $this->db->where('role', $role)->get('mu_users')->result();
            }
        public function get_user_by_id($id)
        {
            return $this->db->where('id', $id)->get('mu_users')->row();
        }
        
       

    }
?>