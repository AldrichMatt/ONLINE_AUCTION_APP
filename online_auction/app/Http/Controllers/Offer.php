<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Item;
use App\Models\RunningOffer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Offer extends Controller
{
    public function OfferShow()
    {

        Session::reflash();
        $items = Item::all();

        $username = Session::get('username');
        if ($username ==  null || $username == 'Guest') {
            return redirect('/login');
        } else {
            Session::reflash();
            return view('users.offers')->with([
                'username' => $username,
                'items' => $items
            ]);
        }
    }

    public function SingleItemShow($item_id)
    {

        $auction = Auction::all()->where('item_id', $item_id);
        $item = Item::all()->where('item_id', $item_id);
        $auction_data = [];
        $user_data = [];
        $offer = [];

        foreach ($auction as $a) {
            $auction_data = $a;
        }
        $auction_id = $auction_data->auction_id;
        $running_offer = RunningOffer::all()->where('auction_id', $auction_id);
        foreach ($running_offer as $r) {
            $offer = $r;
        }
        $username = Session::get('username');
        $user = User::all()->where('username', $username);
        foreach ($user as $user) {
            $user_data = $user;
        }
        if ($username ==  null || $username == 'Guest') {
            return redirect('/login');
        } else {
            Session::reflash();
            // dd($auction);
            return view('users.item', [
                'offer' => $offer,
                'item' => $item,
                'auction' => $auction_data,
                'username' => $username,
                'user' => $user_data,
                'status' =>  ''
            ]);
        }
    }

    public function Bid(Request $request, $auction_id, $user_id)
    {
        $username = Session::get('username');
        $auction = Auction::all()->where('auction_id', $auction_id);
        $auction_data = [];
        $status = "";
        $user_data = [];
        $offer = [];
        $item = [];

        foreach ($auction as $a) {
            $auction_data = $a;
        }

        $item_id = $auction_data->item_id;
        $running_offer = RunningOffer::all()->where('auction_id', $auction_id);
        foreach ($running_offer as $r) {
            $offer = $r;
        }

        $user = User::all()->where('user_id', $user_id);

        foreach ($user as $user) {
            $user_data = $user;
        }

        $item = Item::all()->where('item_id', $item_id);

        $offer_request = $request->validate([
            'offer_price' => 'required|numeric'
        ]);

        if ((int)$offer_request['offer_price'] > $auction_data->starting_price) {
            Session::reflash();
            $offer_data = [
                'auction_id' => $auction_id,
                'user_id' => $user_id,
                'offer_datetime' => now(),
                'offer_price' => $request->offer_price
            ];
            RunningOffer::create($offer_data);
            $status = 'success';
        } else {
            $status = 'fail';
        }
        // dd($user);
        return view('users.item', [
            'offer' => $offer,
            'item' => $item,
            'auction' => $auction_data,
            'username' => $username,
            'user' => $user_data,
            'status' => $status
        ]);
    }
}
