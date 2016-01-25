<?php

/*
 * This file is part of Centurian.
 *
 * (c) Blue Bay Travel <developers@bluebaytravel.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Sentry Endpoint.
    |--------------------------------------------------------------------------
    |
    | The URL where Sentry sites.
    |
    */

    'endpoint' => env('CENTURIAN_ENDPOINT', null),

    /*
    |--------------------------------------------------------------------------
    | Organization Slug.
    |--------------------------------------------------------------------------
    |
    | The organization slug.
    |
    */

    'organization_slug' => env('CENTURIAN_ORG_SLUG', null),

    /*
    |--------------------------------------------------------------------------
    | Project slug.
    |--------------------------------------------------------------------------
    |
    | The project slug.
    |
    */

    'project_slug' => env('CENTURIAN_PROJECT_SLUG', null),

    /*
    |--------------------------------------------------------------------------
    | API Token.
    |--------------------------------------------------------------------------
    |
    | The token provided to make requests.
    |
    */

    'token' => env('CENTURIAN_TOKEN', null),

];
