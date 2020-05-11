<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EditorLib {
    
    private $CI = null;
    
    function __construct()
    {
        $this->CI = &get_instance();
    }   

	public function process($post)
	{	
	    // DataTables PHP library
		require dirname(__FILE__).'/Editor-PHP-1.5.4/DataTables.php';
		
		//Load the model which will give us our data
		$this->CI->load->model('StaffModel');
		
		//Pass the database object to the model
		$this->CI->StaffModel->init($db);
		
		//Let the model produce the data
		$this->CI->StaffModel->getStaff($post);
	}
}

