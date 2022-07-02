<h1>Mantenimiento de las Funciones</h1>
<section>

</section>
<section>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Código</th>
        <th scope="col">Descripción</th>
        <th scope="col">Estado</th>
        <th scope="col">Tipo</th>

        <th><a href="index.php?page=Mnt-Funcion&mode=INS">Nuevo</a></th>
      </tr>
    </thead>
    <tbody>
      {{foreach Funciones}}
      <tr>
        <td>{{fncod}}</td>
        <td> <a href="index.php?page=Mnt-Funcion&mode=DSP&id={{fncod}}">{{fndsc}}</a></td>
        <td>{{fnest}}</td>
        <td>{{fntyp}}</td>
        <td>
          <a href="index.php?page=Mnt-Funcion&mode=UPD&id={{fncod}}">Editar</a>
          &NonBreakingSpace;
          <a href="index.php?page=Mnt-Funcion&mode=DEL&id={{fncod}}">Eliminar</a>
        </td>
      </tr>
      {{endfor Funciones}}
    </tbody>
  </table>
</section>