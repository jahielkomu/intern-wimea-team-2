<?php
class Send_email extends CI_Controller {

    

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('email');
        $this->load->config('email');
        
        //$this->load->library('email');
    }

    public function index() {
   // $this->load->model('Email_model');
    //     $this->email->to('getjohnnasasira@gmail.com');
    // $this->email->from('eagerbeaverdevelopers@gmail.com', 'Identification');
    // $this->email->subject('The beavers');
    // $this->email->message('Hi, John');


     $from = $this->config->item('smtp_user');
     //$to = "tryphn65@gmail.com";
     //$to=$this->Email_model->get_by_id($session_id);
     //echo $to;
     //echo $_SESSION['username'];
     //echo $_SESSION['usertype'];
     //echo $_SESSION['email'];
        $subject = 'Weather';
        $message = "hey, the last weather update has been  uploaded";
        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($_SESSION['email']);
        $this->email->subject($subject);
        $this->email->message($message);
        $filepath = 'application/pictures/gwe.png';
        $this->email->attach($filepath);

        if ($this->email->send()) {
            echo 'Your Email has successfully been sent.';
        } else {
            show_error($this->email->print_debugger());
        }
    /*    
        foreach ($list as $name => $address)
{
        $this->email->clear();

        $this->email->to($address);
        $this->email->from('your@example.com');
        $this->email->subject('Here is your info '.$name);
        $this->email->message('Hi '.$name.' Here is the info you requested.');
        $this->email->send();
}*/
    }



        
       



















    // public function send_mail() {
    //     $from_email = "email@example.com";
    //     $to_email = $this->input->post('email');
    //     //Load email library
    //     $this->load->library('email');
    //     $this->email->from($from_email, 'Identification');
    //     $this->email->to($to_email);
    //     $this->email->subject('Send Email Codeigniter');
    //     $this->email->message('The email send using codeigniter library');
    //     //Send mail
    //     if($this->email->send())
    //         $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
    //     else
    //         $this->session->set_flashdata("email_sent","You have encountered an error");
    //     $this->load->view('contact_email_form');
    // }
}
?>