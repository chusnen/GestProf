    <?php 
    $attributes = array('class' => 'form-horizontal', 'id' => 'registro');
    echo form_open('registro/create',$attributes);
    ?>
        <legend>Registro</legend>
        <fieldset class="control-group error">
            <div class="form-group">
                <label for="usuario" class="control-label col-xs-2">Usuario:</label>
                <div class="col-xs-9">
                    <input name="usuario" id="usuario" type="text" class="form-control"  value="<?php echo set_value('usuario'); ?>" /><?php echo form_error('usuario', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="control-label col-xs-2">Email:</label>
                <div class="col-xs-9">
                    <input name="email" id="email" type="email" class="form-control" id="inputEmail" value="<?php echo set_value('email'); ?>" /><?php echo form_error('email', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="control-label col-xs-2">Password:</label>
                <div class="col-xs-9">
                    <input name="password" id="password" type="password" class="form-control" id="inputPassword" value="<?php echo set_value('password'); ?>" /><?php echo form_error('password', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="confirmarpassword" class="control-label col-xs-2">Confirmar Password:</label>
                <div class="col-xs-9">
                    <input name="confirmarpassword" id="confirmarpassword" type="password" class="form-control" value="<?php echo set_value('confirmarpassword'); ?>" /><?php echo form_error('confirmarpassword', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="nombre" class="control-label col-xs-2">Nombre:</label>
                <div class="col-xs-9">
                    <input name="nombre" id="nombre" type="text" class="form-control" value="<?php echo set_value('nombre'); ?>" /><?php echo form_error('nombre', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="apellidos" class="control-label col-xs-2">Apellidos:</label>
                <div class="col-xs-9">
                    <input name="apellidos" id="apellidos" type="text" class="form-control" value="<?php echo set_value('apellidos'); ?>" /><?php echo form_error('apellidos', '<span class="error">', '</span>'); ?>
                </div>
            </div>
             <div class="form-group">
                <label for="nif" class="control-label col-xs-2">Nif:</label>
                <div class="col-xs-9">
                    <input name="nif" id="nif" type="text" class="form-control" value="<?php echo set_value('nif'); ?>" /><?php echo form_error('nif', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="telefono" class="control-label col-xs-2" >Telefono:</label>
                <div class="col-xs-9">
                    <input name="telefono" id="telefono" type="tel" class="form-control" value="<?php echo set_value('telefono'); ?>" /><?php echo form_error('telefono', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="fax" class="control-label col-xs-2">Fax:</label>
                <div class="col-xs-9">
                    <input name="fax" id="fax" type="tel" class="form-control" value="<?php echo set_value('fax'); ?>" /><?php echo form_error('fax', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="direccion" class="control-label col-xs-2">Dirección:</label>
                <div class="col-xs-9">
                    <textarea name="direccion" id="direccion" rows="2" class="form-control" value="<?php echo set_value('direccion'); ?>" /><?php echo form_error('direccion', '<span class="error">', '</span>'); ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="provincia" class="control-label col-xs-2">Provincia:</label>
                <div class="col-xs-9">
                    <select name="provincia" id="provincia" class="form-control">
                        <option value="" selected="selected">Selecciona la Provincia</option>
                        <?php foreach($provincias as $provincia): ?>
                        <option value="<?php echo $provincia->getProvincia()?>"><?php echo $provincia->getProvincia()?></option>
                        <?php endforeach ?>
                    </select><?php echo form_error('provincia', '<span class="error">', '</span>'); ?>
                </div>
            </div>
              <div class="form-group">
                <label for="delegacion" class="control-label col-xs-2">Delegacion/Población:</label>
                <div class="col-xs-9">
                    <select name="delegacion" id="delegacion" class="form-control">
                        <option value="" selected="selected">Selecciona la Población o Delegación</option>
                        <?php foreach($delegaciones as $delegacion): ?>
                        <option value="<?php echo $delegacion->getPoblacion()?>"><?php echo $delegacion->getPoblacion()?></option>
                        <?php endforeach ?>
                    </select><?php echo form_error('delegacion', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="actividad" class="control-label col-xs-2">Actividad:</label>
                <div class="col-xs-9">
                    <input name="actividad" id="actividad" type="text" class="form-control" value="<?php echo set_value('actividad'); ?>" /><?php echo form_error('actividad', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="nccb" class="control-label col-xs-2">nccb:</label>
                <div class="col-xs-9">
                    <input name="nccb" id="nccb" type="text" class="form-control" placeholder="Número de cuenta bancaria">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-2 col-xs-9">
                    <label for="acepto" class="checkbox-inline">
                        <input name="acepto" id="acepto" type="checkbox" value="agree">  Accepto <a href="#">Terminos y condiciones</a>.
                    </label>
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