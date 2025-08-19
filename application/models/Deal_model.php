<?php 
    class Deal_model extends CI_Model{
        public function GetDeals(){
            $this->db->select('tbl_lead_working.id as working_id,tbl_lead_working.lead_id,tbl_lead_working.agent_id,tbl_lead_working.agent_remarks,cc_leads_a.*,cc_agents.u_name');
            $this->db->join('cc_leads_a','cc_leads_a.id = tbl_lead_working.lead_id');
            $this->db->join('cc_agents','cc_agents.id = tbl_lead_working.agent_id');
            $this->db->where('tbl_lead_working.convert_into_deal',1);
            return $this->db->get('tbl_lead_working')->result();
        }
        
        public function LeadTracking($lead_id){
            $this->db->select('tbl_lead_working.*,cc_agents.u_name,cc_leads_a.fname,cc_leads_a.mid_init,cc_leads_a.surname,cc_leads_a.phones,cc_leads_a.street,
            cc_leads_a.city,cc_leads_a.state_abb,cc_leads_a.zipcode,cc_leads_a.ssn,cc_leads_a.email,cc_leads_a.dob,cc_leads_a.AA,cc_leads_a.gen_code');
            $this->db->join('cc_agents','cc_agents.id = tbl_lead_working.agent_id');
            $this->db->join('cc_leads_a','cc_leads_a.id = tbl_lead_working.lead_id');
            $this->db->where('tbl_lead_working.lead_id',$lead_id);
            return $this->db->get('tbl_lead_working')->row_array();
        }
        
        public function GetName($user_id){
            $this->db->select('cc_agents.u_name');
            $this->db->where('cc_agents.id',$user_id);
            return $this->db->get('cc_agents')->row_array();
        }
        
        public function GetApproveDeals(){
            $this->db->select('tbl_convert_into_deal.id , tbl_convert_into_deal.deal_code,tbl_convert_into_deal.conversion_date,
            tbl_convert_into_deal.status,tbl_convert_into_deal.admin_remarks,tbl_convert_into_deal.closer_amount,tbl_lead_working.agent_id,
            tbl_lead_working.closer_id , tbl_lead_working.qualifier_id');
            $this->db->join('tbl_lead_working','tbl_lead_working.lead_id = tbl_convert_into_deal.lead_id');
            return $this->db->get('tbl_convert_into_deal')->result();
        }
        

    }
?>