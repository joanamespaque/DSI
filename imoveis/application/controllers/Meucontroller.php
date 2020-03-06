<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/fpdf_gen.php');
class Meucontroller extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Imovel_Model', '', TRUE);
		$this->load->model('Usuario_Model', '', TRUE);
		$this->load->helper('form');
		$this->load->helper('array');
		$this->load->library('form_validation');
		$this->load->helper('url'); 
	}
	public function index(){
		redirect("Meucontroller/login");	
	}
	public function pdf(){
		#$this->load->library('fpdf_gen');
		$pdf = new FPDF("L", "mm", "A4");
		$pdf->AddPage();
		$pdf->setAuthor("Joana Mespaque");
		$pdf->setTitle("Lista de Imóveis", 0);
		$pdf->setMargins(5,5);
		$pdf->setFont('Arial','',14);
		$itens = $this->Imovel_Model->listar()->result();

		$pdf->Ln(4);
		$pdf->Cell(0, 0, "LISTA DE IMOVEIS", 0, 0, "C");
		
		$pagina = "";
		$url = base_url('/uploads');
		foreach ($itens as $item) {     
		$pagina = $pagina.
		"


		Codigo: ".$item->codigo.", Descricao: ".$item->descricao.", Bairro: ".$item->bairro.", Tipo: ".$item->tipo_operacao.", Preco: ".$item->preco.", Numero de Dormitorios: ".$item->nDormitorios;
		}
		$pdf->Write(5, $pagina);
		echo $pdf->Output("ListaImoveis_FPDF.pdf","D");

	}
	
	public function salvar(){
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '500';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('userfile')){
			echo $this->upload->display_errors();
		}
		
		else{
			$data = $this->upload->data();
			#redirect('Meucontroller/listar');
			$this->load->library('form_validation');
	
			$id = $this->input->post('codigo');
			$file_name = $data['file_name'];
			$dados = array(
				"descricao" => $this->input->post('descricao'),
				"tipo_operacao" => $this->input->post('tipo_operacao'),
				"bairro" => $this->input->post('bairro'),
				"preco" => $this->input->post('preco'),
				"nDormitorios" => $this->input->post('dormitorios'),
				"foto" => $file_name
			);
			$this->Imovel_Model->salvar($dados,$id);	
			redirect('Meucontroller/listar');		
		}
	}

	public function formulario(){
		if($this->session->userdata('nome')){
			$this->load->view('nav');
			$this->load->view('inserir');
		}else{
			$this->load->view('nav');
			$this->load->view('login');

		}
	}

	public function store(){
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '500';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('userfile')){
			echo $this->upload->display_errors();
		}
		
		else{
			$data = $this->upload->data();
			var_dump($data["file_name"]);
			$this->load->library('form_validation');
	
			$id = $this->input->post('codigo');
			$file_name = $data['file_name'];
			$dados = array(
				"descricao" => $this->input->post('descricao'),
				"tipo_operacao" => $this->input->post('tipo_operacao'),
				"bairro" => $this->input->post('bairro'),
				"preco" => $this->input->post('preco'),
				"nDormitorios" => $this->input->post('dormitorios'),
				"foto" => $file_name
			);
			$this->Imovel_Model->store($dados,$id);	
			redirect('Meucontroller/listar');		
		}
	}

	public function listar(){
		if($this->session->userdata('nome')){
	
			$data['items'] = $this->Imovel_Model->listar()->result();
			$this->load->view('nav');
			$this->load->view('lista',$data);
		} else{
			redirect("Meucontroller/login");

		}
	}
	
	public function get($id = null){
		
		if ($id) {
			$this->db->where('id', $id);
		}
		$this->db->order_by("id", 'desc');
		return $this->db->get('residencias');
	}
	public function procurar(){
		if($this->session->userdata('nome')){
	
			$this->load->view('nav');
			$this->load->view('procurar');
		}else{
			redirect('Meucontroller/login');
		}
	}
	
	public function buscarPor(){
		if($this->session->userdata('nome')){
	
			$this->load->view('nav');
			$this->load->view('buscarPor');
		}else{
			redirect('Meucontroller/login');


		}
	}

	public function buscar(){
		if($this->session->userdata('nome')){
	
			$mensagem = array();
			$dados = array(
				"preco" => $this->input->post('preco'),
				"tipo_operacao" => $this->input->post('tipo_operacao'),
				"bairro" => $this->input->post('bairro'),
				"nDormitorios" => $this->input->post('dormitorios')
			);
			$variavel = $this->Imovel_Model->procurar($dados)->result();
			if ($variavel != array()){
				$data['items'] = $this->Imovel_Model->procurar($dados)->result();
				$this->load->view('nav');
				$this->load->view('imovel',$data);
			}
			else{
				$this->session->set_flashdata('erro','Nada encontrado.');
				redirect('/Meucontroller/procurar');
			}
		}else{
			redirect('Meucontroller/login');
		}
	}

	public function procurarPor(){
		if($this->session->userdata('nome')){
	
			if($this->input->post('buscar')=='venda' || $this->input->post('buscar')=='aluguel'){
				$tipo = $this->input->post('buscar');
				if ($this->Imovel_Model->buscaTipo($tipo)->result()){
					$data['items'] = $this->Imovel_Model->buscaTipo($tipo)->result();
					$this->load->view('nav');
					$this->load->view('imovel',$data);
				}
				else{
					$this->session->set_flashdata('erro','Nada encontrado.');
					redirect('/Meucontroller/buscarPor');
				}
			} elseif($this->input->post('buscar')=='bairro'){
				$bairro = $this->input->post('inputValue');	
				if ($this->Imovel_Model->buscaBairro($bairro)->result()){
					$data['items'] = $this->Imovel_Model->buscaBairro($bairro)->result();
					$this->load->view('nav');
					$this->load->view('imovel',$data);
				}
				else{
					$this->session->set_flashdata('erro','Nada encontrado.');
					redirect('/Meucontroller/buscarPor');
				}
			} else{
				$nDormitorios = $this->input->post('inputValue');	
				if ($this->Imovel_Model->buscaDormitorios($nDormitorios)->result()){
					$data['items'] = $this->Imovel_Model->buscaDormitorios($nDormitorios)->result();
					$this->load->view('nav');
					$this->load->view('imovel',$data);
				}
				else{
					$this->session->set_flashdata('erro','Nada encontrado.');
					redirect('/Meucontroller/buscarPor');
				}
			}
		}else{
			redirect('Meucontroller/login');
		}
		
	}
	
	public function excluir(){
		if(strtolower($this->session->userdata('admin'))=='sim'){
	
			$data['items'] = $this->Imovel_Model->listar()->result();
			$id = $this->uri->segment(3);
			$this->Imovel_Model->excluir($id);
			$this->session->set_flashdata('msg','Excluído com sucesso!');
			redirect('Meucontroller/listar'); 
		} else{
			$this->session->set_flashdata('msg','Apenas administradores podem excluir imóveis.');
			redirect('Meucontroller/listar'); 
		}
	}

	public function alterar($id = null){
		if(strtolower($this->session->userdata('admin'))=='sim'){
			if($id){
		
				$imovel = $this->Imovel_Model->get($id);
				if ($imovel->num_rows() > 0 ) {
					$variaveis['descricao'] = $imovel->row()->descricao;	
					$variaveis['tipo_operacao'] = $imovel->row()->tipo_operacao;
					$variaveis['bairro'] = $imovel->row()->bairro;
					$variaveis['preco'] = $imovel->row()->preco;
					$variaveis['nDormitorios'] = $imovel->row()->nDormitorios;
					$variaveis['foto'] = $imovel->row()->foto;
					$variaveis['codigo'] = $imovel->row()->codigo;
					$this->load->view('inserir', $variaveis);
				}
				
			}
		} else{
			$this->session->set_flashdata('msg','Apenas administradores podem alterar imóveis.');
			redirect('Meucontroller/listar'); 
		}
	}
	public function login(){
		if($this->session->userdata('nome')){
			redirect("Meucontroller/listar");
		} else{
			$this->load->view('nav');
			$this->load->view('/login');

		}
	}
    public function logar(){

        $login = $_POST['login'];
		$senha = md5($_POST['senha']);
		$variavel = $this->Usuario_Model->procurarUsuario($senha,$login);
		if(count($variavel) == 1){
			session_start();
			$_SESSION['admin'] = $variavel[0]->admin;
			$_SESSION['nome'] = $variavel[0]->nome;
			redirect('Meucontroller/listar');
		}
		else{
			$this->session->set_flashdata('login_failed','Dados não validados.');
			redirect('Meucontroller/login');
		}
	}
	
	public function cadastro(){
		$this->load->view('nav');
		$this->load->view('cadastro');
	}
	public function cadastrar(){

		$dados = array(
			"login" => $this->input->post('login'),
			"senha" => md5($this->input->post('senha')),
			"nome" => $this->input->post('nome'),
			"admin" => $this->input->post('administrador')
		);
		$variavel = $this->Usuario_Model->procurarUsuarioLogin($dados['login']);
		if($variavel == array()){
			$this->Usuario_Model->inserirUsuario($dados);	
			print_r($variavel);
			print('sssssss');
			$this->session->set_flashdata('msg', 'Sucesso');
			redirect('Meucontroller/');
		}
		else{
			$this->session->set_flashdata('cadastro_failed','Esse login já existe.');
			redirect('Meucontroller/cadastro');
		}
    }	
	public function logout(){
		$this->session->sess_destroy();
		redirect('Meucontroller/');
	}

}
?>
