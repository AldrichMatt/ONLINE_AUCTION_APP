<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Item;
use App\Models\RunningOffer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Validator;

class Offer extends Controller
{
    public function OfferShow()
    {

        Session::reflash();
        $items = DB::select(
            "SELECT auctions.*, items.*
            FROM auctions
            INNER JOIN items
            ON auctions.item_id = items.item_id
            WHERE auctions.status = 0
            "
        );

        $username = Session::get('username');
        $level = Session::get('level');


        foreach($items as $item)
        {
        $fields[] = array(
                          'item_name' => $item->item_name,
                          'image' => $item->image,
                          'offer_price',
                          'company_name',
                          'location',
                      );
        }

        if (isset($level)) {
            Session::reflash();
            return redirect('/admin/d');
        } else if ($username ==  null || $username == 'Guest') {
            Session::reflash();
            return redirect('/login');
        } else {
            return view('users.offers')->with([
                'username' => $username,
                'items' => $items
            ]);
        }
    }

    public function SingleItemShow($item_id)
    {
        Session::reflash();
        $username = Session::get('username');
        $level = Session::get('level');
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
        $user = User::all()->where('username', $username);
        foreach ($user as $user) {
            $user_data = $user;
        }
        if (isset($level)) {
            Session::reflash();
            return redirect('/admin/d');
        } else if ($username ==  null || $username == 'Guest') {
            Session::reflash();
            return redirect('/login');
        } else {
            Session::reflash();
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
        Session::reflash();
        $auction = Auction::all()->where('auction_id', $auction_id);
        $auction_data = [];
        $item = [];
        foreach ($auction as $a) {
            $auction_data = $a;
        }
        $item_id = $auction_data->item_id;
        $item_data = Item::all()->where('item_id', $item_id);
        foreach ($item_data as $item) {
            $item_data = $item;
        };
        $offer_request = $request->all();
        $offer_price = (string) $offer_request['offer_price'];

        $price_fix = str_replace( ',', '', $offer_price );

        if (empty($offer_request['offer_price'])) {
            $message =  'Please fill the price';
        } else {
            if ($offer_price > $auction_data->starting_price && $offer_price > $item_data->initial_price) {
                $offer_data = [
                    'auction_id' => $auction_id,
                    'user_id' => $user_id,
                    'offer_datetime' => now(),
                    'offer_price' => $price_fix
                ];
                try {
                    RunningOffer::where('auction_id', '=', $auction_id)->delete();
                } catch (\Throwable $th) {
                }
                RunningOffer::create($offer_data);
                $message =  'Successfully placed bid';
            } else {
                $message =  'Bid price is lower than current price';
            }
        }
        return redirect()->back()->with('message', $message);
    }
}
