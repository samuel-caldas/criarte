<?php

	class usuarios_model extends CI_Model {
	
		function __construct()
		{
		    // Call the Model constructor
		    parent::__construct();
		}
		
		function do_login($username, $password)
		{
			$cond = array( 'login' => $username, 'senha' => sha1($password) );

		    $query = $this->db->get_where('usuarios', $cond, 1);
			
			if( $query->num_rows() > 0 )
				return true;
			else
				return false;
		}

		function get_dados($username)
		{
			$cond = array( 'login' => $username);
			$query = $this->db->get_where('usuarios', $cond, 1);

			return $query->row();
		}
		
		function get_all($tipo = null)
		{
			if( isset($tipo))
				$this->db->where(array('tipo' => $tipo));

			$query = $this->db->order_by('nome', 'desc')->get('usuarios');

			return $query->result();
		}

		function is_duplicated($username)
		{
			$cond = array( 'login' => $username );

		    $query = $this->db->get_where('usuarios', $cond, 1);
			
			if( $query->num_rows() > 0 )
				return true;
			else
				return false;
		}

		function adicionar_usuario($usuario)
		{
			$query = $this->db->insert('usuarios', $usuario);
			
			if( $query )
				return true;
			else
				return false;
		}

		function editar_usuario($usuario, $dados)
		{
			$this->db->where('login', $usuario);
			$query = $this->db->update('usuarios', $dados);
			
			if( $query )
				return true;
			else
				return false;
		}
		
		function deletar_usuario($usuario)
		{
			$query = $this->db->delete('usuarios', array('id' => $usuario));
			
			if( $query )
				return true;
			else
				return false;
		}
		
		function get_nome($id)
		{
			if( $id == 0 )
				return '-';
			
			$cond = array( 'id' => $id);
			$query = $this->db->get_where('usuarios', $cond, 1);
			$row = $query->result_array();

			return $row[0]['nome'];
		}

	}

?>