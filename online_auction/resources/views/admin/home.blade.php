<x-layout>
    {{-- content strart --}}
    <x-navbar-admin :username="$username" :level="$level"/>
    <div class="container px-3 py-1">
        <div class="row my-3">
            <div class="row-lg-3 mb-4">
                <div class="h1 fw-semibold">Dashboard</div>
                @If($level == 1)
                <p>Welcome Employee {{$username}}</p>
                @else 
                <p>Welcome Admin {{$username}}</p>
                @endif
            </div>
        </div>
        <div class="row my-3 justify-content-around">
            <div class="col-3">
                <div class="card shadow-lg rounded border border-0 text-center justify-content-center">
                    <a class="text-dark" href="/admin/item">
                    <div class="card-body">
                        <img src="{{asset('assets/logo-dark.png')}}" class="card-img p-4" alt="" srcset="">
                       <p>Item Menu</p>
                    </div>
                    </a>
                </div>
            </div>
            @if($level == 1)
            <div class="col-3">
                <div class="card shadow-lg rounded border border-0 text-center justify-content-center">
                    <a class="text-dark" href="/admin/auction">
                        <div class="card-body">
                            <img src="{{asset('assets/logo-dark.png')}}" class="card-img p-4" alt="" srcset="">
                            <p>Auction Menu</p>
                        </div>
                    </a>
                </div>
            </div>
            @else
            <div class="col-3">
                <div class="card shadow-lg rounded border border-0 text-center justify-content-center">
                    <a class="text-dark" href="/admin/user">
                        <div class="card-body">
                        <img src="{{asset('assets/logo-dark.png')}}" class="card-img p-4" alt="" srcset="">
                       <p>User Menu</p>
                    </div>
                </a>
            </div>
        </div>
            <div class="col-3">
                <div class="card shadow-lg rounded border border-0 text-center justify-content-center">
                    <a class="text-dark" href="/admin/employee">
                    <div class="card-body">
                        <img src="{{asset('assets/logo-dark.png')}}" class="card-img p-4" alt="" srcset="">
                       <p>Employee Menu</p>
                    </div>
                </a>
                </div>
            </div>
            @endif
            <div class="col-3">
                <div class="card shadow-lg rounded border border-0 text-center justify-content-center">
                    <a class="text-dark" href="/admin/report">
                    <div class="card-body">
                        <img src="{{asset('assets/logo-dark.png')}}" class="card-img p-4" alt="" srcset="">
                       <p>Generate Report</p>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>