<?php

/*
* This file is part of Centurian.
*
* (c) Blue Bay Travel <developers@bluebaytravel.co.uk>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace BlueBayTravel\Tests\Centurian\Console;

use BlueBayTravel\Centurian\Centurian;
use BlueBayTravel\Centurian\Console\Commands\CenturianRelease;
use GrahamCampbell\TestBench\AbstractTestCase;
use Mockery;

/**
 * This is the centurian release test class.
 *
 * @author James Brooks <james@bluebaytravel.co.uk>
 */
class CenturianReleaseTest extends AbstractTestCase
{
    public function testFire()
    {
        $command = $this->getCommand();

        dd($command);

        // $command->getEvents()->shouldReceive('fire')->once()->with('command.publishvendors', $command);

        $this->assertEmpty($command->handle());
    }

    protected function getCommand()
    {
        $centurian = Mockery::mock(Centurian::class);

        return new CenturianRelease($centurian);
    }
}
