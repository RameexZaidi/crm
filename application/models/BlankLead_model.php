<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BlankLead_model extends CI_Model {

   public function insert($data)
    {
        return $this->db->insert('cc_leads_a', $data);
    }

    public function is_reference_exists($ref)
    {
        return $this->db->where('reference_number', $ref)->count_all_results('cc_leads_a') > 0;
    }
    
    public function GetBlankDeal(){
        $this->db->select('cc_leads_a.*,cc_agents.u_name');
        $this->db->join('cc_agents','cc_agents.id = cc_leads_a.up_user');
        $this->db->where('cc_leads_a.up_type',"agent");
        return $this->db->get('cc_leads_a')->result();
    }
    
    public function BlankDealDetail($lead_id)
    {
        $this->db->select('cc_leads_a.* ,cc_agents.u_name');
        $this->db->join('cc_agents','cc_agents.id = cc_leads_a.up_user');
        $this->db->where('cc_leads_a.id',$lead_id);
        return $this->db->get('cc_leads_a')->row_array();
    }
    public function update_lead($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('cc_leads_a', $data);
    }

    
}
