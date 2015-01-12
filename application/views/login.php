<div id="login"> 
	<ul class="nav navbar-nav">

		<li><a>Usuario:  <?php echo $this->session->userdata('identity');?></a></li> 
		<li><a href="<?php echo base_url();?>auth/logout">Cerrar sesion</a></li>
	</ul> 
	 </div> 