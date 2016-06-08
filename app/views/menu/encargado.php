<nav class="navbar navbar-inverse" role="navigation">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo $baseUrl; ?>"><i class="fa fa-inbox"></i> ITEMSYSTEM</a>
			</div>
	
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				
				<ul class="nav navbar-nav navbar-right">
					<li <?php if($menuVal== 'panel'){echo "class=\"active\"";} ?>><a href="<?php echo $baseUrl; ?>/panel"><i class="fa fa-list-alt"></i> Panel</a></li>
					<li <?php if($menuVal== 'equipos'){echo "class=\"active\"";} ?>><a href="<?php echo $baseUrl; ?>/equipos"><i class="fa fa-laptop"></i> Equipos</a></li>
					<li <?php if($menuVal== 'funcionarios'){echo "class=\"active\"";} ?>><a href="<?php echo $baseUrl; ?>/funcionarios"><i class="fa fa-users"></i> Funcionarios</a></li>
					<li <?php if($menuVal== 'departamentos'){echo "class=\"active\"";} ?>><a href="<?php echo $baseUrl; ?>/departamentos"><i class="fa fa-building"></i> Departamentos</a></li>
					<li><a href="<?php echo $baseUrl; ?>/salir"><i class="fa fa-user-times"></i> Salir</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div>
	</nav>