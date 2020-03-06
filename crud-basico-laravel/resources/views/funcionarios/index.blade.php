@extends("template.app")

@section("content")
  <style>
    .btn-action {
      padding: 5px;
      margin-left: 5px;
      float: right;
    }
  </style>
  <div>
    <div class="col-sm-12" style="padding-bottom: 10px">
      @foreach(range('A', 'Z') as $letra)
        <div class="btn-group">
          <a href="{{ url('funcionarios/' . $letra) }}" class="btn btn-primary {{ $letra === $criterio ? 'disabled' : '' }}">
            {{ $letra }}
          </a>
        </div>
      @endforeach
    </div>

    <div class="row">
          <div style="margin-right:auto; margin-left: auto;margin-bottom:30px;" class="col-sm-8 input-group">
        <form action="{{ url('/funcionarios/busca') }}" method="post">
            {{ csrf_field() }}
            <div class="from-group col-md-5">
            <select name="condicao" class="form-control">
              <option value="matricula">Matrícula</option>
              <option value="nome">Nome</option>
            </select>
            </div>
            <div class="from-group col-md-5 ">
            <input type="text" class="form-control" name="criterio" placeholder="Buscar...">
            </div>
            <div class="from-group col-md-2" style="float:right;">
            <span class="input-group-btn">
              <button class="btn btn-default" type="submit">OK</button>
            </span>
            </div>
        </form>
          </div>
    </div>

    <div class="tabela">
      <table class="table">
        <tr>
          <th>NOME</th>
          <th>MATRÍCULA</th>
          <th>S. BRUTO</th>
          <th>S. LIQUIDO</th>
          <th>INSS</th>
          <th>IRRF</th>
          <th>CARGO</th>
          <th>BONIFICAÇÃO</th>
        </tr>
      @foreach($funcionarios as $funcionario)
    <?php $liquido = $funcionario->bruto - ($funcionario->bruto*0.11 + $funcionario->bruto*0.16) + 200;?>
        <tr>
          <td>{{ $funcionario->nome }}</td>
          <td>{{ $funcionario->matricula }}</td>
          <td>R${{ $funcionario->bruto }}</td>
          <td>R$ 
            @if($funcionario->bonificado == 1)
              @if($funcionario->cargo=='engenheiro')
                {{ $liquido+($liquido*0.20)}}
              @elseif($funcionario->cargo=='diretor')
                {{ $liquido+($liquido*0.10)}}
              @elseif($funcionario->cargo=='gerente')
                {{ $liquido+($liquido*0.15)}}
              @endif
            @else 
            {{$liquido}}
            @endif
          </td>
          <td>R$ {{ $funcionario->bruto*0.11}}</td>
          <td>R$ {{ $funcionario->bruto*0.16}}</td>
          <td>{{ $funcionario->cargo}}</td>
          <td>
            @if($funcionario->bonificado == 0)
              Não
            @else
              Sim
            @endif
          </td>
          <td>
            <a href="{{ url("/funcionarios/$funcionario->cod/excluir") }}" class="btn btn-danger btn-action">
              <i class="glyphicon glyphicon-trash"></i>
            </a>
            <a href="{{ url("/funcionarios/$funcionario->cod/editar") }}" class="btn btn-primary btn-action">
              <i class="glyphicon glyphicon-pencil"></i>
            </a>
          </td>
        </tr>
      @endforeach
      </table>
    </div>
  </div>
@endsection