<?php

/*
 * This file is part of Centurian.
 *
 * (c) Blue Bay Travel <developers@bluebaytravel.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BlueBayTravel\Centurian\Console\Commands;

use BlueBayTravel\Centurian\Centurian;
use Exception;
use Illuminate\Console\Command;

class CenturianReleaseList extends Command
{
    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'centurian:list';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'List all releases for the project';

    /**
     * The centurian instance.
     *
     * @var \BlueBayTravel\Centurian\Centurian
     */
    protected $centurian;

    /**
     * Create a new instance.
     *
     * @param \BlueBayTravel\Centurian\Centurian $centurian
     *
     * @return void
     */
    public function __construct(Centurian $centurian)
    {
        $this->centurian = $centurian;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Fetching versions...');

        try {
            $releases = $this->centurian->getReleases();
        } catch (Exception $e) {
            $this->error('There was an error contacting the API.');

            return;
        }

        foreach ($releases as $release) {
            $this->info('Release: '.$release->version);
        }
    }

    /**
     * Get the centurian instance.
     *
     * @return \BlueBayTravel\Centurian\Centurian
     */
    public function getCenturian()
    {
        return $this->centurian;
    }
}
