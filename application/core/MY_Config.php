<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Originaly CodeIgniter i18n library by Jérôme Jaglale
 * http://maestric.com/en/doc/php/codeigniter_i18n
 */
/**
 * If you use without  the HMVC modular extension uncomment this and remove other lines load the MX_Loader
 */
//class MY_Config extends CI_Config {
class MY_Config extends CI_Config {

	function site_url($uri = '')
	{
		if (is_array($uri))
		{
			$uri = implode('/', $uri);
		}

		if (class_exists('CI_Controller'))
		{
			$CI =& get_instance();
			$uri = $CI->lang->localized($uri);
		}

		return parent::site_url($uri);
	}

}
// END MY_Config Class
/* End of file MY_Config.php */
/* Location: ./application/core/MY_Config.php */
