
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Risk Management Tool</title>

        <!-- Fonts -->
        <link rel="icon" href="/img/logo2_app">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
        <link rel="stylesheet" href="\css\checkbox.css">
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        
        
        <!-- Styles -->
        
    </head>
    <body>

         
        <nav class="navbar is-spaced is-dark" role="navigation" aria-label="main navigation">
          <div class="container">
  <div class="navbar-brand">
    <a class="navbar-item" href="">
      <img src="/img/logo2_app" width="112" height="28">
    </a>

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>
@if(Auth::user()!==null)
@if(strcmp(Auth::user()->role,'projmanazer')==0) 
  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a href="/projekt" class="navbar-item {{ Request::is('projekt*') ? 'is-active' : '' }}">
        Projekty
      </a>

      <a href="/swot" class="navbar-item {{ Request::is('swot*') ? 'is-active' : '' }}">
        SWOT
      </a>

      <a href="/checklist2" class="navbar-item {{ Request::is('check*') ? 'is-active' : '' }}">
        Kontrolní seznamy
      </a>
      
      <a href="/upravit_rejstrik" class="navbar-item 
      {{ Request::is('upravit*') ? 'is-active' : '' }}
      {{ Request::is('rejstrik*') ? 'is-active' : '' }}
      ">
            Upravit rejstřík rizik
          </a>
      </div>
    </div>
@endif
@if(strcmp(Auth::user()->role,'admin')==0)
  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a href="/vytvorit_uzivatele" class=" navbar-item {{ Request::is('vytvorit*') ? 'is-active' : '' }} ">
        Správa uživatelů
      </a>

      <a href="/uzivatel_tym" class="navbar-item {{ Request::is('uzivatel_tym') ? 'is-active' : '' }}">
        Správa projektů
      </a>
      

      <a href="/katalog" class="navbar-item {{ Request::is('katalog') ? 'is-active' : '' }}">
        Katalog atributů
      </a>
     
      <a href="/checklist_admin" class="navbar-item {{ Request::is('checklist*') ? 'is-active' : '' }}">
        Kontrolní seznamy
      </a>

       <a href="/neopr_pristup" class="navbar-item {{ Request::is('neop*') ? 'is-active' : '' }}">
        Kontrola přístupu
      </a>
      
    </div>
    @endif
@if(strcmp(Auth::user()->role,'user')==0)
  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
  
      <a href="/projekt" class="navbar-item {{ Request::is('projekt*') ? 'is-active' : '' }}">
        Přehled projektů
      </a>
      
      <a href="/swot" class="navbar-item {{ Request::is('swot*') ? 'is-active' : '' }}">
        SWOT
      </a>
      
      <a href="/checklist2" class="navbar-item {{ Request::is('check*') ? 'is-active' : '' }}">
        Kontrolní seznamy
      </a>

    </div>
    @endif

@else
  <script>window.location = "/login";</script>
@endif
    <div class="navbar-end">

      <div class="navbar-item has-dropdown is-hoverable">
        @auth
        <a class="navbar-link">
         {{ Auth::user()->name }}
        </a>

        <div class="navbar-item navbar-dropdown">
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); 
          document.getElementById('logout-form').submit();"class="navbar-item">
            {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
        </div>
      </div>
      @else
      <a class="navbar-link">
        prihlas
      </a>
      @endauth
      @guest
      <a class="navbar-link">
        prihlas
      </a>
      @endguest
{{--       <div class="navbar-item">
        
            
             @if (Route::has('login'))
                 <div class="navbar-item has-dropdown is-hoverable">

                    @auth
                              <div class="navbar-dropdown">
                                <a class="navbar-item" href="/index.php" role="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Přihlášen: 
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <a class="navbar-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                    @else
                                <a  class="navbar-item" href="{{ route('login') }}">Login</a>
                                </div>
                        <div class="button is-info is-outlined">       
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
                </div>
      
  </div> --}}
</div>
  </div>
</div>
</nav>

{{-- Zajištění responzivity-zdroj: https://github.com/adambray89/adambray89.github.io/blob/master/nav-bar.html

  --}}
<script type="text/javascript">
      (function() {
        var burger = document.querySelector('.burger');
        var nav = document.querySelector('#'+burger.dataset.target);
        burger.addEventListener('click', function(){
          burger.classList.toggle('is-active');
          nav.classList.toggle('is-active');
        });
      })();
    </script>


 


        <div class="flex-center position-ref full-height">


  

            <div class="content container">

            @yield('content')
            </div>
          </div>
        </div>
  
    </body>
    <footer class="footer">
  <div class="content has-text-centered">
    <p>
      <strong>Risk Management Tool</strong>. Autor: Jaroslav Vystavěl. Webová aplikace vznikla jako diplomová práce(ak. rok 2018/2019) na <a href="http://www.fit.vutbr.cz/">FIT VUT</a> v Brně.
    </p>
  </div>
</footer>
</html>
