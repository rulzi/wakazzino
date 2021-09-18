<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        return view('send');
    }

    public function send(Request $request)
    {
        $client = new Client(['base_uri' => 'https://panel.kazzino.net']);

        $data = [
            'api_key' => "4c8b571d-1883-11ec-bd2a-cab991d2ebb3",
            'destination' => $request->number,
            'message' => $request->subject,
        ];

        $send = $client->request('POST', '/api/whatsapp/instances/send-text/50023', ['body' => json_encode($data)]);

        return redirect(route('index'));
    }

    public function receive_get(Request $request)
    {
        Log::info("GET");
        Log::info($request);
    }

    public function receive_post(Request $request)
    {
        Log::info("POST");
        Log::info($request);
    }
}
