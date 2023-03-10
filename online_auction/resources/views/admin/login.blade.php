<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone-with-data-2012-2022.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#timezone').val(moment.tz.guess());
        });
    </script>
    <x-loginlayout>
    {{-- content strart --}}
    <div class="container justify-content-center pt-5 my-5">
        <div class="card bg-secondary w-50 m-auto my-5 rounded-4">
            <div class="card-body">
                <div class="card-title text-center h2 py-1">
                    <p class="fw-bold">Backoffice Login</p>
                </div>
                @if($status !== null)
                @switch($code)
                    @case(100)
                         <div class="mb-4 px-3">
                            <p class="alert alert-success rounded-4">{{ $status }}</p>
                        </div>
                        @break
                    @case(101)
                        <div class="mb-4 px-3">
                            <p class="alert alert-danger rounded-4">{{ $status }}</p>
                        </div>
                        @break
                        @case(102)
                        <div class="mb-4 px-3">
                            <p class="alert alert-warning rounded-4">{{ $status }}</p>
                        </div>
                        @break
                    @default
                    
                    @endswitch
                    <form action="/admin/log" method="POST" class="d-flex flex-column justify-content-center text-center">
                        @csrf
                        <input type="text" style="display:none" name="timezone" value="" id="timezone">
                        <div class="mb-4 px-3">
                            <input type="text" name="username" id="username" value="{{@old('username')}}" class="form-control py-3 rounded-4" placeholder="Username">
                        @error('username')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-4 px-3">
                        <input type="password" name="password" id="password" class="form-control py-3 rounded-4" placeholder="Password">
                        @error('password')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-4 mx-auto">
                        <button type="submit" class="btn btn-dark px-5 py-2">Log In</button>
                    </div>
                    <p class="small">Didn't have an account? <a href="/signup" class="text-white">Sign Up</a></p>
                </form>
                @else
                <form action="/admin/log" method="POST" class="d-flex flex-column justify-content-center text-center">
                    @csrf
                    <input type="text" style="display:none" name="timezone" value="" id="timezone">
                    <div class="mb-4 px-3">
                        <input type="text" name="username" id="username" value="{{@old('username')}}" class="form-control py-3 rounded-4" placeholder="Username">
                        @error('username')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-4 px-3">
                        <input type="password" name="password" id="password" class="form-control py-3 rounded-4" placeholder="Password">
                        @error('password')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-4 mx-auto">
                        <button type="submit" class="btn btn-dark px-5 py-2">Log In</button>
                    </div>
                    <p class="small">Didn't have an account? <a href="/admin/signup" class="text-white">Sign Up</a></p>
                </form>
                @endunless
            </div>
        </div>
    </div>
</x-loginlayout>
    
