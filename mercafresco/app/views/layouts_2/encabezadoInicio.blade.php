

     <div class="navbar-wrapper nav-principal">
      <nav class="navbar">
        <div class="container">
         <div class="navbar-header">
          <a class="navbar-brand" href="[[action('InicioController@index')]]"><img  class=" hidden-xs" src="[[ asset('img/logo-a.png') ]]"><img class="visible-xs" src="[[ asset('img/logo-phone.png') ]]" width="auto" height="80px"></a>
          <div class="header-right">
            <div class="header-login">
              <form class="navbar-form navbar-right" role="search">
              <div class="input-group">
                <input id='txtbuscarproducto' type="text" class="form-control" placeholder="Buscar">
                <span class="input-group-btn">
                 <button class="btn btn-default" type="button"><img src="[[ asset('img/search.svg') ]]" alt="Accounts"></button>
                </span>
              </div>
             </form>  
            </div>
            <div class="header-login">
             <a href="/login/" title="Iniciar sesion" class="top-link-login">
              @if(Session::has('usuario'))
             <span class="count hidden-xs ">Bienvenido, [[[ ucfirst(strtolower(Session::get('usuario')->Persona->NOMBRES)) ]]]!</span>    
             @endif 
             <img src="img/sign-in.svg" alt="Accounts" height="30px" width="auto">
             </a>
            </div>
          </div>
         </div>
        </div>
      </nav>
     </div>