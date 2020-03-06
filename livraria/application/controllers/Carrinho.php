<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Carrinho extends CI_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->model('Usuario_Model', '', TRUE);
            $this->load->model('Livro_Model', '', TRUE);
            $this->load->model('Compra_Model', '', TRUE);
            $this->load->helper('form');
            $this->load->helper('array');
            $this->load->library('form_validation');
            $this->load->helper('url'); 
            $this->load->library('cart');
			$this->load->library('email');
        }
    
		public function listar(){
			// $this->load->helper('form');
			if($this->session->userdata('nome')){
			$this->load->helper("funcoes");
			$this->load->view("nav");
			$this->load->view("carrinho");
			} else{
				$this->session->set_flashdata('email_failed','Você precisa fazer login pra acessar essa página.');
				redirect('LojaController/login');
			}
		}
		public function atualizar(){
			
			//recebo todo o conteúdo postado do formulário e no loop abaixo recupero o que preciso
			$conteudo_postado = $this->input->post();
			
			foreach($conteudo_postado as $conteudo) {
				
				$dados[] = array(
				
					"rowid" => $conteudo['rowid'],
					"qty" => $conteudo['qty']
				
				);
					
			}
			//com os dados já preparados, basta dar um update no carrinho
			$this->cart->update($dados);
			
			redirect(base_url('index.php/carrinho/listar'));
			
		}
		public function inserir(){
			if($this->session->userdata('nome')){
			$id_produto = $this->input->post("cod");
			$quantidade = $this->input->post("quantidade");
			$preco = $this->input->post("preco");
			$imagem = $this->input->post("imagem");
            $titulo = $this->input->post("titulo");
            $peso = $this->input->post("peso");
            $estoque = $this->input->post("estoque");
			// $pesoTotal = $peso*$quantidade;
			//se o usuário não informar a quantidade do produto, então, coloco 1
			if (empty($quantidade)) 
				$quantidade = 1;
			
			//A biblioteca do carrinho de compras já está carregada lá pelo autoload, então não preciso chamá-la aqui novamente.
			
			//Esta linha serve para permitir que produtos com acentuação no nome sejam aceitos.
            $this->cart->product_name_rules = "'\d\D'";

			$data = array(
                'id' => $id_produto,
                'qty' => $quantidade,
                'price' => $preco,
                'name' => $titulo,
                'image' => $imagem,
                'estoque' => $estoque,
                'peso' => $peso
			);
			if($quantidade <= $estoque){
				if ($this->cart->insert($data)) {
					redirect(base_url('index.php/carrinho/listar'));
				} else {
					echo "ERRO. Não foi possível inserir. <pre>";
					print_r($data);
					echo "</pre>";				
				}
			} else{
				$this->session->set_flashdata('erro','Você precisa inserir uma quantidade menor ou igual a que temos em estoque.');
				redirect(base_url('index.php/LojaController/livro/'.$id_produto));
			}
		} else{
			$this->session->set_flashdata('email_failed','Você precisa fazer login pra acessar essa página.');
			redirect('LojaController/login');
		}
			
		}
		//função que limpa o conteúdo do carrinho de compras.
		public function limpar(){
			if($this->session->userdata('nome')){
			$this->cart->destroy();
			redirect(base_url('index.php/carrinho/listar'));
			} else{
				$this->session->set_flashdata('email_failed','Você precisa fazer login pra acessar essa página.');
				redirect('LojaController/login');
			}
		}

		public function paginaCompra(){
			$this->load->view('nav');
			$this->load->view('formCompra');
		}

		public function realizaCompra(){
			if($this->session->userdata('nome')){
			$dados = array(
				"conta" => $this->input->post('conta'),
				"agencia" => $this->input->post('agencia'),
				"banco" => $this->input->post('banco'),
				"total" => $_SESSION['total'],
				"frete" => $_SESSION['frete'],
				"quantidade" => intval($this->cart->total_items()),
				"codusuario" => $_SESSION['cod'],
				"datacompra" =>date("Y-m-d")
			);
			$geraCod = $this->Compra_Model->inserir($dados);

			foreach ($this->cart->contents() as $items){
				$dadosItem = array(
					"compra_cod" => $geraCod,
					"livro_cod" => $items['id'],
					"quantidade" => $items['qty'],
					"subtotal" => $items['subtotal']
				);
				$this->Compra_Model->insereItem($dadosItem);
			}
			unset($_SESSION['total']);
			unset($_SESSION['frete']);
			$this->cart->destroy();
			redirect('LojaController/generos');
			} else{
				$this->session->set_flashdata('email_failed','Você precisa fazer login pra acessar essa página.');
				redirect('LojaController/login');
			}
		}
		
		public function listaPendentes(){
			if(strtolower($this->session->userdata('email'))=='admin@admin.com'){
				if(strtolower($this->session->userdata('email'))=='admin@admin.com'){
					$data['pendentes'] = $this->Compra_Model->listaPendentes();
					$this->load->view('nav');
					$this->load->view('pendentes',$data);
		
				} else{
				$this->session->set_flashdata('erro','Apenas administradores podem acessar a página que você tentou acessar.');
				redirect('LojaController/generos'); 
				}
			} else{
			$this->session->set_flashdata('erro','Apenas administradores podem acessar a página que você tentou acessar.');
			redirect('LojaController/generos'); 
			}
		}
		
		public function comprasUsuario(){
				$data['compras'] = $this->Compra_Model->comprasUsuario($_SESSION['cod']);
				$data['itens'] = $this->Compra_Model->listaItensCompra($_SESSION['cod']);
				// var_dump($data['compras']);
				// print('<br>');
				// print('<br>');
				// var_dump($data['itens']);
				$this->load->view('nav');
				$this->load->view('compras',$data);	

		}

		public function validaCompra(){
			if(strtolower($this->session->userdata('email'))=='admin@admin.com'){
				$cod = $this->uri->segment(3);
				$itens = $this->Compra_Model->getItensCompra($cod);
				$compra = $this->Compra_Model->getCompra($cod);
				$mensagem = '<p>O pagamento da sua compra foi aprovado! Veja o resumo dela abaixo:</p>';
				foreach ($itens as $item){
					var_dump($item);
					$mensagem = $mensagem."<p>Livro:".$item->titulo."</p><p>VALOR: R$ ".$item->preco."</p><p>QUANTIDADE: ".$item->quantidade."</p>";
					$data = array(
						'quantidade' => intval($item->estoque)-intval($item->quantidade)
					);
					$this->Livro_Model->salvarLivro($data, $item->codlivro);
				}
				$datacompra = array(
					'validado' => 0
				);
				$this->Compra_Model->alteraCompra($datacompra, $cod);
				$mensagem = $mensagem.'<p>VALOR DO FRETE: R$ '.$compra[0]->frete."</p>";
				$mensagem = $mensagem.'<p>VALOR TOTAL DA COMPRA: R$ '.$compra[0]->total."</p>";
	
				$configmail= array();
				$configmail['protocol'] = "smtp";
				$configmail['smtp_host'] = "ssl://smtp.gmail.com";
				$configmail['smtp_port']= 465;
				$configmail['smtp_user']= 'exerciciotesteds2@gmail.com';
				$configmail['smtp_pass']= 'vishmarinamail';
				$configmail['mailtype'] = 'html';
				$configmail['charset']  = 'utf-8';
				$configmail['newline']  = "\r\n";
				$configmail['validate'] = TRUE;
				$this->email->initialize($configmail);
				$this->email->from("exerciciotesteds2@gmail.com", 'LIVRARIA SORVIL');
				$this->email->to($compra[0]->email); 
				$this->email->subject('Pagamento Aprovado');
				$this->email->message($mensagem);
				$this->email->send();
				
				redirect('Carrinho/listaPendentes');
			} else{
			$this->session->set_flashdata('erro','Apenas administradores podem acessar a página que você tentou acessar.');
			redirect('LojaController/generos'); 
			}
		}
		
		public function cancelaCompra(){
			if(strtolower($this->session->userdata('email'))=='admin@admin.com'){
				$cod = $this->uri->segment(3);
				$itens = $this->Compra_Model->getItensCompra($cod);
				$compra = $this->Compra_Model->getCompra($cod);
				$mensagem = '<p>O pagamento da sua compra foi negado! Veja o resumo dela abaixo:</p>';
				foreach ($itens as $item){
					$mensagem = $mensagem."<p>Livro:".$item->titulo."</p><p>VALOR: R$ ".$item->preco."</p><p>QUANTIDADE: ".$item->quantidade."</p>";
				}
				$datacompra = array(
					'negada' => 0,
					'validado' => 0
				);
				$this->Compra_Model->alteraCompra($datacompra, $cod);
				$mensagem = $mensagem.'<p>VALOR DO FRETE: R$ '.$compra[0]->frete."</p>";
				$mensagem = $mensagem.'<p>VALOR TOTAL DA COMPRA: R$ '.$compra[0]->total."</p>";
				$configmail= array();
				$configmail['protocol'] = "smtp";
				$configmail['smtp_host'] = "ssl://smtp.gmail.com";
				$configmail['smtp_port']= 465;
				$configmail['smtp_user']= 'exerciciotesteds2@gmail.com';
				$configmail['smtp_pass']= 'vishmarinamail';
				$configmail['mailtype'] = 'html';
				$configmail['charset']  = 'utf-8';
				$configmail['newline']  = "\r\n";
				$configmail['validate'] = TRUE;
				$this->email->initialize($configmail);
				$this->email->from("exerciciotesteds2@gmail.com", 'LIVRARIA SORVIL');
				$this->email->to($compra[0]->email); 
				$this->email->subject('Pagamento Negado');
				$this->email->message($mensagem);
				$this->email->send();
				redirect('Carrinho/listaPendentes');	
			} else{
			$this->session->set_flashdata('erro','Apenas administradores podem acessar a página que você tentou acessar.');
			redirect('LojaController/generos'); 
			}
		}
		
	}