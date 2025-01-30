<?php

namespace App\Services\Api\Tmdb;


use Exception;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\StreamInterface;

class TmdbService implements TmdbInterface
{

    protected string $accessToken;


    public function __construct()
    {
        $this->accessToken = config('services.api.tmbd.token');

    }

    /**
     *
     * @param array $attributes
     * @return array|StreamInterface
     */
    public function get(array $attributes)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json',
            ])->get($attributes['url'], [
                'language' => 'en-US',
                'page' => $attributes['page'] ?? 1,
            ]);

            if ($response->successful()) {
                return $response->json();
            } else {
                throw new Exception('API request failed: ' . $response->status());
            }
        } catch (Exception $e) {
            info('HTTP request failed: ' . $e->getMessage());
            return ['error' => 'Request failed. Please try again later.'];
        }
    }
}
