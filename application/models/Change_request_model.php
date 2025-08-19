<?php 
    class Change_request_model extends CI_Model {

    public function create($data) {
        return $this->db->insert('change_requests', $data);
    }

    public function get_all() {
        return $this->db->select('cr.*, u.name as user_name, r.title as report_title')
                        ->from('change_requests cr')
                        ->join('users u', 'cr.user_id = u.id')
                        ->join('reports r', 'cr.report_id = r.id')
                        ->order_by('cr.created_at', 'DESC')
                        ->get()->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where('change_requests', ['id' => $id])->row();
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('change_requests', $data);
    }
    
    public function GetReportForRequest($id){
        $this->db->select('
        cc_reqrpt.id as report_id , 
        cc_reqrpt.dl_id,
        tbl_lead_working.agent_id , 
        tbl_lead_working.super_agent_id,
        tbl_lead_working.report_request,
        cc_leads_a.fname,
        cc_leads_a.mid_init,
        cc_leads_a.surname,cc_leads_a.phones,
        cc_leads_a.street,
        cc_leads_a.city,
        cc_leads_a.state_abb,
        cc_leads_a.zipcode,
        cc_leads_a.ssn,
        cc_leads_a.email,
        cc_leads_a.gen_code,
        cc_leads_a.dob
        ');
        $this->db->join('tbl_lead_working','tbl_lead_working.lead_id = cc_reqrpt.dl_id','left');
        $this->db->join('cc_leads_a','cc_leads_a.id = cc_reqrpt.dl_id','left');
        //$this->db->join('cc_agents','cc_agents.id = change_requests.user_id');
        //$this->db->join('mu_users','mu_users.user_id = cc_agents.id');
        $this->db->where('tbl_lead_working.report_request',1);
        $this->db->where('cc_reqrpt.id',$id);
        return $this->db->get('cc_reqrpt')->result();
    }
    
    public function GetChangeRequest($id){
        $this->db->select('
       
        change_requests.id as change_request_id ,
        change_requests.report_id,
        change_requests.user_id,
        change_requests.created_at,
        change_requests.column_name,
        change_requests.requested_change,
        cc_leads_a.id as lead_id,
        cc_leads_a.fname,
        cc_leads_a.mid_init,
        cc_leads_a.surname,
        cc_leads_a.phones,
        cc_leads_a.street,
        cc_leads_a.city,
        cc_leads_a.state_abb,
        cc_leads_a.zipcode,
        cc_leads_a.ssn,
        cc_leads_a.email,
        cc_leads_a.gen_code,
        cc_leads_a.dob,
        cc_leads_a.AA,
        cc_agents.u_name,
        mu_users.role	
        ');
        $this->db->join('cc_reqrpt','cc_reqrpt.id = change_requests.report_id');
        $this->db->join('cc_leads_a','cc_leads_a.id = cc_reqrpt.dl_id');
        $this->db->join('cc_agents','cc_agents.id = change_requests.user_id');
        $this->db->join('mu_users','mu_users.user_id = cc_agents.id');
        $this->db->where('change_requests.id',$id);
        return $this->db->get('change_requests')->row_array();
    }
    
    
    public function ViewChangeRequest(){
        $this->db->select('
        change_requests.id ,
        change_requests.report_id,
        change_requests.user_id,
        change_requests.created_at,
        change_requests.column_name,
        cc_leads_a.id as lead_id,
        cc_leads_a.fname,
        cc_leads_a.mid_init,
        cc_leads_a.surname,
        cc_leads_a.phones,
        cc_leads_a.street,
        cc_leads_a.city,
        cc_leads_a.state_abb,
        cc_leads_a.zipcode,
        cc_leads_a.ssn,
        cc_leads_a.email,
        cc_leads_a.gen_code,
        cc_leads_a.dob,
        cc_leads_a.AA,
        cc_agents.u_name,
        mu_users.role	
        ');
        $this->db->join('cc_reqrpt','cc_reqrpt.id = change_requests.report_id');
        $this->db->join('cc_leads_a','cc_leads_a.id = cc_reqrpt.dl_id');
        $this->db->join('cc_agents','cc_agents.id = change_requests.user_id');
        $this->db->join('mu_users','mu_users.user_id = cc_agents.id');
       
        return $this->db->get('change_requests')->result();
    }
}

?>