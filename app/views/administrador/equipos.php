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
								<th>Acciones</th>
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
									<td>
										<a class="btn btn-primary btn-xs" data-toggle="modal" href='#ed-equipo-<?php echo $eq["id_articulo"]; ?>'><i class="fa fa-edit"></i> Editar</a>
										<a class="btn btn-danger btn-xs" data-toggle="modal" href='#del-equipo-<?php echo $eq["id_articulo"]; ?>'><i class="fa fa-minus-circle"></i> Eliminar</a>
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
					<a class="btn btn-primary btn-block" data-toggle="modal" href='#crear-articulo'><i class="fa fa-plus"></i> Crear Registro</a>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="crear-articulo">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Crear un Registro</h4>
				</div>
				<div class="modal-body">
					<form action="" method="POST" class="form-horizontal" role="form">
							<input type="hidden" name="accion" class="form-control" value="crear">
							<div class="form-group">
								<label for="tipo-articulo" class="col-xs-12 col-sm-2">Tipo Artículo</label>
								<div class="col-xs-12 col-sm-10">
									<select name="tipo-articulo" id="tipo-articulo" class="form-control" required="required">
										<?php foreach ($listaTipos as $ltipo) { ?>
											<option value="<?php echo $ltipo["id_tipoArticulo"] ?>"><?php echo $ltipo["descripcion_tipoArticulo"] ?></option>	
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="descripcion" class="col-xs-12 col-sm-2">Descripción</label>
								<div class="col-xs-12 col-sm-10">
									<input type="text" name="descripcion" id="descripcion" class="form-control" required="required" placeholder="Ingrese pequeña descripción del artículo">
								</div>
							</div>
							<div class="form-group">
								<label for="estado-articulo" class="col-xs-12 col-sm-2">Estado</label>
								<div class="col-xs-12 col-sm-10">
									<select name="estado-articulo" id="estado-articulo" class="form-control" required="required">
										<?php foreach ($listaEstados as $lestado) { ?>
											<option value="<?php echo $lestado["id_estado"]; ?>"><?php echo $lestado["descripcion_estado"]; ?> - <?php if (!$lestado["ultilizable"]){ echo "NO ";} ?>Utilizable</option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="departamento" class="col-xs-12 col-sm-2">Departamento</label>
								<div class="col-xs-12 col-sm-10">
									<select name="departamento" id="departamento" class="form-control" required="required">
										<?php foreach ($listaDepartamentos as $ldepto) { ?>
											<option value="<?php echo $ldepto["id_depto"]; ?>"><?php echo $ldepto["nombre_depto"]; ?></option>
										<?php } ?>
									</select>
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

<?php 
	foreach ($listaEquipos as $eq) { ?>
		<!--Editar equipo-->
		<div class="modal fade" id="ed-equipo-<?php echo $eq["id_articulo"]; ?>">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Editar equipo</h4>
					</div>
					<div class="modal-body">
						<form action="" method="POST" class="form-horizontal" role="form">
								<input type="hidden" name="accion" class="form-control" value="editar">
								<input type="hidden" name="id" class="form-control" value="<?php echo $eq["id_articulo"]; ?>">
								<div class="form-group">
									<label for="tipo-articulo" class="col-xs-12 col-sm-2">Tipo Artículo</label>
									<div class="col-xs-12 col-sm-10">
										<select name="tipo-articulo" id="tipo-articulo" class="form-control" required="required">
											<?php foreach ($listaTipos as $ltipo) { ?>
												<option value="<?php echo $ltipo["id_tipoArticulo"] ?>" <?php if($ltipo["id_tipoArticulo"] == $eq["tipoArticulo"]){ echo "selected=\"selected\"";} ?>><?php echo $ltipo["descripcion_tipoArticulo"] ?></option>	
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="descripcion" class="col-xs-12 col-sm-2">Descripción</label>
									<div class="col-xs-12 col-sm-10">
										<input type="text" name="descripcion" id="descripcion" class="form-control" required="required" value="<?php echo $eq["descripcion_articulo"]; ?>" placeholder="Ingrese pequeña descripción del artículo">
									</div>
								</div>
								<div class="form-group">
									<label for="estado-articulo" class="col-xs-12 col-sm-2">Estado</label>
									<div class="col-xs-12 col-sm-10">
										<select name="estado-articulo" id="estado-articulo" class="form-control" required="required">
											<?php foreach ($listaEstados as $lestado) { ?>
												<option value="<?php echo $lestado["id_estado"]; ?>" <?php if($lestado["id_estado"] == $eq["estado"]){ echo "selected=\"selected\"";} ?>><?php echo $lestado["descripcion_estado"]; ?> - <?php if (!$lestado["ultilizable"]){ echo "NO ";} ?>Utilizable</option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="departamento" class="col-xs-12 col-sm-2">Departamento</label>
									<div class="col-xs-12 col-sm-10">
										<select name="departamento" id="departamento" class="form-control" required="required">
											<?php foreach ($listaDepartamentos as $ldepto) { ?>
												<option value="<?php echo $ldepto["id_depto"]; ?>" <?php if($ldepto["id_depto"] == $eq["depto"]){} ?>><?php echo $ldepto["nombre_depto"]; ?></option>
											<?php } ?>
										</select>
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


		<!--Eliminar equipo-->
		<div class="modal fade" id="del-equipo-<?php echo $eq["id_articulo"]; ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Eliminar equipo</h4>
				</div>
				<div class="modal-body">
					<p>Realmente desea <span class="text-danger">eliminar</span> el equipo N° <b><?php echo $eq["id_articulo"]; ?></b>, 
						cuya descripción es: <b><?php echo $eq["descripcion_articulo"]; ?></b>.</p>
					<form action="" method="POST" class="form-horizontal" role="form">
						<input type="hidden" name="accion" class="form-control" value="eliminar">
						<input type="hidden" name="id" class="form-control" value="<?php echo $eq["id_articulo"]; ?>">
							
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