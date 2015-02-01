<div id="centralregistro">	
    
    <?php 
	$attributes = array('class' => 'form-horizontal', 'id' => 'modelo3031t');
    echo form_open('fichero303',$attributes);//le indico el controlador
    ?>
    <legend>Generar Modelo 303</legend>
    <fieldset>
		<div class="form-group">
		    <label for="ano" class="control-label col-xs-2">Indica el año:</label>
		    <div class="col-xs-9">
		    	<input name="ano" id="ano" type="text" class="form-control" value="<?php echo set_value('ano'); ?>" /><?php echo form_error('ano', '<span class="error">', '</span>'); ?>
			</div>
		</div>	
		<div class="form-group">
		    <label for="trimestre" class="control-label col-xs-2">Indica el trimestre:</label>
		    <div class="col-xs-9">
		    	<input name="trimestre" id="trimestre" type="text" class="form-control" value="<?php echo set_value('trimestre'); ?>" /><?php echo form_error('trimestre', '<span class="error">', '</span>'); ?>
			</div>
		</div>
		<div class="form-group">
            <label for="tipodocumento" class="control-label col-xs-2">Tipo Documento:</label>
            <div class="col-xs-9">
                <select name="tipodocumento" id="tipodocumento" class="form-control">
                    <option value="0" selected="selected">Selecciona el Tipo de Documento que quieres generar</option>
                    <option value="0">Fichero de texto codificado según directrices de hacienda</option>
                    <option value="1">Hoja de cálculo</option>
                </select>
            </div>
        </div>   
		<div class="form-group">
		    <div class="col-xs-offset-2 col-xs-9">
		        <input name="enviar" id="enviar" type="submit" class="btn btn-primary" value="Generar Modelo 303">
		        <input id="limpiar" type="reset" class="btn btn-default" value="Limpiar">
		    </div>
		</div>
	</fieldset> 		
 	<?php echo form_close(); ?>
 	 <?php 
	$attributes = array('class' => 'form-horizontal', 'id' => 'modelo1301t');
    echo form_open('fichero130',$attributes);//le indico el controlador
    ?>
     <legend>Generar Modelo 130</legend>
    <fieldset>
		<div class="form-group">
		    <label for="ano" class="control-label col-xs-2">Indica el año:</label>
		    <div class="col-xs-9">
		    	<input name="ano" id="ano" type="text" class="form-control" value="<?php echo set_value('ano'); ?>" /><?php echo form_error('ano', '<span class="error">', '</span>'); ?>
			</div>
		</div>
		<div class="form-group">
		    <label for="trimestre" class="control-label col-xs-2">Indica el trimestre:</label>
		    <div class="col-xs-9">	
		    	<input name="trimestre" id="trimestre" type="text" class="form-control" value="<?php echo set_value('trimestre'); ?>" /><?php echo form_error('trimestre', '<span class="error">', '</span>'); 	?>
			</div>
		</div>
		<div class="form-group">
            <label for="tipodocumento" class="control-label col-xs-2">Tipo Ducumento:</label>
            <div class="col-xs-9">
                <select name="tipodocumento" id="tipodocumento" class="form-control">
                    <option value="0" selected="selected">Selecciona el Tipo de Documento que quieres generar</option>
                    <option value="0">Fichero de texto codificado según directrices de hacienda</option>
                    <option value="1">Hoja de cálculo</option>
                </select>
            </div>
        </div>   
		<div class="form-group">
		    <div class="col-xs-offset-2 col-xs-9">
		        <input name="enviar" id="enviar" type="submit" class="btn btn-primary" value="Generar Modelo 130">
		        <input id="limpiar" type="reset" class="btn btn-default" value="Limpiar">
		    </div>
		</div>
	</fieldset> 	
</div>