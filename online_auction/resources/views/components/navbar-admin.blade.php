@props(['username'])
@props(['level'])
<nav class="autohide navbar bg-dark sticky-top">
  <div class="container-fluid">

    <div class="col-lg-4">
      <a data-bs-toggle="offcanvas" type="button" data-bs-target="#Sidebar" aria-controls="Sidebar">
        <img src="{{asset('/assets/three_line.png')}}" alt="logo" width="30px" onclick="" srcset="">
      </a>
    </div>

    <div class="offcanvas offcanvas-start" data-bs-backdrop="dynamic" tabindex="-1" id="Sidebar" aria-labelledby="SidebarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="SidebarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div>
          <div class="h1 fw-semibold">
            <a class="text-black" href="/admin/d">Home</a>
          </div>
          <hr>
          <div class="h1 fw-semibold">
            <a class="text-black" href="/admin/item">Item Menu</a>
          </div>
          <hr>
          @if($level == 1)
          <div class="h1 fw-semibold">
            <a class="text-black" href="/admin/auction">Auction Menu</a>
          </div>
          <hr>
          @endif
          @if($level == 2)
          <div class="h1 fw-semibold">
            <a class="text-black" href="/admin/user">User Menu</a>
          </div>
          <hr>
          <div class="h1 fw-semibold">
            <a class="text-black" href="/admin/employee">Employee Menu</a>
          </div>
          <hr>
          @endif
          <div class="h1 fw-semibold">
            <a class="text-black" href="/admin/report">Reports</a>
          </div>
          <hr>
        </div>
      </div>
    </div>
    <div class="col-lg-4 d-flex flex-wrap justify-content-center">
      <a href="#top">
        <img src="{{asset('/assets/logo.png')}}" width="45vw" alt="">
      </a>
    </div>
    <div class="col-lg-4 d-flex flex-wrap justify-content-end align-items-center ">
      @if ($level == 2)
      <p class="text-white h6 px-2">Admin {{$username}}</p>
      <a href="/admin/logout" class="text-decoration-none text-white h6 px-2">Log Out </a>
      @else
      <p class="text-white h6 px-2">Employee {{$username}}</p>
      <a href="/admin/logout" class="text-decoration-none text-white h6 px-2">Log Out </a>
      @endif

    </div>

  </div>
  </div>
</nav>