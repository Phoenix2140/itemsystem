<div class="container col-xs-12 col-sm-10 col-sm-offset-1">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-users"></i> Funcionarios</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th>RUT</th>
								<th>Nombre</th>
								<th>Departamento</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($listaFuncionarios as $funcionario) { ?>
								<tr>
									<td><?php echo $funcionario["rut"]; ?></td>
									<td><?php echo $funcionario["nombre"]; ?> </td>
									<td><?php echo $listaNombresDepartamentos[$funcionario["depto"]]; ?></td>
									<td>
										<a class="btn btn-primary btn-xs" data-toggle="modal" href='#editar-funcionario-<?php echo $funcionario["id_funcionario"]; ?>'><i class="fa fa-edit"></i> Editar</a>
										<a class="btn btn-danger btn-xs" data-toggle="modal" href='#del-funcionario-<?php echo $funcionario["id_funcionario"]; ?>'><i class="fa fa-minus-circle"></i> Eliminar</a>
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
					<a class="btn btn-primary btn-block" data-toggle="modal" href='#crear-funcionario'><i class="fa fa-plus"></i> Crear Funcionario</a>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="crear-funcionario">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Crear Funcionario</h4>
				</div>
				<div class="modal-body">
					<form action="" method="POST" class="form-horizontal" role="form">
							<input type="hidden" name="accion" class="form-control" value="crear">
							<div class="form-group">
								<label for="nombre" class="col-xs-12 col-sm-2">Nombre</label>
								<div class="col-xs-12 col-sm-10">
									<input type="text" name="nombre" id="nombre" class="form-control" required="required" placeholder="Ingrese el nombre del funcionario">
								</div>
							</div>
							
							<div class="form-group">
								<label for="rut" class="col-xs-12 col-sm-2">Rut</label>
								<div class="col-xs-12 col-sm-10">
									<input type="text" name="rut" id="rut" class="form-control" required="required" placeholder="Ingrese el rut del funcionario">
								</div>
							</div>

							<div class="form-group">
								<label for="departamento" class="col-xs-12 col-sm-2">Departamento</label>
								<div class="col-xs-12 col-sm-10">
									<select name="departamento" id="departamento" class="form-control" required="required">
										<?php foreach ($listaDepartamentos as $departamento) { ?>
											<option value="<?php echo $departamento["id_depto"]; ?>"><?php echo $departamento["nombre_depto"]; ?></option>						
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

<?php foreach ($listaFuncionarios as $funcionario) { ?>
	
	<div class="modal fade" id="editar-funcionario-<?php echo $funcionario["id_funcionario"] ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Editar Funcionario</h4>
				</div>
				<div class="modal-body">
					<form action="" method="POST" class="form-horizontal" role="form">
							<input type="hidden" name="accion" class="form-control" value="editar">
							<input type="hidden" name="id" class="form-control" value="<?php echo $funcionario["id_funcionario"] ?>">
							<div class="form-group">
								<label for="nombre" class="col-xs-12 col-sm-2">Nombre</label>
								<div class="col-xs-12 col-sm-10">
									<input type="text" name="nombre" class="form-control" required="required" value="<?php echo $funcionario["nombre"]; ?>" placeholder="Ingrese el nombre del funcionario">
								</div>
							</div>
							
							<div class="form-group">
								<label for="rut" class="col-xs-12 col-sm-2">Rut</label>
								<div class="col-xs-12 col-sm-10">
									<input type="text" name="rut" class="form-control" required="required" value="<?php echo $funcionario["rut"]; ?>" placeholder="Ingrese el rut del funcionario">
								</div>
							</div>

							<div class="form-group">
								<label for="departamento" class="col-xs-12 col-sm-2">Departamento</label>
								<div class="col-xs-12 col-sm-10">
									<select name="departamento" class="form-control" required="required">
										<?php foreach ($listaDepartamentos as $departamento) { ?>
											<option value="<?php echo $departamento["id_depto"]; ?>" <?php if($departamento["id_depto"] == $funcionario["depto"]){ echo "selected=\"selected\""; } ?>><?php echo $departamento["nombre_depto"]; ?></option>						
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

	<div class="modal fade" id="del-funcionario-<?php echo $funcionario["id_funcionario"]; ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Eliminar Funcionario</h4>
				</div>
				<div class="modal-body">
					<p>Realmente desea <span class="text-danger">eliminar</span> al funcionario <b><?php echo $funcionario["nombre"]; ?></b>.</p>
					<form action="" method="POST" class="form-horizontal" role="form">
						<input type="hidden" name="accion" class="form-control" value="eliminar">
						<input type="hidden" name="id" class="form-control" value="<?php echo $funcionario["id_funcionario"]; ?>">
							
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