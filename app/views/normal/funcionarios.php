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
							</tr>
						</thead>
						<tbody>
							<?php foreach ($listaFuncionarios as $funcionario) { ?>
								<tr>
									<td><?php echo $funcionario["rut"]; ?></td>
									<td><?php echo $funcionario["nombre"]; ?> </td>
									<td><?php echo $listaNombresDepartamentos[$funcionario["depto"]]; ?></td>
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