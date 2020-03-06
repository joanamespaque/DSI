@extends('template.app')

@section('content')
    <div class="col-md-12 well">
        <div class="col-md-12">
            <h3>
            <strong>Nome: {{$funcionario->nome}}</strong>
            </h3>
            <h5>
            <strong>Matrícula: {{$funcionario->matricula}}</strong>
            </h5>
            <h3>Deseja excluir esse funcionário?</h3>
            <div style="float: right">
                <a class="btn btn-default" href="{{ url('funcionarios') }}">
                    <i class="glyphicon glyphicon-chevron-left"></i>
                    &nbsp;Cancelar
                </a>
                <a class="btn btn-danger" href="{{ url("funcionarios/$funcionario->cod/destroy") }}">
                    <i class="glyphicon glyphicon-remove"></i>
                    &nbsp;Excluir
                </a>
            </div>
        </div>
    </div>

@endsection