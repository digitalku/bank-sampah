 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link navbar-light">
      <img src="{{URL::asset('tempAdmin')}}/dist/img/icon.png" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <h4 class="brand-text font-bold-light">Bank Sampah</h4>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3">
        <div class="image">
          <img src="{{URL::asset('tempAdmin')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @auth
          @if(Auth::user()->role_id == "1")
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('sampah') }}" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Deposit
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('category') }}" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Kategori
              </p>
            </a>
          </li>


          @elseif(Auth::user()->role_id == "2")
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('sampah') }}" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Deposit
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('category') }}" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Kategori
              </p>
            </a>
          </li>

          @else
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Sampah
              </p>
            </a>
          </li>
          @endif
          @endauth
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>