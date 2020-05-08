<div id="modalColaborar" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Colaborar em um projeto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  	<form action="{{route('colaborarProjeto')}}" method="POST" id="formColaborar">
			<div class="modal-body">
				@csrf
				<div class="col-12">
					<label for="nomeProjeto" class="control-label" >Chave do projeto:</label>
					<input type="text" class="form-control" name="chaveColaboracao" id="chaveColaboracao" required=required />
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" id="submitColaborar" class="btn btn-primary"><i class="fa fa-check"></i>Colaborar</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i>Cancelar</button>
			</div>
		</form>	
    </div>
  </div>
</div>
