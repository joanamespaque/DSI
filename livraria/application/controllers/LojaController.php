<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LojaController extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Usuario_Model', '', TRUE);
		$this->load->model('Livro_Model', '', TRUE);
		$this->load->helper('form');
		$this->load->helper('array');
		$this->load->library('form_validation');
		$this->load->helper('url'); 
		$this->load->library('cart');
		$this->load->library('email');
		$this->load->helper("funcoes");
		require_once APPPATH.'/third_party//vendor/autoload.php';
	}
	
	public function pdfUsuario(){
		$html1 = "
		<fieldset>
		<h1 style='text-align:center;'>LISTA DE USUÁRIOS</h1>
		<p style='text-align:center;'>
			usuários cadastrados no sistema
		</p>
        <table utosize='2.4'>
            <thead>
                <tr>
                    <th style='width: 5cm'>NOME</th>
                    <th style='width: 5cm'>E-MAIL</th>
                    <th style='width: 5cm'>ESTADO</th>
                    <th style='width: 5cm'>CIDADE</th>
                    <th style='width: 5cm'>ENDEREÇO</th>
                </tr>
            </thead>
			<tbody>";
		$html2 = "";
		$usuarios = $this->Usuario_Model->listaUsuarios();
		foreach ($usuarios as $u){
			$html2 = $html2."
				<tr>
					<td style='width: 5cm; text-align:center;'>".$u->nome."</td>
					<td style='width: 5cm; text-align:center;'>".$u->email."</td>
					<td style='width: 5cm; text-align:center;'>".$u->estado."</td>
					<td style='width: 5cm; text-align:center;'>".$u->cidade."</td>
					<td style='width: 5cm; text-align:center;'>".$u->endereco."</td>
				</tr>
			";
		}  
		$html3 = "
		</tbody>
		</table>";
		$html = $html1.$html2.$html3;
		$mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/tmp']);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}
	public function pdfLivros(){
		$html1 = "
		<fieldset>
		<h1 style='text-align:center;'>LISTA DE PRODUTOS</h1>
		<p style='text-align:center;'>
			livros cadastrados no sistema:
		</p>
        <table utosize='2.4'>
            <thead>
                <tr>
                    <th style='width: 5cm'>TÍTULO</th>
                    <th style='width: 5cm'>AUTOR</th>
                    <th style='width: 5cm'>PREÇO</th>
                    <th style='width: 5cm'>QUANTIDADE</th>
                    <th style='width: 5cm'>PESO</th>
                </tr>
            </thead>
			<tbody>";
		$html2 = "";
		$livros= $this->Livro_Model->listarTodos();
		foreach ($livros as $l){
			$html2 = $html2."
				<tr>
					<td style='width: 5cm; text-align:center;'>".$l->titulo."</td>
					<td style='width: 5cm; text-align:center;'>".$l->autor."</td>
					<td style='width: 5cm; text-align:center;'>".$l->preco."</td>
					<td style='width: 5cm; text-align:center;'>".$l->quantidade."</td>
					<td style='width: 5cm; text-align:center;'>".$l->peso."Kg</td>
				</tr>
			";
		}  
		$html3 = "
		</tbody>
		</table>";
		$html = $html1.$html2.$html3;
		$mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/tmp']);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	public function index(){
		redirect("lojaController/login");	
	}

	public function login(){
		if($this->session->userdata('nome')){
			redirect("/lojaController/generos");
		} else{
			$this->load->view('/nav');
			$this->load->view('/login');

		}
	}

    public function logar(){
        $email = $_POST['email'];
		$senha = md5($_POST['senha']);
		$variavel = $this->Usuario_Model->procurarUsuario($senha,$email);
		if(count($variavel) == 1){
			$_SESSION['email'] = strtolower($variavel[0]->email);
			$_SESSION['nome'] = $variavel[0]->nome;
			$_SESSION['estado'] = $variavel[0]->estado;
			$_SESSION['cod'] = $variavel[0]->cod;
			print($_SESSION['email']);
			redirect('LojaController/generos');
		} else{
			$this->session->set_flashdata('email_failed','Dados não validados.');
			redirect('LojaController/login');
			// print('SSSSSSSSSSSSSSSSSS');
		}
	}
	
	public function cadastro(){
		$this->load->view('nav');
		$this->load->view('cadastro');
	}
	public function cadastrar(){
		$dados = array(
			"email" => $this->input->post('email'),
			"senha" => md5($this->input->post('senha')),
			"nome" => $this->input->post('nome'),
			"estado" => $this->input->post('estado'),
			"endereco" => $this->input->post('endereco'),
			"cidade" => $this->input->post('cidade')
		);
		$variavel = $this->Usuario_Model->procurarUsuarioEmail($dados['email']);
		if($variavel == array()){
			$this->Usuario_Model->inserirUsuario($dados);	
			$this->session->set_flashdata('sucesso','Cadastro feito com sucesso!');
			redirect('LojaController/login');
		}
		else{
			$this->session->set_flashdata('cadastro_failed','Esse email já existe.');
			redirect('LojaController/cadastro');
		}
    }	
	public function logout(){
		$this->session->sess_destroy();
		$this->cart->destroy();
		redirect('LojaController/login');
	}
	public function listaUsuarios(){
		if(strtolower($this->session->userdata('email'))=='admin@admin.com'){
			$input = $this->input->post('busca'); 
			if($input){
				$data['usuarios'] = $this->Usuario_Model->get($input);
				$data['valor'] = $input;
			} else{
				$data['usuarios'] = $this->Usuario_Model->listaUsuarios();
			}
			// var_dump($data['usuarios']);
			$this->load->view('nav');
			$this->load->view('listaUsuarios', $data);
		} else{
		$this->session->set_flashdata('erro','Apenas administradores podem acessar a página que você tentou acessar.');
		redirect('LojaController/generos'); 
		}
	}
	public function excluirUsuario(){

		if(strtolower($this->session->userdata('email'))=='admin@admin.com'){
			$cod = $this->uri->segment(3);
			$this->Usuario_Model->excluirUsuario($cod);
			redirect('LojaController/listaUsuarios');

		} else{
		$this->session->set_flashdata('erro','Apenas administradores podem acessar a página que você tentou acessar.');
		redirect('LojaController/generos'); 
		}
	}
	


	// GENERO



	public function formGenero(){
		if(strtolower($this->session->userdata('email'))=='admin@admin.com'){
			$this->load->view('nav');
			$data['generos'] = $this->Livro_Model->listarGeneros();
			$this->load->view('inserirGenero', $data);
		} else{
		$this->session->set_flashdata('erro','Apenas administradores podem acessar a página que você tentou acessar.');
		redirect('LojaController/generos'); 
		}

	}

	public function generos(){
		if ($this->Livro_Model->listarGeneros()){
			$data['items'] = $this->Livro_Model->listarGeneros();
			$this->load->view('nav');
			$this->load->view('buscarPor',$data);
		}
	}

	public function procurarPor(){
		$cod = $this->input->get('genero'); 
		$data['items'] = $this->Livro_Model->listarGeneros();
		$data['cod'] = $cod;
		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		if ($this->Livro_Model->listarPorGenero($cod)){
			$data['livros'] = $this->Livro_Model->listarPorGenero($cod);
			$this->load->view('nav');
			$this->load->view('buscarPor',$data);
		}
		else{
			$this->session->set_flashdata('erro','Nada encontrado.');
			redirect('LojaController/generos');
		}
	}
	
	public function inserirGenero(){
		if(strtolower($this->session->userdata('email'))=='admin@admin.com'){
			$titulo = strtolower($this->input->post('titulo'));
			$dados = array(
				'titulo' => $titulo
			);
			$variavel = $this->Livro_Model->procurarGenero($titulo);
			print($variavel);
			if($variavel == array()){
				$this->Livro_Model->inserirGenero($dados);	
				$this->session->set_flashdata('msg','Cadastro feito com sucesso.');
				redirect('LojaController/formGenero');
			}
			else{
				$this->session->set_flashdata('cadastro_failed','Esse gênero já existe.');
				redirect('LojaController/formGenero');
			}
		} else{
			$this->session->set_flashdata('erro','Apenas administradores podem acessar a página que você tentou acessar.');
			redirect('LojaController/generos'); 
		}
	}
	
	public function excluirGenero(){
		if(strtolower($this->session->userdata('email'))=='admin@admin.com'){
			$cod = $this->uri->segment(3);
			$this->Livro_Model->excluirGenero($cod);
			redirect('LojaController/formGenero');
		} else{
			$this->session->set_flashdata('erro','Apenas administradores podem acessar a página que você tentou acessar.');
			redirect('LojaController/generos'); 
		}
	}


	
	//  LIVRO
	public function listaLivros(){
		if(strtolower($this->session->userdata('email'))=='admin@admin.com'){
			$config = array();
			$config["base_url"] = base_url('index.php/LojaController/listaLivros/');
			$config["total_rows"] = $this->Livro_Model->ContaLivros();
			$config["per_page"] = 5;
			$config["uri_segment"] = 3;

			$config['full_tag_open'] 	= '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] 	= '</ul></nav></div>';
			$config['num_tag_open'] 	= '<li class="page-item">';
			$config['num_tag_close'] 	= '</li>';
			$config['cur_tag_open'] 	= '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] 	= '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] 	= '<li class="page-item">';
			$config['next_tagl_close'] 	= '<span aria-hidden="true">&raquo;</span></li>';
			$config['prev_tag_open'] 	= '<li class="page-item">';
			$config['prev_tagl_close'] 	= '</li>';
			$config['first_tag_open'] 	= '<li class="page-item">';
			$config['first_tagl_close'] = '</li>';
			$config['last_tag_open'] 	= '<li class="page-item">';
			$config['last_tagl_close'] 	= '</li>';
			$config['attributes'] = array('class' => 'page-link');

			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data['livros'] = $this->Livro_Model->listar('titulo', 'asc', $config['per_page'],$offset);
			$this->load->view('nav');
			$this->load->view('lista',$data);
			
		} else{
			$this->session->set_flashdata('erro','Apenas administradores podem acessar a página que você tentou acessar.');
			redirect('LojaController/generos'); 
		}	
	}

	public function alterarLivro($cod = null){
		if(strtolower($this->session->userdata('email'))=='admin@admin.com'){
			if($cod){
				$livro = $this->Livro_Model->procurarLivro($cod);
				$generos = $this->Livro_Model->procurarLivroGenero($cod);
				if ($this->Livro_Model->listarGeneros()){
					$data['items'] = $this->Livro_Model->listarGeneros();
					if($generos){
						$data['generos'] = $generos;
					}
					if ($livro->num_rows() > 0 ) {
						$data['cod'] = $livro->row()->cod;
						$data['titulo'] = $livro->row()->titulo;	
						$data['autor'] = $livro->row()->autor;
						$data['sinopse'] = $livro->row()->sinopse;
						$data['preco'] = $livro->row()->preco;
						$data['quantidade'] = $livro->row()->quantidade;
						$data['peso'] = $livro->row()->peso;
						$data['imagem'] = $livro->row()->imagem;
					}
					$this->load->view('nav');
					$this->load->view('inserirLivro',$data);
			}
		} else{
			$this->session->set_flashdata('erro','Apenas administradores podem acessar a página que você tentou acessar.');
			redirect('LojaController/generos'); 
		}
	}
	}

	public function formLivro(){
		if(strtolower($this->session->userdata('email'))=='admin@admin.com'){
			if ($this->Livro_Model->listarGeneros()){
				$data['items'] = $this->Livro_Model->listarGeneros();
				$this->load->view('nav');
				$this->load->view('inserirLivro',$data);
			}
		} else{
			$this->session->set_flashdata('erro','Apenas administradores podem acessar a página que você tentou acessar.');
			redirect('LojaController/generos'); 
		}
	}

	public function livro($cod = null){
		if($cod){
			$livro = $this->Livro_Model->procurarLivro($cod)->result()[0];
			$data['livro'] = $livro;
			$this->load->view('nav');
			$this->load->view('livro',$data);
		}
	}

	public function salvarLivro(){
		if(strtolower($this->session->userdata('email'))=='admin@admin.com'){
			$config['upload_path'] = 'uploads/';
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
				#redirect('Meucontroller/listar');
				$this->load->library('form_validation');
				$cod = $this->input->post('cod');
				$file_name = $data['file_name'];
				$dados = array(
					"titulo" => $this->input->post('titulo'),
					"autor" => $this->input->post('autor'),
					"sinopse" => $this->input->post('sinopse'),
					"preco" => $this->input->post('preco'),
					"quantidade" => $this->input->post('quantidade'),
					"peso" => $this->input->post('peso'),
					"imagem" => $file_name
				);
				$generos = $this->input->post('genero');
				$geraCod = $this->Livro_Model->salvarLivro($dados,$cod);
				if($cod){
					$this->Livro_Model->salvarLivro_Genero($generos, $cod);	
				}else{
					$this->Livro_Model->salvarLivro_Genero($generos, $geraCod);	
				}
				redirect('LojaController/listaLivros');		
			}
		} else{
			$this->session->set_flashdata('erro','Apenas administradores podem acessar a página que você tentou acessar.');
			redirect('LojaController/generos'); 
		}
		
	}

	public function excluirLivro(){
		if(strtolower($this->session->userdata('email'))=='admin@admin.com'){
			$cod = $this->uri->segment(3);
			$this->Livro_Model->excluirLivro($cod);
			redirect('LojaController/listaLivros');

		} else{
		$this->session->set_flashdata('erro','Apenas administradores podem acessar a página que você tentou acessar.');
		redirect('LojaController/generos'); 
		}
	}



	//  MENSAGEM 
	public function mensagem(){
		if(strtolower($this->session->userdata('email'))=='admin@admin.com'){
			$this->load->view('nav');
			$this->load->view('mensagem');
		} else{
		$this->session->set_flashdata('erro','Apenas administradores podem acessar a página que você tentou acessar.');
		redirect('LojaController/generos'); 
		}
	}
	public function enviaMensagem(){
		$data = array(
			"assunto" => $this->input->post('assunto'),
			"mensagem" => $this->input->post('mensagem')
		);

		$config = array();
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
		$config['smtp_port']= 465;
		$config['smtp_user']= 'exerciciotesteds2@gmail.com';
		$config['smtp_pass']= 'vishmarinamail';
        $config['mailtype'] = 'html';
        $config['charset']  = 'utf-8';
        $config['newline']  = "\r\n";
        $config['validate'] = TRUE;

		$this->email->initialize($config);

		if($this->Usuario_Model->listarEmails()){
			$emails = $this->Usuario_Model->listarEmails();
		}
		foreach($emails as $e){
			$this->email->from("exerciciotesteds2@gmail.com", 'LIVRARIA SORVIL');
			$this->email->to($e->email); 
			$this->email->subject($data['assunto']);
			$this->email->message('<p>'.$data['mensagem'].'</p>');
			$this->email->send();
		}

		$this->session->set_flashdata('msg','E-mails enviados.');
		redirect('LojaController/mensagem');
	}

}
?>
