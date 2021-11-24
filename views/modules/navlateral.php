<section class="full-box cover dashboard-sideBar">

	<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
	<div class="full-box dashboard-sideBar-ct">
		<!--SideBar Title -->
		<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
			<?php echo COMPANY; ?> <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
		</div>
		<!-- SideBar User info -->
		<div class="full-box dashboard-sideBar-UserInfo">
			<figure class="full-box">
				<div class="text-center">
					<img src="<?php echo SERVERURL; ?>views/assets/img/irenlogo.png" width="50%" alt="">
				</div>
				<!--<img src=" <?php /*echo SERVERURL; ?>vistas/assets/avatars/<?php echo  $_SESSION['foto_sli'];*/?>" alt="UserIcon">-->
				
			</figure>
			<?php
				if($_SESSION['tipo_sli']=='Administrador'){
					$tipo="admin";
				}else{
					$tipo="user";
				}
			?>
			<ul class="full-box list-unstyled text-center">
				<li>
					<a href="<?php echo SERVERURL; ?>nopermiso/<?php echo $tipo?>/<?php echo $lc->encryption($_SESSION['codigo_cuenta_sli']);?>/" title="Mis datos">
						<i class="zmdi zmdi-account-circle"></i>
					</a>
				</li>
				<li>
					<a href="<?php echo SERVERURL; ?>nopermiso/<?php echo $tipo?>/<?php echo $lc->encryption($_SESSION['codigo_cuenta_sli']);?>/" title="Mi cuenta">
						<i class="zmdi zmdi-settings"></i>
					</a>
				</li>
				<li>
					<a href="<?php echo $_SESSION['token_sli'];?>" title="Salir del sistema" class="btn-exit-system">
						<i class="zmdi zmdi-power"></i>
					</a>
				</li>
			</ul>
		</div>
		<!-- SideBar Menu -->
		<ul class="list-unstyled full-box dashboard-sideBar-Menu">
		<?php $tipousuario=$_SESSION['tipo_sli'];
		
		if($tipousuario=="Administrador"){
			?><li>
				<a href="<?php echo SERVERURL; ?>home/">
					<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Cuadro de mando
				</a>
			</li>
			<?php
		}
		?>
			
			<li>
			<!--zmdi-truck-->
				<a href="#!" class="btn-sideBar-SubMenu">
					<i class="zmdi zmdi-case zmdi-widgets zmdi-hc-fw"></i> Aplicativo <i class="zmdi zmdi-caret-down pull-right"></i>
				</a>
				<ul class="list-unstyled full-box">
				<?php 
				$tipousuario=$_SESSION['tipo_sli'];
				switch($tipousuario){
					case "Administrador":?>
					<li>
						<a href="<?php echo SERVERURL; ?>fua/"><i class="zmdi zmdi-accounts zmdi-hc-fw"></i> Fua</a>
					</li>
					
				
					
					<?php break;
					case "Registrador":?>
					<li>
						<a href="<?php echo SERVERURL; ?>fua/"><i class="zmdi zmdi-accounts zmdi-hc-fw"></i> Fuas</a>
					</li>					
					<?php break;
					
				}
				?>
					<!--<li>
						<a href="<?php echo SERVERURL; ?>establecimiento/"><i class="zmdi zmdi-balance zmdi-hc-fw"></i> Centros de Salud</a>
					</li>-->
					
				</ul>
			</li>
			<?php
			if($_SESSION['tipo_sli']=='Administrador'){
			?><li>
				<a href="#!" class="btn-sideBar-SubMenu">
					<i class="zmdi zmdi-case zmdi-hc-fw"></i> Tablas Maestras <i class="zmdi zmdi-caret-down pull-right"></i>
				</a>
				<ul class="list-unstyled full-box">
					<li>
						<a href="<?php echo SERVERURL; ?>nopermiso/"><i class="zmdi zmdi-balance zmdi-hc-fw"></i>Hospital</a>
					</li>
					<li>
						<a href="<?php echo SERVERURL; ?>nopermiso/"><i class="zmdi zmdi-labels zmdi-hc-fw"></i>Dirección</a>
					</li>
					<li>
						<a href="<?php echo SERVERURL; ?>nopermiso/"><i class="zmdi zmdi-truck zmdi-hc-fw"></i>Logo</a>
					</li>
					<li>
						<a href="<?php echo SERVERURL; ?>nopermiso/"><i class="zmdi zmdi-book zmdi-hc-fw"></i>Observaciones</a>
					</li>
				</ul>
			</li>
			<?php
			}
			?>
			<li>
			<?php
			if($_SESSION['tipo_sli']=='Administrador' || $_SESSION['tipo_sli']=='Recepcionador'){
			?>	
				<a href="#!" class="btn-sideBar-SubMenu">
					<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuarios <i class="zmdi zmdi-caret-down pull-right"></i>
				</a>
				<ul class="list-unstyled full-box">
					<li>
						<a href="<?php echo SERVERURL; ?>employee/"><i class="zmdi zmdi-account zmdi-hc-fw"></i>Personal</a>
					</li>
				</ul>
			</li>
			<?php
			}
			?>
			<li>
				<a href="http://irencentro.pe/" target="_Black">
					<i class="zmdi zmdi-book-image zmdi-hc-fw"></i>Portal Web
				</a>
			</li>
		</ul>
	</div>
	
</section>