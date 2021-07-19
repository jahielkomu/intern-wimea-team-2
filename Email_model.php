<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_model extends CI_Model
{

    public $table = 'users';
    public $id = 'id';
    //public $name='username';
    

    function __construct()
    {
        parent::__construct();
    }
    public function get_by_id($id)
    {
        $this->db->select('email');
        $this->db->from($this->table);
        $this->db->where('id', $this->id);
        $query =$this->db->get();
        //return $query->row();

        if ($query->num_rows() == 1)
        {

        $val = $query->row();
      // $dat = $query->result_array();
       //var_dump($dat);
        // $dat = return  var_dump($val);
        //return $val['email'];  
       // $result = (array) json_decode($val);
        //return $query;
        //return $val->result;
        return $val->email; 
        //echo $this->id; 
        }
        else{
            echo $id;
           // print_r('no row');
        }
       
        
    }
     // update data
    /* public function getEmail($id)
     {    
        $this->db->select('email');
        $this->db->from('users');
        $this->db->where('id', $id);
       
        //$this->db->order_by('seasonal_updates.issue_time', $this->order);   
        $query=$this->db->get();   
        //return $query->row();
        if ($query->num_rows() == 1)
     {
     $val = $query->row();
     return $val->result;    
     }
     else{
         print_r();
     }
    }

        /*
          $sql = "SELECT email FROM $this->table WHERE $this->table.id = $id";
         return $this->db->query->$result($sql, $email);*/
     
      // get all
    /*public function get_all()
    {
        $this->db->order_by($this->$id);
       
	   return $this->db->get($this->table)->result();
    }*/

    
    
}?>