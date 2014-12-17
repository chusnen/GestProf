<div id="centralregistro">
    <script type="text/javascript">
        $(document).ready(function(){
            $("#registro").submit(function(){
                $.ajax({
                    url: $(this).attr("action"),
                    type: $(this).attr("method"),
                    data: $(this).serialize(),
                    beforeSend:function(){
                        $(".loader").show();
                    },
                    success:function(){
                        $(".loader").fadeOut("slow");
                    }
                });
 
            });
            return false;
        });
    </script>
    <?php 
    $attributes = array('class' => 'form-horizontal', 'id' => 'facturas');
    echo form_open('ingreso/factura',$attributes);//le indico el controlador
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
                <label for="formacobro" class="control-label col-xs-2">Forma Cobro:</label>
                <div class="col-xs-9">
                    <input name="formacobro" id="formacobro" type="text" class="form-control" id="inputformacobro" value="<?php echo set_value('formacobro'); ?>" /><?php echo form_error('formacobro', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="fechacobro" class="control-label col-xs-2">Fecha Cobro:</label>
                <div class="col-xs-9">
                    <input name="fechacobro" id="fechacobro" type="text" class="form-control" id="inputfechacobro" value="<?php echo set_value('fechacobro'); ?>" /><?php echo form_error('fechacobro', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="tipoingreso" class="control-label col-xs-2">Tipo Ingreso:</label>
                <div class="col-xs-9">
                    <input name="tipoingreso" id="tipoingreso" type="text" class="form-control" value="<?php echo set_value('tipoingreso'); ?>" /><?php echo form_error('tipoingreso', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="cliente" class="control-label col-xs-2">Cliente:</label>
                <div class="col-xs-9">
                    <input name="cliente" id="cliente" type="text" class="form-control" value="<?php echo set_value('cliente'); ?>" /><?php echo form_error('cliente', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="fecha" class="control-label col-xs-2">Fecha:</label>
                <div class="col-xs-9">
                    <input name="fecha" id="fecha" type="text" class="form-control" value="<?php echo set_value('fecha'); ?>" /><?php echo form_error('fecha', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <p><a class="btn btn-primary btn-lg" href="<?php echo base_url(); ?>Ingreso/detalle" role="button">Añadir Detalle Factura</a></p>
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