<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Controller Admin
	 * 
	 * Ações da área administrativa
	 */

	public function index()
	{
		# condição para usuário logado	
		if( $this->session->userdata('logged') == false || $this->session->userdata('tipo') != 'a'){
			redirect('login');
		}
	}

}