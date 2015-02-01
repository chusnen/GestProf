
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
  
<<<<<<< HEAD
    <title>GestProf</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript y jquery
    ================================================== -->
    <script src="/js/jquery-1.11.1.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/less.min.js"></script>
    <script src="/js/bootstrap-dropdown.js"></script>
=======
    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="/GestProf/css/bootstrap.min.css" rel="stylesheet">
    <link href="/GestProf/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="/GestProf/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript y jquery
    ================================================== -->
    <script src="/GestProf/js/jquery-1.11.1.js"></script>
    <script src="/GestProf/js/bootstrap.min.js"></script>
    <script src="/GestProf/js/bootstrap.js"></script>
    <script src="/GestProf/js/less.min.js"></script>
    <script src="/GestProf/js/bootstrap-dropdown.js"></script>
>>>>>>> 8011f33d8a051de6436db586be2a2cf87510dff8
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]-->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <!--[endif]-->
    </head>
    <body>
    <div class="row-fluid page-header">    	
	    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	        <div class="span12">
	        	<div class="navbar-header">
	          		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		            	<span class="sr-only">Toggle navigation</span>
		            	<span class="icon-bar"></span>
		            	<span class="icon-bar"></span>
		           	 	<span class="icon-bar"></span>
	          		</button>	          		
         			<a class="navbar-brand" href="<?php echo base_url();?>">GestProf</a>
	        	</div>
	        	<div id="navbar" class="collapse navbar-collapse">	
              

            <ul class="nav navbar-nav">            	
	          	
                <li><a href="<?php echo base_url(); ?>">Inicio</a></li>
                <?php  
                if ($this->ion_auth->logged_in()){ 
                    if(!$this->ion_auth->is_admin()){
                        $this->load->view('encabezadologeado'); 
                        
                    }
                    else{
                        $this->load->view('encabezadoadministrador') ;
                         
                    }
                }
                ?>
                  
            </ul>
                <?php  if ($this->ion_auth->logged_in()) $this->load->view('login') ?>
                   		 
	           	</div><!--/.nav-collapse -->	           	
	        </div>
	    </nav>
	</div>
