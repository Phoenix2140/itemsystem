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
								<th>Ubicación</th>
								<th>Cantidad de Equipos</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Finanzas</td>
								<td>Nieves</td>
								<td>3</td>
								<td>
									<button type="button" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</button>
									<button type="button" class="btn btn-danger btn-xs"><i class="fa fa-minus-circle"></i> Eliminar</button>
								</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Gerencia</td>
								<td>Nieves</td>
								<td>1</td>
								<td>
									<button type="button" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</button>
									<button type="button" class="btn btn-danger btn-xs"><i class="fa fa-minus-circle"></i> Eliminar</button>
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td>RRHH</td>
								<td>Hodor</td>
								<td>5</td>
								<td>
									<button type="button" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</button>
									<button type="button" class="btn btn-danger btn-xs"><i class="fa fa-minus-circle"></i> Eliminar</button>
								</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Secretaría</td>
								<td>Stark</td>
								<td>9</td>
								<td>
									<button type="button" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</button>
									<button type="button" class="btn btn-danger btn-xs"><i class="fa fa-minus-circle"></i> Eliminar</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="col-xs-12 col-sm-3 col-sm-offset-3">
					<a href="<?php echo $baseUrl; ?>/panel"	type="button" class="btn btn-default btn-block"><i class="fa fa-arrow-circle-left"></i> Volver</a>
				</div>
				<div class="col-xs-12 col-sm-3">
					<button type="button" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Crear</button>
				</div>
			</div>
		</div>
	</div>