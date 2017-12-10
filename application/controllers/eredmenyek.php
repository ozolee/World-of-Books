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

              $all_results = $this->results_list_view($limit, $offset = 0, $team = "");

              //echo '<pre>'; print_r($all_results);die;

              $data = array(
                  'results' => $all_results,
                  'count' => $count,
                  'limit' => $limit,
              );

              $this->home->show($data);
  	}
    public function results_list_view($limit = 0, $offset = 0, $team = ""){

        $results_list = $this->wob_model->results_list_view($limit,$offset,$team);

        if($this->input->is_ajax_request()){

            $team = $this->input->post('team');

            $results_list = $this->wob_model->results_list_view($limit,$offset,$team);
            $count_list = $this->wob_model->count_results_list($team);
            if ($count_list <= $limit){
                $offset = 0;
                $results_list = $this->wob_model->results_list_view($limit,$offset,$team);
            }

            echo json_encode($results_list);
        } else {
            return $results_list;
        }
    }
}
