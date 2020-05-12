<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Consulta extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		# Condição para usuário logado
        if( $this->session->userdata('logged') != true )
			redirect('login');

		$this->load->model('viagens_model', 'viagens');
		$this->load->model('onibus_model', 'onibus');
	}
	
	public function index()
	{
		$master = 'admin/master_sem_coluna';
		$view = 'admin/consulta/pesquisa';
		$side = '';
		$data = array('estados' => $this->viagens->get_estados());
		#array('viagens_abertas' => $this->viagens->get_viagens(), 'viagens_fechadas' => $this->viagens->get_viagens(false));

		load_view($master, $view, $side, 'Consultar Viagem', '', $data);
	}
	
	public function pesquisa($cidade_origem = '', $cidade_destino = '', $data = '')
	{
		$view = 'admin/consulta/resultado_pesquisa';

		$data = array(
			'viagens_encontradas' => $this->viagens->get_viagens(true, $cidade_origem, $cidade_destino, $data)
		);

		$this->load->view($view, $data);
	}
	
	public function reservas($v)
	{
		$msg = array('tipo' => '0', 'msg' => '');

		$r_ida = false;
		$r_volta = false;
		$r_iv = false;
		
		$reservas_ida = array();
		$reservas_volta = array();
		$reservas_iv = array();

		if( isset($_POST['action_add']) ){

			$ins = $this->viagens->adicionar_reserva($_POST['r']);
			
			if($ins != false){
				$msg['tipo'] = '1';
				$msg['msg'] = 'Reserva criada com sucesso.';
			} else {
				$msg['tipo'] = '2';
				$msg['msg'] = 'Erro ao criar reserva.';
			}

		}

		if( isset($_POST['action_editar']) ){

			if( !isset( $_POST['r']['ida'] ) )
				$_POST['r']['ida'] = 0;

			if( !isset( $_POST['r']['volta'] ) )
				$_POST['r']['volta'] = 0;

			$ins = $this->viagens->editar_reserva($_POST['r'], $_POST['id']);

			if($ins != false){
				$msg['tipo'] = '1';
				$msg['msg'] = 'Reserva editada com sucesso.';
			} else {
				$msg['tipo'] = '2';
				$msg['msg'] = 'Erro ao editar reserva.';
			}

		}

		if( isset($_POST['action_deletar']) ){

			$ins = $this->viagens->deletar_reserva($_POST['id']);

			if($ins != false){
				$msg['tipo'] = '1';
				$msg['msg'] = 'Reserva removida com sucesso.';
			} else {
				$msg['tipo'] = '2';
				$msg['msg'] = 'Erro ao remover reserva.';
			}

		}

		$viagem = $this->viagens->get_viagem($v);
		$onibus = $this->onibus->get_dados($viagem[0]->onibus_id);
		$reservas = $this->viagens->get_reservas($v);

		if( $reservas != false ){
			$r_ida   = $this->viagens->get_reservas($v, 'i');
			$r_volta = $this->viagens->get_reservas($v, 'v');
			$r_iv    = $this->viagens->get_reservas($v, 'iv');
			
			if( $r_ida != false ){
				foreach($r_ida as $val){
					$reservas_ida[] = $val->poltrona;
				}
			}
			
			if( $r_volta != false ){
				foreach($r_volta as $val){
					$reservas_volta[] = $val->poltrona;
				}
			}
			
			if( $r_iv != false ){
				foreach($r_iv as $val){
					$reservas_iv[] = $val->poltrona;
				}
			}
		}

		$add_iv = array_intersect($reservas_ida, $reservas_volta);

		if( count($add_iv) ){
			
			foreach($add_iv as $val){
				$reservas_iv[] = $val;
				
				$key_i = array_search($val, $reservas_ida);
				unset($reservas_ida[$key_i]);
				
				$key_v = array_search($val, $reservas_volta);
				unset($reservas_volta[$key_v]);
			}
			
		}

		$master = 'admin/master_sem_coluna';
		$view = 'admin/consulta/reservas';
		$side = '';
		$data = array(
			'onibus' => $onibus,
			'viagem' => $viagem[0],
			'reservas' => $reservas,
			'reservas_ida' => $reservas_ida,
			'reservas_volta' => $reservas_volta,
			'reservas_iv' => $reservas_iv,
			'msg' => $msg);
	
		load_view($master, $view, $side, 'Reservas', '', $data);
	}
	
	public function relatorio($v)
	{
		$viagem = $this->viagens->get_viagem($v);
		$onibus = $this->onibus->get_dados($viagem[0]->onibus_id);
		$reservas = $this->viagens->get_reservas($v);

		$reservas_ida = $reservas_volta = $reservas_iv = array();

		if( $reservas != false ){
			$r_ida   = $this->viagens->get_reservas($v, 'i');
			$r_volta = $this->viagens->get_reservas($v, 'v');
			$r_iv    = $this->viagens->get_reservas($v, 'iv');
			
			if( $r_ida != false ){
				foreach($r_ida as $val){
					$reservas_ida[] = $val->poltrona;
				}
			}
			
	
			
			if( $r_volta != false ){
				foreach($r_volta as $val){
					$reservas_volta[] = $val->poltrona;
				}
			}
			
			#exit;
						
			if( $r_iv != false ){
				foreach($r_iv as $val){
					$reservas_iv[] = $val->poltrona;
				}
			}
			
			$add_iv = array_intersect($reservas_ida, $reservas_volta);
		
			if( count($add_iv) ){
				
				foreach($add_iv as $val){
					$reservas_iv[] = $val;
	
					$key_i = array_search($val, $reservas_ida);
					unset($reservas_ida[$key_i]);
					
					$key_v = array_search($val, $reservas_volta);
					unset($reservas_volta[$key_v]);
				}
			
			}
		}
		


		$master = 'admin/master_relatorio';
		$view = 'admin/consulta/relatorio';
		$side = '';
		$data = array(
			'onibus'         => $onibus,
			'viagem'         => $viagem[0],
			'reservas'       => $reservas,
			'reservas_ida'   => $reservas_ida,
			'reservas_volta' => $reservas_volta,
			'reservas_iv'    => $reservas_iv,
			);
	
		load_view($master, $view, $side, 'Reservas', '', $data);
	}
}
