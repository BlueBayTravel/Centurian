<?php

/*
 * This file is part of Centurian.
 *
 * (c) Blue Bay Travel <developers@bluebaytravel.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BlueBayTravel\Tests\Centurian;

use BlueBayTravel\Centurian\Centurian;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;

/**
 * This is the service provider test class.
 *
 * @author James Brooks <james@bluebaytravel.co.uk>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testCenturianIsInjectable()
    {
        $this->assertIsInjectable(Centurian::class);
    }
}
