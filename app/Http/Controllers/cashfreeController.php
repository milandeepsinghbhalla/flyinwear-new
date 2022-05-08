<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cashfreeController extends Controller
{
    //
    public function pay_online(Request $req){
        // API URL
		$url = 'https://sandbox.cashfree.com/pg/orders';
		$app_id ="111757da6e876d961e30b66af5757111";
		$security_key = "TEST125be7b015eab5f894ac84d2f7e0f86b1a9cb0ab";
		// Create a new cURL resource
		$ch = curl_init($url);

		// Setup request to send json via POST
		$data = array(
			'order_id' => $req->order_id,
			'order_amount' => (float) $req->order_amount,
			'order_currency' => "INR",
			'customer_details' => array(
				'customer_id' => $req->customer_details['customer_id'],
				'customer_email' => $req->customer_details['customer_email'],
				'customer_phone' => $req->customer_details['customer_phone']
			),
			'order_meta' => array(
				'return_url' => $req->order_meta['return_url']
			)
		);
		$payload = json_encode($data);

		// Attach encoded JSON string to the POST fields
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

		// Set the content type to application/json
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','x-api-version: 2021-05-21','x-client-id: '.$app_id,'x-client-secret: '.$security_key));

		// Return response instead of outputting
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// Execute the POST request
		$result = curl_exec($ch);

		// Close cURL resource
		curl_close($ch);
		return $result;
    }
    public function check_payment(Request $req){
        $url = "https://sandbox.cashfree.com/pg/orders/";
        $url = $url . $req->order_id;
        $app_id ="111757da6e876d961e30b66af5757111";
		$security_key = "TEST125be7b015eab5f894ac84d2f7e0f86b1a9cb0ab";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','x-api-version: 2021-05-21','x-client-id: '.$app_id,'x-client-secret: '.$security_key));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);

		// Close cURL resource
		curl_close($ch);
		return $result;

    }
}
