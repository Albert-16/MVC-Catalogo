<h1>Trabajar con los Scores</h1>
<section>
</section>
<section>
  <table>
    <thead>
      <tr>
        <th>Id</th>
        <th>Descripción</th>
        <th>Autor</th>
        <th>Género</th>
        <th>Año</th>
        <th>Ventas</th>
        <th>Precio</th>
        <th>URL</th>
        <th>Estado</th>
        <th><a href="index.php?page=Mnt-Score&mode=INS">Nuevo</a></th>
      </tr>
    </thead>
    <tbody>
      {{foreach Scores}}
      <tr>
        <td>{{scoreid}}</td>
        <td> <a href="index.php?page=Mnt-Score&mode=DSP&id={{scoreid}}">{{scoredsc}}</a></td>
        <td>{{scoreauthor}}</td>
        <td>{{scoregenre}}</td>
        <td>{{scoreyear}}</td>
        <td>{{scoresales}}</td>
        <td>{{scoreprice}}</td>
        <td>{{scoredocurl}}</td>
        <td>{{scoreest}}</td>
        <td>
          <a href="index.php?page=Mnt-Score&mode=UPD&id={{scoreid}}">Editar</a>
          &NonBreakingSpace;
          <a href="index.php?page=Mnt-Score&mode=DEL&id={{scoreid}}">Eliminar</a>
        </td>
      </tr>
      {{endfor Scores}}
    </tbody>
  </table>
</section>
