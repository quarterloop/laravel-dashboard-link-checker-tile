<?php

namespace Quarterloop\LinkCheckerTile\Services;

use Illuminate\Support\Facades\Http;

class LinkCheckerAPI
{
  public static function getBrokenLinks(string $url, string $key): array
  {

      $response = Http::withHeaders([
        'x-api-key' => {$key},
      ])->post('https://api.geekflare.com/brokenlink', [
        'url' => {$url},
      ])->json();

      return $response;
  }
}
