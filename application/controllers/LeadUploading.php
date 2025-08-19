
<?php 
require_once(APPPATH . '../vendor/autoload.php'); // adjust path if needed
use PhpOffice\PhpSpreadsheet\IOFactory;

	class LeadUploading extends CI_Controller{
		public function index(){
			$this->load->view('layout/header');
			$this->load->view('lead_a/upload_lead_a');
			$this->load->view('layout/footer');
		}

// 		public function upload_excel()
//     {
//     date_default_timezone_set('Asia/Karachi');

//     if ($_FILES['excel_file']['name'] != '') {
//         $config['upload_path']   = './assets/excels/';
//         $config['allowed_types'] = 'xls|xlsx';
//         $config['file_name']     = 'lead_' . time();

//         if (!is_dir($config['upload_path'])) {
//             mkdir($config['upload_path'], 0755, true);
//         }

//         $this->load->library('upload', $config);

//         if (!$this->upload->do_upload('excel_file')) {
//             $error = $this->upload->display_errors();
//             $this->session->set_flashdata('error', $error);
//         } else {
//             try {
//                 $fileData    = $this->upload->data();
//                 $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileData['full_path']);
//                 $sheetData   = $spreadsheet->getActiveSheet()->toArray();

//                 $inserted = 0;

//                 foreach ($sheetData as $key => $row) {
//                     if ($key == 0) continue; // Skip header

//                     $data = [
//                         'fname'     => isset($row[0]) ? $row[0] : null,
//                         'mid_init'  => isset($row[1]) ? $row[1] : null,
//                         'surname'   => isset($row[2]) ? $row[2] : null,
//                         'gen_code'  => isset($row[3]) ? $row[3] : null,
//                         'phones'    => isset($row[4]) ? $row[4] : null,
//                         'street'    => isset($row[5]) ? $row[5] : null,
//                         'city'      => isset($row[6]) ? $row[6] : null,
//                         'state_abb' => isset($row[7]) ? $row[7] : null,
//                         'zipcode'   => isset($row[8]) ? $row[8] : null,
//                         'ssn'       => isset($row[9]) ? $row[9] : null,
//                         'email'     => isset($row[10]) ? $row[10] : null,
//                         'dob'       => isset($row[11]) ? $row[11] : null,
//                         'XFC01'     => isset($row[12]) ? $row[12] : null,
//                         'XFC02'     => isset($row[13]) ? $row[13] : null,
//                         'XFC03'     => isset($row[14]) ? $row[14] : null,
//                         'XFC04'     => isset($row[15]) ? $row[15] : null,
//                         'XFC05'     => isset($row[16]) ? $row[16] : null,
//                         'XFC06'     => isset($row[17]) ? $row[17] : null,
//                         'XFC07'     => isset($row[18]) ? $row[18] : null,
//                         'DEM10'     => isset($row[19]) ? $row[19] : null,
//                         'DEMO7'     => isset($row[20]) ? $row[20] : null,
//                         'DEMO9'     => isset($row[21]) ? $row[21] : null,
//                         'SCORE1'    => isset($row[22]) ? $row[22] : null,
//                         'DEM02'     => isset($row[23]) ? $row[23] : null, // Fixed from row[30]
//                         'DEM08'     => isset($row[24]) ? $row[24] : null,
//                         'ARV05'     => isset($row[25]) ? $row[25] : null,
//                         'ARV06'     => isset($row[26]) ? $row[26] : null,
//                         'ARV16'     => isset($row[27]) ? $row[27] : null,
//                         'ARV17'     => isset($row[28]) ? $row[28] : null,
//                         'ARV18'     => isset($row[29]) ? $row[29] : null,
//                         'AA'        => isset($row[30]) ? $row[30] : null,
//                         't_enable'  => 't',
//                         't_block'   => 'f',
//                     ];


//                     // Debug logs
//                     log_message('debug', 'Row Data: ' . json_encode($row));
//                     log_message('debug', 'Insert Data: ' . json_encode($data));

//                     if (!$this->db->insert('cc_leads_a', $data)) {
//                         // Log DB error
//                         $db_error = $this->db->error();
//                         log_message('error', 'DB Insert Error: ' . json_encode($db_error));
//                         log_message('error', 'Failed Data: ' . json_encode($data));
//                     } else {
//                         $inserted++;
//                     }
//                 }

//                 $this->session->set_flashdata('success', "$inserted records inserted successfully.");
//             } catch (Exception $e) {
//                 log_message('error', 'Exception during file processing: ' . $e->getMessage());
//                 $this->session->set_flashdata('error', 'An error occurred while processing the file.');
//             }
//         }
//     } else {
//         $this->session->set_flashdata('error', 'No file selected!');
//     }

//     redirect($_SERVER['HTTP_REFERER']);
// }




// public function upload_excel()
// {
//     date_default_timezone_set('Asia/Karachi');

//     if ($_FILES['excel_file']['name'] != '') {
//         $config['upload_path']   = './assets/excels/';
//         $config['allowed_types'] = 'xls|xlsx';
//         $config['file_name']     = 'lead_' . time();

//         if (!is_dir($config['upload_path'])) {
//             mkdir($config['upload_path'], 0755, true);
//         }

//         $this->load->library('upload', $config);

//         if (!$this->upload->do_upload('excel_file')) {
//             $error = $this->upload->display_errors();
//             $this->session->set_flashdata('error', $error);
//             redirect($_SERVER['HTTP_REFERER']);
//             return;
//         } else {
//             $fileData    = $this->upload->data();
//             $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileData['full_path']);
//             $sheetData   = $spreadsheet->getActiveSheet()->toArray();

//             // Get header row (first row)
//             $header = $sheetData[0];

//             // Store the full sheet data in session for next step insert
//             $this->session->set_userdata('uploaded_sheet_data', $sheetData);

//             // Define your DB fields here for dropdown
//             $db_fields = [
//                 'fname', 'mid_init', 'surname', 'gen_code', 'phones', 'street', 'city', 'state_abb', 'zipcode',
//                 'ssn', 'email', 'dob', 'XFC01', 'XFC02', 'XFC03', 'XFC04', 'XFC05', 'XFC06', 'XFC07', 'DEM10',
//                 'DEMO7', 'DEMO9', 'SCORE1', 'DEM02', 'DEM08', 'ARV05', 'ARV06', 'ARV16', 'ARV17', 'ARV18', 'AA'
//             ];

//             // Pass header and db_fields to the mapping view
//             $data = [
//                 'header' => $header,
//                 'db_fields' => $db_fields
//             ];

//             $this->load->view('lead_upload_mapping', $data);
//         }
//     } else {
//         $this->session->set_flashdata('error', 'No file selected!');
//         redirect($_SERVER['HTTP_REFERER']);
//     }
// }


// public function upload_excel()
// {
//     date_default_timezone_set('Asia/Karachi');

//     if ($_FILES['excel_file']['name'] != '') {
//         $config['upload_path']   = './assets/excels/';
//         $config['allowed_types'] = 'xls|xlsx';
//         $config['file_name']     = 'lead_' . time();

//         if (!is_dir($config['upload_path'])) {
//             mkdir($config['upload_path'], 0755, true);
//         }

//         $this->load->library('upload', $config);

//         if (!$this->upload->do_upload('excel_file')) {
//             $error = $this->upload->display_errors();
//             $this->session->set_flashdata('error', $error);
//             return redirect($_SERVER['HTTP_REFERER']);
//         } else {
//             $fileData    = $this->upload->data();
//             $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileData['full_path']);
//             $sheetData   = $spreadsheet->getActiveSheet()->toArray();

//             if (empty($sheetData) || count($sheetData[0]) == 0) {
//                 $this->session->set_flashdata('error', 'Excel file is empty or invalid.');
//                 return redirect($_SERVER['HTTP_REFERER']);
//             }

//             // Save to session
//             $this->session->set_userdata('uploaded_sheet_data', $sheetData);

//             // Redirect to map_fields()
//             return redirect('LeadUploading/map_fields');
//         }
//     } else {
//         $this->session->set_flashdata('error', 'No file selected!');
//         return redirect($_SERVER['HTTP_REFERER']);
//     }
// }
// public function map_fields()
// {
//     $sheetData = $this->session->userdata('uploaded_sheet_data');
    
//     if (!$sheetData) {
//         $this->session->set_flashdata('error', 'Session expired. Please upload again.');
//         return redirect('LeadUploading/upload_form');
//     }

//     $header = $sheetData[0]; // First row = column names

//     $db_fields = [
//         'fname', 'mid_init', 'surname', 'gen_code', 'phones', 'street', 'city', 'state_abb', 'zipcode',
//         'ssn', 'email', 'dob', 'XFC01', 'XFC02', 'XFC03', 'XFC04', 'XFC05', 'XFC06', 'XFC07', 'DEM10',
//         'DEMO7', 'DEMO9', 'SCORE1', 'DEM02', 'DEM08', 'ARV05', 'ARV06', 'ARV16', 'ARV17', 'ARV18', 'AA'
//     ];

//     $data = [
//         'header'    => $header,
//         'db_fields' => $db_fields
//     ];
//     $this->load->view('layout/header');
//     $this->load->view('lead_a/lead_uploading_mapping',$data);
//     $this->load->view('layout/footer');
// }


public function upload_excel() {
        date_default_timezone_set('Asia/Karachi');

        if (!empty($_FILES['excel_file']['name'])) {
            $config['upload_path']   = './assets/excels/';
            $config['allowed_types'] = 'xls|xlsx';
            $config['file_name']     = 'lead_' . time();

            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0755, true);
            }

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('excel_file')) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect('LeadUploading/upload_form');
            } else {
                $fileData = $this->upload->data();
                $spreadsheet = IOFactory::load($fileData['full_path']);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();

                if (empty($sheetData) || count($sheetData[0]) == 0) {
                    $this->session->set_flashdata('error', 'Excel sheet is empty or invalid.');
                    redirect('LeadUploading/upload_form');
                }

                $this->session->set_userdata('uploaded_sheet_data', $sheetData);
                redirect('LeadUploading/map_fields'); // Redirect to mapping function
            }
        } else {
            $this->session->set_flashdata('error', 'No file selected!');
            redirect('LeadUploading/upload_form');
        }
    }

    public function map_fields() {
        $sheetData = $this->session->userdata('uploaded_sheet_data');

        if (!$sheetData) {
            $this->session->set_flashdata('error', 'Session expired. Please upload again.');
            redirect('LeadUploading/upload_form');
            return;
        }

        $header = $sheetData[0];

        $db_fields = [
            'fname', 'mid_init', 'surname', 'gen_code', 'phones', 'street', 'city', 'state_abb', 'zipcode',
            'ssn', 'email', 'dob', 'XFC01', 'XFC02', 'XFC03', 'XFC04', 'XFC05', 'XFC06', 'XFC07', 'DEM10',
            'DEMO7', 'DEMO9', 'SCORE1', 'DEM02', 'DEM08', 'ARV05', 'ARV06', 'ARV16', 'ARV17', 'ARV18', 'AA'
        ];

        $data = [
            'header'    => $header,
            'db_fields' => $db_fields
        ];

        $this->load->view('layout/header');
        $this->load->view('lead_a/lead_uploading_mapping',$data);
        $this->load->view('layout/footer');
    }

    // public function process_mapping() {
    //     $mapping = $this->input->post('mapping');

    //     if (!$mapping) {
    //         $this->session->set_flashdata('error', 'Please map fields correctly.');
    //         redirect('LeadUploading/map_fields');
    //     }

    //     // Example only: you can now process and insert into DB
    //     echo "<pre>";
    //     print_r($mapping);
    // }
