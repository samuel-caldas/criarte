<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viagens extends CI_Controller {

	/**
	 * Controller Viagens
	 * 
	 * Ações relacionadas diretamente a viagens na area administrativa.
	 * Apenas administradores tem acesso.
	 */

	public function __construct()
	{
		parent::__construct();
		
		# Condição para administrador logado
        if( $this->session->userdata('logged') != true || $this->session->userdata('tipo') != 'a')
			redirect('login');
		
		$this->load->model('viagens_model', 'viagens');
		$this->load->model('onibus_model', 'onibus');
	}
	
	public function index()
	{
		$master = 'admin/master';
		$view = 'admin/viagens/listagem';
		$side = 'admin/viagens/listagem_side';
		$data = array('viagens_abertas' => $this->viagens->get_viagens(), 'viagens_fechadas' => $this->viagens->get_viagens(false));

		load_view($master, $view, $side, 'Viagens', '', $data);
	}

	public function adicionar($attempt = null, $error = null)
	{
		$data = array(
			'erro' => '',
			'estados' => $this->viagens->get_estados(),
			'onibus' => $this->onibus->get_all(),
			'post' => array(
				'n_partida' => '',
				'n_estado_partida' => '',
				'partida' => '',
				'estado_partida' => '',
				'data_partida' => '',
				'n_destino' => '',
				'n_estado_destino' => '',
				'destino' => '',
				'estado_destino' => '',
				'data_destino' => '',
				'numero_onibus' => ''
			)
		);

		if(isset($_POST['action'])){

			$ins = array(
				'estado_partida',
				'cidade_partida',
				'data_partida',
				'estado_destino',
				'cidade_destino',
				'data_volta',
				'numero_onibus',
			);

			$v = $_POST['v'];

			if( $v['n_partida'] == 'Criar nova cidade...' && $v['partida'] == 'Selecione uma estado...' ){
				$data['erro'] = 'Cidade de partida não especificada!';
			} else if( $v['n_estado_partida'] == '' && $v['estado_partida'] == '' ){
				$data['erro'] = 'Estado de partida não especificad!';
			} else if( $v['n_destino'] == 'Criar nova cidade...' && $v['destino'] == 'Selecione uma estado...' ){
				$data['erro'] = 'Cidade de destino não especificada!';
			} else if( $v['n_estado_destino'] == '' && $v['estado_destino'] == '' ){
				$data['erro'] = 'Estado de destino não especificado!';
			} else if( $v['data_partida'] == '' ){
				$data['erro'] = 'Data de ida não especificada.';
			} else if( $v['data_volta'] == '' ){
				$data['erro'] = 'Data de volta não especificada.';
			} else if( $v['numero_onibus'] == '' ){
				$data['erro'] = 'Número do ônibus não especificado.';
			}
			
			if( $v['n_partida'] != 'Criar nova cidade...' ){
				if( $v['n_estado_partida'] == '' ) {
					$data['erro'] = 'Impossível criar cidade de partida sem definir seu estado.';
				} else {

					$cidade = array(
						'cidade' => $v['n_partida'],
						'estado_id' => $v['n_estado_partida']
					);

					$insert['estado_partida'] = $v['n_estado_partida'];
					$insert['cidade_partida'] = $this->viagens->adicionar_cidade($cidade);

				}
			} else {
				$insert['estado_partida'] = $v['estado_partida'];
				$insert['cidade_partida'] = $v['partida'];
			}

			if( $v['n_destino'] != 'Criar nova cidade...' ){
				if( $v['n_estado_destino'] == '' ) {
					$data['erro'] = 'Impossível criar cidade de destino sem definir seu estado.';
				} else {
					
					$cidade = array(
						'cidade' => $v['n_destino'],
						'estado_id' => $v['n_estado_destino']
					);

					$insert['estado_destino'] = $v['n_estado_destino'];
					$insert['cidade_destino'] = $this->viagens->adicionar_cidade($cidade);
					
				}
			} else {
				$insert['estado_destino'] = $v['estado_destino'];
				$insert['cidade_destino'] = $v['destino'];
			}
			
			if( $data['erro'] == '' ){

				$insert['data_partida'] = date( 'Y-m-d' , strtotime( $v['data_partida'] ) );
				$insert['data_volta']   = date( 'Y-m-d' , strtotime( $v['data_volta'] ) );
				$insert['numero_onibus']  = $v['numero_onibus'];

				if( $this->viagens->adicionar_viagem($insert) )
					redirect('viagens');
				else
					$data['erro'] = 'Um erro inesperado impediu a criação da nova viagem. Tente novamente mais tarde.';

			}
			
			$data['post'] = $v;
		}

		$master = 'admin/master';
		$view = 'admin/viagens/adicionar';
		$side = 'admin/viagens/adicionar_side';

		load_view($master, $view, $side, 'Viagens', '', $data);
	}

	public function editar($id)
	{
		$data = array(
			'erro' => '',
			'estados' => $this->viagens->get_estados(),
			'onibus' => $this->onibus->get_all(),
			'post' => array(
				'n_partida' => '',
				'n_estado_partida' => '',
				'partida' => '',
				'estado_partida' => '',
				'data_partida' => '',
				'n_destino' => '',
				'n_estado_destino' => '',
				'destino' => '',
				'estado_destino' => '',
				'data_destino' => '',
				'numero_onibus' => ''
			),
			'viagem' => $this->viagens->get_viagem($id)
		);

		if(isset($_POST['action'])){

			$ins = array(
				'estado_partida',
				'cidade_partida',
				'data_partida',
				'estado_destino',
				'cidade_destino',
				'data_volta',
				'numero_onibus',
			);

			$v = $_POST['v'];
			
			if($v['editar_partida'] == '1'){
				
				if( $v['n_partida'] == 'Criar nova cidade...' && $v['partida'] == 'Selecione uma estado...' ){
					$data['erro'] = 'Cidade de partida não especificada!';
				} else if( $v['n_estado_partida'] == '' && $v['estado_partida'] == '' ){
					$data['erro'] = 'Estado de partida não especificado!';
				}

				if( $v['n_partida'] != 'Criar nova cidade...' ){
					
					if( $v['n_estado_partida'] == '' ) {
						$data['erro'] = 'Impossível criar cidade de partida sem definir seu estado.';
					} else {
	
						$cidade = array(
							'cidade' => $v['n_partida'],
							'estado_id' => $v['n_estado_partida']
						);
	
						$insert['estado_partida'] = $v['n_estado_partida'];
						$insert['cidade_partida'] = $this->viagens->adicionar_cidade($cidade);
	
					}
				} else {
					$insert['estado_partida'] = $v['estado_partida'];
					$insert['cidade_partida'] = $v['partida'];
				}
			}

			if($v['editar_destino'] == '1'){
				
				if( $v['n_destino'] == 'Criar nova cidade...' && $v['destino'] == 'Selecione uma estado...' ){
					$data['erro'] = 'Cidade de destino não especificada!';
				} else if( $v['n_estado_destino'] == '' && $v['estado_destino'] == '' ){
					$data['erro'] = 'Estado de destino não especificado!';
				}
				
				if( $v['n_destino'] != 'Criar nova cidade...' ){
					if( $v['n_estado_destino'] == '' ) {
						$data['erro'] = 'Impossível criar cidade de destino sem definir seu estado.';
					} else {
						
						$cidade = array(
							'cidade' => $v['n_destino'],
							'estado_id' => $v['n_estado_destino']
						);
	
						$insert['estado_destino'] = $v['n_estado_destino'];
						$insert['cidade_destino'] = $this->viagens->adicionar_cidade($cidade);
						
					}
				} else {
					$insert['estado_destino'] = $v['estado_destino'];
					$insert['cidade_destino'] = $v['destino'];
				}

				
			}
			
			if( $v['data_partida'] == '' ){
				$data['erro'] = 'Data de ida não especificada.';
			} else if( $v['data_volta'] == '' ){
				$data['erro'] = 'Data de volta não especificada.';
			} else if( $v['numero_onibus'] == '' ){
				$data['erro'] = 'Número do ônibus não especificado.';
			}

			if( $data['erro'] == '' ){

				$insert['data_partida'] = date( 'Y-m-d' , strtotime( $v['data_partida'] ) );
				$insert['data_volta']   = date( 'Y-m-d' , strtotime( $v['data_volta'] ) );
				$insert['numero_onibus']  = $v['numero_onibus'];

				if( $this->viagens->editar_viagem($_POST['id'], $insert) )
					redirect('viagens');
				else
					$data['erro'] = 'Um erro inesperado impediu a edição da viagem. Tente novamente mais tarde.';

			}

			$data['post'] = $v;
		}

		$master = 'admin/master';
		$view = 'admin/viagens/editar';
		$side = 'admin/viagens/editar_side';

		load_view($master, $view, $side, 'Viagens', '', $data);
	}

	public function select_cidade($estado)
	{
		$data['cidades'] = $this->viagens->get_cidades($estado);
		
		$this->load->view('admin/viagens/select', $data);
	}
	
	public function deletar($viagem)
	{
			if($viagem == '')
			self::index();
		else{
			if( $this->viagens->deletar_viagem($viagem) )
				self::index();
		}
	}
}