<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LineNotifyController extends Controller
{

    public function index()
    {
        $clientId = 'plrO0HBXHpv7RNM3nTO0J3';
        $redirectUri = 'http://localhost:8000/line-notify/callback';
        $state = csrf_token(); // or any unique identifier

        $authUrl = "https://notify-bot.line.me/oauth/authorize?response_type=code&client_id={$clientId}&redirect_uri={$redirectUri}&scope=notify&state={$state}";

        return view('line-notify', ['authUrl' => $authUrl]);
    }

    public function callback(Request $request)
    {
        $code = $request->query('code');
        $state = $request->query('state');

        if ($state !== csrf_token()) {
            return redirect('/line-notify')->with('error', 'Invalid state');
        }

        $tokenUrl = 'https://notify-bot.line.me/oauth/token';
        $clientId = 'plrO0HBXHpv7RNM3nTO0J3';
        $clientSecret = 'WBelhq5IiZH3Z56K74ylnk056vB77FdYuomLEtlERBD';
        $redirectUri = 'http://localhost:8000/line-notify/callback';

        $response = Http::asForm()->post($tokenUrl, [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $redirectUri,
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ]);

        $responseBody = $response->json();

        if (isset($responseBody['access_token'])) {
            $accessToken = $responseBody['access_token'];
            // Save the access token or use it as needed
            return redirect('/line-notify')->with('success', 'Access token generated successfully');
        } else {
            return redirect('/line-notify')->with('error', 'Failed to generate access token');
        }
    }

    //old version
    public function generateToken(Request $request)
    {
        // Replace with your Line Notify Client ID and Client Secret
        $clientId = 'plrO0HBXHpv7RNM3nTO0J3';
        $clientSecret = 'WBelhq5IiZH3Z56K74ylnk056vB77FdYuomLEtlERBD';

        // Exchange authorization code for access token
        $response = Http::post('https://notify-bot.line.me/oauth/token', [
            'grant_type' => 'authorization_code',
            'code' => $request->code,
            'redirect_uri' => route('line-notify.token'),
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ]);

        // Handle response and store access token in your application
        $accessToken = $response->json()['access_token'];

        dd($accessToken);
        return redirect()->route('home')->with('success', 'Access token generated successfully!');
    }
}
