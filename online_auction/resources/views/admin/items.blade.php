<x-layout>
    {{-- content strart --}}
    <x-navbar :username="$username"/>
    <div class="container">
        <div class="row my-2">
            <div class="h1 fw-semibold">
                Items
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 space-y-4">
            @unless(count($items) == 0)
            <table class="table  table-striped">
                <thead class="bg-dark text-white">
                        <th>Id</th>
                        <th>Image</th>
                        <th>Item name</th>
                        <th>Company & location</th>
                        <th>Item Price</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($items as $items)
                        
                            <tr>
                                <td>{{$items->item_id}}</td>
                                <td><img src="{{asset("$items->image")}}" alt="" srcset=""></td>
                                <td>{{$items->item_name}}</td>
                                <td>{{$items->company_name}}<br/> <img src="{{asset('assets/map-pin.svg')}}" alt="location pin" height="15px" srcset=""> {{ $items->location}}</td>
                                <td>{{$items->initial_price}}</td>
                                <td>
                                    <a href="/admin/item/{{$items->item_id}}" class="btn btn-primary me-1"><img src="{{asset('assets/eye.svg')}}" alt="Details" srcset=""></a>
                                    <a href="/admin/delete/item/{{$items->item_id}}" class="btn btn-danger me-1"><img src="{{asset('assets/trash.svg')}}" alt="Delete" srcset=""></a>
                                    <a href="" class="btn btn-warning me-1">Edit</a>
                                </td>
                            </tr>
                        
                        @endforeach
                    </tbody>
                </table>
            @else
            <p>No Items Found</p>
            @endunless
        </div>
    </div>
    <div class="sticky-bottom float-end">
        <a href="" class="btn btn-dark m-5 rounded-5">+</a>
    </div>
</x-layout>