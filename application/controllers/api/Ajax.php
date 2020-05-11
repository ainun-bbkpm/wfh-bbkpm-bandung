<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
    
	public function staff()
	{	
	    //Load our library EditorLib 
        $this->load->library('EditorLib');
        
        // print_r($_POST);
		// die();
		//`Call the process method to process the posted data
        $this->editorlib->process($_POST);
        

	}



	
}