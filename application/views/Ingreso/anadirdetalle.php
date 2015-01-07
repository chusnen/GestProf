<div id="centralregistro" >
    <?php 
    $attributes = array('class' => 'form-horizontal', 'id' => 'anadirdetalles');
    echo form_open('anadirdetalle',$attributes);//le indico el controlador
    ?>
    <legend>Detalle Factura</legend>
    <fieldset>
        <div class="form-group">
            <label for="descripcion" class="control-label col-xs-2">Descripción:</label>
            <div class="col-xs-9">
                <input name="descripcion" id="descripcion" type="text" class="form-control"  value="<?php echo set_value('descripcion'); ?>" /><?php echo form_error('descripcion', '<span class="error">', '</span>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="preciounitario" class="control-label col-xs-2">Precio Unitario:</label>
            <div class="col-xs-9">
                <input name="preciounitario" id="preciounitario" type="text" class="form-control"  value="<?php echo set_value('preciounitario'); ?>" /><?php echo form_error('preciounitario', '<span class="error">', '</span>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="cantidad" class="control-label col-xs-2">Cantidad:</label>
            <div class="col-xs-9">
                <input name="cantidad" id="cantidad" type="text" class="form-control"  value="<?php echo set_value('cantidad'); ?>" /><?php echo form_error('cantidad', '<span class="error">', '</span>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="descuento" class="control-label col-xs-2">Descuento:</label>
            <div class="col-xs-9">
                <input name="descuento" id="descuento" type="text" class="form-control"  value="<?php echo set_value('descuento'); ?>" /><?php echo form_error('descuento', '<span class="error">', '</span>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="iva" class="control-label col-xs-2">Iva:</label>
            <div class="col-xs-9">
                <select name="iva" id="iva" class="form-control">
                    <?php foreach($ivas as $iva): ?>
                    <option value="<?php echo $iva->getIdIva()?>"><?php echo $iva->getDescripcion()?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>   
        <div class="col-xs-offset-2 col-xs-9">
            <input type='hidden' name='numero' value="<?php echo $numero?>"><!-- Obtengo el numero de factura para añadir los detalle a esa factura -->
            <input name="anadir" id="enviar" type="submit" class="btn btn-primary" value="Añadir Detalle">
            <input id="limpiar" type="reset" class="btn btn-default" value="Limpiar">
        </div>
    </fieldset>
    <div class="panel panel-default">
        <?php echo form_close(); ?>
        <div class="panel-heading">Detalle</div>
            <table class="table" summary="Detalle">
                <thead>
                    <tr>
                        <th scope="col">Linea</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Precio Unitario</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Descuento</th>
                        <th scope="col">Iva</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php foreach($detalles as $detalle): ?>
                    <?php $cont=0;
                    $cont=$cont+1?>
                    <tr>
                        <td><?php echo $cont?></td>
                        <td><?php echo $detalle->getDescripcion()?></td>
                        <td><?php echo $detalle->getPreciounitario()?> €</td>
                        <td><?php echo $detalle->getCantidad()?></td>
                        <td><?php echo $detalle->getDescuento()?></td>
                        <td><?php echo $detalle->getIdIva()->getTipo()?> %</td>
                        <td><?php echo $detalle->getTotal()?> €</td>                       
                    </tr>            
                    <?php endforeach ?>            
                </tbody>
            </table>
        </div>
        <?php 
        $attributes = array('class' => 'form-horizontal', 'id' => 'anadirdetalles');
        echo form_open('anadirdetalle/enviar',$attributes);//le indico el controlador
        ?>
        <input type='hidden' name='numero' value="<?php echo $numero?>">
        <input name="enviar" id="enviar" type="submit" class="btn btn-primary" value="Añadir Detalle">
         <?php echo form_close(); ?>
    </div> 
</div>      