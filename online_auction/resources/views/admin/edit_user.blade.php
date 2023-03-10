<x-layout>
    {{-- content start --}}
    <x-navbar-admin :username="$username" :level="$level"/>
    
    <div class="container my-5 modal-open">
        @foreach ($user as $user)
        <strong><a href="/admin/item" class="text-dark"><img src="{{asset('assets/chevron-left.svg')}}" alt="" srcset=""> Back</a></strong>
        <form action="/admin/update/item/{{$user->item_id}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row row-cols-2">
                <div class="col">
                    <div class="mb-3">
                        <label for="ItemName" class="form-label">User Name</label>
                        <input type="text" name="item_name" class="form-control border-0" value="{{$user->item_name}}" readonly id="ItemName">                        
                        <label for="CompanyName" class="form-label">Company /label>
                        <input type="text" name="company_name" class="form-control border-0" value="{{$user->company_name}}" readonly id="CompanyName">                        
                        <label for="Location" class="form-label">Location</label>
                        <input type="text" name="location" class="form-control border-0" value="{{$user->location}}" readonly id="Location">                        
                        <label for="Price" class="form-label">Price</label>
                        <input type="text" name="initial_price" class="form-control" value="{{$user->initial_price}}" id="Price">                        
                        <input type="hidden" name="input_date" value="{{$mydate['year'] . "-" . $mydate ['mon'] . "-" . $mydate['mday']}}" id="InputDate">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="Description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="Description">{{$user->description}}</textarea>                        
                        <label for="ImageInput" class="form-label">Image</label>
                        <input class="form-control" value="{{$user->image}}" type="file" name="image" id="ImageInput" accept="image/*">                        
                        <img id="ImagePreview" style="max-width:220px; min-width:200px" src="{{asset("$user->image")}}" class="mt-3 rounded-3"/>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Item</button>
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