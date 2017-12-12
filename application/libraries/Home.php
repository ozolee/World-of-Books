<?php
class Home{

	protected $ci = null;

	public $title               = '';
	public $meta_keywords       = '';
	public $meta_description    = '';

	public $charset             = 'utf-8';
	public $style_sheets        = array();
	public $scripts             = array();

	public $layout              = 'layouts/home';
	public $view_data           = array('left_column'=>false);

	public function __construct(){
		$this->ci = &get_instance();

		$this->style_sheets = array(
			base_url().'css/style.css',
			base_url().'css/font.css',
			base_url().'css/alertify.core.css',
			base_url().'css/alertify.default.css',
			base_url().'font-awesome-4.5.0/css/font-awesome.css',
		);

		$this->scripts = array(
			base_url().'js/jquery-2.0.3.js',
			base_url().'js/jquery-ui-1.10.3.custom.js',
			base_url().'js/alertify.js',
			base_url().'js/jquery.bpopup.min.js',
			base_url().'js/default.js',
		);
	}

	public function add_stylesheet($style){
		if(!in_array($style, $this->style_sheets)){
			$this->style_sheets[] = $style;
		}
		return $this;
	}

	public function add_script($url){
		if(!in_array($url, $this->scripts)){
			$this->scripts[] = $url;
		}
		return $this;
	}


	public function show($view_data=null,$view=null,$layout=null){

		if($layout){$this->layout = $layout;}
		if(!$this->layout){$this->layout = 'layouts/home';}

		if($view_data){$this->view_data = $view_data;}

		global $RTR;
		$c  = $RTR->class;
		$m  = $RTR->method;

		if(empty($view) || !$view){
			if((!$this->view_data || empty($this->view_data['app_content'])) && is_file(APPPATH.'views/'.$c.'/'.$m.EXT)){
				$view = $c.'/'.$m;
			}
		}

		if($view && is_file(APPPATH.'views/'.$view.EXT)){
			$this->view_data['app_content'] = $this->ci->load->view($view,$this->view_data,true);
		}


		$head="\t".'<title>'.($this->title?''.$this->title:'').' </title>'."\r\n";
                $head.= "\t<script>var site_url = '".site_url()."';</script>\r\n";

		for($i=0;$i<count($this->style_sheets);$i++){
			$head.="\t".'<link rel="stylesheet" href="'.$this->style_sheets[$i].'">'."\r\n";
		}

		for($i=0;$i<count($this->scripts);$i++){
			$head.="\t".'<script src="'.$this->scripts[$i].'"></script>'."\r\n";
		}

		$this->view_data['output_data']=array(
			'head'=>$head,
			'meta_keywords'=>$this->meta_keywords,
			'meta_description'=>$this->meta_description
		);

		$this->ci->load->view($this->layout,$this->view_data);
	}
}
