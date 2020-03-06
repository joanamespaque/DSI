<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imovel_Model extends CI_Model {
	public $codigo;
	public $descricao;
	public $foto;
	public $tipo_operacao;
	public $bairro;
	public $preco;
	public $nDormitorios;
	public function __construct() {
		parent::__construct();
	}
	public function salvar($data = null, $cod = null) {
		if ($cod) {
			$this->db->where('codigo', $cod);
			if ($this->db->update('imovel', $data)) {
				return true;
			} else {
				return false;
			}
		} else {
			if ($this->db->insert('imovel', $data)) {
				return true;
			} else {
				return false;
			}
		}
	}
	public function get($cod = null) {
		if ($cod) {
			$this->db->where('codigo', $cod);
		}
		$this->db->order_by("codigo", 'desc');
		return $this->db->get('imovel');
	}
	public function inserir() {
		return $this->db->insert('imovel', $this);
	}
	public function listar() {
		return $this->db->get('imovel');
	}
	public function excluir($cod) {
		$this->db->where('codigo', $cod);
		return $this->db->delete('imovel');
	}
	public function procurar($data) {
		$this->db->where('bairro', $data['bairro']);
		$this->db->where('preco<=', $data['preco']);
		$this->db->where('tipo_operacao', $data['tipo_operacao']);
		$this->db->where('nDormitorios', $data['nDormitorios']);
		return $this->db->get('imovel');
	}

	public function buscaBairro($bairro){
		$this->db->where('bairro', $bairro);
		return $this->db->get('imovel');
	}

	public function buscaDormitorios($nDormitorios){
		$this->db->where('nDormitorios', $nDormitorios);
		return $this->db->get('imovel');
	}

	public function buscaTipo($tipo){
		$this->db->where('tipo_operacao', $tipo);
		return $this->db->get('imovel');
	}
	
}
?>
