<x-layout>
    {{-- content strart --}}
    <x-navbar-admin :level="$level" :username="$username"/>
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
                                <td><img src="{{asset("$items->image")}}" style="max-width:250px" alt="" srcset=""></td>
                                <td>{{$items->item_name}}</td>
                                <td>{{$items->company_name}}<br/> <img src="{{asset('assets/map-pin.svg')}}" alt="location pin" height="15px" srcset=""> {{ $items->location}}</td>
                                <td>{{$items->initial_price}}</td>
                                <td>
                                    <a href="/admin/item/{{$items->item_id}}" class="btn btn-primary me-1"><img src="{{asset('assets/eye-dark.svg')}}" alt="Details" srcset=""></a>
                                    <a href="/admin/delete/item/{{$items->item_id}}" class="btn btn-danger me-1"><img src="{{asset('assets/trash-dark.svg')}}" alt="Delete" srcset=""></a>
                                    <a href="/admin/update/item/{{$items->item_id}}" class="btn btn-warning me-1"><img src="{{asset('assets/edit-dark.svg')}}" alt="Edit" srcset=""></a>
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
        <!-- Button trigger modal -->
    <button type="button" class="btn btn-dark m-5 rounded-5" data-bs-toggle="modal" data-bs-target="#newItemModal">
        +
    </button>
</div>
<div class="modal fade" id="newItemModal" tabindex="-1" aria-labelledby="newItemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="newItemModalLabel">Add new Item</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/admin/add/item" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row row-cols-2">
                <div class="col">
                    <div class="mb-3">
                        <label for="ItemName" class="form-label">Item Name</label>
                        <input type="text" name="item_name" class="form-control" id="ItemName" required>
                        @error('item_name')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                        <label for="CompanyName" class="form-label">Company Name / Seller Name</label>
                        <input type="text" name="company_name" class="form-control" id="CompanyName" required>
                        @error('company_name')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                        <label for="Location" class="form-label">Location</label>
                        <input type="text" name="location" class="form-control" id="Location" required>
                        @error('location')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                        <label for="Price" class="form-label">Price</label>
                        <input type="text" name="initial_price" class="form-control" id="Price" required>
                        @error('initial_price')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                        <input type="hidden" name="input_date" value="{{$mydate['year'] . "-" . $mydate ['mon'] . "-" . $mydate['mday']}}" id="InputDate">
                        
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="Description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="Description" required></textarea>
                        @error('description')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                        <label for="ImageInput" class="form-label">Image</label>
                        <input class="form-control" type="file" name="image" id="ImageInput" accept="image/*" required>
                        @error('image')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                        <img id="ImagePreview" style="max-width:220px; min-width:200px" class="mt-3"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
            <button type="submit" class="btn btn-primary">Create Item</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
    document.getElementById('ImageInput').onchange = function () {
  var src = URL.createObjectURL(this.files[0])
  document.getElementById('ImagePreview').src = src
}
</script>
</x-layout>