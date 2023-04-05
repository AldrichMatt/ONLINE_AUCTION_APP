<x-layout>
    {{-- content strart --}}
    <x-navbar-admin :level="$level" :username="$username"/>
    <div class="container">
        <div class="row my-2">
            <div class="h1 fw-semibold">
                Auctions
            </div>
            @if($message !== null)
            @switch($code)
            @case(100)
                 <div class="mb-4 px-3">
                    <p class="alert alert-success rounded-4">{{ $message }}</p>
                </div>
                @break
            @case(101)
                <div class="mb-4 px-3">
                    <p class="alert alert-danger rounded-4">{{ $message }}</p>
                </div>
                @break
            @case(102)
                <div class="mb-4 px-3">
                    <p class="alert alert-warning rounded-4">{{ $message }}</p>
                </div>
                @break
            @default
            @endswitch
            @else
            @endif
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
                                <td><img src="{{asset("$auctions->image")}}" width="300px" alt="Image" srcset=""></td>
                                <td>{{$auctions->auction_date}}</td>
                                <td>Rp {{number_format($auctions->starting_price)}}</td>
                                <td>@if($auctions->status == 0)Sedang Berjalan 
                                    @elseif($auctions->status == 1) Selesai 
                                    @elseif($auctions->status == 2) Suspended 
                                    @else Terminated 
                                    @endif
                                </td>
                                <td>
                                    @if($auctions->status == 0)
                                    <a href="/admin/auction/{{$auctions->auction_id}}/finish/1" class="btn btn-warning me-1"><img src="{{asset('/assets/check.svg')}}" alt="" srcset=""></a>
                                    <a href="/admin/auction/{{$auctions->auction_id}}/setstatus/2" class="btn btn-danger me-1"><img src="{{asset('/assets/pause.svg')}}" alt="" srcset=""></a>
                                    @elseif($auctions->status == 1)
                                    <a href="/admin/report/invoice/{{$auctions->auction_id}}" class="btn btn-secondary me-1"><img src="{{asset('/assets/printer.svg')}}" alt="" srcset=""></a>
                                    @elseif($auctions->status = 2)
                                    <a href="/admin/auction/{{$auctions->auction_id}}/setstatus/0" class="btn btn-success me-1"><img src="{{asset('/assets/play.svg')}}" alt="" srcset=""></a>
                                    <a href="/admin/delete/auction/{{$auctions->auction_id}}" class="btn btn-danger me-1"><img src="{{asset('/assets/trash-dark.svg')}}" alt="" srcset=""></a>
                                    @endif
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
        <!-- Button trigger modal -->
    <button type="button" class="btn btn-dark m-5 rounded-5" data-bs-toggle="modal" data-bs-target="#newItemModal">
        +
    </button>
</div>
<div class="modal fade" id="newItemModal" tabindex="-1" aria-labelledby="newItemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="newItemModalLabel">Add new Auction</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/admin/add/auction" method="post">
            @csrf
            <div class="row">
                <div class="mb-3">
                        <label for="ItemName" class="form-label">Item Name</label>
                        <select class="form-select" name="item_id" id="">
                            @foreach($items as $item)
                            <option value="{{$item->item_id}}">{{$item->item_name}}</option>
                            {{-- <input type="hidden" name="starting_price" value="{{$item->initial_price}}"> --}}
                            @endforeach
                        </select>
                        <input type="hidden" name="employee_name" value="{{$username}}">
                        <input type="hidden" name="status" value="0">
                        <input type="hidden" name="timezone" value="" id="timezone">
                        </div>
    
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
            <button type="submit" class="btn btn-primary">Create Item</button>
        </form>
      </div>
    </div>
  </div>
</div>
</x-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone-with-data-2012-2022.min.js"></script>
<script>
    $(document).ready(function() {
        $('#timezone').val(moment.tz.guess());
    });

</script>