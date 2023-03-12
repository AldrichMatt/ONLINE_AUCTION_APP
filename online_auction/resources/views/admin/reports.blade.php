<x-layout>
    {{-- content strart --}}
    <x-navbar-admin :level="$level" :username="$username"/>
    <div class="container">
        <div class="row my-2">
            <div class="h1 fw-semibold">
                Reports
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 space-y-4">
            @unless(count($auctions) == 0)
            <table class="table  table-striped">
                <thead class="bg-dark text-white">
                        <th>Auction Id</th>
                        <th>Item Name</th>
                        <th>Item Image</th>
                        <th>Starting date</th>
                        <th>Starting Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($auctions as $auctions)
                        
                            <tr>
                                <td>{{$auctions->auction_id}}</td>
                                <td>{{$auctions->item_name}}</td>   
                                <td><img src="{{asset("$auctions->image")}}" class="rounded-3" width="300px" alt="Image" srcset=""></td>
                                <td>{{$auctions->auction_date}}</td>
                                <td>Rp {{number_format($auctions->starting_price)}}</td>
                                <td>@if($auctions->status == 0)Sedang Berjalan 
                                    @elseif($auctions->status == 1) Selesai 
                                    @elseif($auctions->status == 2) Suspended 
                                    @else Terminated 
                                    @endif
                                </td>
                                <td>
                                    <a href="/admin/reports/invoice/{{$auctions->auction_id}}" class="btn btn-secondary me-1"><img src="{{asset('/assets/printer.svg')}}" alt="" srcset=""></a>
                                </td>
                            </tr>
                        
                        @endforeach
                    </tbody>
                </table>
            @else
            <p>No Auctions Found</p>
            @endunless
        </div>
    </div>
    <div class="sticky-bottom float-end">
     
</div>
</x-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone-with-data-2012-2022.min.js"></script>
<script>
    $(document).ready(function() {
        $('#timezone').val(moment.tz.guess());
    });

</script>