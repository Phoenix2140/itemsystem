	<div class="container col-xs-12 col-sm-10 col-sm-offset-1">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-users"></i> Equipos</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Tipo</th>
								<th>Descripción</th>
								<th>Estado</th>
								<th>Utilizable</th>
								<th>Departamento</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($listaEquipos as $eq) { ?>
								<tr>
									<td><?php echo $eq["id_articulo"]; ?></td>
									<td><?php echo $arrayTipos[$eq["tipoArticulo"]]; ?></td>
									<td><?php echo $eq["descripcion_articulo"]; ?></td>
									<td><?php echo $arrayEstados[$eq["estado"]]["descripcion"]; ?></td>
									<td><?php if($arrayEstados[$eq["estado"]]["utilizable"]){ echo "Si"; }else{ echo "No"; } ; ?></td>
									<td><?php echo $arrayDepartamentos[$eq["depto"]]; ?></td>
								</tr>
							<?php } ?>
							
						</tbody>
					</table>
				</div>

				<div class="col-xs-12 col-sm-4 col-sm-offset-4">
					<a href="<?php echo $baseUrl; ?>/panel" type="button" class="btn btn-default btn-block"><i class="fa fa-arrow-circle-left"></i> Volver</a>
				</div>
			</div>
		</div>
	</div>

	