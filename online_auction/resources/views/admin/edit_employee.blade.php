<x-layout>
    {{-- content start --}}
    <x-navbar-admin :username="$username" :level="$level"/>
    
    <div class="container my-5 modal-open">
        @foreach ($employee as $employee)
        <strong><a href="/admin/employee" class="text-dark"><img src="{{asset('assets/chevron-left.svg')}}" alt="" srcset=""> Back</a></strong>
        <form action="/admin/update/employee/{{$employee->employee_id}}" method="POST" >
            @csrf
            <div class="row row-cols-2">
                <div class="col">
                    <div class="mt-3">
                        <label for="UserName" class="form-label">User Name</label>
                        <input type="text" name="username" class="form-control mb-3 border-0" value="{{$employee->username}}" readonly id="UserName">           
                        <label for="FullName" class="form-label">Employee Name</label>
                        <input type="text" name="employee_name" class="form-control mb-3 border-0" value="{{$employee->employee_name}}" readonly id="FullName">           
                        <label for="Password" class="form-label">Password</label>
                        <input type="text" name="password" class="form-control mb-3 border-0" value="{{$employee->password}}" readonly id="Password">           
                        <label class="form-label">Level</label>
                        <select class="form-select mb-3" name="level" id="">
                            @If($employee->level == 1)
                            <option value="1" selected>Employee</option>
                            <option value="2">Admin</option>
                            @elseif($employee->level == 2)
                            <option value="1" >Employee</option>
                            <option value="2" selected>Admin</option>
                            @else
                            <option value="0" selected >Unverified</option>
                            <option value="1" >Employee</option>
                            <option value="2" >Admin</option>
                            @endif
                        </select>       
                    </div>
                </div>
            </div>
            @endforeach 
            <button type="submit" class="btn btn-primary">Update Employee</button>
        </div>
        </form>
         </div>
    </div>
</div>
</div>
</x-layout>