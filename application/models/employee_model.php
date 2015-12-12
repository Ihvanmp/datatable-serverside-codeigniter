<?php

class Employee_model extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }


        public function get_datatable_data(){

        //We Need Column Index for Ordering
        $columns = array(
                0 =>'employee_name', 
                1 => 'employee_salary',
                2=> 'employee_age'
        );

        $totalData  = $this->db->count_all('employee');
        $totalFiltered =  $totalData; 

        //Only select column that want to show in datatable or you can filte it mnually when send it
        $this->db->start_cache();
        $this->db->select($columns);
        // if there is a search parameter, $_REQUEST['search']['value'] contains search parameter
        if( !empty($_REQUEST['search']['value']) ){
                $search_value = $_REQUEST['search']['value'];

                $this->db->like('employee_name', $search_value);
                $this->db->or_like('employee_salary', $search_value);
                $this->db->or_like('employee_age', $search_value);
                $this->db->stop_cache();

                $totalFiltered  = $this->db->get('employee')->num_rows();
        }

        $this->db->stop_cache();
        
        $this->db->order_by($columns[$_REQUEST['order'][0]['column']], $_REQUEST['order'][0]['dir']);
        $this->db->limit($_REQUEST['length'], $_REQUEST['start']);

        $query = $this->db->get('employee');

        //Reset Key Array
        $data = array();
        foreach ($query->result_array() as $val) {
                $data[] = array_values($val);
        }

        //Prepare Return Data
        $return = array(
                "draw"            => $_REQUEST['draw'] ,   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                "recordsTotal"    => $totalData,  // total number of records
                "recordsFiltered" => $totalFiltered, // total number of records after searching, if there is no searching then totalFiltered = totalData
                "data"            => $data  // total data array
        );

        return $return;

        }

}