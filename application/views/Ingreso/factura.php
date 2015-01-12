<div id="centralregistro">
    <?php 
    $attributes = array('class' => 'form-horizontal', 'id' => 'facturas');
    echo form_open('anadirfactura',$attributes);//le indico el controlador
    ?>
        <legend>Añadir Factura</legend>
        <fieldset class="control-group error">
            <div class="form-group">
                <label for="numero" class="control-label col-xs-2">Nº Factura:</label>
                <div class="col-xs-9">
                    <input name="numero" id="numero" type="text" class="form-control"  id="inputnumero" value="<?php echo set_value('numero'); ?>" /><?php echo form_error('numero', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="cliente" class="control-label col-xs-2">Cliente:</label>
                <div class="col-xs-9">                    
                    <select name="cliente" id="cliente" class="form-control">
                        <?php foreach($clientes as $cliente): ?>
                        <option value="<?php echo $cliente->getIdcliente()//mando por post el codigo?>"><?php echo $cliente->getIdpersona()->getNombre()//muestro la descripcion?></option>
                        <?php endforeach ?>
                    </select> 
                    <a class="btn btn-primary btn-xs" href="<?php echo base_url(); ?>mostrarcliente" role="button">Añadir Cliente</a>
                </div>
            </div>
            <div class="form-group">
                <label for="fecha" class="control-label col-xs-2">Fecha:</label>
                <div class="col-xs-9">
                    <input type="date" name="fecha" step="1" min="2014-01-01" required="required" value="<?php echo set_value('fecha'); ?>" /><?php echo form_error('fecha', '<span class="error">', '</span>'); ?>
                </div>
            </div>
        </fieldset>
        <div class="form-group">
            <div class="col-xs-offset-2 col-xs-9">
                <input name="enviar" id="enviar" type="submit" class="btn btn-primary" value="Añadir Detalle">
                <input id="limpiar" type="reset" class="btn btn-default" value="Limpiar">
            </div>
        </div>         
    <?php echo form_close(); ?>              
 </div>