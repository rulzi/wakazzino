<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Storage;

class HomeController extends Controller
{
    public function index()
    {
        return view('send');
    }

    public function image()
    {
        return view('send_image');
    }

    public function document()
    {
        return view('send_document');
    }

    public function send(Request $request)
    {
        $client = new Client(['base_uri' => 'https://panel.kazzino.net']);

        $data = [
            'api_key' => "fa43f1d7-2a1f-11eb-991d-cab991d2ebb3",
            'destination' => $request->number,
            'message' => $request->subject,
        ];

        $send = $client->request('POST', '/api/whatsapp/instances/send-text/50022', ['body' => json_encode($data)]);

        return redirect(route('index'));
    }

    public function send_image(Request $request)
    {
        $client = new Client(['base_uri' => 'https://panel.kazzino.net']);

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filename= Str::random(10).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('public/file', $filename);
        }

        $data = [
            'api_key' => "fa43f1d7-2a1f-11eb-991d-cab991d2ebb3",
            'destination' => $request->number,
            'message' => $request->subject,
            'media_url' => url(Storage::url($path)),
            'type' => "image",
        ];

        $send = $client->request('POST', '/api/whatsapp/instances/send-media/50022', ['body' => json_encode($data)]);

        return redirect(route('index'));
    }

    public function send_document(Request $request)
    {
        $client = new Client(['base_uri' => 'https://panel.kazzino.net']);

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filename= Str::random(10).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('public/file', $filename);
        }

        $data = [
            'api_key' => "fa43f1d7-2a1f-11eb-991d-cab991d2ebb3",
            'destination' => $request->number,
            'message' => $request->subject,
            'media_url' => url(Storage::url($path)),
            'type' => "document",
        ];

        dd($data);

        $send = $client->request('POST', '/api/whatsapp/instances/send-media/50022', ['body' => json_encode($data)]);

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
