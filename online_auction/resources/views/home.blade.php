<x-layout>
    {{-- content strart --}}
    <x-navbar :username="$username"/>
    <x-carousel>
    </x-carousel>
    <div class="container px-3 py-1">
        <div class="row mt-3 mb-3">
            <div class="row-lg-3 mb-4">
                <div class="h1 fw-semibold">Online Auction Web</div>
                The Auction Web used, authorized and trusted by the government.
            </div>
            @if($username == "Guest")
            <x-login-hero></x-login-hero>
            @else
            <div class="text-center">

                <a href="/offers" class="btn py-3 bg-dark w-25 text-white">Offers</a>
            </div>
            @endif
        </div>
        <div class="row mb-3">
            <div class="row-lg-3 mb-2">
                <div class="h1 fw-semibold">Our History</div>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nostrum eaque odio expedita eveniet fuga pariatur voluptas, odit atque illum. Tempora accusantium saepe laborum obcaecati voluptatibus. Nihil libero consectetur sint facilis accusamus harum quidem voluptatem earum.
            </div>
        </div>
        <div class="row mb-3" id="partner">
            <div class="row-lg-3 mb-2 justify-content-center">
                <div class="h1 fw-semibold">Our Partners</div>
               <img src="{{asset('assets/partner-1.jpg')}}" width="15%" alt="partner-1" srcset="">
               <img src="{{asset('assets/partner-2.jpg')}}" width="15%" alt="partner-2" srcset="">
               <img src="{{asset('assets/partner-3.jpg')}}" width="15%" alt="partner-3" srcset="">
               <img src="{{asset('assets/partner-4.jpg')}}" width="15%" alt="partner-4" srcset="">
               <img src="{{asset('assets/partner-5.jpg')}}" width="15%" alt="partner-5" srcset="">
               <img src="{{asset('assets/partner-6.jpg')}}" width="15%" alt="partner-6" srcset="">
            </div>
        </div>

    </div>
    <x-footer></x-footer>
    <x-sticky-bottom></x-sticky-bottom>
</x-layout>