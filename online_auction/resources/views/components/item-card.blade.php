@props(['items'])
<div class="row row-cols-md-1">
    <div class="card mb-2 p-3">
        <div class="row">
            <div class="col-3 text-end">
                <img src="{{asset($items->image)}}" width="100%"  alt="" srcset="">
            </div>
            <div class="col-6">
                <div class="position-absolute top-0 end-0 px-3">
                    <div class="text-lg mt-4">
                        Current Price
                    </div>
                    <div class="text-lg mt-2">
                        <i class="fa-solid fa-location-dot"></i> {{$items->initial_price}}
                    </div>
                </div>
                <div class="col-lg-6">
                    <h3>
                        <a href="/item/{{$items->item_id}}" class="text-dark text-decoration-underline">{{$items->item_name}}</a>
                    </h3>
                    <div class="text-xl font-bold">{{$items->company_name}}</div>
                    <div class="text-lg">
                        <img src="{{asset('assets/map-pin.svg')}}" width="5%" class="me-2"/>{{$items->location}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
