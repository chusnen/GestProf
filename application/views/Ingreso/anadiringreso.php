<div id="centralregistro">
<?php 
    $attributes = array('class' => 'form-horizontal', 'id' => 'anadiringreso');
    echo form_open('anadiringreso',$attributes);//le indico el controlador
    ?>
        <legend>Añadir Pago</legend>
        <fieldset class="control-group error">
            <div class="form-group">
                <label for="fecha" class="control-label col-xs-2">Fecha:</label>
                <div class="col-xs-9">
                    <input type="date" name="fecha" step="1" min="2014-01-01" required="required" value="<?php echo set_value('fecha'); ?>" /><?php echo form_error('fecha', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="formapago" class="control-label col-xs-2">Forma de Pago:</label>
                <div class="col-xs-9">
                    <select name="formapago" id="formapago" class="form-control"><?php echo form_error('formapago', '<span class="error">', '</span>'); ?>
                        <option value="0" selected="selected">Selecciona la Forma de Pago</option><!-- Pongo por defecto 0 para controlar el error -->
                        <?php foreach($formaspago as $formapago): ?>
                        <option value="<?php echo $formapago->getIdFormapago()?>"><?php echo $formapago->getDescripcion()?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>   
             <div class="form-group">
                <label for="tipoingreso" class="control-label col-xs-2">Tipo de Ingreso:</label>
                <div class="col-xs-9">
                    <select name="tipoingreso" id="tipoingreso" class="form-control"><?php echo form_error('tipoingreso', '<span class="error">', '</span>'); ?>
                        <option value="0" selected="selected">Selecciona el Tipo de Ingreso</option><!-- Pongo por defecto 0 -->
                        <?php foreach($tiposingreso as $tipoingreso): ?>
                        <option value="<?php echo $tipoingreso->getIdTipoingreso()?>"><?php echo $tipoingreso->getDescripcion()?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>               
            <br>
            <div class="form-group">
                <div class="col-xs-offset-2 col-xs-9">
                    <input type='hidden' name='idfactura' value="<?php echo $numero?>"><!-- Obtengo el id de factura para añadir los detalle a esa factura -->
                    <input name="enviar" id="enviar" type="submit" class="btn btn-primary" value="Enviar">
                    <input id="limpiar" type="reset" class="btn btn-default" value="Limpiar">
                </div>
            </div>

        </fieldset> 
        <?php echo form_close(); ?>   
    </form>
</div>