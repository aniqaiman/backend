<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use JWTAuth;

class ApiController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only('company_registration_mykad_number', 'password');
        $token = null;

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Invalid (company registration / MyKad) number or password or inactivated account.',
                ], 401);
            }

            $credentials['status_email'] = 1;

            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Your email was not verified yet. Please check your email to verify it.',
                ], 401);
            }

            $credentials['status_account'] = 1;

            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Your account is not activated yet since it currently being review by Food Rico team. You will be inform once it had been activated.',
                ], 401);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to generate token.',
            ], 500);
        }

        return response()->json([
            'token' => $token,
        ]);
    }

    public function getAuthUser(Request $request)
    {
        try {
            return response()->json(
                JWTAuth::parseToken()->authenticate()
            );
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to verify token.',
            ], 500);
        }
    }

    public function verifyReCAPTCHA(Request $request)
    {
        $client = new Client();
        $response = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => '6LeYmFIUAAAAAAiDzgP6UdTksJUY5Uumu6CccBPp',
                'response' => $request->get('captcha'),
            ],
        ]);

        return response()->json(
            json_decode($response->getBody()),
            $response->getStatusCode()
        );
    }

    public function playground(Request $request)
    {
        return response()->json(
            \App\Category::with('products', 'products.prices')->find('1')->toArray()
        );
    }

}
