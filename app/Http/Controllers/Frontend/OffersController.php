<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
class OffersController extends Controller
{
    public function index()
    {
        $offers = Offer::where('start_date', '<=', now())
        ->where('end_date', '>=', now())->get();
        return view('frontend.offers.index',compact('offers'));
    }
}
