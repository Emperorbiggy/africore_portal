<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FetchUserDetails extends Controller
{
    /**
     * Fetch user details based on token.
     */
    public function fetchUserWithToken(Request $request)
    {
        // Validate that the token is provided
        $request->validate([
            'token' => 'required|string',
        ]);

        $token = $request->input('token');

        try {
            // Query the user_credentials table to find a user with the provided token
            $user = DB::table('user_credentials')->where('token', $token)->first();

            if ($user) {
                // Return a successful response with all user details if the token is valid
                return response()->json([
                    'success' => true,
                    'user' => $user,
                ], 200);
            } else {
                // Return an error response if the token is invalid or user not found
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid token or user not found.',
                ], 404);
            }
        } catch (\Exception $e) {
            // Log the error and return a server error response
            Log::error('Database error during token verification: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred. Please try again later.',
            ], 500);
        }
    }
}
