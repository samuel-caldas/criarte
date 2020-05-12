<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Controller Login
	 * 
	 * Direciona o usuário para o sistema
	 * ou gerencia o login do mesmo.
	 */

	public function index()
	{
		# condição para usuário logado	
		if( $this->session->userdata('logged') == true ){
			
			if( $this->session->userdata('tipo') == 'a')
				redirect('usuarios');
			else
				redirect('consulta');

		} else {
			self::form();
		}
	}

	public function form($error = null)
	{
		if( $error != null)
			$this->load->view('login', array('error' => true));
		else
			$this->load->view('login', array('error' => false));
	}
	
	public function attempt()
	{
		# Pega variaveis do post
		$u = $_POST['username'];
		$p = $_POST['password'];

		$this->load->model('usuarios_model', 'usuarios');

		# Efetua o login
		if( $this->usuarios->do_login($u, $p) )	{
			
			$usuario = $this->usuarios->get_dados($u);

			# Define os dados na sessão
			$sess_data = array(
				'user_id' => $usuario->id,
				'login' => $usuario->login,
				'email' => $usuario->email,
				'nome' => $usuario->nome,
				'tipo' => $usuario->tipo,
				'logged' => true
			);

			$this->session->set_userdata($sess_data);

			# Direciona o usuário
			if( $usuario->tipo == 'a')
				redirect('usuarios');
			else
				redirect('consulta');

		} else {

			redirect('login/form/error');

		}
	}
	
	public function logout()
	{
		$sess_data = array('user_id' => '','login' => '','email' => '','nome' => '','tipo' => '','logged' => false);
		$this->session->set_userdata($sess_data);

		$this->session->sess_destroy();
		redirect('/');
	}
}