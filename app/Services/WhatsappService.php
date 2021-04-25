<?php

namespace Services;

use App\Models\Customer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class WhatsappService
{
    public function http($slug, $data = [])
    {
        $response = Http::asForm()
        ->withOptions(['base_uri' => setting('api'), 'debug' => false])
        ->post($slug, $data)
        ->json();

        return $response;
    }

    public function message($data)
    {
        return $this->http('send-message', [
            'token' => setting('token'),
            'number' => $data['number'],
            'message' => $data['message'],
        ]);
    }

    public function media($data)
    {
        return $this->http('send-media', [
            'token' => setting('token'),
            'number' => $data['number'],
            'file' => $data['file'],
            'file_name' => $data['file_name'],
            'caption' => $data['caption'],
        ]);
    }

    public function broadcast($message, $file = null, $filename = null)
    {
        $customers = Customer::whereIsSubscribe(1)->get();

        if ($file) {
            foreach ($customers as $customer) {
                $this->media([
                    'token' => setting('token'),
                    'number' => $customer->number,
                    'caption' => $message,
                    'file' => asset(Storage::url($file)),
                    'file_name' => $filename
                ]);
            }
        }else{
            foreach ($customers as $customer) {
                $this->message([
                    'token' => setting('token'),
                    'number' => $customer->number,
                    'message' => $message,
                ]);
            }
        }

        return true;
    }
}
