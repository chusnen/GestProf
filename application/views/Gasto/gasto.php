<div id="centralregistro" >
	<div id="navbar" class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
			<li><a href="#">Nombre: <?php echo $nombre ?> </a> </li>
			<li> <a href="#">Apellidos: <?php echo $apellidos ?> </a> </li>
			<li> <a href="#">Nif: <?php echo $nif ?> </a> </li>
			<li> <a href="#">Actividad: <?php echo $actividad ?></a> </li>
		</ul>
	</div>
	<p><a class="btn btn-primary btn-lg" href="<?php echo base_url(); ?>anadirfacturagasto" role="button">Añadir factura</a></p>
	<div class="panel panel-default">
   		<div class="panel-heading">Resumen Facturación de Gastos</div>
		<table class="table" summary="Resumen Facturas">
	  		<thead>
		        <tr>
			      	<th scope="col">Fecha</th>
				    <th scope="col">Nº Factura</th>
				    <th scope="col">Descripcion</th>
				    <th scope="col">Proveedor</th>
				    <th scope="col">Base Imponible</th>
				    <th scope="col">Total</th>
				    <th scope="col">Agregar Pago</th>
		    	</tr>
	  		</thead> 
 			<tbody>
 				<?php foreach($facturas as $factura): ?>
 				<tr>
	                <td><?php echo $factura->getFecha()?></td>
	                <td><?php echo $factura->getNumero()?></td>
	                <td><?php echo $factura->getDescripcion()?></td>
	                <td><?php echo $factura->getIdproveedores()->getIdpersona()->getNombre()?></td> 
	                <td><?php echo $factura->getBaseImponible()?> €</td>
	                <td><?php echo $factura->getTotal()?> €</td>
		            <td><?php 
	                		if ($factura->getIdcaja() == null) {
	                			$attributes = array('class' => 'form-horizontal', 'id' => 'pago');
	                			echo form_open('anadirgasto',$attributes);//le indico el controlador
	                			echo "<input name='enviar' id='enviar' type='submit' class='btn btn-primary-xs' value='Agregar Cobro'>";
	                			echo "<input type='hidden' name='idfactura' value='"; 
	                			echo $factura->getId();
	                			echo "'>";
    							echo form_close(); 
	                		}
	                		else{
	                			$attributes = array('class' => 'form-horizontal', 'id' => 'pago');
	                			echo form_open('#',$attributes);//le indico el controlador
	                			echo "<label for='pagado' class='control-label col-xs-2'>Pagado</label>";
    							echo form_close(); 
	                		}
	                	?> 	                	
    				</td>
    			</tr>            
        		<?php endforeach ?>			   
 			</tbody>
		</table>
	</div>
</div>