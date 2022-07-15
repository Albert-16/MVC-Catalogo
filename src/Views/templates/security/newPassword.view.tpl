<section class="fullCenter">
  <form class="grid" method="post" action="index.php?page=sec_EmailRecover">
    <section class="depth-1 row col-12 col-m-8 offset-m-2 col-xl-6 offset-xl-3">
      <h1 class="col-12">Cambio de Contraseña</h1>
    </section>
    <section class="depth-1 py-5 row col-12 col-m-8 offset-m-2 col-xl-6 offset-xl-3">
      <div class="row">
        <label class="col-12 col-m-4 flex align-center" for="txtContrasenia">Ingrese su nueva contraseña</label>
        <div class="col-12 col-m-8">
          <input class="width-full" type="password" id="txtContrasenia" name="txtContrasenia" value="" />
        </div>
        {{if errortxtContrasenia}}
        <div class="error col-12 py-2 col-m-8 offset-m-4">{{errortxtContrasenia}}</div>
        {{endif errortxtContrasenia}}
      </div>      
      <div class="row">
        <label class="col-12 col-m-4 flex align-center" for="txtContraseniaNew">Repita su contraseña</label>
        <div class="col-12 col-m-8">
          <input class="width-full" type="password" id="txtContraseniaNew" name="txtContraseniaNew" value="" />
        </div>
        {{if errorEmail}}
        <div class="error col-12 py-2 col-m-8 offset-m-4">{{errorEmail}}</div>
        {{endif errorEmail}}
      </div>
      <div class="row right flex-end px-4">
        <button class="primary" id="btnEnviar" type="submit">Cambiar Contraseña</button>
      </div>
    </section>
  </form>
</section>
  <script>
  document.addEventListener('DOMContentLoaded', function(){
    document.getElementById('btnCancelar').addEventListener('click', function(e){
      e.preventDefault();
      e.stopPropagation();
      window.location.href = 'index.php?page=sec_EmailRecover';
    });
  });
</script>
