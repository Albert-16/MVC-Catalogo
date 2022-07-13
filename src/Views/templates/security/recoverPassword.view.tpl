<section class="fullCenter">
    <form class="grid" method="post" action="index.php?page=sec_RecoverAccount{{if redirto}}&redirto={{redirto}}{{endif redirto}}">
      <section class="depth-1 row col-12 col-m-8 offset-m-2 col-xl-6 offset-xl-3">
        <h1 class="col-12">Recupera tu cuenta</h1>
      </section>
      <section class="depth-1 py-5 row col-12 col-m-8 offset-m-2 col-xl-6 offset-xl-3">
        <div class="row">
          <label class="col-12 col-m-4 flex align-center" for="txtEmail">Correo Electrónico</label>
          <div class="col-12 col-m-8">
            <input class="width-full" type="email" id="txtEmail" name="txtEmail" value="{{txtEmail}}" />
          </div>
          {{if errorEmail}}
            <div class="error col-12 py-2 col-m-8 offset-m-4">{{errorEmail}}</div>
          {{endif errorEmail}}
        </div>
        
      {{if generalError}}
        <div class="row">
          {{generalError}}
        </div>
      {{endif generalError}}
      <div class="col px-4 text-center">
        <button class="primary" id="btnBuscar" type="submit">Buscar</button>
        &nbsp;
        <button class="secondary" id="btnCancelar" type="submit">Cancelar</button>
      </div>
      </section>
    </form>
  </section>

  <script>
  document.addEventListener('DOMContentLoaded', function(){
    document.getElementById('btnCancelar').addEventListener('click', function(e){
      e.preventDefault();
      e.stopPropagation();
      window.location.href = 'index.php?page=sec_login';
    });
  });
</script>

  <script>
  document.addEventListener('DOMContentLoaded', function(){
    document.getElementById('btnBuscar').addEventListener('click', function(e){
      e.preventDefault();
      e.stopPropagation();
      window.location.href = 'index.php?page=sec_EmailRecover';
    });
  });
</script>