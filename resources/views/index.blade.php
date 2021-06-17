@extends('app')
@section('titulo','Pagina Inicial')
@section('conteudo')
<h1>Lista de diaristas</h1>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">telefone</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($diaristas as $diarista)
        <tr>
            <th scope="row">{{$diarista->id}}</th>
            <td>{{$diarista->nome_completo}}</td>
            <td>{{ \Clemdesign\PhpMask\Mask::apply($diarista->telefone, '(00) 00000-0000') }}</td>
            <td>
                <a class="btn btn-primary" href="{{route('diaristas.edit',$diarista)}}">Atualizar</a>
                <a class="btn btn-danger" href="{{route('diaristas.destroy', $diarista)}}"
                    onclick="return confirm('Tem certeza que deseja apagar?')">Apagar</a>
            </td>
        </tr>
        @empty
        <tr>
            <th></th>
            <td>Nenhum registro cadastrado</td>
            <td></td>
            <td></td>
        </tr>
        @endforelse
    </tbody>
</table>
<a href=" {{route('diaristas.create')}}" class="btn btn-success">Nova Diarista</a>
@endsection