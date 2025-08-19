<?php 
	class LeadAssign_model extends CI_Model{
		public function GetAssignLeads(){
			$this->db->select('cc_leads_a.* , cc_agents.u_name');
			$this->db->join('cc_agents','cc_agents.id = cc_leads_a.agent_id');
			$this->db->where('cc_leads_a.agent_id > 0');
			return $this->db->get('cc_leads_a')->result();
		}



		public function UnAssignedList(){
			$this->db->select('cc_leads_a.*');
			$this->db->where('cc_leads_a.agent_id',0);
			return $this->db->get('cc_leads_a')->result();
		}
	}
?>