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
            @foreach ($items as $items)
                <x-item-card :items="$items"/>
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