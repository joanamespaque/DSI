<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compra_Model extends CI_Model {
	public function __construct() {
		parent::__construct();
    }
    
    public function inserir($dados){
		if($this->db->insert('compra', $dados)){
			return $this->db->insert_id();
		}
	}
    public function insereItem($dados){
		if($this->db->insert('compra_itens', $dados)){
			return true;
		}
	}
	public function comprasUsuario($codusuario){
		$this->db->select('*');
		$this->db->from('compra');
		$this->db->where('codusuario', $codusuario);
		$query = $this->db->get();
		if ($query->num_rows() > 0) return $query->result();
		else return false;
	}
	public function listaPendentes(){
		$this->db->select('compra.cod,compra.frete, compra.total, compra.quantidade, compra.datacompra, compra.validado, compra.banco, compra.conta, compra.agencia, compra.codusuario, usuario.nome');
		$this->db->from('compra');
		$this->db->join('usuario', 'usuario.cod = compra.codusuario');
		$this->db->where('validado', 1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) return $query->result();
		else return false;
	}
	public function listaItensCompra($codusuario){
		$this->db->select('*');
		$this->db->from('compra_itens');
		$this->db->join('compra', 'compra.cod = compra_itens.compra_cod');
		$this->db->join('livro', 'livro.cod = compra_itens.livro_cod');
		$this->db->where('compra.codusuario', $codusuario);
		$query = $this->db->get();
		if ($query->num_rows() > 0) return $query->result();
		else return false;
	}
	public function getItensCompra($codcompra){
		$this->db->select('compra_itens.quantidade, livro.cod as codlivro, livro.titulo, livro.quantidade as estoque, usuario.cod as codusuario, compra_itens.cod, compra.total, livro.preco');
		$this->db->from('compra_itens');
		$this->db->join('livro', 'livro.cod = compra_itens.livro_cod');
		$this->db->join('compra', 'compra.cod = compra_itens.compra_cod');
		$this->db->join('usuario', 'usuario.cod = compra.codusuario');
		$this->db->where('compra.cod', $codcompra);
		$query = $this->db->get();
		if ($query->num_rows() > 0) return $query->result();
		else return false;
	}
	public function getCompra($cod){
		$this->db->select("*");
		$this->db->from("compra");
		$this->db->join('usuario', 'usuario.cod = compra.codusuario');
		$this->db->where('compra.cod', $cod);
		$query = $this->db->get();
		if ($query->num_rows() > 0) return $query->result();
		else return false;
	}
	public function alteraCompra($data = null, $cod = null){
		if ($cod) {
			$this->db->where('cod', $cod);
			if ($this->db->update('compra', $data)) {
				return true;
			} else {
				return false;
			}
		}
	}

	public function excluir($cod){
		if ($cod) {
			$this->db->where('cod', $cod);
			return $this->db->delete('compra');
		}
	}
	
}
?>
