	<div class="container col-xs-12 col-sm-10 col-sm-offset-1">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-users"></i> Estados de Artículos</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Descripción</th>
								<th>Utilizable</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($listaEstados as $estado) { ?>
								<tr>
									<td><?php echo $estado["id_estado"]; ?></td>
									<td><?php echo $estado["descripcion_estado"]; ?></td>
									<td><?php if($estado["ultilizable"]){ echo "Si"; }else{ echo "No"; } ?></td>
									<td>
										<a class="btn btn-primary btn-xs" data-toggle="modal" href="#ed-user-<?php echo $estado["id_estado"]; ?>"><i class="fa fa-edit"></i> Editar</a>
										<a class="btn btn-danger btn-xs" data-toggle="modal" href="#del-user-<?php echo $estado["id_estado"]; ?>"><i class="fa fa-minus-circle"></i> Eliminar</a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>

				<div class="col-xs-12 col-sm-3 col-sm-offset-3">
					<a href="<?php echo $baseUrl; ?>/panel" type="button" class="btn btn-default btn-block"><i class="fa fa-arrow-circle-left"></i> Volver</a>
				</div>
				<div class="col-xs-12 col-sm-3">
					<a class="btn btn-primary btn-block" data-toggle="modal" href="#crear-estado"><i class="fa fa-user-plus"></i> Crear Estado Artículo</a>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="crear-estado">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Crear Estado Artículo</h4>
				</div>
				<div class="modal-body">
					<form action="" method="POST" class="form-horizontal" role="form">
						<input type="hidden" name="accion" class="form-control" value="crear">
						<div class="form-group">
							<label for="estado-articulo" class="col-xs-12 col-sm-2">Descripción</label>
							<div class="col-xs-12 col-sm-10">
								<input type="text" name="estado-articulo" id="estado-articulo" class="form-control" required="required" placeholder="Ingrese la descripción del estado del artículo">
							</div>
						</div>

						<div class="form-group">
							<label for="estado-articulo" class="col-xs-12 col-sm-2">Utilizable</label>
							<div class="col-xs-12 col-sm-10">
								<div class="radio">
									<label class="col-xs-12">
										<input type="radio" name="utilizable" value="1" checked="checked">
										El equipo se puede utilizar
									</label>
									<label class="col-xs-12">
										<input type="radio" name="utilizable" value="0">
										El equipo no se puede utilizar
									</label>
								</div>
							</div>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
					</form>
					
			</div>
		</div>
	</div>