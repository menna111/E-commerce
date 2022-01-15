<?php

namespace App\Http\Controllers;

use App\Http\Services\FatoorahServices;
use App\Models\client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FatoorahController extends Controller
{
    private $fatoorahServices;
    public function __construct(FatoorahServices $fatoorahServices){
        $this->fatoorahServices=$fatoorahServices;
    }


    public function payOrder(){
        $user=Auth::user();
//        $user= Auth::guard('api')->user();

        $client=client::where('user_id',Auth::id())->first();

        $data=[
            "CustomerName"       => $user->name,
            "NotificationOption" => 'Lnk', //'SMS', 'EML', or 'ALL'
            "InvoiceValue"       => '50'  , //total price to pay
            "CustomerMobile"     => $client->phone,
            "CustomerEmail"      => $user->email,
            "CallBackUrl"        => 'https://google.com/callback',
            "ErrorUrl"           => 'https://youtube.com/callback',
            "Language"           => 'en',
            "DisplayCurrencyIso" => 'KWD',
        ];

        return $this->fatoorahServices->sendPayment($data);
    }
}
