<x-layout>
    {{-- content start --}}
    <x-navbar-admin :username="$username" :level="$level"/>
    
    <div class="container my-5 modal-open">
        @foreach ($item as $item)
        <strong><a href="/admin/item" class="text-dark"><img src="{{asset('assets/chevron-left.svg')}}" alt="" srcset=""> Back</a></strong>
        <form action="/admin/update/item/{{$item->item_id}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row row-cols-2">
                <div class="col">
                    <div class="mb-3">
                        <label for="ItemName" class="form-label">Item Name</label>
                        <input type="text" name="item_name" class="form-control border-0" value="{{$item->item_name}}" readonly id="ItemName">                        
                        <label for="CompanyName" class="form-label">Company Name / Seller Name</label>
                        <input type="text" name="company_name" class="form-control border-0" value="{{$item->company_name}}" readonly id="CompanyName">                        
                        <label for="Location" class="form-label">Location</label>
                        <input type="text" name="location" class="form-control border-0" value="{{$item->location}}" readonly id="Location">                        
                        <label for="price" class="form-label">Price</label>
                        <input type="text" name="initial_price" class="form-control" value="{{$item->initial_price}}" onload="(format($(this).val().toString())" id="price">                        
                        <input type="hidden" name="input_date" value="{{$mydate['year'] . "-" . $mydate ['mon'] . "-" . $mydate['mday']}}" id="InputDate">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="Description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="Description">{{$item->description}}</textarea>                        
                        <label for="ImageInput" class="form-label">Image</label>
                        <input class="form-control" value="{{$item->image}}" type="file" name="image" id="ImageInput" accept="image/*">                        
                        <img id="ImagePreview" style="max-width:220px; min-width:200px" src="{{asset("$item->image")}}" class="mt-3 rounded-3"/>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

    $(function(){
      $("#price").focus(function(e){
        $("#price").val(format($(this).val().toString()));
      });
    });
    var format = function(num){
      var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
      if(str.indexOf(".") > 0) {
        parts = str.split(".");
        str = parts[0];
      }
      str = str.split("").reverse();
      for(var j = 0, len = str.length; j < len; j++) {
        if(str[j] != ",") {
          output.push(str[j]);
          if(i%3 == 0 && j < (len - 1)) {
            output.push(",");
          }
          i++;
        }
      }
      formatted = output.reverse().join("");
      return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
    };
    </script>