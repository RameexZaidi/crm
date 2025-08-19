<?php 
    class LeadsProcess_model extends CI_Model{
        public function GetLeads(){
    $this->db->select('cc_leads_a.id,cc_leads_a.fname,cc_leads_a.fname,mid_init,cc_leads_a.surname,cc_leads_a.phones');
  
    $this->db->where('cc_leads_a.agent_id', $this->session->userdata('user_id'));

    // ✅ Current date filter (adjust the column name if needed)
    $this->db->where('DATE(cc_leads_a.up_time)', date('Y-m-d'));

    $result = $this->db->get('cc_leads_a')->result();

    // ✅ Debug query if needed (move above return)
    // die($this->db->last_query());

    return $result;
}
public function GetAllRemarksByLead($lead_id) {
    $this->db->where('lead_id', $lead_id);
    $query = $this->db->get('tbl_lead_working'); // Replace with your actual table name
    return $query->row();  // assuming one row per lead with all remarks columns
}


 public function GetPreviousLeads(){
    $this->db->select('tbl_lead_assign_detail.id, tbl_lead_assign_detail.user_id, tbl_lead_assign_detail.lead_id , cc_leads_a.fname,cc_leads_a.fname,mid_init,cc_leads_a.surname,cc_leads_a.phones');
    $this->db->join('cc_leads_a', 'cc_leads_a.id = tbl_lead_assign_detail.lead_id');
    $this->db->where('tbl_lead_assign_detail.user_id', $this->session->userdata('user_id'));

    // ✅ Current date filter (adjust the column name if needed)
   
    $result = $this->db->get('tbl_lead_assign_detail')->result();

    // ✅ Debug query if needed (move above return)
    // die($this->db->last_query());

    return $result;
}

public function GetLeadsDetail($lead_id){
    $this->db->select('cc_leads_a.*');
    $this->db->where('cc_leads_a.id',$lead_id);
    return $this->db->get('cc_leads_a')->row_array();
}
public function getLeadWorkingStatus($lead_id)
{
    return $this->db->get_where('tbl_lead_working', ['lead_id' => $lead_id])->row_array();
}
 public function GetUserSpecificRemarks($lead_id, $user_id) {
    $this->db->select('*'); // all fields so we can determine which one matches
    $this->db->from('tbl_lead_working');
    $this->db->where('lead_id', $lead_id);
    $this->db->group_start();
    $this->db->where('super_agent_id', $user_id);
    $this->db->or_where('agent_id', $user_id);
    $this->db->or_where('qualifier_id', $user_id);
    $this->db->or_where('closer_id', $user_id);
    $this->db->group_end();
    $query = $this->db->get();
    return $query->row(); // contains all IDs and remarks
}

 public function GetLeadRemarks($lead_id) {
    $this->db->select('*'); // all fields so we can determine which one matches
    $this->db->from('tbl_lead_working');
    $this->db->where('lead_id', $lead_id);
 
    $query = $this->db->get();
    return $query->row(); // contains all IDs and remarks
}

    }
?>