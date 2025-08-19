<?php 
    class Report_model extends CI_Model{
        public function GetReportRequest(){
            $this->db->select('tbl_lead_working.id , tbl_lead_working.lead_id , tbl_lead_working.report_request,tbl_lead_working.remarks_at,
            cc_leads_a.fname
            ,cc_leads_a.mid_init,cc_leads_a.surname,cc_leads_a.phones,cc_leads_a.street,cc_leads_a.city,cc_leads_a.ssn,tbl_lead_working.agent_id , 
            tbl_lead_working.qualifier_id,tbl_lead_working.closer_id');
            $this->db->join('cc_leads_a','cc_leads_a.id = tbl_lead_working.lead_id');
            $this->db->where('tbl_lead_working.report_request',1);
            return $this->db->get('tbl_lead_working')->result();
        }
        
        public function GetLeadsDetail($lead_id){
            $this->db->select('cc_leads_a.*');
            $this->db->where('cc_leads_a.id',$lead_id);
            return $this->db->get('cc_leads_a')->row_array();
        }
        
        public function GetUploadedReport(){
            $this->db->select('cc_reqrpt.id , cc_reqrpt.fileupload, cc_reqrpt.dl_id,cc_leads_a.fname,cc_leads_a.mid_init,cc_leads_a.surname,cc_leads_a.phones');
            $this->db->join('cc_leads_a','cc_leads_a.id = cc_reqrpt.dl_id');
            return $this->db->get('cc_reqrpt')->result();
        }
        
        public function ShowLeadsTouser(){
            $this->db->select('cc_reqrpt.id , cc_reqrpt.ag_id,cc_reqrpt.fileupload,cc_reqrpt.cr_date,cc_leads_a.fname,
            cc_leads_a.mid_init,cc_leads_a.surname,cc_leads_a.phones,cc_leads_a.street,cc_leads_a.city,
            cc_leads_a.ssn');
            $this->db->join('cc_leads_a','cc_leads_a.id = cc_reqrpt.dl_id');
            $this->db->where('cc_reqrpt.ag_id',$this->session->userdata('user_id'));
            $this->db->where('cc_reqrpt.t_enable','t');
            return $this->db->get('cc_reqrpt')->result();
        }
        
        public function ReportTracking(){
            $this->db->select('cc_reqrpt.id,cc_reqrpt.dl_id,cc_reqrpt.ag_id,cc_reqrpt.change_request,cc_reqrpt.t_enable
            ,change_requests.id as req_id,
            ,change_requests.column_name,
            ,change_requests.requested_change,
            ,change_requests.status,
            cc_agents.u_name,
            cc_leads_a.fname,
            cc_leads_a.mid_init,
            cc_leads_a.mid_init,
            cc_leads_a.surname,
            cc_leads_a.ssn,
            ');
            $this->db->join('change_requests','change_requests.report_id = cc_reqrpt.id');
            $this->db->join('cc_agents','cc_agents.id = cc_reqrpt.ag_id');
            $this->db->join('cc_leads_a','cc_leads_a.id = cc_reqrpt.dl_id');
            $this->db->group_by('change_requests.report_id');
            return $this->db->get('cc_reqrpt')->result();
        }
    }
?>