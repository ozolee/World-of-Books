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

            $answer = array(
              'success' => true,
              'results_list' => $results_list,
              'count_list'  => $count_list
            );

            echo json_encode($answer);
        } else {
            return $results_list;
        }
    }

    public function pagination_calibrate(){
        if($this->input->is_ajax_request()){

            $limit      = $this->input->post('limit');
            $team       = $this->input->post('team');

            $total = $this->wob_model->count_results_list($team);
            $count = ceil($total/$limit);

            $answer = array(
              'total' => $total,
              'count' => $count
            );

            echo json_encode($answer);

        } else {
            redirect('/');
        }
    }

    public function save_new_result(){
      if($this->input->is_ajax_request()){

        $user_id =  $this->input->post('user_id');
        $team = $this->input->post('filter_team');

        if($this->input->post('date') && $this->input->post('home_team') && $this->input->post('away_team')
        && $this->input->post('home_score') && $this->input->post('away_score')  && $this->input->post('tournament')
        && $this->input->post('city')  && $this->input->post('country')) {

          if($this->input->post('date') > date('Y-m-d')){

              $this->output->set_output(json_encode(array(
                  'success'   => false,
                  'msg'       => lang('error_date')
              )));
              return;

          } else {

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

                  $count = $this->wob_model->count_results_list($team);

                  $this->output->set_output(json_encode(array(
                      'success'   => true,
                      'result_id' => $result_id,
                      'count'   => $count,
                      'msg' => lang('success_result_insert')
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

    public function get_datas(){
        if($this->input->is_ajax_request()){

            $result_id =  $this->input->post('result_id');

            $result = $this->wob_model->get_result_where(array('results.id' => $result_id));

                if(empty($result)) {
                    $this->output->set_output(json_encode(array(
                        'success'   => false,
                        'msg'       => lang('error_query')
                    )));
                    return;

                } else {

                    $this->output->set_output(json_encode(array(
                        'success'   => true,
                        'result_id'   => $result->id,
                        'date'        => $result->date,
                        'home_team'   => $result->home_team,
                        'away_team'   => $result->away_team,
                        'home_score'   => $result->home_score,
                        'away_score'   => $result->away_score,
                        'tournament'   => $result->tournament,
                        'city'      => $result->city,
                        'country'   => $result->country,
                    )));
                    return;
                }

        } else {
            redirect('/');
        }

    }

    public function update_result(){
        if($this->input->is_ajax_request()){

            $result_id =  $this->input->post('result_id');

            if($this->input->post('date') && $this->input->post('home_team') && $this->input->post('away_team')
            && $this->input->post('home_score') && $this->input->post('away_score')  && $this->input->post('tournament')
            && $this->input->post('city')  && $this->input->post('country'))
            {

              if($this->input->post('date') > date('Y-m-d')){

                  $this->output->set_output(json_encode(array(
                      'success'   => false,
                      'msg'       => lang('error_date')
                  )));
                  return;

              } else {

                $update = array(
                  'date' =>  $this->input->post('date'),
                  'home_team' =>  $this->input->post('home_team'),
                  'away_team' =>  $this->input->post('away_team'),
                  'home_score' =>  $this->input->post('home_score'),
                  'away_score' =>  $this->input->post('away_score'),
                  'tournament' =>  $this->input->post('tournament'),
                  'city' =>  $this->input->post('city'),
                  'country' =>  $this->input->post('country')
                );

                $done = $this->wob_model->update_result($result_id, $update);

                if($done) {

                    $this->output->set_output(json_encode(array(
                        'success'   => true,
                        'date'        => $update['date'],
                        'home_team'   => $update['home_team'],
                        'away_team'   => $update['away_team'],
                        'home_score'   => $update['home_score'],
                        'away_score'   => $update['away_score'],
                        'tournament'   => $update['tournament'],
                        'city'      => $update['city'],
                        'country'   => $update['country'],
                        'msg'   => lang('success_result_update')

                    )));
                    return;

                } else {
                    $this->output->set_output(json_encode(array(
                        'success'   => false,
                        'msg'       => lang('error_update')
                    )));
                    return;
                }
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

    public function delete_result(){
        if($this->input->is_ajax_request()){

            $result_id  =  $this->input->post('result_id');
            $team  =  $this->input->post('filter_team');

            $check = $this->wob_model->get_result_where(array('results.id' => $result_id));

            if(empty($check)) {

                $this->output->set_output(json_encode(array(
                    'success'   => false,
                    'msg'       => lang('error_data_values')
                )));
                return;

            } else {

                $delete_result = $this->wob_model->delete_result(array('id' => $result_id));
                $delete_users_result = $this->wob_model->delete_users_result(array('result_id' => $result_id));

                if($delete_result && $delete_users_result){

                    $count = $this->wob_model->count_results_list($team);

                    $this->output->set_output(json_encode(array(
                        'success'   => true,
                        'count'     => $count,
                        'msg'   => lang('success_result_delete')
                    )));
                    return;

                } else {
                    $this->output->set_output(json_encode(array(
                        'success'   => false,
                        'msg'       => lang('error_delete')
                    )));
                    return;
                }
            }


        } else {
            redirect('/');
        }

    }
}
