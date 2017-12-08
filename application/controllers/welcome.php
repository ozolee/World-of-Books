<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {


        public function __construct() {

            parent::__construct();
        }

	public function index(){

		$this->home->show();
	}


    public function login(){
        if($this->input->is_ajax_request()){

            $email = $this->input->post('email');
            $pass = $this->input->post('pass');

            $pass = sha1($this->input->post('pass'));

            $email_check = $this->wob_model->get_user_where(array('email' => $email));

            if(empty($email_check)) {
                $this->output->set_output(json_encode(array(
                    'success'   => false,
                    'msg'       => 'Ilyen e-mail cím nem szerepel az adatbázisban.'
                )));
                return;

            } else {

                $pass_check = $this->wob_model->get_user_where(array('email' => $email_check->email, 'pass' => $pass));

                if(empty($pass_check)){

                    $this->output->set_output(json_encode(array(
                        'success'   => false,
                        'msg'       => "Helytelen e-mail és jelszó párosítás.",
                    )));
                    return;

                } else {


                    $this->session->set_userdata('user_id',$email_check->user_id);
                    $this->session->set_userdata('user_name',$email_check->name);
                    $this->session->set_userdata('user_email',$email_check->email);
                    $this->session->set_userdata('user_permission',$email_check->permission);
                    $this->session->set_userdata('logged_in',1);

                    $this->session->set_flashdata('success','Sikeres bejelentkezés');

                    $this->output->set_output(json_encode(array(
                        'success'   => true,
                    )));
                    return;

                }

            }

        } else {
            redirect('/');
        }

    }

    public function kijelentkezes(){
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('user_permission');
        $this->session->set_userdata('logged_in',0);
        $this->session->set_flashdata('success','Sikeres kijelentkezés');
        redirect(site_url());
    }


}
