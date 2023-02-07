<x-loginlayout>
    {{-- content strart --}}
    <div class="container justify-content-center pt-5 my-5">
        <div class="card bg-secondary w-50 m-auto my-5 rounded-4">
            <div class="card-body">
                <div class="card-title text-center h2 py-1">
                    <p class="fw-bold">Log In</p>
                </div>
                <form action="/d" method="GET" class="d-flex flex-column justify-content-center text-center">
                    <div class="mb-4 px-3">
                        <input type="text" name="username" id="username" class="form-control py-3 rounded-4" placeholder="Username">
                    </div>
                    <div class="mb-4 px-3">
                        <input type="password" name="password" id="password" class="form-control py-3 rounded-4" placeholder="Password">
                    </div>
                    <div class="mb-4 mx-auto">
                        <button type="submit" class="btn btn-dark px-5 py-2">Log In</button>
                    </div>
                    <p class="small">Didn't have an account? <a href="/signup" class="text-white">Sign Up</a></p>
                </form>
            </div>
        </div>
    </div>

</x-loginlayout>