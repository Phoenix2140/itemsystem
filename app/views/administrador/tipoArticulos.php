	<div class="container col-xs-12 col-sm-10 col-sm-offset-1">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-users"></i> Tipo Articulos</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Descripción</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($listaTipos as $tipo) { ?>
								<tr>
									<td><?php echo $tipo["id_tipoArticulo"]; ?></td>
									<td><?php echo $tipo["descripcion_tipoArticulo"]; ?></td>
									<td>
										<a class="btn btn-primary btn-xs" data-toggle="modal" href="#ed-tipo-<?php echo $tipo["id_tipoArticulo"]; ?>"><i class="fa fa-edit"></i> Editar</a>
										<a class="btn btn-danger btn-xs" data-toggle="modal" href='#del-tipo-<?php echo $tipo["id_tipoArticulo"]; ?>'><i class="fa fa-minus-circle"></i> Eliminar</a>
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
					<a class="btn btn-primary btn-block" data-toggle="modal" href="#crear-tipo"><i class="fa fa-user-plus"></i> Crear Tipo Artículo</a>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="crear-tipo">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Crear Tipo Artículo</h4>
				</div>
				<div class="modal-body">
					<form action="" method="POST" class="form-horizontal" role="form">
						<input type="hidden" name="accion" class="form-control" value="crear">
						<div class="form-group">
							<label for="tipo-articulo" class="col-xs-12 col-sm-2">Tipo artículo</label>
							<div class="col-xs-12 col-sm-10">
								<input type="text" name="tipo-articulo" id="tipo-articulo" class="form-control" required="required" placeholder="Ingrese el tipo de artículo que desea agregar a la lista">
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

<?php foreach ($listaTipos as $tipo) { ?>

	<!--Editar tipo articulo-->
	<div class="modal fade" id="ed-tipo-<?php echo $tipo["id_tipoArticulo"]; ?>">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Editar Tipo Artículo</h4>
				</div>
				<div class="modal-body">
					<form action="" method="POST" class="form-horizontal" role="form">
						<input type="hidden" name="accion" class="form-control" value="editar">
						<input type="hidden" name="id" class="form-control" value="<?php echo $tipo["id_tipoArticulo"]; ?>">
						<div class="form-group">
							<label for="tipo-articulo" class="col-xs-12 col-sm-2">Tipo artículo</label>
							<div class="col-xs-12 col-sm-10">
								<input type="text" name="tipo-articulo" id="tipo-articulo" class="form-control" required="required" placeholder="Ingrese el tipo de artículo que desea agregar a la lista" value="<?php echo $tipo["descripcion_tipoArticulo"]; ?>">
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

	<!--Eliminar tipo articulo-->
	<div class="modal fade" id="del-tipo-<?php echo $tipo["id_tipoArticulo"]; ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Eliminar Tipo Artículo</h4>
				</div>
				<div class="modal-body">
					<p>Realmente desea <span class="text-danger">eliminar</span> el el tipo de artículo <b><?php echo $tipo["descripcion_tipoArticulo"]; ?></b>.</p>
					<form action="" method="POST" class="form-horizontal" role="form">
						<input type="hidden" name="accion" class="form-control" value="eliminar">
						<input type="hidden" name="id" class="form-control" value="<?php echo $tipo["id_tipoArticulo"]; ?>">
							
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-danger">Eliminar</button>
				</div>
					</form>
					
			</div>
		</div>
	</div>

<?php } ?>