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
    $attributes = array('class' => 'form-horizontal', 'id' => 'detalles');
    echo form_open('ingreso/detalle',$attributes);//le indico el controlador
    ?>
        <legend>Añadir Detalle</legend>
        <fieldset class="control-group error">
            <div class="form-group">
                <label for="iva" class="control-label col-xs-2">Iva:</label>
                <div class="col-xs-9">
                    <input name="iva" id="iva" type="text" class="form-control"  id="inputiva" value="<?php echo set_value('iva'); ?>" /><?php echo form_error('iva', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="descripcion" class="control-label col-xs-2">Descripción:</label>
                <div class="col-xs-9">
                    <input name="descripcion" id="descripcion" type="text" class="form-control" id="inputdescripcion" value="<?php echo set_value('descripcion'); ?>" /><?php echo form_error('descripcion', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="cantidad" class="control-label col-xs-2">Cantidad:</label>
                <div class="col-xs-9">
                    <input name="cantidad" id="cantidad" type="text" class="form-control" id="inputcantidad" value="<?php echo set_value('cantidad'); ?>" /><?php echo form_error('cantidad', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="descuento" class="control-label col-xs-2">Descuento:</label>
                <div class="col-xs-9">
                    <input name="descuento" id="descuento" type="text" class="form-control" value="<?php echo set_value('descuento'); ?>" /><?php echo form_error('descuento', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="total" class="control-label col-xs-2">Total:</label>
                <div class="col-xs-9">
                    <input name="total" id="total" type="text" class="form-control" value="<?php echo set_value('total'); ?>" /><?php echo form_error('total', '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <br>
            <div class="form-group">
                <div class="col-xs-offset-2 col-xs-9">
                    <input name="anadir" id="anadir" type="submit" class="btn btn-primary" value="Añadir">
                    <input id="limpiar" type="reset" class="btn btn-default" value="Limpiar">
                </div>
            </div>
        </fieldset> 
        <?php echo form_close(); ?>   
    </form>
    <div class="panel panel-default">
        <div class="panel-heading">Detalle</div>
        <table class="table" summary="Detalle">
            <thead>
                <tr>
                    <th scope="col">Linea</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Iva</th>
                    <th scope="col">Descuento</th>
                    <th scope="col">Total</th>
                </tr>
            </thead> 
            <tbody>
                <!-- <?php //foreach($facturas as $factura): ?>
                    <tr>
                    <td><?php //echo $factura->getFecha()?></td>
                    <td><?php //echo $factura->getNumero()?></td>
                    <td><?php //echo $factura->getDescripcion()?></td>
                    <td><?php //echo $factura->getIdcliente()?></td>
                    <td><?php// echo $factura->getBaseImponible()?></td>
                    <td><?php //echo $factura->getTotal()?></td>
                    <td><?php //echo $factura->getRutaPdf()?></td>
                </tr>            
                <?php //endforeach ?>  -->           
            </tbody>
        </table>
    </div>
</div>