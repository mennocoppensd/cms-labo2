<?php

namespace Woutermenno\Rating;

use Woutermenno\Rating\Tags\Rating;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{

    /**
     * @var list<class-string<Tags>>
     */
    protected $tags = [
        Rating::class,
    ];

    // /**
    //  * @var list<string> - Paths on disk
    //  */
    // protected $stylesheets = [
    //     __DIR__ . '/../resources/css/addon.css',
    // ];

    protected $vite = [
        'input' => [
            'resources/js/addon.js',
            'resources/css/addon.css'
        ],
        'publicDirectory' => 'resources/dist',
    ];

    public function bootAddon()
    {
        //
    }
}
