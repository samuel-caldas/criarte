<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('load_view'))
{
	function load_view($master, $view, $sidebar, $titulo, $tagline = '', $data = array(), $side_data = array())
	{
		$CI =& get_instance();

		$goData = array(
			'view'      => $view,
			'side'      => $sidebar,
			'titulo'    => $titulo,
			'tagline'   => $tagline,
			'data'      => $data,
			'side_data' => $side_data 
		);

		$CI->load->view($master,$goData);
	}
}


/* End of file path_helper.php */
/* Location: ./system/helpers/path_helper.php */