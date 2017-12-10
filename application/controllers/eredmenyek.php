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
          'user_id' => $this->session->userdata('user_id'),
          'user_permission' => $this->session->userdata('user_permission'),
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

    public function save_new_result(){
      if($this->input->is_ajax_request()){

        $user_id =  $this->input->post('user_id');

        if($this->input->post('date') && $this->input->post('home_team') && $this->input->post('away_team')
        && $this->input->post('home_score') && $this->input->post('away_score')  && $this->input->post('tournament')
        && $this->input->post('city')  && $this->input->post('country')) {

          $insert = array(
            'date' =>  $this->input->post('date'),
            'home_team' =>  $this->input->post('home_team'),
            'away_team' =>  $this->input->post('away_team'),
            'home_score' =>  $this->input->post('home_score'),
            'away_score' =>  $this->input->post('away_score'),
            'tournament' =>  $this->input->post('tournament'),
            'city' =>  $this->input->post('city'),
            'country' =>  $this->input->post('country')
          );

          $result_id = $this->wob_model->insert_result($insert);

          if($result_id) {

            $insert_user_result = array(
              'user_id' => $user_id,
              'result_id' => $result_id
            );

            $user_result = $this->wob_model->insert_users_result($insert_user_result);

            if($user_result){

                $this->session->set_flashdata('success',lang('success_result_insert'));

                $this->output->set_output(json_encode(array(
                    'success'   => true,
                    'result_id' => $result_id
                )));
                return;

              } else {
                  $this->output->set_output(json_encode(array(
                      'success'   => false,
                      'msg'       => lang('error_insert')
                  )));
                  return;
              }

          } else {
              $this->output->set_output(json_encode(array(
                  'success'   => false,
                  'msg'       => lang('error_insert')
              )));
              return;
          }

        } else {
            $this->output->set_output(json_encode(array(
                'success'   => false,
                'msg'       => lang('error_empty_field')
            )));
            return;
        }

        } else {
            redirect('/');
        }

    }
}
