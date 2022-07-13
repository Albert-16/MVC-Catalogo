<h1>Administrar Usuarios</h1>

<section>
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Correo Electrónico</th>
                <th>Nombre de usuario</th>
                <th>Contraseña</th>
                <th>Fecha de Ingreso</th>
                <th>Contraseña Estado</th>
                <th>Fecha de Expiración</th>
                <th>Estado del Usuario</th>
                <th>Código de Activación</th>
                <th>Contraseña Anterior</th>
                <th>Tipo de Usuario</th>
                <th><a href="index.php?page=Mnt_usuarioMnt&mode=INS">Agregar</a></th>
            </tr>
        </thead>

        <tbody>
            {{foreach usuarios}}
            <tr>
                <td>{{usercod}}</td>
                <td>{{useremail}}</td>
                <td>{{username}}</td>
                <td>{{userpswd}}</td>
                <td>{{userfching}}</td>
                <td>{{userpswdest}}</td>
                <td>{{userpswdexp}}</td>
                <td>{{userest}}</td>
                <td>{{useractcod}}</td>
                <td>{{userpswdchg}}</td>
                <td>{{usertipo}}</td>

                <td>
                    <a href="index.php?page=Mnt-usuarioMnt&mode=UPD&id={{usercod}}">Modificar</a>
                    &NonBreakingSpace;
                    <a href="index.php?page=Mnt-usuarioMnt&mode=DEL&id={{usercod}}">Eliminar</a>
                </td>
            </tr>
            {{endfor usuarios}}
        </tbody>
    </table>
</section>