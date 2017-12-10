<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eredmenyek extends CI_Controller {


        public function __construct() {

            parent::__construct();

            if(!$this->session->userdata('logged_in')) {
                redirect(site_url());
            }
        }

        public function index(){

                  $limit = 10;
                  $total = $this->wob_model->count_results(array());
                  $count = ceil($total/$limit);

                  $all_results = $this->wob_model->get_results_where_limit($limit, $offset = 0, array());

                  //echo '<pre>'; print_r($all_results);die;

                  $data = array(
                      'results' => $all_results,
                      'count' => $count,
                      'limit' => $limit,
                  );

                  $this->home->show($data);
      	}
}
