<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles">Panel <small>usuario</small></h1>
	</div>
</div>
<div class="full-box text-center" style="padding: 30px 10px;">
    <?php 
        require "./controllers/employeeController.php";
        $insEmpleado= new employeeController();
        $CEmpleo=$insEmpleado->datos_empleado_controlador("Conteo", 0);
    ?>
    <div class="row">
    <div class="col-lg-6">
    	<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Panel Usuario</h6>
                </div>
                <div class="card-body">
                  Bienvenido al aplicativo
                </div>
        </div>
    </div>
    </div>
    <!--
	<article class="full-box tile">
		<div class="full-box tile-title text-center text-titles text-uppercase">
			Teacher
		</div>
		<div class="full-box tile-icon text-center">
			<i class="zmdi zmdi-male-alt"></i>
		</div>
		<div class="full-box tile-number text-titles">
			<p class="full-box">10</p>
			<small>Register</small>
		</div>
	</article>
	<article class="full-box tile">
		<div class="full-box tile-title text-center text-titles text-uppercase">
			Student
		</div>
		<div class="full-box tile-icon text-center">
			<i class="zmdi zmdi-face"></i>
		</div>
		<div class="full-box tile-number text-titles">
			<p class="full-box">70</p>
			<small>Register</small>
		</div>
	</article>-->
</div>
<div class="container-fluid">
<!--	<div class="page-header">
	  <h1 class="text-titles">System <small>TimeLine</small></h1>
	</div>
	<section id="cd-timeline" class="cd-container">
        <div class="cd-timeline-block">
            <div class="cd-timeline-img">
                <img src="<?php echo SERVERURL; ?>vistas/assets/avatars/Male1Avatar.png" alt="user-picture">
            </div>
            <div class="cd-timeline-content">
                <h4 class="text-center text-titles">1 - Name (Admin)</h4>
                <p class="text-center">
                    <i class="zmdi zmdi-timer zmdi-hc-fw"></i> Start: <em>7:00 AM</em> &nbsp;&nbsp;&nbsp; 
                    <i class="zmdi zmdi-time zmdi-hc-fw"></i> End: <em>7:17 AM</em>
                </p>
                <span class="cd-date"><i class="zmdi zmdi-calendar-note zmdi-hc-fw"></i> 07/07/2016</span>
            </div>
        </div>  
        <div class="cd-timeline-block">
            <div class="cd-timeline-img">
                <img src="<?php echo SERVERURL; ?>vistas/assets/avatars/Male1Avatar.png" alt="user-picture">
            </div>
            <div class="cd-timeline-content">
                <h4 class="text-center text-titles">2 - Name (Teacher)</h4>
                <p class="text-center">
                    <i class="zmdi zmdi-timer zmdi-hc-fw"></i> Start: <em>7:00 AM</em> &nbsp;&nbsp;&nbsp; 
                    <i class="zmdi zmdi-time zmdi-hc-fw"></i> End: <em>7:17 AM</em>
                </p>
                <span class="cd-date"><i class="zmdi zmdi-calendar-note zmdi-hc-fw"></i> 07/07/2016</span>
            </div>
        </div>
        <div class="cd-timeline-block">
            <div class="cd-timeline-img">
                <img src="<?php echo SERVERURL; ?>vistas/assets/avatars/Male1Avatar.png" alt="user-picture">
            </div>
            <div class="cd-timeline-content">
                <h4 class="text-center text-titles">3 - Name (Student)</h4>
                <p class="text-center">
                    <i class="zmdi zmdi-timer zmdi-hc-fw"></i> Start: <em>7:00 AM</em> &nbsp;&nbsp;&nbsp; 
                    <i class="zmdi zmdi-time zmdi-hc-fw"></i> End: <em>7:17 AM</em>
                </p>
                <span class="cd-date"><i class="zmdi zmdi-calendar-note zmdi-hc-fw"></i> 07/07/2016</span>
            </div>
        </div>
        <div class="cd-timeline-block">
            <div class="cd-timeline-img">
                <img src="<?php echo SERVERURL; ?>vistas/assets/avatars/Male1Avatar.png" alt="user-picture">
            </div>
            <div class="cd-timeline-content">
                <h4 class="text-center text-titles">4 - Name (Personal Ad.)</h4>
                <p class="text-center">
                    <i class="zmdi zmdi-timer zmdi-hc-fw"></i> Start: <em>7:00 AM</em> &nbsp;&nbsp;&nbsp; 
                    <i class="zmdi zmdi-time zmdi-hc-fw"></i> End: <em>7:17 AM</em>
                </p>
                <span class="cd-date"><i class="zmdi zmdi-calendar-note zmdi-hc-fw"></i> 07/07/2016</span>
            </div>
        </div>   
    </section>

-->
</div>