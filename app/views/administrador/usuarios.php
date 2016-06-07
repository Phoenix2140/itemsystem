<div class="container col-xs-12 col-sm-10 col-sm-offset-1">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-users"></i> Usuarios</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Usuario</th>
								<th>Tipo</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($usuarios as $usuario) { 
								if($usuario["tipoUsuario"] != 'admin'){?>
								<tr>
									<td><?php echo $usuario["id_usuario"]; ?></td>
									<td><?php echo $usuario["nombreUsuario"]; ?> </td>
									<td><?php echo $usuario["tipoUsuario"]; ?></td>
									<td>
										<a class="btn btn-primary btn-xs" data-toggle="modal" href="#ed-user-<?php echo $usuario["id_usuario"]; ?>"><i class="fa fa-edit"></i> Editar</a>
										<a class="btn btn-danger btn-xs" data-toggle="modal" href="#del-user-<?php echo $usuario["id_usuario"]; ?>"><i class="fa fa-minus-circle"></i> Eliminar</a>
									</td>
								</tr>
							<?php }} ?>
							
						</tbody>
					</table>
				</div>

				<div class="col-xs-12 col-sm-3 col-sm-offset-3">
					<a href="<?php echo $baseUrl; ?>/panel" type="button" class="btn btn-default btn-block"><i class="fa fa-arrow-circle-left"></i> Volver</a>
				</div>
				<div class="col-xs-12 col-sm-3">
					<a class="btn btn-primary btn-block" data-toggle="modal" href="#crear-usuario"><i class="fa fa-plus"></i> Crear</a>
				</div>
			</div>
		</div>
	</div>
<?php 
	foreach ($usuarios as $usuario) {
		if($usuario["tipoUsuario"] != 'admin'){?>
		<div class="modal fade" id="ed-user-<?php echo $usuario["id_usuario"]; ?>">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Editar Usuario</h4>
					</div>
					<div class="modal-body">
					<form action="" method="POST" class="form-horizontal" role="form">
						<input type="hidden" name="accion" class="form-control" value="editar">
						<input type="hidden" name="id" value="<?php echo $usuario["id_usuario"]; ?>">
						<div class="form-group">
							<label class="col-xs-12 col-sm-2" for="usuario">Usuario</label>
							<div class="col-xs-12 col-sm-10">
								<input type="text" name="usuario" id="usuario" class="form-control" value="<?php echo $usuario["nombreUsuario"]; ?>" required="required" placeholder="Ingrese el nombre del Usuario">
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-2" for="pass">Contraseña</label>
							<div class="col-xs-12 col-sm-10">
								<input type="password" name="pass" id="pass" class="form-control" required="required" placeholder="Ingrese la Contraseña del usuario">
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-2" for="tipo-usuario">Tipo Usuario</label>
							<div class="col-xs-12 col-sm-10">
								<select name="tipo-usuario" id="tipo-usuario" class="form-control" required="required">
									<option value="encargado" <?php if($usuario["tipoUsuario"] == 'encargado'){ echo "selected=\"selected\"";} ?>>Encargado</option>
									<option value="normal" <?php if($usuario["tipoUsuario"] == 'normal'){ echo "selected=\"selected\"";} ?>>Normal</option>
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
		<div class="modal fade" id="del-user-<?php echo $usuario["id_usuario"]; ?>">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Eliminar Usuario</h4>
					</div>
					<div class="modal-body">
						<p>Está seguro que desea <span class="text-danger">eliminar</span> al usuario <b><?php echo $usuario["nombreUsuario"]; ?></b></p>
						<form action="" method="POST" class="form-horizontal" role="form">
							<input type="hidden" name="id" value="<?php echo $usuario["id_usuario"]; ?>">
							<input type="hidden" name="accion" value="eliminar">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-danger">Eliminar</button>
					</div>
						</form> <!-- fin del formulario -->
				</div>
			</div>
		</div>
		
<?php }} ?>

<div class="modal fade" id="crear-usuario">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Crear Usuario</h4>
			</div>
			<div class="modal-body">
				<form action="" method="POST" class="form-horizontal" role="form">
					<input type="hidden" name="accion" class="form-control" value="crear">
					<div class="form-group">
						<label class="col-xs-12 col-sm-2" for="usuario">Usuario</label>
						<div class="col-xs-12 col-sm-10">
							<input type="text" name="usuario" id="usuario" class="form-control" required="required" placeholder="Ingrese el nombre del Usuario">
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-2" for="pass">Contraseña</label>
						<div class="col-xs-12 col-sm-10">
							<input type="password" name="pass" id="pass" class="form-control" required="required" placeholder="Ingrese la Contraseña del usuario">
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-2" for="tipo-usuario">Tipo Usuario</label>
						<div class="col-xs-12 col-sm-10">
							<select name="tipo-usuario" id="tipo-usuario" class="form-control" required="required">
								<option value="encargado">Encargado</option>
								<option value="normal">Normal</option>
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

