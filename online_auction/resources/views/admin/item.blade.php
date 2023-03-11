<x-layout>
    {{-- content start --}}
    <x-navbar-admin :username="$username" :level="$level"/>
    
    <div class="container my-5 modal-open">
        @foreach ($item as $item)
        <strong><a href="/admin/item" class="text-dark"><img src="{{asset('assets/chevron-left.svg')}}" alt="" srcset=""> Back</a></strong>
        <div class="row">
            <div class="col-lg-5 col-sm-12 justify-content-center text-center align-items-center">
                <img src="{{asset($item->image)}}" width="60%" alt="" srcset="">
            </div>
            <div class="col-7">
                <div class="row">
                    <div class="col-6 float-start">
                        <div class="fs-1 fw-bold">
                        {{$item->item_name}}
                    </div>
                    <div class="fs-2">                    
                        {{$item->company_name}}
                    </div>
                    <div class="fs-4">
                        <img src="{{asset('assets/map-pin.svg')}}" class="pe-2" alt="" srcset="">{{$item->location}}
                    </div>
                </div>
                <div class="col-6 float-end text-end">
                    <div class="fs-5">Initial Price</div>
                    <div class="fs-5 fw-bold"> <span class="border-0 rounded-0 bg-white">Rp</span>{{$item->initial_price}}</div>
                </div>
                </div>
                <div class="fs-5 fw-bold -bottom-3">Description</div>
                <p style="font-size: 75%; text-align: justify">{{$item->description}}</p>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</div>
    
@endforeach 
</x-layout>