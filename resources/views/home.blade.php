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
                        <button class="btn btn-primary btn-sm">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            Colaborar
                        </button>
                    </div>
                </div>

                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
@include('modais.novoProjeto')
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('#btnNovo').click(function() {
            $('#modalNovoProjeto').modal('show');
        });
    });
</script>
@endsection