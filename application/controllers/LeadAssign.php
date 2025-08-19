<?php 
	class LeadAssign extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('Group_model');
			$this->load->model('LeadAssign_model');
		}
		public function Assign(){
			 $data['groups'] = $this->Group_model->get_all();
			$this->load->view('layout/header');
			$this->load->view('lead_assign/assign',$data);
			$this->load->view('layout/footer');
		}
		public function AssignLeadList(){
			 $data['leads'] = $this->LeadAssign_model->GetAssignLeads();
			$this->load->view('layout/header');
			$this->load->view('lead_assign/Assgnleads_listing',$data);
			$this->load->view('layout/footer');
		}

		public function UnAssignLeadList(){
			 $data['un_assign_leads'] = $this->LeadAssign_model->UnAssignedList();
			$this->load->view('layout/header');
			$this->load->view('lead_assign/un_assigned_list',$data);
			$this->load->view('layout/footer');
		}


public function assign_leads_to_group()
{
    $lead_type = $this->input->post('lead_type');
    $group_id = $this->input->post('grp_id');
    $lead_count = (int)$this->input->post('lead_count');

    // Step 1: Get all AGENTS in group, and ensure their role is 'agent' in mu_users
    $agents = $this->db
        ->select('cc_agents.*,mu_users.role')
        ->from('cc_agents')
        ->join('mu_users', 'cc_agents.id = mu_users.user_id')
        ->where('cc_agents.grp_id', $group_id)
        ->where('mu_users.role', 'agent')
        ->get()
        ->result();
    //die($this->db->last_query());
    if (empty($agents)) {
        echo "No valid agents found in selected group.";
        return;
    }

    // Step 2: Calculate total required leads
    $total_required = count($agents) * $lead_count;
    
    // Step 3: Get unassigned leads
    $leads = $this->db->where('agent_id', 0)->limit($total_required)->get($lead_type)->result();
    //die($this->db->last_query());
    if (empty($leads)) {
        echo "No unassigned leads found.";
        return;
    }

    $assigned_count = 0;
    $lead_index = 0;

    foreach ($agents as $agent) {
        for ($i = 0; $i < $lead_count; $i++) {
            if (!isset($leads[$lead_index])) break;

            $this->db->where('id', $leads[$lead_index]->id)->update($lead_type, [
                'agent_id' => $agent->id,
                'up_date' => date('Y-m-d'),
                'up_time' => date('Y-m-d H:i:s')
            ]);

            $assigned_count++;
            $lead_index++;
        }
    }

   $this->session->set_flashdata('success', "$assigned_count leads assigned successfully.");
   return redirect('LeadAssign/Assign');
}

// public function assign_leads_to_group()
// {
//     $grp_id = $this->input->post('grp_id');
//     $number_of_leads = $this->input->post('number_of_leads');
//     $lead_type = $this->input->post('lead_type'); 
//     $current_date = date('Y-m-d');
   
//     // 1. Get group members (active)
//   $agents = $this->db
//     ->select('cc_agents.*') // agar mu_users ka data bhi chahiye toh select('cc_agents.*, mu_users.*')
//     ->from('cc_agents')
//     ->join('mu_users', 'mu_users.user_id = cc_agents.id')
//     ->where('cc_agents.grp_id', $grp_id)
//     ->where('cc_agents.u_enable', 't')
//     ->where('mu_users.role', 'agent')
//     ->get()
//     ->result();

//     $agent_count = count($agents);
   
//     if ($agent_count == 0) {
//         echo "No active agents found for this group.";
//         return;
//     }

//     // 2. Insert into cc_lead_assign_master
//     $master_data = [
//         'grp_id' => $grp_id,
//         'group_member_count' => $agent_count,
//         'assign_date' => $current_date,
//         'assign_at' => date('Y-m-d H:i:s'),
//         'status' => 1
//     ];
//     $this->db->insert('cc_lead_assign_master', $master_data);
//     $master_id = $this->db->insert_id();
    
//     // 3. Get unassigned leads with optional lead_type filter
//     $this->db->where('agent_id', 0);
   
//     $leads = $this->db->limit($number_of_leads)->get('cc_leads_a')->result();
   
//     if (count($leads) == 0) {
//         echo "No unassigned leads available.";
//         return;
//     }

//     // 4. Assign leads to agents (round-robin)
//     $i = 0;
//     foreach ($leads as $lead) {
//         $agent = $agents[$i % $agent_count];

//         // Check login_log
//         $login = $this->db->where('agent_id', $agent->id)
//                           ->like('login_time', $current_date) // assuming datetime
//                           ->get('tbl_login_log')->row();

//         $assign_status = $login ? 1 : 0;

//         // Insert into lead assign detail
//         $this->db->insert('tbl_lead_assign_detail', [
//             'lead_assign_master_id' => $master_id,
//             'user_id' => $agent->id,
//             'lead_id' => $lead->id,
//             'assign_date' => $current_date,
//             'status' => $assign_status
//         ]);

//         // Update cc_leads_a
//         $this->db->where('id', $lead->id)->update('cc_leads_a', [
//             'agent_id' => $agent->id
//         ]);

//         // If logged in, update login_log today_quota and lead_assign
//         if ($assign_status == 1) {
//             $this->db->set('today_quota', 'today_quota+1', FALSE);
//             $this->db->set('lead_assign', 1);
//             $this->db->where('agent_id', $agent->id);
//             $this->db->like('login_time', $current_date);
//             $this->db->update('tbl_login_log');
//         }

//         $i++;
//     }

//     return redirect('LeadMnagement');
// }




	}
?>