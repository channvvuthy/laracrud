<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    /**
     * Handles the payment process.
     *
     * @param Request $request The HTTP request
     * @return mixed
     */
    public function payment(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal_success'),
                "cancel_url" => route('paypal_cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->get('amount')
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
        } else {
            return redirect()->route('paypal_cancel');
        }
    }

    /**
     * A function that handles the success response from PayPal and redirects to offerings if the payment order is completed.
     *
     * @param Request $request The request object
     * @return mixed
     */
    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()->route('offerings')->with('success', true);
        } else {
            $this->cancel();
        }
    }

    /**
     * Cancels the current action and redirects to the 'offerings' route with a payment failed message.
     *
     * @return mixed
     */
    public function cancel()
    {
        return redirect()->route('offerings')->with('payment_failed', true);
    }
}
