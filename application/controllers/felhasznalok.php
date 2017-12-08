<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class felhasznalok extends CI_Controller {


        public function __construct() {

            parent::__construct();

            if(!$this->session->userdata('logged_in')) {
                redirect(site_url());
            }
        }

	public function index(){

    $users = $this->wob_model->get_all_users();

    $data = array(
      'users' => $users,
    );

    $this->home->show($data);

	}




}
