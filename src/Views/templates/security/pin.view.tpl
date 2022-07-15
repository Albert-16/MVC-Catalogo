<section class="fullCenter">
  <form class="grid" method="post" action="index.php?page=sec_EmailTry">
    <section class="depth-1 row col-12 col-m-8 offset-m-2 col-xl-6 offset-xl-3">
      <h1 class="col-12">Recuperacion de Contraseña</h1>
    </section>
    <section class="depth-1 py-5 row col-12 col-m-8 offset-m-2 col-xl-6 offset-xl-3">
      <div class="row">
        <label class="col-12 col-m-4 flex align-center" for="txtEmail">Ingrese su pin de restablecimiento</label>
        <div class="col-12 col-m-8">
          <input class="width-full" type="number" id="txtPin" name="txtPin" value="" />
        </div>
        
        {{if errorPin}}
        <div class="error col-12 py-2 col-m-8 offset-m-4">{{errorPin}}</div>
        {{endif errorPin}}
        
      </div>
      <div class="row right flex-end px-4">
        <button class="primary" id="btnEnviar" type="submit">Aceptar</button>
      </div>
    </section>
  </form>
</section>
  <script>
  document.addEventListener('DOMContentLoaded', function(){
    document.getElementById('btnCancelar').addEventListener('click', function(e){
      e.preventDefault();
      e.stopPropagation();
      window.location.href = 'index.php?page=sec_Mail';
    });
  });
</script>
