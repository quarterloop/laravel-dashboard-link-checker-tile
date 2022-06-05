<?php

namespace Quarterloop\LinkCheckerTile\Commands;

use Illuminate\Console\Command;
use Quarterloop\LinkCheckerTile\Services\LinkCheckerAPI;
use Quarterloop\LinkCheckerTile\LinkCheckerStore;
use Session;

class FetchLinkCheckerCommand extends Command
{
    protected $signature = 'dashboard:fetch-link-checker-data';

    protected $description = 'Fetch link checker data';

    public function handle(LinkCheckerAPI $link_checker_api)
    {

        $this->info('Fetching link checker data ...');

        $brokenLinks = $link_checker_api::getBrokenLinks(
            Session::get('website'),
            config('dashboard.tiles.geekflare.key'),
        );

        LinkCheckerStore::make()->setData($brokenLinks);

        $this->info('Stored data ...');

        $this->info('All done!');
    }
}
