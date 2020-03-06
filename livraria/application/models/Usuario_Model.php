<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	function inserirUsuario($dados){
		$this->db->insert('usuario', $dados);
	}
	public function excluirUsuario($cod){
		$this->db->where('cod', $cod);
		return $this->db->delete('usuario');
	}

	function procurarUsuario($senha,$email){
		$this->db->where('senha',$senha); 
		$this->db->where('email',$email);
		return $this->db->get('usuario')->result();
	} 

	function procurarUsuarioEmail($email){
		$this->db->where('email',$email);
		return $this->db->get('usuario')->result();
	} 

	function listaUsuarios(){
		$this->db->order_by('nome', 'asc');
		$query = $this->db->get('usuario'); 
		if ($query->num_rows() > 0) return $query->result();
		else return false;
	}

	function listarEmails(){
		$data = array('email'=>'ADMIN@ADMIN.com');
		$this->db->select('email');
		$this->db->where_not_in('email', $data['email']);
		$query = $this->db->get('usuario');
		if ($query->num_rows() > 0) return $query->result();
		else return false;
	}
	function get($string){
		// SELECT * FROM countries WHERE LOWER( countries.title ) LIKE '%kosovo%'
		$sql = "SELECT * from usuario WHERE email LIKE '%".$string."%' OR nome LIKE '%".$string."%' OR estado LIKE '%".$string."%' OR cidade LIKE '%".$string."%' OR endereco LIKE '%".$string."%'";
		$this->db->where("(nome=".$string." OR email=".$string.")");
		$query = $this->db->query($sql);
		return $query->result();
	} 

}
?>
