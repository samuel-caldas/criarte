<?php

	class onibus_model extends CI_Model {
	
		function __construct()
		{
		    // Call the Model constructor
		    parent::__construct();
		}

		function get_dados($onibus)
		{
			$this->db->select('o.id, o.numero, o.andares, o.tipo, ( SELECT poltronas from poltronas where o.id = onibus_id and andar = 1 ) as primeiro_andar, ( SELECT poltronas from poltronas where o.id = onibus_id and andar = 2 ) as segundo_andar');
			$this->db->distinct();
			$this->db->from('onibus o, poltronas p');
			$this->db->where('p.onibus_id = o.id and o.id = ' . $onibus);

			$query = $this->db->get('onibus');

			return $query->row();
		}
		
		function get_all($ativo = 1)
		{
			$this->db->select('o.id, o.numero, o.andares, o.tipo, ( SELECT SUM(poltronas) from poltronas where o.id = onibus_id ) as poltronas');
			$this->db->distinct();
			$this->db->from('onibus o, poltronas p');
			$this->db->where('p.onibus_id = o.id and o.ativo = ' . $ativo);

			$query = $this->db->order_by('o.numero', 'desc')->get('onibus');

			return $query->result();
		}

		function editar_onibus($onibus, $dados)
		{
			$this->db->where('id', $onibus);
			$query = $this->db->update('onibus', $dados);

			if( $query )
				return true;
			else
				return false;
		}

		function adicionar_onibus($onibus)
		{
			$query = $this->db->insert('onibus', $onibus);
			
			if( $query )
				return $this->db->insert_id();
			else
				return false;
		}
		
		function inserir_poltronas($poltronas)
		{
			$query = $this->db->insert('poltronas', $poltronas);

			if( $query )
				return true;
			else
				return false;
		}
		
		function editar_poltronas($poltronas)
		{
			if( $poltronas['andar'] == 1 ){
				$this->db->where('onibus_id', $poltronas['onibus_id']);
				$this->db->where('andar', 1);
				
				$query = $this->db->update('poltronas', $poltronas);

			} else {
				if( self::andarExiste(2, $poltronas['onibus_id']) ){
					
					if( $poltronas['poltronas'] == 0 ){

						$this->db->where('onibus_id', $poltronas['onibus_id']);
						$this->db->where('andar', $poltronas['andar']);
						$query = $this->db->delete('poltronas');

					} else {
						$this->db->where('onibus_id', $poltronas['onibus_id']);
						$this->db->where('andar', $poltronas['andar']);
						$query = $this->db->update('poltronas', $poltronas);				
					}
		
				} else {
					$query = self::inserir_poltronas($poltronas);
				}
			}

			if( $query )
				return true;
			else
				return false;
		}

		function deletar_usuario($usuario)
		{
			$query = $this->db->delete('usuarios', array('login' => $usuario));
			
			if( $query )
				return true;
			else
				return false;
		}

		function andarExiste($andar, $onibus)
		{
			$cond = array( 'andar' => $andar, 'onibus_id' => $onibus );

		    $query = $this->db->get_where('poltronas', $cond, 1);
			
			if( $query->num_rows() > 0 )
				return true;
			else
				return false;
		}

	}

?>