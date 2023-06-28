<header class="topbar" data-navbarbg="skin5">
  <nav class="navbar top-navbar navbar-expand-md navbar-dark">
      <div class="navbar-header" data-logobg="skin6">
          <!-- ============================================================== -->
          <!-- Logo -->
          <!-- ============================================================== -->
          <a class="navbar-brand" href="{{ route('user.dashboard') }}">

            @auth
                @if(auth()->user()->role == 'admin')
                    <!-- Logo icon -->
                    <b class="logo-icon">
                        <!-- Dark Logo icon -->
                        <img src="{{ asset('theme/plugins/images/logo-icon.png') }}" alt="homepage" />
                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text -->
                    <span class="logo-text">
                        <!-- dark Logo text -->
                        <img src="{{ asset('theme/plugins/images/logo-text.png') }}" alt="homepage" />
                    </span>
                @elseif(auth()->user()->role == 'judge')
                    <span class="logo-text text-dark" style="letter-spacing:0.1rem; ">Judge </span>
                @elseif(auth()->user()->role == 'contestant')
                    <span class="logo-text text-dark" style="letter-spacing:0.1rem">Contestant </span>
                @elseif(auth()->user()->role == 'user')
                    <span class="logo-text text-dark" style="letter-spacing:0.1rem">User </span>
                @endif
            @endauth

            @guest
                <span class="logo-text text-dark" style="letter-spacing:0.1rem">Welcome to Pageanto</span>

            @endguest



          </a>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- toggle and nav items -->
          <!-- ============================================================== -->
          <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
              href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
      </div>
      <!-- ============================================================== -->
      <!-- End Logo -->
      <!-- ============================================================== -->
      <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
         
          <!-- ============================================================== -->
          <!-- Right side toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav ms-auto d-flex align-items-center ">

              <!-- ============================================================== -->
              <!-- Search -->
              <!-- ============================================================== -->
              <li class=" in">
                  
              </li>
              <!-- ============================================================== -->
              <!-- Login -->
              <!-- ============================================================== -->
                @guest
                    <li>
                        
                        <a href="/login" class="btn btn-primary mr-3 rounded rounded-3">
                            Login  
                            {{--<i class="fa fa-user"></i>--}}
                            
                        </a>
                        &nbsp;&nbsp;&nbsp;

                    </li>
                @endguest
              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
                @auth
                    <li>

                        <a class="profile-pic" href="/profile">
                            <img src="{{ (!empty(auth()->user()->photo)) ? url('upload/'.auth()->user()->photo) : url('upload/no_image.jpg') }}" alt="user-img" width="36" class="img-circle"><span class="text-white font-medium">{{ auth()->user()->name }}</span></a>
                    </li>
                    
                        
                        
                            <form action="/logout" class="" method="post">
                                @csrf
                                <button class="btn btn-light" type="submit">Logout</button>
                            </form>
                            
                        &nbsp;&nbsp;&nbsp;
                    
                @endauth
              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
          </ul>
      </div>
  </nav>
</header>