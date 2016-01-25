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

class CenturianRelease extends Command
{
    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'centurian:release';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Notifies Sentry of a new release';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'centurian:release {version}';

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
        $version = $this->argument('version');

        $this->info('Notifying Sentry of new version: '.$version);

        try {
            $this->centurian->release($version);
        } catch (Exception $e) {
            $this->error('There was an error making your release.');

            return;
        }

        $this->info('Version '.$version.' has been released.');
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
