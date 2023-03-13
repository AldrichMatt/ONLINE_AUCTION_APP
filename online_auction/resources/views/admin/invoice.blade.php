<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>
<body>
    <div class="container">
        <div class="row row-cols-2">
            {{-- {{dd($auctions)}} --}}
            <div class="col mt-1">
                <div class="jumbotron h1">ONLINE AUCTION</div>
                <div class="jumbotron h1">INVOICE</div>
            </div>
            <div class="col mt-1">
                <img src="{{asset('assets/main-logo.png')}}" style="max-width:100px" class="float-end me-2" alt="" srcset="">
                <img src="{{asset('assets/logo-dark.png')}}" style="max-width:120px" class="float-end me-2" alt="" srcset="">
            </div>
        </div>
        <div class="row mt-3">
            <div class="jumbotron h3">
                {{sprintf("%04d",$auctions->auction_id) . sprintf("%04d",$auctions->item_id) . sprintf("%04d",$auctions->employee_id).  str_replace("-", "", $auctions->auction_date)}}
            </div>
            <div class="jumbotron h5">
                Seller : {{$item->company_name}} <img src="{{asset('/assets/map-pin.svg')}}" style="max-height:17px" alt="" srcset=""> {{$item->location}}
            </div>
            <div class="jumbotron h5">
                Buyer : {{$user->username}} / {{$user->full_name}} {{"(".$user->telephone.")"}}
            </div>
            <div class="row">
                <div class="jumbotron h5">
                    printed by <strong>{{$username}}</strong>
                </div>
            </div>
            <table class="table stripped-dark mt-5 mb-5">
                <thead>
                    <th>No</th>
                    <th>Item Name</th>
                    <th>Initial Price</th>
                    <th>Final Price</th>
                    <th>Auction Start Date</th>
                    <th>Auction End Date</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{$item->item_name}}</td>
                        <td>Rp {{number_format($item->initial_price)}}</td>
                        <td>Rp {{number_format($offer->offer_price)}}</td>
                        <td>{{date('l, d-M-Y',strtotime($auctions->auction_date))}}</td>
                        <td>{{date('l, d-M-Y',strtotime($history->report_date))}}</td>
                    </tr>
                </tbody>
            </table>
            <div class="jumbtron h5">
                Subtotal : Rp {{number_format($offer->offer_price)}}
            </div>
            <div class="jumbtron h5">
                Tax 2% : Rp {{number_format($offer->offer_price*2/100)}} 
            </div>
            <div class="jumbtron h5">
                Admin Fee 0.1% : Rp {{number_format($offer->offer_price/100)}}
            </div>
            <div class="jumbtron h5">
                Total : Rp {{number_format($offer->offer_price/100 + $offer->offer_price*2/100 + $offer->offer_price )}}
            </div>
        </div>
    </div>
</body>
</html>