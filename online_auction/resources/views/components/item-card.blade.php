@props(['items'])
<div class="row row-cols-2 row-cols-md-1">
    <div class="card mb-2 p-3">
        <div class="col-lg-3">
            <img src="{{$items->image}}}" alt="" srcset="">
        </div>
      {{-- <h3 class="te2xl">
        <a href="/items/{{$items->item_id}}">{{$items->item_name}}</a>
      </h3>
      <div class="text-xl font-bold mb-4">{{$items->company_name}}</div>
      <div class="text-lg mt-4">
        <i class="fa-solid fa-location-dot"></i> {{$items->location}}
      </div>
      <div class="text-lg mt-4">
        <i class="fa-solid fa-location-dot"></i> {{$items->initial_price}}
      </div> --}}
  </div>
</div>
