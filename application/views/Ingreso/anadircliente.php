<div id="centralregistro">
    <?php 
    $attributes = array('class' => 'form-horizontal', 'id' => 'anadircliente');
    echo form_open('anadircliente',$attributes);//le indico el controlador
    ?>
        <legend>Añadir Cliente</legend>
        <fieldset class="control-group error">
            <div class="form-group">
                <label for="nombre" class="control-label col-xs-2">Nombre:</label>
                <div class="col-xs-9">
                    <input name="nombre" id="nombre" type="text" class="form-control"  id="inputnombre" value="<?php echo set_value('nombre'); ?>" /><?php echo form_error('nombre', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="apellidos" class="control-label col-xs-2">Apellidos:</label>
                <div class="col-xs-9">
                    <input name="apellidos" id="apellidos" type="text" class="form-control"  id="inputapellidos" value="<?php echo set_value('apellidos'); ?>" /><?php echo form_error('apellidos', '<span class="error">', '</span>'); ?>
                </div>
            </div>
             <div class="form-group">
                <label for="nif" class="control-label col-xs-2">Nif:</label>
                <div class="col-xs-9">
                    <input name="nif" id="nif" type="text" class="form-control"  id="inputnif" value="<?php echo set_value('nif'); ?>" /><?php echo form_error('nif', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="direccion" class="control-label col-xs-2">Dirección:</label>
                <div class="col-xs-9">
                    <input name="direccion" id="direccion" type="text" class="form-control" id="inputdireccion" value="<?php echo set_value('direccion'); ?>" /><?php echo form_error('direccion', '<span class="error">', '</span>'); ?>
                </div>
            </div> 
            <div class="form-group">
                <label for="provincia" class="control-label col-xs-2">Provincia:</label>
                <div class="col-xs-9">
                    <select name="provincia" id="provincia" class="form-control">
                        <option value="0" selected="selected">Selecciona la Provincia</option>
                        <?php foreach($provincias as $provincia): ?>
                        <option value="<?php echo $provincia->getIdprovincia()?>"><?php echo $provincia->getProvincia()?></option>
                        <?php endforeach ?>
                    </select><?php echo form_error('telefono', '<span class="error">', '</span>'); ?>
                </div>
            </div>   
            <div class="form-group">
                <label for="telefono" class="control-label col-xs-2">Teléfono:</label>
                <div class="col-xs-9">
                    <input name="telefono" id="telefono" type="text" class="form-control" id="inputtelefono" value="<?php echo set_value('telefono'); ?>" /><?php echo form_error('telefono', '<span class="error">', '</span>'); ?>
                </div>
            </div>
             <div class="form-group">
                <label for="fax" class="control-label col-xs-2">Fax:</label>
                <div class="col-xs-9">
                    <input name="fax" id="fax" type="text" class="form-control" id="inputfax" value="<?php echo set_value('fax'); ?>" /><?php echo form_error('fax', '<span class="error">', '</span>'); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="contacto" class="control-label col-xs-2">Contacto:</label>
                <div class="col-xs-9">
                    <input name="contacto" id="contacto" type="text" class="form-control" value="<?php echo set_value('contacto'); ?>" /><?php echo form_error('contacto', '<span class="error">', '</span>'); ?>
                </div>
            </div>            
            <br>
            <div class="form-group">
                <div class="col-xs-offset-2 col-xs-9">
                    <input name="enviar" id="enviar" type="submit" class="btn btn-primary" value="Enviar">
                    <input id="limpiar" type="reset" class="btn btn-default" value="Limpiar">
                </div>
            </div>

        </fieldset> 
        <?php echo form_close(); ?>   
    </form>
</div>