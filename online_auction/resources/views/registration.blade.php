<x-loginlayout>
    {{-- content strart --}}
    <div class="container justify-content-center">
        <div class="card bg-secondary w-50 m-auto mt-5 rounded-4">
            <div class="card-body">
                <div class="card-title text-center h2 py-1">
                    <p class="fw-bold">Sign Up</p>
                </div>
                <form action="/d" method="GET" class="d-flex flex-column justify-content-center text-center">
                    <div class="mb-4 px-3">
                        <input type="text" name="full_name" id="full_name" class="form-control py-3 rounded-4" placeholder="Full Name">
                    </div>
                    <div class="mb-4 px-3">
                        <input type="text" name="username" id="username" class="form-control py-3 rounded-4" placeholder="Username">
                    </div>
                    <div class="mb-4 px-3">
                        <input type="password" name="password" id="password" class="form-control py-3 rounded-4" placeholder="Password">
                    </div>
                    <div class="mb-4 px-3">
                        <input type="text" name="telephone" id="telephone" class="form-control py-3 rounded-4" placeholder="Telephone">
                    </div>
                    <div class="mb-4 mx-auto">
                        <button type="submit" class="btn btn-dark px-5 py-2">Sign Up</button>
                    </div>
                    <p class="small">Already have an account? <a href="/login" class="text-white">Log In</a></p>
                </form>
            </div>
        </div>
    </div>

</x-loginlayout>