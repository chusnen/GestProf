<div id="centralregistro">	
    
    <?php 
	$attributes = array('class' => 'form-horizontal', 'id' => 'modelo3031t');
    echo form_open('grafico',$attributes);//le indico el controlador
    ?>
    <legend>Generar Grafico de la Situacion financiera por Fechas</legend>
    <fieldset>
		<div class="form-group">
		    <label for="fechainicio" class="control-label col-xs-2">Indica la fecha de inicio:</label>
		    <div class="col-xs-9">
		    	<input type="date" name="fechainicio" step="1" min="2014-01-01" required="required" value="<?php echo set_value('fechainicio'); ?>" /><?php echo form_error('fechainicio', '<span class="error">', '</span>'); ?>
			</div>
		</div>	
		<div class="form-group">
		    <label for="fechafin" class="control-label col-xs-2">Indica la fecha de final:</label>
		    <div class="col-xs-9">
		    	<input type="date" name="fechafin" step="1" min="2014-01-01" required="required" value="<?php echo set_value('fechafin'); ?>" /><?php echo form_error('fechafin', '<span class="error">', '</span>'); ?>
			</div>
		</div>
		<div class="form-group">
		    <div class="col-xs-offset-2 col-xs-9">
		        <input name="fechas" id="enviar" type="submit" class="btn btn-primary" value="Generar Gráfico">
		        <input id="limpiar" type="reset" class="btn btn-default" value="Limpiar">
		    </div>
		</div>
	</fieldset> 		
 	<?php echo form_close(); ?>
 	 <?php 
	$attributes = array('class' => 'form-horizontal', 'id' => 'modelo1301t');
    echo form_open('grafico',$attributes);//le indico el controlador
    ?>
     <legend>Generar Gráfico del total de ingresos y gastos</legend>
    <fieldset>
		<div class="form-group">
		    <div class="col-xs-offset-2 col-xs-9">
		        <input name="total" id="enviar" type="submit" class="btn btn-primary" value="Generar grafico">
		        <input id="limpiar" type="reset" class="btn btn-default" value="Limpiar">
		    </div>
		</div>
	</fieldset> 	
</div>