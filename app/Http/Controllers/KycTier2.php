<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;  // Import DB facade

class KycTier2 extends Controller
{
    private $secretKey;

    public function __construct()
    {
        // Retrieve the secret key from the config file
        $this->secretKey = Config::get('app.map_secret_key');
    }

    public function upgradeToTier2(Request $request)
    {
        // Retrieve the token from the request headers
        $token = $request->header('Authorization');

        // Remove the 'Bearer ' prefix if it's present
        $token = str_replace('Bearer ', '', $token);

        // Check if the token exists in the user_credentials table
        $userExists = DB::table('user_credentials')
                        ->where('token', $token)
                        ->exists();

        if (!$userExists) {
            return response()->json([
                'error' => 'Unauthorized: Invalid token'
            ], 401); // Return an unauthorized error if the token doesn't exist
        }

        // Fetch the customer_id from the kyc_tier table based on the token using the model
        $kycTierRecord = DB::table('kyc_tier')->where('token', $token)->first();

        if (!$kycTierRecord) {
            return response()->json([
                'error' => 'Customer ID not found for the provided token'
            ], 400);
        }

        // Extract the customer_id from the fetched record
        $customerId = $kycTierRecord->customer_id;

        // Extract the data for the Tier 2 upgrade from the request
        $identityType = $request->input('type');  // e.g., "NIN"
        $identityImage = "https://res.cloudinary.com/dp6qznjwq/image/upload/v1711058413/uploads/phpZHJaoZ_qarrpn.jpg"; // Image URL
        $identityNumber = $request->input('number'); // e.g., "0123456789"
        $country = $request->input('country'); // e.g., "NG"

        // Prepare the API request to upgrade to Tier 2
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->secretKey,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->patch('https://sandbox.api.maplerad.com/v1/customers/upgrade/tier2', [
            'identity' => [
                'type' => $identityType,
                'image' => $identityImage,  // Using the provided image URL
                'number' => $identityNumber,
                'country' => $country
            ],
            'customer_id' => $customerId,
        ]);

        // Parse the response from the upgrade request
        $responseData = $response->json();

        // Check if the upgrade was successful
        if (isset($responseData['status']) && $responseData['status'] === true) {
            // Optionally, you could also update the user level to "Tier 2" in the database using the model
            DB::table('kyc_tier')
                ->where('customer_id', $customerId)
                ->update(['level' => 'Tier 2']);

            return response()->json([
                'message' => 'Customer upgraded to Tier 2 successfully',
                'customer_id' => $customerId
            ], 200);
        } else {
            return response()->json([
                'error' => 'Tier 2 upgrade failed',
                'details' => $responseData
            ], 400);
        }
    }
}

