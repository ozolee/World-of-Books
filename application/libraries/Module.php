<?php defined('BASEPATH') || die('No direct script access allowed');

/**
 *
 * Module loader class
 *
 */
class Module
{
  function __construct(){
    $this->_assign_libraries();
    }
       
  function run($name, $action='index') {       
    $args = func_get_args();

    require_once APPPATH.'modules/'.$name.'/'.$name.EXT;
    $name = ucfirst($name);
       
    $module = new $name();
        return call_user_func_array(array(&$module, $action), array_slice($args, 1));
  }
   
  function render($data = array(), $view = 'default', $_ci_return = FALSE) {
    extract($data);
        $cn = get_class($this);
        ob_start();
        include APPPATH.'modules/'.$cn.'/views/'.$view.EXT;
        $buffer = ob_get_contents();
        if ($_ci_return === TRUE) {       
            $buffer = ob_get_contents();
            @ob_end_clean();
            return $buffer;
        }
        ob_end_flush();
  }

  function load($object) {
    $this->$object =& load_class(ucfirst($object));
  }

  function _assign_libraries() {
    $ci =& get_instance();
    foreach (get_object_vars($ci) as $key => $object) {
      $this->$key =& $ci->$key;
    }
  }
}