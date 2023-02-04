<x-loginlayout>
    {{-- content strart --}}
    <div class="position-absolute top-50 start-50 translate-middle">
        <div class="card bg-secondary px-5 py-3 rounded-4">
            <div class="card-title">
                Login
            </div>
            <div class="card-body d-flex flex-column align-items-center">
                <form class="" action="" method="POST">
                    <div class="form-group mb-3">
                        <input type="text" name="username" id="username" class="form-control w-100 rounded-3" placeholder="Username">
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password" id="password" class="form-control rounded-3" placeholder="Password">
                    </div>
                </form>
                <button class="btn btn-dark w-100">
                    Login
                </button>
            </div>
        </div>
    </div>

</x-loginlayout>