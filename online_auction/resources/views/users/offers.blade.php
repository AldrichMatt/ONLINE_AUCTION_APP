<x-layout>
    {{-- content strart --}}
    <x-navbar :username="$username"/>
    <div class="container">
        <div class="row my-2">
                <img src="{{asset('assets/hero.webp')}}" style="height:200px; object-fit:cover;"width="70%" height="10%" alt="">
        </div>
        <div class="row my-2">
            <div class="h1 fw-semibold mb-4">
                Offers
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 space-y-4 mb-5">
            @unless(count($items) == 0)
            @foreach($items as $item)
            <div class="row row-cols-md-1">
                <div class="card mb-2 p-3">
                    <div class="row">
                        <div class="col-3 text-end">
                            <img src="{{asset($item->image)}}" width="100%"  alt="" srcset="">
                        </div>
                        <div class="col-6">
                            <div class="position-absolute top-0 end-0 px-3">
                                <div class="text-lg mt-4">
                                    Starting Price
                                </div>
                                <div class="text-lg mt-2">
                                    <i class="fa-solid fa-location-dot"></i>Rp {{number_format($item->initial_price)}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                <h3>
                                    <a href="/item/{{$item->item_id}}" class="text-dark text-decoration-underline">{{$item->item_name}}</a>
                                </h3>
                                <div class="text-xl font-bold">{{$item->company_name}}</div>
                                <div class="text-lg">
                                    <img src="{{asset('assets/map-pin.svg')}}" width="5%" class="me-2"/>{{$item->location}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <p>No auctions Found</p>
            @endunless
        </div>
    </div>
    <div class="footer fs-6" id="aboutus">
    <div class="sticky-bottom fs-6">
        <x-footer></x-footer>
        <x-sticky-bottom></x-sticky-bottom>
    </div>
    </div>
</x-layout>