<div id="centralregistro" >
	<div id="navbar" class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
			<li><a href="#">Nombre: <?php echo $nombre ?> </a> </li>
			<li> <a href="#">Apellidos: <?php echo $apellidos ?> </a> </li>
			<li> <a href="#">Nif: <?php echo $nif ?> </a> </li>
			<li> <a href="#">Actividad: <?php echo $actividad ?></a> </li>
		</ul>
	</div>
	<p><a class="btn btn-primary btn-lg" href="<?php echo base_url(); ?>Ingreso/factura" role="button">Añadir factura</a></p>
	<div class="panel panel-default">
   		<div class="panel-heading">Resumen Facturación</div>
		<table class="table" summary="Resumen Facturas">
	  		<thead>
		        <tr>
			      	<th scope="col">Fecha</th>
				    <th scope="col">Nº Factura</th>
				    <th scope="col">Descripcion</th>
				    <th scope="col">Cliente</th>
				    <th scope="col">Base Imponible</th>
				    <th scope="col">Total</th>
				    <th scope="col">PDF</th>
		    	</tr>
	  		</thead> 
 			<tbody>
 				<?php foreach($facturas as $factura): ?>
 				<tr>
	                <td><?php echo $factura->getFecha()?></td>
	                <td><?php echo $factura->getNumero()?></td>
	                <td><?php echo $factura->getDescripcion()?></td>
	                <td><?php echo $factura->getIdcliente()?></td>
	                <td><?php echo $factura->getBaseImponible()?></td>
	                <td><?php echo $factura->getTotal()?></td>
	                <td><?php echo $factura->getRutaPdf()?></td>
                </tr>            
        		<?php endforeach ?>			   
 			</tbody>
		</table>
	</div>
</div>
