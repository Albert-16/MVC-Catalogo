<h1>Trabajar con Productos</h1>
<section>

</section>
<section>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nombre</th>
        <th scope="col">Tipo</th>
        <th scope="col">Estado</th>
        <th scope="col">Vendible</th>
        <th scope="col">Precio Venta</th>
        <th scope="col">En Stok</th>

        <th><a href="index.php?page=Mnt-Producto&mode=INS">Nuevo</a></th>
      </tr>
    </thead>
    <tbody>
      {{foreach Productos}}
      <tr>
        <td>{{invPrdCodInt}}</td>
        <td> <a href="index.php?page=Mnt-Producto&mode=DSP&id={{invPrdId}}">{{invPrdDsc}}</a></td>
        <td>{{invPrdTip}}</td>
        <td>{{invPrdEst}}</td>
        <td>{{invPrdVnd}}</td>
        <td>{{invPrdPrecioVenta}}</td>
        <td>{{invPrdStock}}</td>

        <td>
          <a href="index.php?page=Mnt-Producto&mode=UPD&id={{invPrdId}}">Editar</a>
          &NonBreakingSpace;
          <a href="index.php?page=Mnt-Producto&mode=DEL&id={{invPrdId}}">Eliminar</a>
        </td>
      </tr>
      {{endfor Productos}}
    </tbody>
  </table>
</section>