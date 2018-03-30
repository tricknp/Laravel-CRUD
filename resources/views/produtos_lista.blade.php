@extends('modelo')
@section('conteudo')

<div class="container">

<div class="row" style="margin-top: 10px">
<div class="col-sm-6">
    <h2>Cadastro de Produtos </h2>
</div>

<div class="col-sm-4">
    <form method="POST" class="form-inline" action="{{route('produtos.pesq')}}">
        {{csrf_field()}}
        <input type="text" class="form-control" name="palavra" placeholder="Palavra para Filtrar"> &nbsp;
        <input type="submit" value="Filtrar" class="btn btn-success">
    </form>
</div>

<div class="col-sm-2">
    <a href="{{route('produtos.index')}}" class="btn btn-warning" rule="button"> Todos </a>
    <a href="{{route('produtos.create')}}" class="btn btn-info" rule="button"> Novo </a>
</div>

</div>
@if (session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif
<table class="table table-hover">
    <thead>
      <tr>
        <th>Descrição do Produto</th>
        <th>Marca</th>
        <th>Quantidade</th>
        <th>Preço R$</th>
        <th>Ações</th>
      </tr>
    </thead>

    <tbody>

    @forelse ($produtos as $p)
        <tr>
        <td>{{$p->nome}}</td>
        <td>{{$p->marca}}</td>
        <td>{{$p->quant}}</td>
        <td>{{number_format($p->preco, 2, ',', '.')}}</td>
        <td>
        <a href="{{route('produtos.show', $p ->id)}}"class="btn btn-success btn-sm" role="button">Consultar</a>
        <a href="{{route('produtos.edit', $p ->id)}}"class="btn btn-warning btn-sm" role="button">Alterar</a>
        <form method="POST" action="{{route('produtos.destroy', $p ->id)}}"
            style="display: inline-block;" 
            onsubmit="return confirm('Confirma Exclusão?')">
            {{ method_field('DELETE')}}
            {{csrf_field()}}
            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
        </form>
        </td>
        </tr>
        @empty
            <tr><td colspan=5> Não há Produtos Cadastrados ou para Pesquisa Informada</td></tr>
    @endforelse

    </tbody>

  </table>

</div>

@endsection()
