<?php 
	class LeadManagementModel extends CI_Model{
		public function GetAllLeads()
			{
			    $this->db->select('
			        cc_leads_a.*,
			        cc_agents.u_name
			    ');
			    $this->db->from('cc_leads_a');
			    $this->db->join('cc_agents', 'cc_agents.id = cc_leads_a.agent_id', 'left');
			    $this->db->join('cc_comp', 'cc_comp.id = cc_leads_a.comp_id', 'left');
			    $this->db->limit(100); // Limit to 100 records
			    return $this->db->get()->result();
			}


			public function get_cc_b_leads()
			{
			    $this->db->select('
			        cc_leads_b.*,
			        cc_agents.u_name
			    ');
			    $this->db->from('cc_leads_b');
			    $this->db->join('cc_agents', 'cc_agents.id = cc_leads_b.agent_id', 'left');
			    $this->db->join('cc_comp', 'cc_comp.id = cc_leads_b.comp_id', 'left');
			    $this->db->limit(100); // Limit to 100 records
			    return $this->db->get()->result();
			}

		public function get_unassigned_leads() {
			$this->db->where('agent_id', 0);
			$query = $this->db->get('cc_leads_a');
			return $query->result(); // result() → multiple records
		}


	}
?>
