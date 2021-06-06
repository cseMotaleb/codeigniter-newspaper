<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backup extends CI_Controller {

    var $data = array();

    var $table = 'authors';

    function __construct()
    {
		parent::__construct();
		$this->load->model(array('admin/login_model'));
		$this->login_model->auth_user();
    }

    public function index()
    {
    	$tables = $this->db->list_tables('timetune_datanews');
		$this->load->dbutil();
		$prefs = array(
                'tables'      => (is_array($tables)) ? $tables : array(),  // Array of tables to backup.
                'ignore'      => array(),           // List of tables to omit from the backup
                'format'      => 'zip',             // gzip, zip, txt
                'filename'    => 'my_db_backup.sql',    // File name - NEEDED ONLY WITH ZIP FILES
                'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                'newline'     => "\n"               // Newline character used in backup file
              );
		$backup = $this->dbutil->backup($prefs);

        $db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
        $save = './uploads/_tmp/'.$db_name;
        $this->load->helper('file');
        write_file($save, $backup);

        $this->load->helper('download');
        force_download($db_name, $backup);
    } 
}