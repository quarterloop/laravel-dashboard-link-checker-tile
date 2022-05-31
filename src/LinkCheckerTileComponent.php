<?php

namespace Quarterloop\LinkCheckerTile;

use Livewire\Component;

class LinkCheckerTileComponent extends Component
{

    public $position;

    public function mount(string $position)
    {
        $this->position = $position;
    }


    public function render()
    {

      $linkCheckerStore = LinkCheckerStore::make();

        return view('dashboard-link-checker-tile::tile', [
            'website'         => config('dashboard.tiles.hosting.url'),

            'lastUpdateTime'  => date('H:i:s', strtotime($linkCheckerStore->getLastUpdateTime())),
            'lastUpdateDate'  => date('d.m.Y', strtotime($linkCheckerStore->getLastUpdateDate())),
        ]);
    }
}
