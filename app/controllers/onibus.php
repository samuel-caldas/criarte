<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Onibus extends CI_Controller {

	/**
	 * Controller Ônibus
	 * 
	 * Ações relacionadas diretamente a onibus na area administrativa.
	 * Apenas administradores tem acesso.
	 */

	public function __construct()
	{
		parent::__construct();
		
		# Condição para administrador logado
        if( $this->session->userdata('logged') != true || $this->session->userdata('tipo') != 'a')
			redirect('login');
		
		$this->load->model('onibus_model', 'onibus');
	}
	
	public function index()
	{
		$master = 'admin/master';
		$view   = 'admin/onibus/listagem';
		$side   = 'admin/onibus/listagem_side';
		$data   = array('todos' => $this->onibus->get_all(), 'todos_removidos' => $this->onibus->get_all(0));

		load_view($master, $view, $side, 'Ônibus', 'Área de administração de ônibus', $data);
	}

	public function remover($onibus)
	{
		$update = array(
			'ativo' => 0
		);

		if( $this->onibus->editar_onibus($onibus, $update) ){
			redirect('onibus');
		} else {
			$master = 'admin/master';
			$view   = 'admin/onibus/remover';
			$side   = 'admin/onibus/remover_side';
			$data   = array('status' => false);
	
			load_view($master, $view, $side, 'Ônibus', 'Área de administração de ônibus', $data);
		}
	}

	public function reativar($onibus)
	{
		$update = array(
			'ativo' => 1
		);

		if( $this->onibus->editar_onibus($onibus, $update) ){
			redirect('onibus');
		} else {
			$master = 'admin/master';
			$view   = 'admin/onibus/reativar';
			$side   = 'admin/onibus/reativar_side';
			$data   = array('status' => false);
	
			load_view($master, $view, $side, 'Ônibus', 'Área de administração de ônibus', $data);
		}
	}

	public function adicionar($attempt = null, $error = null)
	{
		$data = array(
			'erro' => '',
			'post' => array('numero' => '','' => '','login' => '')
		);
		
		if(isset($_POST['action'])){

			if( strlen($_POST['numero']) < 1 || strlen($_POST['primeiro_andar']) < 1 ){
				$data['erro'] = 'Campos não podem estar em branco!';
			} else {
			
				$onibus = array(
					'numero' => $_POST['numero'],
					'andares' => ( ( $_POST['primeiro_andar'] > 0 and isset($_POST['segundo_andar']) ) ? 2 : 1 ),
					'tipo' => $_POST['tipo'],
					'ativo' => 1
				);
				
				$onibus_id = $this->onibus->adicionar_onibus($onibus);
				
				if( $onibus_id != false ){
					
					$poltronas = array(
						'onibus_id' => $onibus_id,
						'andar' => 1,
						'poltronas' => $_POST['primeiro_andar']
					);
					
					$insPrimeiroAndar = $this->onibus->inserir_poltronas($poltronas);
					
					if( $insPrimeiroAndar == true && isset($_POST['segundo_andar']) ){
						
						$poltronas = array(
							'onibus_id' => $onibus_id,
							'andar' => 2,
							'poltronas' => $_POST['segundo_andar']
						);
						
						if( !$this->onibus->inserir_poltronas($poltronas) )
							$data['erro'] = 'Erro ao salvar o número de poltronas.';
						
					} else if( $insPrimeiroAndar == false ){
						$data['erro'] = 'Erro ao salvar o número de poltronas.';
					}

				} else {
					$data['erro'] = 'Um erro inesperado ocorreu ao salvar o ônibus.';
				}
				
				redirect('onibus');
				
			}	
		}

		$master = 'admin/master';
		$view = 'admin/onibus/adicionar';
		$side = 'admin/onibus/adicionar_side';

		load_view($master, $view, $side, 'Ônibus', 'Área de administração de ônibus', $data);

	}

	public function editar($onibus_id = false)
	{
		if( $onibus_id == false )
			redirect('onibus');
		
		$data = array(
			'erro' => '',
			'post' => array('numero' => '','primeiro_andar' => '', 'segundo_andar' => ''),
			'onibus' => $this->onibus->get_dados($onibus_id)
		);
	
		if(isset($_POST['action'])){

			if( strlen($_POST['numero']) < 1 || strlen($_POST['primeiroAndar']) < 1 ){
				$data['erro'] = 'Campos Número/Primeiro Andar não podem estar em branco!';
			} else {
			
				$onibus = array(
					'numero' => $_POST['numero'],
					'andares' => ( ( $_POST['primeiroAndar'] > 0 and isset($_POST['segundoAndar']) ) ? 2 : 1 ),
					'tipo' => $_POST['tipo'],
					'ativo' => 1
				);
				
				$edit = $this->onibus->editar_onibus($onibus_id, $onibus);
				
				if( $edit != false ){
					
					$poltronas = array(
						'onibus_id' => $onibus_id,
						'andar' => 1,
						'poltronas' => $_POST['primeiroAndar']
					);

					$editPrimeiroAndar = $this->onibus->editar_poltronas($poltronas);

					if( !isset($_POST['segundoAndar']) )
						$_POST['segundoAndar'] = 0;

					if( $editPrimeiroAndar == true && ($data['onibus']->segundo_andar != $_POST['segundoAndar']) ){

						$poltronas = array(
							'onibus_id' => $onibus_id,
							'andar' => 2,
							'poltronas' => $_POST['segundoAndar']
						);

						if( !$this->onibus->editar_poltronas($poltronas) )
							$data['erro'] = 'Erro ao salvar o número de poltronas.';
						
					} else if( $editPrimeiroAndar == false ){
						$data['erro'] = 'Erro ao salvar o número de poltronas.';
					}

				} else {
					$data['erro'] = 'Um erro inesperado ocorreu ao salvar o ônibus.';
				}
				
				redirect('onibus');
			}
		}

		if(strlen($data['erro']) > 0){
			$data['post'] = array('numero' => $_POST['numero'], 'primeiro_andar' => $_POST['primeiroAndar'], 'segundo_andar' => $_POST['segundoAndar']);
		}

		$master = 'admin/master';
		$view = 'admin/onibus/editar';
		$side = 'admin/onibus/editar_side';

		load_view($master, $view, $side, 'Ônibus', 'Área de administração de ônibus', $data);
	}
}