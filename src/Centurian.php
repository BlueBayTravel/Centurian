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
    /**
     * The guzzle client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * The config repository.
     *
     * @param \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * Create a new centurian instance.
     *
     * @param \GuzzleHttp\Client                      $client
     * @param \Illuminate\Contracts\Config\Repository $config
     *
     * @return void
     */
    public function __construct(Client $client, Repository $config)
    {
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * Create a new release.
     *
     * @param mixed      $version
     * @param mixed|null $ref
     *
     * @return \Psr7\Request
     */
    public function release($version, $ref = null)
    {
        $org = $this->config->get('centurian.organization_slug');
        $project = $this->config->get('centurian.project_slug');

        $result = $this->request('api/0/projects/'.$org.'/'.$project.'/releases/', array_filter([
            'version' => $version,
            'ref'     => $ref,
        ]));

        $body = (string) $result->getBody();

        return json_decode($body);
    }

    /**
     * Makes a request to a URL.
     *
     * @param string $request
     * @param array  $params
     *
     * @return \Psr7\Request
     */
    protected function request($request, array $params = [])
    {
        $endpoint = $this->config->get('centurian.endpoint');
        $uri = sprintf('%s/%s', $endpoint, $request);

        $data = [
            'form_params' => $params,
            'auth'        => [
                $this->config->get('centurian.token'),
                null,
            ],
        ];

        return $this->client->post($uri, $data);
    }
}
