<?php 
class BlankLead extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('BlankLead_model');
    }
    public function index(){
        $this->load->view('layout/header');
        $this->load->view('lead_working/blank_leads');
        $this->load->view('layout/footer');
    }
    
   public function store()
    {
        $this->load->library('session');

        // Generate Unique Reference Number
        do {
            $reference_number = 'Z' . strtoupper(substr(md5(time() . rand()), 0, 9));
        } while ($this->BlankLead_model->is_reference_exists($reference_number));

        $data = array(
            'reference_number' => $reference_number,
            'fname' => $this->input->post('fname'),
            'mid_init' => $this->input->post('mid_init'),
            'surname' => $this->input->post('surname'),
            'phones' => $this->input->post('phones'),
            'street' => $this->input->post('street'),
            'city' => $this->input->post('city'),
            'state_abb' => $this->input->post('state_abb'),
            'zipcode' => $this->input->post('zipcode'),
            'ssn' => $this->input->post('ssn'),
            'email' => $this->input->post('email'),
            'gen_code' => $this->input->post('gen_code'),
            'dob' => $this->input->post('dob'),

            'XFC01' => $this->input->post('XFC01'),
            'XFC02' => $this->input->post('XFC02'),
            'XFC03' => $this->input->post('XFC03'),
            'XFC04' => $this->input->post('XFC04'),
            'XFC05' => $this->input->post('XFC05'),
            'XFC06' => $this->input->post('XFC06'),
            'XFC07' => $this->input->post('XFC07'),
            'DEM10' => $this->input->post('DEM10'),
            'DEMO7' => $this->input->post('DEMO7'),
            'DEMO9' => $this->input->post('DEMO9'),
            'SCORE1' => $this->input->post('SCORE1'),
            'DEM02' => $this->input->post('DEM02'),
            'DEM08' => $this->input->post('DEM08'),
            'ARV05' => $this->input->post('ARV05'),
            'ARV06' => $this->input->post('ARV06'),
            'ARV16' => $this->input->post('ARV16'),
            'ARV17' => $this->input->post('ARV17'),
            'ARV18' => $this->input->post('ARV18'),

            'up_user' => $this->session->userdata('user_id'),  // Get from session
            'up_type' => $this->session->userdata('role'),     // Get from session
        );

        $this->BlankLead_model->insert($data);

        $this->session->set_flashdata('success', 'Lead inserted successfully!');
        return redirect('BlankLead/');  // or wherever your form page is
    }

    private function generate_reference_number() {
        $this->load->helper('string');
        do {
            $ref = 'Z-' . strtoupper(random_string('alnum', 7));
        } while ($this->BlankLead_model->check_reference_exists($ref));
        return $ref;
    }

   public function GetBlankLead(){
       $data['blank_lead'] = $this->BlankLead_model->GetBlankDeal();
       $this->load->view('layout/header');
       $this->load->view('lead_working/blank_leads_listing',$data);
       $this->load->view('layout/footer');
   }
   
   
   public function BlankLeadDetail($lead_id){
       $data['leads'] = $this->BlankLead_model->BlankDealDetail($lead_id);
    //   print_r($data['leads']);
    //   die;
       $this->load->view('layout/header');
       $this->load->view('lead_working/blank_lead_detail',$data);
       $this->load->view('layout/footer');
   }
   public function update($id)
    {
        $data = [
            'fname'                   => $this->input->post('f_name'),
            'mid_init'                => $this->input->post('u_father'),
            'surname'                 => $this->input->post('u_mobile'),
            'phones'                  => $this->input->post('phones'),
            'street'                  => $this->input->post('street'),
            'city'                    => $this->input->post('city'),
            'state_abb'               => $this->input->post('state_abb'),
            'zipcode'                 => $this->input->post('zipcode'),
            'ssn'                     => $this->input->post('ssn'),
            'email'                   => $this->input->post('email'),
            'gen_code'                => $this->input->post('gen_code'),
            'dob'                     => $this->input->post('jn_date'),
            'AA'                      => $this->input->post('AA'),
            'updated_by'              => $this->session->userdata('user_id'),
            'update_role_type'        => $this->session->userdata('role'),
            'updated_at'              => date('Y-m-d H:i:s'),
        ];
    
        $this->db->where('id', $id);
        $this->db->update('cc_leads_a', $data);
    
        $this->session->set_flashdata('success', 'Lead updated successfully!');
        redirect('BlankLead/GetBlankLead'); // update with your view
    }
    
    public function toggle_status($id)
{
    $lead = $this->db->get_where('cc_leads_a', ['id' => $id])->row();

    if ($lead) {
        $new_status = ($lead->t_enable == 't') ? 'f' : 't';
        $this->db->where('id', $id);
        $this->db->update('cc_leads_a', ['t_enable' => $new_status]);

        $this->session->set_flashdata('success', 'Lead status updated!');
    } else {
        $this->session->set_flashdata('error', 'Lead not found.');
    }

    redirect('BlankLead/GetBlankLead'); // replace with your actual listing route
}


}
?>