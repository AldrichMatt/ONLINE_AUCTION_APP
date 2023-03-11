<x-layout>
    {{-- content start --}}
    <x-navbar-admin :username="$username" :level="$level"/>
    
    <div class="container my-5 modal-open">
        @foreach ($employee as $employee)
        <strong><a href="/admin/item" class="text-dark"><img src="{{asset('assets/chevron-left.svg')}}" alt="" srcset=""> Back</a></strong>
        <form action="/admin/update/item/{{$employee->employee_id}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row row-cols-2">
                <div class="col">
                    <div class="mb-3">
                        <label for="ItemName" class="form-label">User Name</label>
                        <input type="text" name="username" class="form-control border-0" value="{{$employee->username}}" readonly id="ItemName">           
                        <label for="ItemName" class="form-label">Full Name</label>
                        <input type="text" name="employee_name" class="form-control border-0" value="{{$employee->employee_name}}" readonly id="ItemName">           
                        <label for="ItemName" class="form-label">Password</label>
                        <input type="text" name="password" class="form-control border-0" value="{{$employee->password}}" readonly id="ItemName">           
                        <label for="ItemName" class="form-label">Level</label>
                        <select class="form_control" name="level" id="">
                            <option value="1">Employee</option>
                            <option value="2">Admin</option>
                        </select>       
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Employee</button>
        </div>
        </form>
         </div>
    </div>
</div>
</div>
    
<script>
    document.getElementById('ImageInput').onchange = function () {
    var src = URL.createObjectURL(this.files[0])
    document.getElementById('ImagePreview').src = src
}</script>
@endforeach 
</x-layout>