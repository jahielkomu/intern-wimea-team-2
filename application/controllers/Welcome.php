<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
	parent::__construct();
	$this->load->library(array('form_validation'));
	}
   public function index()
   {
     $this->form_validation->set_rules('name', 'Name', 'required');
$this->form_validation->set_rules('email', 'Email', 'required');
// $this->form_validation->set_rules('pdffile', 'Document', 'required');

if ($this->form_validation->run() == false) {
    $this->load->view('myform');
}
//  else {

//     $this->load->view('success');
// }
else {
    $config['upload_path'] = './documents/';
    $config['allowed_types'] = 'pdf|csv';
    // $config['max_size'] = '1000';
    // $config['max_width'] = '1024';
    // $config['max_height'] = '768';

    $this->load->library('upload', $config);

    $this->upload->initialize($config);
    if (!$this->upload->do_upload('pdffile')) {
        echo $this->upload->display_errors();

        if ($_FILES['pdffile']['error'] != 4) {
            $this->load->view('myform');

        }
        //    $this->load->view('myform');

    } else {
        $data = $this->upload->data();
        // $data will contain full inforation
        // echo $data['full_path'];
        // call your libraryt= to convert to csv
        $this->load->library("Csvconverter");
        $this->csvconverter->convert($data['full_path'], $data['raw_name']);
        $this->load->view('success');

    }

}

    }
}

		