<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Funcionario;

class FuncionariosController extends Controller
{
    private $funcionario;

    public function __construct()
    {
        $this->funcionario = new Funcionario();
    }

    public function index($letra)
    {        
        if($letra !== "home"){
            $list_funcionarios = funcionario::indexLetra($letra);
        } else{
            $list_funcionarios = funcionario::orderBy('bruto', 'asc')->get();
        }
        return view('funcionarios.index', [
            'funcionarios' => $list_funcionarios,
            'criterio' => $letra
        ]);
    }

    public function busca(Request $request)
    {
        $funcionarios = funcionario::busca($request->criterio, $request->condicao);

        return view('funcionarios.index', [
            'funcionarios' => $funcionarios,
            'criterio' => $request->criterio
        ]);
    }

    public function novoView()
    {
        return view('funcionarios.create');
    }

    public function store(Request $request)
    {
        $validacao = $this->validacao($request->all());

        if ($validacao->fails()) {
            return redirect()->back()
                ->withErrors($validacao->errors())
                ->withInput($request->all());
        }

        $funcionario = funcionario::create($request->all());

        return redirect("/funcionarios")->with("message", "funcionario criada com sucesso!");
    }

    public function excluirView($cod)
    {
        $func = $this->getfuncionario($cod);
        // var_dump($func);
        return view('funcionarios.delete', [
            'funcionario' => $func
        ]);
    }

    public function destroy($cod)
    {
        Funcionario::where('cod',$cod)->delete();

        return redirect(url('funcionarios'))->with('success', 'Excluído!');
    }

    public function editarView($cod)
    {
        return view('funcionarios.create', [
            'funcionario' => $this->getfuncionario($cod)
        ]);
    }

    public function update(Request $request)
    {
        $validacao = $this->validacao($request->all());

        if ($validacao->fails()) {
            return redirect()->back()
                ->withErrors($validacao->errors())
                ->withInput($request->all());
        }
        $funcionario = $this->getfuncionario($request->cod);
        $funcionario->update($request->all());

        return redirect('/funcionarios');
    }

    protected function getfuncionario($cod)
    {
        $funcionario = Funcionario::find($cod);
        // var_dump($funcionario);
        return $funcionario;
    }

    private function validacao($data)
    {
        $regras['nome'] = 'required|min:3';
        $regras['matricula'] = 'required|min:8';
        $regras['bruto'] = 'required|';
        $regras['cargo'] = 'required';

        $mensagens = [
            'nome.required' => 'Campo nome é obrigatório',
            'nome.min' => 'Campo nome deve ter ao menos 3 letras',
            'matricula.required' => 'Campo matricula é obrigatório',
            'matricula.min' => 'Campo nome deve ter ao menos 8 caracteres',
            'bruto.required' => 'Campo de salario é obrigatório',
            // 'bruto.min' => 'Campo de salario deve ser ao menos um salario minimo',
            'cargo.required' => 'Campo de cargo é obrigatório'
        ];

        return Validator::make($data, $regras, $mensagens);
    }

}

?>