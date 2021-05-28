<?php

namespace Services;

use App\Models\Customer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class WhatsappService
{
    public function http(string $slug, array $data = [])
    {
        $response = Http::asForm()
        ->withOptions(['base_uri' => config('services.whatsapp.url'), 'debug' => false])
        ->post($slug, $data)
        ->json();

        return $response;
    }

    public function message(array $data)
    {
        return $this->http('send-message', [
            'token' => setting('token'),
            'number' => $data['number'],
            'message' => $data['message'],
        ]);
    }

    public function media(array $data)
    {
        return $this->http('send-media', [
            'token' => setting('token'),
            'number' => $data['number'],
            'media' => $data['media'],
            'caption' => $data['caption'],
        ]);
    }

    public function broadcast(string $message, $media = null)
    {
        $customers = Customer::whereIsSubscribe(1)->get();

        if ($media) {
            foreach ($customers as $customer) {
                $this->media([
                    'token' => setting('token'),
                    'number' => $customer->number,
                    'caption' => $message,
                    'media' => asset(Storage::url($media)),
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
