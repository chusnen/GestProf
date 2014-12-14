<div id="centralregistro">
    <form action='login.php' method='post' class="form-horizontal">
        <fieldset >
            <legend>Login</legend>
            			<!-- <div><span class='error'><?php echo $error; ?></span></div> -->
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    <label class="control-label col-xs-2" for='usuario' >Usuario:</label><br/>
                    <input type="usuario" class="form-control" placeholder="Username">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    <label class="control-label col-xs-2" for='password' >Contraseña:</label><br/>
                    <input type='password' name='password' id='password' class="form-control" placeholder="Contraseña" /><br/>
                </div>
            </div>
            <div class='campo'>
                <button type="submit" class="btn btn-primary">Acceder</button>
            </div>
        </fieldset>
    </form>
   
</div>

 