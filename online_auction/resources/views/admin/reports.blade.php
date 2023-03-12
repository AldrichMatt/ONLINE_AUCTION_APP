<x-layout>
    {{-- content strart --}}
    <x-navbar-admin :level="$level" :username="$username"/>
    <div class="container">
        <div class="row my-2">
            <div class="h1 fw-semibold">
                Reports
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 space-y-4">
            @unless(count($reports) == 0)
            <table class="table  table-striped">
                <thead class="bg-dark text-white">
                        <th>Id</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Telephone</th>
                        <th>Password</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                        
                            <tr>
                                <td>{{$report->user_id}}</td>
                                <td>{{$report->full_name}}</td>
                                <td>{{$report->username}}</td>
                                <td>{{$report->telephone}}</td>
                                <td>{{$report->password}}</td>
                                <td>
                                    <a href="/admin/delete/user/{{$report->user_id}}" class="btn btn-danger me-1"><img src="{{asset('assets/trash-dark.svg')}}" alt="Delete" srcset=""></a>
                                </td>
                            </tr>
                        
                        @endforeach
                    </tbody>
                </table>
            @else
            <p>No reports Found</p>
            @endunless
        </div>
    </div>
</div>
</x-layout>