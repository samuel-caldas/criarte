<?php

	class viagens_model extends CI_Model {
	
		function __construct()
		{
		    // Call the Model constructor
		    parent::__construct();
		}

		function adicionar_viagem($viagem)
		{
			$query = $this->db->insert('viagens', $viagem);
			
			if( $query )
				return true;
			else
				return false;
		}
		
		function editar_viagem($id, $viagem)
		{
			$this->db->where('id', $id);
			$query = $this->db->update('viagens', $viagem);
			
			if( $query )
				return true;
			else
				return false;
		}
		
		function get_viagens($abertas = true, $cidade_partida = null, $cidade_destino = null, $data = null)
		{
			$this->db->select('
				v.id, 
				( SELECT sigla from estados where v.estado_partida = id ) as estado_partida,
				( SELECT cidade from cidades where v.cidade_partida = id ) as cidade_partida,
				v.data_partida,
				( SELECT sigla from estados where v.estado_destino = id ) as estado_destino,
				( SELECT cidade from cidades where v.cidade_destino = id ) as cidade_destino,
				v.data_volta,
				o.numero as numero_onibus
			');
			$this->db->distinct();
			$this->db->from('viagens v, onibus o');
			
			if($abertas == true){
				$this->db->where('o.id = v.numero_onibus');
				$this->db->where('v.data_volta > UTC_DATE()');
			} else {
				$this->db->where('o.id = v.numero_onibus');
				$this->db->where('v.data_volta <= UTC_DATE()');
			}

			if( $cidade_partida != null && is_numeric($cidade_partida) )
				$this->db->where(array('v.cidade_partida' => $cidade_partida));

			if( $cidade_destino != null && is_numeric($cidade_destino) )
				$this->db->where(array('v.cidade_destino' => $cidade_destino));

			if( $data != null && $data != '')
				$this->db->where(array('v.data_partida' => date( 'Y-m-d' , strtotime( $data ) )));

			$query = $this->db->get();

			return $query->result();
		}

		function get_viagem($id)
		{
			$this->db->select('
				v.id, 
				( SELECT sigla from estados where v.estado_partida = id ) as estado_partida,
				( SELECT cidade from cidades where v.cidade_partida = id ) as cidade_partida,
				v.data_partida,
				( SELECT sigla from estados where v.estado_destino = id ) as estado_destino,
				( SELECT cidade from cidades where v.cidade_destino = id ) as cidade_destino,
				v.data_volta,
				o.numero as numero_onibus,
				o.id as onibus_id,
			');
			$this->db->distinct();
			$this->db->from('viagens v, onibus o');
			$this->db->where('o.id = v.numero_onibus');
			$this->db->where('v.id = ' . $id);

			$query = $this->db->get();

			return $query->result();
		}
		
		function deletar_viagem($id)
		{
			$query = $this->db->delete('reservas', array('viagem_id' => $id));
			$query = $this->db->delete('viagens', array('id' => $id));
			
			if( $query )
				return true;
			else
				return false;
		}

		# ====================================================

		function get_estados()
		{
			$query = $this->db->order_by('sigla')->get('estados');
			
			return $query->result();
		}
		
		function get_cidades($estado)
		{
			$query = $this->db->order_by('cidade')->get_where('cidades', array('estado_id' => $estado));

			if( $query->num_rows() > 0 )
				return $query->result();
			else
				return false;
		}
		
		function adicionar_cidade($cidade)
		{
			$query = $this->db->insert('cidades', $cidade);
			
			if( $query )
				return $this->db->insert_id();
			else
				return false;
		}
	
		# ====================================================
		
		function get_reservas($viagem, $modo = '')
		{
			if($modo == 'i')
				$query = $this->db->get_where('reservas', array('viagem_id' => $viagem, 'ida' => 1, 'volta' => 0));
			else if($modo == 'v')
				$query = $this->db->get_where('reservas', array('viagem_id' => $viagem, 'ida' => 0, 'volta' => 1));
			else if($modo == 'iv')
				$query = $this->db->get_where('reservas', array('viagem_id' => $viagem, 'ida' => 1, 'volta' => 1));
			else
				$query = $this->db->get_where('reservas', array('viagem_id' => $viagem));

			if( $query->num_rows() > 0 )
				return $query->result();
			else
				return false;
		}
		
		function adicionar_reserva($reserva)
		{
			$query = $this->db->insert('reservas', $reserva);
			
			if( $query )
				return $this->db->insert_id();
			else
				return false;
		}
		
		function editar_reserva($reserva, $id)
		{
			$this->db->where('id', $id);
			$query = $this->db->update('reservas', $reserva);
			
			if( $query )
				return true;
			else
				return false;
		}
		
		function deletar_reserva($reserva)
		{
			$query = $this->db->delete('reservas', array('id' => $reserva));
			
			if( $query )
				return true;
			else
				return false;
		}
	
	}

?>