<div id="centralregistro">
    <form action="login.php" method="post" class="form-horizontal">
        <fieldset >
            <legend>Login</legend>
            <div class="form-group">
                <label class="control-label col-xs-2" for="usuario" >Usuario:</label><br/>
                <div class="col-xs-9">                  
                    <input type="usuario" class="form-control" placeholder="Username">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-2" for="password" >Contraseña:</label><br/>               
                <div class="col-xs-9">                   
                    <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" /><br/>
                </div>
            </div>
        </fieldset>
            <div class="form-group">
                <div class="col-xs-offset-2 col-xs-9">
                    <button type="submit" class="btn btn-primary">Acceder</button>
                </div>
            </div>           
    </form>   
</div>

 