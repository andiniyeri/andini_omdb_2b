<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MovieService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('omdb.api_key');
        $this->baseUrl = rtrim(config('omdb.base_url', 'https://www.omdbapi.com/'), '/');
    }

    protected function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->baseUrl);
    }

    public function search($query, $page = 1)
    {
        if (! $this->isConfigured()) {
            Log::error('OMDB configuration missing api_key or base_url');
            return false;
        }

        try {
            $response = Http::timeout(10)->get($this->baseUrl, [
                'apikey' => $this->apiKey,
                's'      => $query,
                'page'   => $page,
                'type'   => 'movie',
            ]);

            if (! $response->successful()) {
                Log::error('OMDB search failed', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                return false;
            }

            $data = $response->json();

            if ($data['Response'] === 'True') {
                return [
                    'movies' => $data['Search'],
                    'total'  => (int) $data['totalResults'],
                    'error'  => null,
                ];
            }

            return [
                'movies' => [],
                'total'  => 0,
                'error'  => $data['Error'],
            ];
        } catch (\Exception $e) {
            Log::error('OMDB error: ' . $e->getMessage());
            return false;
        }
    }

    public function detail($imdbId)
    {
        try {
            $response = Http::timeout(10)->get($this->baseUrl, [
                'apikey' => $this->apiKey,
                'i'      => $imdbId,
                'plot'   => 'full',
            ]);

            if (! $response->successful()) {
                Log::error('OMDB detail failed', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                return false;
            }

            $data = $response->json();

            Log::info('OMDB detail response: ', $data);

            if (isset($data['Response']) && $data['Response'] === 'True') {
                return $data;
            }

            Log::error('OMDB detail response false', ['response' => $data]);
            return false;
        } catch (\Exception $e) {
            Log::error('OMDB detail error: ' . $e->getMessage());
            return false;
        }
    }
}