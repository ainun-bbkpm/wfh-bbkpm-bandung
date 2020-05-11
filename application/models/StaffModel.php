<?php

use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Join,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;
    
class StaffModel extends CI_Model 
{
    private $editorDb = null;
    
    //constructor which loads the CodeIgniter database class (not required)
    public function __construct()	{
        $this->load->database();
    }    
    
    public function init($editorDb)
    {
        $this->editorDb = $editorDb;
    }
    
    public function getStaff($post)
    {
		// Build our Editor instance and process the data coming from _POST
		// Use the Editor database class
		Editor::inst( $this->editorDb, 'datatables_demo' )
		->fields(
		    Field::inst( 'nama_pegawai')->validator( 'Validate::notEmpty' ),
		    Field::inst( 'last_name' )->validator( 'Validate::notEmpty' ),
		    Field::inst( 'position' ),
		    Field::inst( 'email' ),
		    Field::inst( 'office' ),
		    Field::inst( 'extn' ),
		    Field::inst( 'age' )
		    ->validator( 'Validate::numeric' )
		    ->setFormatter( 'Format::ifEmpty', null ),
		    Field::inst( 'salary' )
		    ->validator( 'Validate::numeric' )
		    ->setFormatter( 'Format::ifEmpty', null ),
		    Field::inst( 'start_date' )
		    ->validator( 'Validate::dateFormat', array(
		        "format"  => Format::DATE_ISO_8601,
		        "message" => "Please enter a date in the format yyyy-mm-dd"
		    ) )
		    ->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
		    ->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 )
		)
		->process( $post )
		->json();    
    }
    
    //An additional method just to see if we can still use the Codeigniter database class (not required)
    public function getStaffMember($id)
    {
        if($id != false) 
        {
            //Use the CodeIgniter database class
            $query = $this->db->get_where('users', array('id' => $id));
            return $query->row_array();
        }
        return false;
    }
}