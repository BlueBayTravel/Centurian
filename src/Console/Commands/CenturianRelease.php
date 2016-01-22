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
use Illuminate\Console\Command;

class CenturianRelease extends Command
{
    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'centurian:release {version}';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Notifies Sentry of a new release';

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
        dd($this->argument());
        $version = $this->argument('version');

        $this->info('Notifying Sentry of new version: '.$version);
        $this->centurian->release($version);
        $this->success('Version '.$version.' has been released.');
    }
}
