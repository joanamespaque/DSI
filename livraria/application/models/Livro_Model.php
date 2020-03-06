<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Livro_Model extends CI_Model {
	public $cod;
	public $titulo;
	public $imagem;
	public $autor;
	public $genero;
	public $preco;
	public $quantidade;
	public $peso;
	public function __construct() {
		parent::__construct();
	}

	public function inserirLivro($dados){
		$this->db->insert('livro', $dados);
	}

	public function inserirGenero($dados){
		$this->db->insert('genero', $dados);
	}

	public function procurarLivro($cod){
		$this->db->where('cod',$cod);
		$query = $this->db->get('livro');
		if($query->num_rows() > 0){
			return $query;
		} else{
			return false;
		}
	} 

	public function procurarGenero($titulo){
		$this->db->where('titulo',$titulo); 
		return $this->db->get('genero')->result();
	}

	public function excluirLivro($cod){
		if ($cod) {
			$this->db->where('cod', $cod);
			return $this->db->delete('livro');
		}
	}
	
	public function listarTodos(){
		$this->db->order_by('autor', 'asc');
		$query = $this->db->get('livro');
		if ($query->num_rows() > 0) return $query->result();
		else return false;

	}

	public function excluirGenero($cod){
		$this->db->where('cod', $cod);
		return $this->db->delete('genero');
	}

	public function listar($sort = 'titulo', $order = 'asc', $limit = null, $offset = null){
		$this->db->limit($limit,$offset);
		$this->db->order_by($sort, $order);
		$query = $this->db->get('livro');
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        else return false;
	}

	public function listarPorGenero($codGenero, $sort = 'titulo', $order = 'asc', $limit = null, $offset = null){
		$this->db->order_by('titulo', 'asc');
		$this->db->select('livro.cod, livro.titulo, livro.autor, livro.sinopse, livro.preco, livro.quantidade, livro.imagem, livro.peso');  
		$this->db->from('livro');
		$this->db->join('genero_livro', 'genero_livro.livro_id = livro.cod');
		$this->db->join('genero', 'genero_livro.genero_id = genero.cod');
		$this->db->where('genero.cod', $codGenero); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        else return false;
	}

	public function listarGeneros(){
		$this->db->order_by('titulo', 'asc');
		$query = $this->db->get('genero'); 
		if ($query->num_rows() > 0) return $query->result();
		else return false;
	}

	function CountAll($cod){
		$this->db->select('livro.titulo, livro.autor, livro.sinopse, livro.preco, livro.quantidade, livro.imagem, livro.peso');  
		$this->db->from('livro');
		$this->db->join('genero_livro', 'genero_livro.livro_id = livro.cod');
		$this->db->join('genero', 'genero_livro.genero_id = genero.cod');
		$this->db->where('genero.cod', $cod);
		$query = $this->db->get();
		return $query->num_rows();
	}
	function ContaLivros(){
		$this->db->select("*");
		$this->db->from('livro');
		$query = $this->db->get();
		return $query->num_rows();

	}
	public function salvarLivro_Genero($generos, $cod){
		$this->db->db_debug = TRUE; 
		$this->db->select('*');
		$this->db->from('genero_livro');
		$this->db->where('livro_id', $cod);
		$vetor = $this->db->get()->result();
		foreach ($vetor as $coluna){
			if(! in_array($coluna->genero_id, $generos)){
				$this->db->where('genero_id', $coluna->genero_id);
				$this->db->where('livro_id', $coluna->livro_id);
				$this->db->delete('genero_livro');
			}
		}

		foreach ($generos as $g){
			$data = array(
				'genero_id' => intval($g), 
				'livro_id' => intval($cod)
			);
			$this->db->select('*');
			$this->db->from('genero_livro');
			$this->db->where('genero_id', $g);
			$this->db->where('livro_id', $cod);
			$this->db->db_debug = FALSE; 
			$result = $this->db->get('genero_livro'); 
			if(! $result){
				print("<br>");
				var_dump($result);
				print("<br>");
				var_dump($data);
				print("<br>");
				$this->db->insert('genero_livro', $data);
			}
			
		}
	}
	public function salvarLivro($data = null, $cod = null) {
		if ($cod) {
			$this->db->where('cod', $cod);
			if ($this->db->update('livro', $data)) {
				return true;
			} else {
				return false;
			}
		} else {
			if ($this->db->insert('livro', $data)) {
				return $this->db->insert_id();
			} else {
				return false;
			}
		}
	}

	public function procurarLivroGenero($codLivro){
		$this->db->select('genero_id');
		$this->db->from('genero_livro');
		$this->db->where('livro_id', $codLivro);
		$query = $this->db->get();
		if ($query->num_rows() > 0) return $query->result();
		else return false;
	}

	public function get_all()
	{
	$query = $this->db->get('livro');
	return $query->result_array();
	}
}
?>
