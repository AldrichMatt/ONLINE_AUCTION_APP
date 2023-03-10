<x-layout>
    {{-- content strart --}}
    <x-navbar-admin :level="$level" :username="$username"/>
    <div class="container">
        <div class="row my-2">
            <div class="h1 fw-semibold">
                Users
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 space-y-4">
            @unless(count($users) == 0)
            <table class="table  table-striped">
                <thead class="bg-dark text-white">
                        <th>Id</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Telephone</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $users)
                        
                            <tr>
                                <td>{{$users->user_id}}</td>
                                <td>{{$users->full_name}}</td>
                                <td>{{$users->username}}</td>
                                <td>{{$users->telephone}}</td>
                                <td>
                                    <a href="/admin/user/{{$users->user_id}}" class="btn btn-primary me-1"><img src="{{asset('assets/eye-dark.svg')}}" alt="Details" srcset=""></a>
                                    <a href="/admin/delete/user/{{$users->user_id}}" class="btn btn-danger me-1"><img src="{{asset('assets/trash-dark.svg')}}" alt="Delete" srcset=""></a>
                                    <a href="/admin/edit/user/{{$users->user_id}}" class="btn btn-warning me-1"><img src="{{asset('assets/edit-dark.svg')}}" alt="Edit" srcset=""></a>
                                </td>
                            </tr>
                        
                        @endforeach
                    </tbody>
                </table>
            @else
            <p>No Users Found</p>
            @endunless
        </div>
    </div>
    <div class="sticky-bottom float-end">
        <!-- Button trigger modal -->
    <button type="button" class="btn btn-dark m-5 rounded-5" data-bs-toggle="modal" data-bs-target="#newItemModal">
    </button>
</div>
<div class="modal fade" id="newItemModal" tabindex="-1" aria-labelledby="newItemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="newItemModalLabel">Add new User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/admin/add/user" method="POST">
            @csrf
            <div class="row row-cols-2">
                <div class="col">
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full name</label>
                        <input type="text" name="full_name" class="form-control" id="fullName">
                        <label for="userName" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="userName">
                        
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                         <label for="Password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="Password">
                        <label for="telePhoneNum" class="form-label">Telephone</label>
                        <input type="text" name="telephone" class="form-control" id="telePhoneNum">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
            <button type="submit" class="btn btn-primary">Create User</button>
        </form>
      </div>
    </div>
  </div>
</div>
</x-layout>