<div id="modalNovoProjeto" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Criar Novo Projeto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  	<form action="{{route('novoProjeto')}}" method="POST">
			<div class="modal-body">
				@csrf
				<div class="col-12">
					<label for="nomeProjeto" class="control-label" >Nome do Projeto:</label>
					<input type="text" class="form-control" name="nomeProjeto" id="nomeProjeto" required=required />
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Criar Projeto</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i>Cancelar</button>
			</div>
		</form>	
    </div>
  </div>
</div>