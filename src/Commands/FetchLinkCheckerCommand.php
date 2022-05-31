<?php

namespace Quarterloop\LinkCheckerTile\Commands;

use Illuminate\Console\Command;
use Quarterloop\LinkCheckerTile\Services\LinkCheckerAPI;
use Quarterloop\LinkCheckerTile\LinkCheckerStore;

class FetchLinkCheckerCommand extends Command
{
    protected $signature = 'dashboard:fetch-link-checker-data';

    protected $description = 'Fetch link checker data';

    public function handle(LinkCheckerAPI $link_checker_api)
    {

        $this->info('Fetching link checker data ...');

        $brokenLinks = $link_checker_api::getBrokenLinks(
            config('dashboard.tiles.hosting.url'),
            config('dashboard.tiles.linkChecker.key'),
        );

        LinkCheckerStore::make()->setData($brokenLinks);

        $this->info('Stored data ...');

        $this->info('All done!');
    }
}