public function process_mapping()
{
    $mapping = $this->input->post('mapping'); // Array: Excel col index => DB field

    $sheetData = $this->session->userdata('uploaded_sheet_data');
    if (!$sheetData) {
        $this->session->set_flashdata('error', 'Session expired. Please upload the file again.');
        redirect(site_url('LeadUploading/upload_form')); // Ya jahan se form hota hai
        return;
    }

    $inserted = 0;

    foreach ($sheetData as $key => $row) {
        if ($key == 0) continue; // Skip header row

        $data = [];

        // Map each Excel column to the correct DB field according to user's selection
        foreach ($mapping as $colIndex => $dbField) {
            if ($dbField) {
                $data[$dbField] = isset($row[$colIndex]) ? $row[$colIndex] : null;
            }
        }

        // Add fixed values for these fields
        $data['t_enable'] = 't';
        $data['t_block']  = 'f';

        if ($this->db->insert('cc_leads_a', $data)) {
            $inserted++;
        } else {
            $db_error = $this->db->error();
            log_message('error', 'DB Insert Error: ' . json_encode($db_error));
            log_message('error', 'Failed Data: ' . json_encode($data));
        }
    }

    // Clear session data after insert
    $this->session->unset_userdata('uploaded_sheet_data');

    $this->session->set_flashdata('success', "$inserted records inserted successfully.");
    redirect(site_url('LeadUploading'));  // Ya jahan se upload karwana hai
}








	}
?>