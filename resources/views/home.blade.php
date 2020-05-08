@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Meus projetos
                    <div class="float-right">
                        <button class="btn btn-success btn-sm" id="btnNovo">
                            <i class="fa fa-file-o" aria-hidden="true"></i>
                            Novo Projeto
                        </button>
                        <button class="btn btn-primary btn-sm" id="btnColaborar">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            Colaborar
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    @if(count($projetos))  
                    <table class="table table-condensed " style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th style="width:40%">Nome</th>
                                <th>Criado em</th>
                                <th>Papel</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projetos as $projeto)
                                <tr>
                                    <td>{{$projeto->nome}}</td>
                                    <td>{{Carbon\Carbon::parse($projeto->created_at)->format('d/m/Y')}}</td>
                                    <td>{{$projeto->tipo == 'P'?'Proprietário':'Colaborador'}}</td>
                                    <td>
                                        <a href="{{route('editarProjeto',$projeto->url)}}"  class="btn btn-outline-secondary btn-sm">
                                            <i class="fa fa-edit"></i>
                                            Editar
                                        </a>
                                        <a data-chave="{{$projeto->url}}" data-toggle="tooltip" title="Clique para gerar chave de colaboração"  class="btn btn-link btn-sm btnChave">
                                            <i class="fa fa-user-plus"></i>
                                        </a>
                                    </td>
                                </tr>                            
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="alert text-center"><h4>Você ainda não tem nenhum projeto</h4></div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@include('modais.novoProjeto')
@include('modais.colaborarProjeto')
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('#btnNovo').click(function() {
            $('#modalNovoProjeto').modal('show');
        });
        $('#btnColaborar').click(function() {
            $('#modalColaborar').modal('show');
        });
        $('.btnChave').click(function() {
            var txt = `<h4 class="text-center">Compartilhe a chave abaixo com os usuários que deseja convidar para colaborar</h4>
                        <p class="alert alert-primary pt-2 text-center">${$(this).attr("data-chave")}</p>`;
            bootbox.alert(txt);
        }); $('#formNovo').submit(function() {
            showLoader();
        });
        $('#formColaborar').submit(function() {
            showLoader();
        });
    });
   
</script>
@endsection