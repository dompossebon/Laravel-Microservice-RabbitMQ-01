<?php


namespace App\Services\Traits;


use Illuminate\Support\Facades\Http;

trait ConsumeExternalService
{
    public function headers(array $headers = [])
    {
        $headers = array_merge($headers, [
            'Accept' => 'application/json',
            'Authorization' => $this->token
        ]);

        return Http::withHeaders($headers);
    }

    public function request(string $method, string $endPoint, $formParams = null, array $headers = [])
    {
        return $this->headers($headers)->$method($this->url . $endPoint);
    }

}
