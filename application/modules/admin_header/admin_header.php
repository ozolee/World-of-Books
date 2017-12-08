<?php

class admin_header extends Module{
	public function __construct(){
		parent::__construct();
	}

	public function index(){

	    $url = $this->uri->segment(2);

	    $this->render(array(
		    'url'       => $url,
            ));
	}
}
