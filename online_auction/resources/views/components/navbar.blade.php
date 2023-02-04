<nav class="navbar bg-dark">
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
                    I will not close if you click outside of me.
                  </div>
                </div>
              </div>
            <div class="col-lg-4 d-flex flex-wrap justify-content-center">
              <a href="#">
                <img src="{{asset('/assets/logo.png')}}" width="75vw" alt="">
              </a>
            </div>
            <div class="col-lg-4">4</div>
            
        </div>
    </div>
</nav>