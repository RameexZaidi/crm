<?php 
    class DashboardModel extends CI_Model{
        public function CountAssignLeads(){
            $this->db->select('COUNT(cc_leads_a.id) as total_leads');
            $this->db->where('cc_leads_a.agent_id !=', 0);
            return $this->db->get('cc_leads_a')->row_array();
        }
    }
?>