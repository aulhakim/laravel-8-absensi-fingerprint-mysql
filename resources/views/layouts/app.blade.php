<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Informasi Fingerprint</title>
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
 
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="#" class="text-nowrap logo-img">
            {{-- <img src="#" width="180" alt="" /> --}}
            <h5 class="fw-bold">ABSENSI SISWA</h5> 
          </a>
          {{-- <a href="#" class="text-nowrap logo-img">
            <img src="../assets/images/logos/dark-logo.svg" width="180" alt="" />
          </a> --}}
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar  " data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('dashboard') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>

            
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('absensi') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-fingerprint"></i>
                </span>
                <span class="hide-menu">Absensi</span>
              </a>
            </li>
            @if(auth()->user()->user_type == 0 )
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('notifikasi') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-bell"></i>
                </span>
                <span class="hide-menu">Notifikasi</span>
              </a>
            </li>

            @endif
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">DATA USER</span>
            </li>

            @if(auth()->user()->user_type == 0 )

            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('user/guru') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-user"></i>
                </span>
                <span class="hide-menu">Guru</span>
              </a>
            </li>
     

            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('user/orang') }}-tua" aria-expanded="false">
                <span>
                  <i class="ti ti-user"></i>
                </span>
                <span class="hide-menu">Orang Tua</span>
              </a>
            </li>

            @endif
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('user/murid') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">Siswa </span>
              </a>
            </li>

            @if(auth()->user()->user_type == 1 )

            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('user/orang') }}-tua" aria-expanded="false">
                <span>
                  <i class="ti ti-user"></i>
                </span>
                <span class="hide-menu">Orang Tua</span>
              </a>
            </li>

            @endif

            @if(auth()->user()->user_type == 0 )

            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">DATA MASTER</span>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('master/kelas') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-door"></i>
                </span>
                <span class="hide-menu">Kelas</span>
              </a>
            </li>
              
            @endif

          </ul>
        
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header shadow">
        <nav class="navbar navbar-expand-lg navbar-light ">
          <ul class="navbar-nav ">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              {{-- <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">Download Free</a> --}}
              <h6 class="pt-2">
                
                @php
                if(auth()->user()->user_type == 1){
                  echo "GURU -";
                }else if(auth()->user()->user_type == 2){
                  echo "MURID -";
                }else if(auth()->user()->user_type == 3){
                  echo "ORANG TUA -";
                }
              @endphp
              
              {{ auth()->user()->name }} </h6>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    @php
                      if(auth()->user()->user_type == 1){
                        $name = 'user/guru/edit/'.auth()->user()->id;
                      }else if(auth()->user()->user_type == 2){
                        $name = 'user/murid/edit/'.auth()->user()->id;
                      }else if(auth()->user()->user_type == 3){
                        $name = 'user/orang-tua/edit/'.auth()->user()->id;
                      }else{
                        $name = 'dashboard';

                      }
                    @endphp
                    <a href="{{ url($name) }}" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
              
                 
                    <a href="javascript:void()" class="btn btn-outline-primary mx-3 mt-2 d-block" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->



      <div class="container-fluid mw-100">
        

          @yield('content')

      </div>
    </div>
  </div>
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
</body>

</html>