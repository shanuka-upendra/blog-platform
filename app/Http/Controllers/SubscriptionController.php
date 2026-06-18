<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    // Show pricing page
    public function index()
    {
        return view('blog.subscribe');
    }

    // Create Stripe checkout session
    public function checkout()
    {
        $user = Auth::user();

        // If already premium redirect away
        if ($user->is_premium) {
            return redirect('/blog')->with('success', 'You already have Premium!');
        }

        /** @var \App\Models\User $user */
        $session = $user->newSubscription('default', env('STRIPE_PRICE_ID'))
            ->checkout([
                'success_url' => route('subscription.success'),
                'cancel_url'  => route('subscribe'),
            ]);

        return redirect($session->url);
    }

    // After successful payment
    public function success()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Mark user as premium
        $user->update(['is_premium' => true]);

        return redirect('/blog')->with('success', '🎉 Welcome to Premium! Enjoy all exclusive content.');
    }

    // Cancel subscription
    public function cancel()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->subscribed('default')) {
            $user->subscription('default')->cancel();
            $user->update(['is_premium' => false]);
        }

        return redirect('/blog')->with('success', 'Subscription cancelled.');
    }
}