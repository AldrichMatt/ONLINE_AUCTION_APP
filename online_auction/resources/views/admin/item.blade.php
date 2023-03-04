<x-layout>
    {{-- content start --}}
    <x-navbar-admin :username="$username" :level="$level"/>
    
    <div class="container my-5 modal-open">
        @foreach ($item as $item)
        <strong><a href="/offers" class="text-dark text-decoration-underline"><- Offers</a></strong>
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
                    <div class="fs-5 fw-bold"> <span class="border-0 rounded-0 bg-white">$</span>{{$item->initial_price}}</div>
                    <div class="fs-5">Running Bid</div>
                    <div class="fs-5 fw-bold"><span class="border-0 rounded-0 bg-white">$</span>@if(isset($offer->offer_price)){{$offer->offer_price}}
                        @else{{$auction->starting_price}}
                    @endif
                </div>
                </div>
                <div class="fs-5 fw-bold -bottom-3">Description</div>
                <p style="font-size: 75%; text-align: justify">{{$item->description}}</p>
                </div>
                <div class="col-12">
                    <div class="row">
                        <strong style="font-size:75%" class="ms-4 ps-4">Your Bid</strong>
                    <div class="col-8">
                <form action="/offer/bid/{{$auction->auction_id}}/{{$user->user_id}}" method="POST" id="bid_form">
                    @csrf
                    <div class="input-group w-100">
                        <span class="input-group-text border-0 rounded-0 bg-white fw-bold">$</span>
                        <input type="number" value="{{old('offer_price')}}" name="offer_price" class="form-control border-light border-0 rounded-0 border-bottom border-dark" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                        @if (Session::has('message'))
                            <div class="small text-dark">
                                {{ Session::get('message')}}
                                </div>
                        @endif
                      </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" id="bid"  data-bs-toggle="modal" data-bs-target="#exampleModalLive" class="btn btn-dark px-5 mx-auto w-100">Bid</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    @if($status !== '')

            @switch($status)
                @case("success")  
    Bid placed successfully
    @break
    @case("fail")
    
    Failed to place bid
        @break
    @default
        
@endswitch
    </div>
    @else
    @endif
</div>
</div>
    
@endforeach 
</x-layout>