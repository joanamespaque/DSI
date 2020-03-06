@extends('template.app')

@section('content')
  <div class="col-md-12">
    <h3 style="text-align:center;">Novo contato</h3>
  </div>

  <div class="">
    <form class="col-md-12" action="
    @if(isset($funcionario))
    {{ url('/funcionarios/update') }}
    @else
    {{ url('/funcionarios/store') }}
    @endif
    " method="POST">
      {{ csrf_field() }}
      <div class="from-group col-md-4 {{ $errors->has('nome') ? 'has-error' : '' }}">
        @if(isset($funcionario))
        <input type="hidden" name='cod' value="{{$funcionario->cod}}">
        @endif
        <label class="control-label">Nome</label>
        <input name="nome" value="@if(isset($funcionario)){{$funcionario->nome}}@endif" class="form-control" placeholder="Nome">
        @if($errors->has('nome'))
          <span class="help-block">
            {{ $errors->first('nome') }}
          </span>
        @endif
      </div>
      <div class="from-group col-md-4 {{ $errors->has('matricula') ? 'has-error' : '' }}">
        <label class="control-label">Matrícula</label>
        <input name="matricula" value="@if(isset($funcionario)){{$funcionario->matricula}}@endif" class="form-control" placeholder="matricula">
        @if($errors->has('matricula'))
          <span class="help-block">
            {{ $errors->first('matricula') }}
          </span>
        @endif
      </div>

      <div class="from-group col-md-4 {{ $errors->has('bruto') ? 'has-error' : '' }}">
        <label class="control-label">Salário Bruto</label>
        <input type='number' name="bruto" value="@if(isset($funcionario)){{$funcionario->bruto}}@endif" class="form-control" placeholder="salario bruto">
        @if($errors->has('bruto'))
          <span class="help-block">
            {{ $errors->first('bruto') }}
          </span>
        @endif
        <br>
      </div>

      <div class="from-group col-md-4 {{ $errors->has('cargo') ? 'has-error' : '' }}">
        <label class="control-label">Cargo</label>
        <select name="cargo" class='form-control'>
          @if(! isset($funcionario))
          <option disabled selected>Selecione um cargo</option>
          @endif
          <option value="gerente"
          @if(isset($funcionario))
            @if($funcionario->cargo == 'gerente')
            selected
            @endif
          @endif
          >Gerente</option>
          <option value="diretor"
          @if(isset($funcionario))
            @if($funcionario->cargo == 'diretor')
            selected
            @endif
          @endif
          >Diretor</option>
          <option value="engenheiro"
          @if(isset($funcionario))
            @if($funcionario->cargo == 'engenheiro')
            selected
            @endif
          @endif
          >Engenheiro</option>
        </select>
        @if($errors->has('cargo'))
          <span class="help-block">
            {{ $errors->first('cargo') }}
          </span>
        @endif
        <br>
      </div>

      <div class="from-group col-md-4 {{ $errors->has('bonificado') ? 'has-error' : '' }}">
        <label class="control-label">O funcionário tem bonificação?</label>
        <select name="bonificado" class='form-control'>
          <option disabled selected>Selecione</option>
          <option value=1
          @if(isset($funcionario))
            @if($funcionario->bonificado == 1)
            selected
            @endif
          @endif
          >Sim</option>
          <option value=0 
          @if(isset($funcionario))
            @if($funcionario->bonificado == 0)
            selected
            @endif
          @endif
          >Não</option>
        </select>
        @if($errors->has('bonificado'))
          <span class="help-block">
            {{ $errors->first('bonificado') }}
          </span>
        @endif
        <br>
      </div>

      <div class="col-md-12">
        <button style="display: block !important; margin-left: auto; margin-right: auto;" class="btn btn-primary">CADASTRAR</button>
      </div>
    </form>
  </div>
@endsection