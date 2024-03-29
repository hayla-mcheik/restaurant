<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Subscriptions;
use App\Mail\SubscriptionConfirmation; 
use Illuminate\Support\Facades\Mail;
class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:subscriptions,email',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors()->first(), 400);
        } else {
            $subscriber = new Subscriptions();
            $subscriber->email = $request->email;
            $subscriber->save();

            Mail::to($subscriber->email)->send(new SubscriptionConfirmation($subscriber));

            return redirect()->back()->with('success', 'Subscription successful! Check your email for confirmation.');
        }
    }
}
