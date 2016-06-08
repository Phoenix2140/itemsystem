<div class="container col-xs-12 col-sm-10 col-sm-offset-1">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-building"></i> Departamentos</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Cantidad de Equipos</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($listDepartamentos as $departamento) { ?>
								<tr>
									<td><?php echo $departamento["id_depto"]; ?></td>
									<td><?php echo $departamento["nombre_depto"]; ?></td>
									<td><?php echo $equiposPorDepartamento[$departamento["id_depto"]]; ?></td>
									<td>
										<button type="button" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</button>
										<button type="button" class="btn btn-danger btn-xs"><i class="fa fa-minus-circle"></i> Eliminar</button>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>

				<div class="col-xs-12 col-sm-3 col-sm-offset-3">
					<a href="<?php echo $baseUrl; ?>/panel"	type="button" class="btn btn-default btn-block"><i class="fa fa-arrow-circle-left"></i> Volver</a>
				</div>
				<div class="col-xs-12 col-sm-3">
					<a class="btn btn-primary btn-block" data-toggle="modal" href='#crear-depto'><i class="fa fa-plus"></i> Crear Departamento</a>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="crear-depto">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Crear un departamento</h4>
				</div>
				<div class="modal-body">
					<form action="" method="POST" class="form-horizontal" role="form">
							<div class="form-group">
								<input type="hidden" name="accion" class="form-control" value="crear">
								<label for="nombre" class="col-xs-12 col-sm-3">Nombre Departamento</label>
								<div class="col-xs-12 col-sm-9">
									<input type="text" name="nombre" id="nombre" class="form-control" required="required" placeholder="Ingrese el Nombre del departamento aquí">
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