<x-layout>
    {{-- content strart --}}
    <x-navbar-admin :level="$level" :username="$username"/>
    <div class="container">
        <div class="row my-2">
            <div class="h1 fw-semibold">
                Employees
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 space-y-4">
            @unless(count($employees) == 0)
            <table class="table  table-striped">
                <thead class="bg-dark text-white">
                        <th>Id</th>
                        <th>Employee Name</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Password</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employees)
                        
                            <tr>
                                <td>{{$employees->employee_id}}</td>
                                <td>{{$employees->employee_name}}</td>
                                <td>{{$employees->username}}</td>
                                <td>
                                    @if($employees->level == 1) Employee 
                                    @elseif($employees->level == 2) Admin 
                                    @else Unverified
                                    @endif
                                </td>
                                <td>{{$employees->password}}</td>
                                <td>
                                    {{-- <a href="/admin/employee/{{$employees->employee_id}}" class="btn btn-primary ms-1"><img src="{{asset('assets/eye-dark.svg')}}" alt="Details" srcset=""></a> --}}
                                    <a href="/admin/delete/employee/{{$employees->employee_id}}" class="btn btn-danger ms-1"><img src="{{asset('assets/trash-dark.svg')}}" alt="Delete" srcset=""></a>
                                    <a href="/admin/edit/employee/{{$employees->employee_id}}" class="btn btn-warning ms-1"><img src="{{asset('assets/edit-dark.svg')}}" alt="Edit" srcset=""></a>
                                </td>
                            </tr>
                        
                        @endforeach
                    </tbody>
                </table>
            @else
            <p>No Employees Found</p>
            @endunless
        </div>
    </div>
    <div class="sticky-bottom float-end">
        <!-- Button trigger modal -->
    <button type="button" class="btn btn-dark m-5 rounded-5" data-bs-toggle="modal" data-bs-target="#newItemModal">
        +
    </button>
</div>
<div class="modal fade" id="newItemModal" tabindex="-1" aria-labelledby="newItemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="newItemModalLabel">Add new Employee</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/admin/add/employee" method="post">
            @csrf
            <div class="row row-cols-2">
                <div class="col">
                    <div class="mb-3">
                        <label for="UserName" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control mb-2"  id="UserName">           
                        <label for="FullName" class="form-label">Employee Name</label>
                        <input type="text" name="employee_name" class="form-control mb-2"  id="FullName">  
                    </div>
                </div>
                <div class="col">
                    
                    <label for="Password" class="form-label">Password</label>
                    <input type="text" name="password" class="form-control mb-2"  id="Password">           
                    <label class="form-label">Level</label>
                    <select class="form-select mb-3" name="level" id="">
                        <option value="1">Employee</option>
                        <option value="2">Admin</option>
                    </select>       
                </div>         
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
            <button type="submit" class="btn btn-primary">Create Employee</button>
        </form>
      </div>
    </div>
  </div>
</div>
</x-layout>