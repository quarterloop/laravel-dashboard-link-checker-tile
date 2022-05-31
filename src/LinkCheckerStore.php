<?php

namespace Quarterloop\LinkCheckerTile;

use Spatie\Dashboard\Models\Tile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LinkCheckerStore
{
    private Tile $tile;

    public static function make()
    {
        return new static();
    }

    public function __construct()
    {
        $this->tile = Tile::firstOrCreateForName("linkChecker");
    }

    public function setData(array $data): self
    {
        $this->tile->putData('brokenLinks', $data);

        return $this;
    }

    public function getData(): array
    {
        return$this->tile->getData('brokenLinks') ?? [];
    }

    public function getLastUpdateTime()
    {
        $tileName = 'linkChecker';

        $queryTime = DB::table('dashboard_tiles')->select('updated_at')->where('name', '=', $tileName)->get();

        $responseTime = Str::substr($queryTime, 26, 9);

        return $responseTime;
    }

    public function getLastUpdateDate()
    {
        $tileName = 'linkChecker';

        $queryDate = DB::table('dashboard_tiles')->select('updated_at')->where('name', '=', $tileName)->get();

        $responseDate = Str::substr($queryDate, 16, 10);

        return $responseDate;
    }
}
