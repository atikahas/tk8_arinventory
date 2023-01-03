<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>AR Inventory</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
    <link href="{{url('')}}/sleek/source/assets/plugins/simplebar/simplebar.css" rel="stylesheet" />
    <link href="{{url('')}}/sleek/theme/assets/plugins/nprogress/nprogress.css" rel="stylesheet" />
    <link id="sleek-css" rel="stylesheet" href="{{url('')}}/sleek/theme/assets/css/sleek.css" />
    <link href="{{url('')}}/sleek/theme/assets/img/favicon.png" rel="shortcut icon" />
    <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
    -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="{{url('')}}/sleek/theme/assets/plugins/nprogress/nprogress.js"></script>
    <link href="{{url('')}}/sleek/theme/assets/plugins/toastr/toastr.min.css" rel="stylesheet">
    @yield('scriptheader')
  </head>

  <body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">
    <script>
      NProgress.configure({ showSpinner: false });
      NProgress.start();
    </script>

    <div class="wrapper">

      <aside class="left-sidebar bg-sidebar">
        <div id="sidebar" class="sidebar sidebar-with-footer">
          <div class="app-brand">
            <a href="{{ url('/home') }}">
              <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33" viewBox="0 0 30 33">
                <g fill="none" fill-rule="evenodd">
                  <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                  <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                </g>
              </svg>
              <span class="brand-name text-truncate">AR Inventory</span>
            </a>
          </div>

          <div class="" data-simplebar style="height: 100%;">
            <ul class="nav sidebar-inner" id="sidebar-menu">

              <li class="">
                <a class="sidenav-item-link" href="{{ url('users') }}">
                  <i class="mdi mdi-account-circle"></i>
                  <span class="nav-text">Administration</span>
                </a>
              </li>

              <hr class="separator mb-0" />

              <li class=" @yield('activedash')">
                <a class="sidenav-item-link" href="{{ url('/home') }}">
                  <i class="mdi mdi-apps"></i>
                  <span class="nav-text">Dashboard</span>
                </a>
              </li>

              <li class="has-sub @yield('activeitems') @yield('expanditems')">
                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#items" aria-expanded="false" aria-controls="items">
                  <i class="mdi mdi-package-variant-closed"></i>
                  <span class="nav-text">Items</span> <b class="caret"></b>
                </a>
                <ul class="collapse @yield('showitems')" id="items" data-parent="#sidebar-menu">
                  <div class="sub-menu">
                    <li class="@yield('listitems')">
                      <a class="sidenav-item-link" href="{{ url('items') }}">
                        <span class="nav-text">List Items</span>
                      </a>
                    </li>
                    <li class="@yield('additems')">
                      <a class="sidenav-item-link" href="{{ url('items/create') }}">
                        <span class="nav-text">Add Items</span>
                      </a>
                    </li>
                  </div>
                </ul>
              </li>

              <li class="has-sub @yield('activeexpenses') @yield('expandexpenses')">
                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#expenses" aria-expanded="false" aria-controls="expenses">
                  <i class="mdi mdi-cash-multiple"></i>
                  <span class="nav-text">Expenses</span> <b class="caret"></b>
                </a>
                <ul class="collapse @yield('showexpenses')" id="expenses" data-parent="#sidebar-menu">
                  <div class="sub-menu">
                    <li class="@yield('listexpenses')">
                      <a class="sidenav-item-link" href="{{ url('expenses') }}">
                        <span class="nav-text">List Expenses</span>
                      </a>
                    </li>
                    <li class="@yield('addexpenses')">
                      <a class="sidenav-item-link" href="{{ url('expenses/create') }}">
                        <span class="nav-text">Add Expenses</span>
                      </a>
                    </li>
                    <li class="@yield('summaryexpenses')">
                      <a class="sidenav-item-link" href="{{ url('expenses/summary') }}">
                        <span class="nav-text">Summary Expenses</span>
                      </a>
                    </li>
                  </div>
                </ul>
              </li>

            </ul>
          </div>
        </div>
      </aside>

      <div class="page-wrapper">

        <header class="main-header " id="header">
          <nav class="navbar navbar-static-top navbar-expand-lg" style="padding-right:0px">
            <button id="sidebar-toggler" class="sidebar-toggle"><span class="sr-only">Toggle navigation</span></button>
            
            <div class="search-form d-none d-lg-inline-block">
              <div class="input-group">
                <button type="button" name="search" id="search-btn" class="btn btn-flat"><i class="mdi mdi-magnify"></i></button>
                <input type="text" name="query" id="search-input" class="form-control" placeholder="'button', 'chart' etc." autofocus autocomplete="off" />
              </div>
              <div id="search-results-container">
                <ul id="search-results"></ul>
              </div>
            </div>

            <div class="navbar-right ">
              <ul class="nav navbar-nav">
                <li class="dropdown user-menu">
                  <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <img src="https://static.alphacoders.com/avatars/21577.jpg" class="user-image" alt="User Image" />
                    <span class="d-none d-lg-inline-block">{{Auth::user()->name}}</span>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-header">
                      <img src="https://static.alphacoders.com/avatars/21577.jpg" class="img-circle" alt="User Image" />
                      <div class="d-inline-block">
                      {{Auth::user()->name}}<small class="pt-1">{{Auth::user()->email}}</small>
                      </div>
                    </li>

                    <li>
                      <a href="user-profile.html">
                      <i class="mdi mdi-account"></i> My Profile
                      </a>
                    </li>
                    <li class="right-sidebar-in">
                      <a href="javascript:0"> <i class="mdi mdi-settings"></i> Setting </a>
                    </li>

                    <li class="dropdown-footer">
                      <a href="{{ route('logout.perform') }}"> <i class="mdi mdi-logout"></i> Log Out </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
        </header>

        <div class="content-wrapper">
          <div class="content">
            @yield('content')
          </div> 
        </div> 

        <footer class="footer mt-auto">
          <div class="copyright bg-white">
            <p>Copyright TK &copy; <span id="copy-year"></span></p>
          </div>
          
          <script>
            var d = new Date();
            var year = d.getFullYear();
            document.getElementById("copy-year").innerHTML = year;
          </script>
        </footer>

      </div> 
    </div>

    <script src="{{url('')}}/sleek/theme/assets/plugins/jquery/jquery.min.js"></script>
    <script src="{{url('')}}/sleek/theme/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('')}}/sleek/source/assets/plugins/simplebar/simplebar.min.js"></script>
    <script src="{{url('')}}/sleek/theme/assets/js/sleek.js"></script>
    <link href="{{url('')}}/sleek/source/assets/options/optionswitch.css" rel="stylesheet">
    <script src='{{url('')}}/sleek/theme/assets/plugins/toastr/toastr.min.js'></script>
    <script>
      @if(Session('success'))
      toastr.success("{{Session('success')}}");
      @endif
      @if(Session('error'))
      toastr.danger("{{Session('error')}}");
      @endif
    </script>
    @yield('scriptfooter')
  </body>
</html>

