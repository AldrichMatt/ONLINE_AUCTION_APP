<x-loginlayout>
    {{-- content strart --}}
    <div class="container justify-content-center pt-5">
        <div class="card bg-secondary w-50 m-auto mt-5 rounded-4">
            <div class="card-body">
                <div class="card-title text-center h2 py-1">
                    <p class="fw-bold">Sign Up</p>
                </div>
                <form action="/admin_register" method="POST" class="d-flex flex-column justify-content-center">
                    @csrf
                    <div class="mb-3 px-3">
                        <input type="text" name="employee_name" id="employee_name" class="form-control py-3 rounded-4" value="{{old('full_name')}}" placeholder="Full Name">
                        @error('employee_name')
                            <p class="text-white">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3 px-3">
                        <input type="text" name="username" id="username" class="form-control py-3 rounded-4" value="{{old('username')}}" placeholder="Username">
                        @error('username')
                        <p class="text-white">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3 px-3">
                        <input type="password" name="password" id="password" class="form-control py-3 rounded-4" placeholder="Password">
                        @error('password')
                        <p class="text-white">{{$message}}</p>
                        @enderror
                        <input type="hidden" name="level" id="password" value="0">
                    </div>
                    <div class="mb-4 text-center">
                        <button type="submit" class="btn btn-dark px-5">Sign Up</button>
                        <p class="small pt-4">Already have an account? <a href="/admin/login" class="text-white">Log In</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-loginlayout>