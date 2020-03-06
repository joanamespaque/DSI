<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	function inserirUsuario($dados){
		$this->db->insert('usuario', $dados);
	}

	function procurarUsuario($senha,$login){
		$this->db->where('senha',$senha); 
		$this->db->where('login',$login);
		return $this->db->get('usuario')->result();
	} 
	function procurarUsuarioLogin($login){
		$this->db->where('login',$login);
		return $this->db->get('usuario')->result();
	} 
}
?>
