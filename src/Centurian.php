<?php

/*
* This file is part of Centurian.
*
* (c) Blue Bay Travel <developers@bluebaytravel.co.uk>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace BlueBayTravel\Centurian;

use GuzzleHttp\Client;
use Illuminate\Contracts\Config\Repository;

class Centurian
{
    protected $client;

    protected $config;

    public function __construct(Client $client, Repository $config)
    {
        $this->client = $client;
        $this->config = $config;
    }

    public function release($version)
    {
        $dsn = $this->config->get('centurian.dsn');
        $org = $this->config->get('centurian.org');

        $this->request('hooks/release/builtin/'.$org.'/'.$dsn, [
            'version' => $version,
        ]);
    }

    protected function request($request, array $params = [])
    {
        $endpointUrl = $this->config->get('centurian.endpoint');

        $endpoint = sprintf('%s/api/%s', $endpointUrl, $request);

        return $this->client->post($endpoint, $params);
    }
}
