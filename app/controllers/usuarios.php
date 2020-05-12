<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	/**
	 * Controller Usuários
	 * 
	 * Ações relacionadas diretamente a usuarios na area administrativa.
	 * Apenas administradores tem acesso.
	 */

	public function __construct()
	{
		parent::__construct();
		
		# Condição para administrador logado
        if( $this->session->userdata('logged') != true || $this->session->userdata('tipo') != 'a')
			redirect('login');
		
		$this->load->model('usuarios_model', 'usuarios');		
	}
	
	public function index()
	{
		$master = 'admin/master';
		$view = 'admin/usuarios/listagem';
		$side = 'admin/usuarios/listagem_side';
		$data = array('todos_admin' => $this->usuarios->get_all('a'), 'todos_vend' => $this->usuarios->get_all('v'));

		load_view($master, $view, $side, 'Usuários', 'Área de administração de usuários', $data);
	}
	
	public function adicionar($attempt = null, $error = null)
	{
		$data = array(
			'erro' => '',
			'post' => array('nome' => '','email' => '','login' => '')
		);
		
		if(isset($_POST['action'])){

			$u = $_POST['u'];

			# TODO
			# MUDAR USANDO APENAS POST
			# Fazer validação javascript

			if( strlen($u['nome']) < 1 && strlen($u['email']) < 1 && strlen($u['login']) < 1 && strlen($u['senha']) < 1 ){
				$data['erro'] = 'Campos não podem estar em branco!';
			} else 
			if( preg_match("/[A-Za-z0-9\\._-]+@[A-Za-z]+\\.[A-Za-z]+/", $u['email']) == 0 ){
				$data['erro'] = 'Email inválido!';
			} else if( $u['senha'] != $u['c_senha'] ){
				$data['erro'] = 'Senhas não conferem!';
			} else if( $this->usuarios->is_duplicated($u['login']) ){
				$data['erro'] = 'Nome de usuário já está sendo utilizado por outro usuário!';
			}

			if( $data['erro'] == '' ){

				unset($u['c_senha']);
				$u['senha'] = sha1($u['senha']);

				if( $this->usuarios->adicionar_usuario($u) )
					redirect('usuarios');
			}

			$data['post'] = $u;
		}

		$master = 'admin/master';
		$view = 'admin/usuarios/adicionar';
		$side = 'admin/usuarios/adicionar_side';

		load_view($master, $view, $side, 'Usuários', 'Área de administração de usuários', $data);

	}

	public function deletar($usuario)
	{
		if($usuario == '')
			self::index();
		else{
			if( $this->usuarios->deletar_usuario($usuario) )
				self::index();
		}
	}

	public function reset($usuario)
	{
		$novo = substr( str_shuffle( 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789' ) , 0 , 6 );
		
		$update = array(
			'senha' => sha1($novo)
		);

		$data['usuario'] = $usuario;
		$data['senha']   = $novo;

		$master = 'admin/master';
		$view = 'admin/usuarios/reset';
		$side = 'admin/usuarios/reset_side';

		$data['status'] = $this->usuarios->editar_usuario($usuario, $update); 

		load_view($master, $view, $side, 'Usuários', 'Área de administração de usuários', $data);
	}

	public function editar($usuario = false)
	{
		if( $usuario == false )
			$usuario = $this->session->userdata('login');

		$data = array(
			'erro' => '',
			'post' => array('nome' => '','email' => '','login' => ''),
			'usuario' => $this->usuarios->get_dados($usuario)
		);

		if(isset($_POST['action'])){

			$update = $_POST['u'];

			# TODO
			# Fazer validação javascript

			if( strlen($update['nome']) < 1 && strlen($update['email']) < 1 && strlen($update['login']) < 1){
				$data['erro'] = 'Campos não podem estar em branco!';
			} else 
			if( preg_match("/[A-Za-z0-9\\._-]+@[A-Za-z]+\\.[A-Za-z]+/", $update['email']) == 0 ){
				$data['erro'] = 'Email inválido!';
			}

			if( strlen($update['senha']) > 0 && $update['senha'] != $update['c_senha'] ){
			 	$data['erro'] = 'Senhas não conferem!';
			} else {
				unset($update['c_senha']);
				$update['senha'] = sha1($update['senha']);
			}

			if( $data['erro'] == '' ){

				if( $data['status'] = $this->usuarios->editar_usuario($usuario, $update) )
					redirect('usuarios');

			}

			$data['post'] = $update;			
		} 

		$master = 'admin/master';
		$view = 'admin/usuarios/editar';
		$side = 'admin/usuarios/editar_side';  

		load_view($master, $view, $side, 'Usuários', 'Área de administração de usuários', $data);
		
	}
}