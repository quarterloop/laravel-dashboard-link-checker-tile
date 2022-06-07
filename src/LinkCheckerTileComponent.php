<?php

namespace Quarterloop\LinkCheckerTile;

use Livewire\Component;
use Illuminate\Support\DB;

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

      $count200    = count(array_filter($linkCheckerStore->getData()['data'], function($element) {
                                return $element['status']==200;
                              }));

      $count404    = count(array_filter($linkCheckerStore->getData()['data'], function($element) {
                                return $element['status']==404;
                              }));

      $countOther  = count(array_filter($linkCheckerStore->getData()['data'], function($element) {
                                return $element['status']!=200 && $element['status']!=404;
                              }));

      $countAll = count($linkCheckerStore->getData()['data']);


        return view('dashboard-link-checker-tile::tile', [
            'website'         => config('dashboard.tiles.hosting.url'),
            'links'           => array_filter($linkCheckerStore->getData()['data'], function($element) {
                                      return $element['status'] == 404;
                                    }),
            // 'links'           => $linkCheckerStore->getData()['data'],
            'workingLinks'    => $count200,
            'brokenLinks'     => $count404,
            'notSure'         => $countOther,
            'checkedLinks'    => $countAll,
            'lastUpdateTime'  => date('H:i:s', strtotime($linkCheckerStore->getLastUpdateTime())),
            'lastUpdateDate'  => date('d.m.Y', strtotime($linkCheckerStore->getLastUpdateDate())),
        ]);
    }
}


class LinkCheckerSmallTileComponent extends Component
{

    public $position;

    public function mount(string $position)
    {
        $this->position = $position;
    }


    public function render()
    {

      $linkCheckerStore = LinkCheckerStore::make();

      $count200    = count(array_filter($linkCheckerStore->getData()['data'], function($element) {
                                return $element['status']==200;
                              }));

      $count404    = count(array_filter($linkCheckerStore->getData()['data'], function($element) {
                                return $element['status']==404;
                              }));

      $countOther  = count(array_filter($linkCheckerStore->getData()['data'], function($element) {
                                return $element['status']!=200 && $element['status']!=404;
                              }));

      $countAll = count($linkCheckerStore->getData()['data']);


        return view('dashboard-link-checker-tile::tile-small', [
            'website'         => config('dashboard.tiles.hosting.url'),
            'links'           => array_filter($linkCheckerStore->getData()['data'], function($element) {
                                      return $element['status'] == 404;
                                    }),
            // 'links'           => $linkCheckerStore->getData()['data'],
            'workingLinks'    => $count200,
            'brokenLinks'     => $count404,
            'notSure'         => $countOther,
            'checkedLinks'    => $countAll,
            'lastUpdateTime'  => date('H:i:s', strtotime($linkCheckerStore->getLastUpdateTime())),
            'lastUpdateDate'  => date('d.m.Y', strtotime($linkCheckerStore->getLastUpdateDate())),
        ]);
    }
}
