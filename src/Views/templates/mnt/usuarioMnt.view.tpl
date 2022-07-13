<h1>{{mode_desc}}</h1>
<section>
    <form action="index.php?page=mnt_usuarioMnt" method="post">
        <input type="hidden" name="mode" value="{{mode}}" />
        <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
        <input type="hidden" name="usercod" value="{{usercod}}" />

        <fieldset>
            <label for="useremail">Correo Electrónico</label>
            <input type="text" id="useremail" name="useremail" value="{{useremail}}" placeholder="Correo Electrónico"
                {{if readonly}} readonly {{endif readonly}} />
            {{if error_useremail}} {{foreach error_useremail}} <div class="error">{{this}}</div>
            {{endfor error_useremail}}
            {{endif error_useremail}}
        </fieldset>

        <fieldset>
            <label for="username">Nombre de usuario</label>
            <input type="text" id="username" name="username" value="{{username}}" placeholder="Nombre de usuario"
                {{if readonly}} readonly {{endif readonly}} />
        </fieldset>

        <fieldset>
            <label for="userpswd">Contraseña</label>
            <input type="text" id="userpswd" name="userpswd" placeholder="Contraseña" value="{{userpswd}}"
                {{if readonly}} readonly {{endif readonly}} />
            {{if error_userpswd}} {{foreach error_userpswd}} <div class="error">{{this}}</div>
            {{endfor error_userpswd}}
            {{endif error_userpswd}}
        </fieldset>
        
        <fieldset>
            <label for="userfching">Fecha de Ingreso</label>
            <input type="text" id="userfching" name="userfching" placeholder="año-mes-día" value="{{userfching}}"
                {{if readonly}} readonly {{endif readonly}} />
            {{if error_userfching}} {{foreach error_userfching}} <div class="error">{{this}}</div>
            {{endfor error_userfching}}
            {{endif error_userfching}}
        </fieldset>
       <fieldset>
            <label for="userpswdest">Estado de la Contraseña</label>
            <select name="userpswdest" id="userpswdest" {{if readonly}}readonly disabled{{endif readonly}}>
                {{foreach userpswdestArr}}
                <option value="{{value}}" {{selected}}>{{text}}</option>
                {{endfor userpswdestArr}}
            </select>
        </fieldset>
        <fieldset>
            <label for="userpswdexp">Fecha de Expiración</label>
            <input type="text" id="userpswdexp" name="userpswdexp" placeholder="año-mes-día" value="{{userpswdexp}}"
                {{if readonly}} readonly {{endif readonly}} />
            {{if error_userpswdexp}} {{foreach error_userpswdexp}} <div class="error">{{this}}</div>
            {{endfor error_userpswdexp}}
            {{endif error_userpswdexp}}
        </fieldset>

        <fieldset>
            <label for="userest">Estado del Usuario</label>
            <select name="userest" id="userest" {{if readonly}}readonly disabled{{endif readonly}}>
                {{foreach userestArr}}
                <option value="{{value}}" {{selected}}>{{text}}</option>
                {{endfor userestArr}}
            </select>
        </fieldset>

        <fieldset>
            <label for="useractcod">Código de Activación</label>
            <input type="text" id="useractcod" name="useractcod" placeholder="useractcod" value="{{useractcod}}"
                {{if readonly}} readonly {{endif readonly}} />
            {{if error_useractcod}} {{foreach error_useractcod}} <div class="error">{{this}}</div>
            {{endfor error_useractcod}}
            {{endif error_useractcod}}
        </fieldset>

        <fieldset>
            <label for="userpswdchg">Contraseña Anterior</label>
            <input type="text" id="userpswdchg" name="userpswdchg" placeholder="userpswdchg" value="{{userpswdchg}}"
                {{if readonly}} readonly {{endif readonly}} />
            {{if error_userpswdchg}} {{foreach error_userpswdchg}} <div class="error">{{this}}</div>
            {{endfor error_userpswdchg}}
            {{endif error_userpswdchg}}
        </fieldset>

        <fieldset>
            <label for="usertipo">Tipo de Usuario</label>
            <input type="text" id="usertipo" name="usertipo" placeholder="usertipo" value="{{usertipo}}"
                {{if readonly}} readonly {{endif readonly}} />
            {{if error_usertipo}} {{foreach error_usertipo}} <div class="error">{{this}}</div>
            {{endfor error_usertipo}}
            {{endif error_usertipo}}
        </fieldset> 
        <fieldset>
            {{if showBtn}}
            <button type="submit" name="btnEnviar">{{btnEnviarText}}</button>
            &nbsp;
            {{endif showBtn}}
            <button name="btnCancelar" id="btnCancelar">Cancelar</button>
        </fieldset>
    </form>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('btnCancelar').addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            window.location.href = 'index.php?page=mnt_usuariosMnt';
        });
    });
</script>