<?php

namespace Woutermenno\Rating;

use Statamic\Facades\CP\Nav;
use Statamic\Facades\Preference;
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

   /**
     * Map of type => Path of route PHP file on disk where the key (type) can be one
     * of `cp`, `web`, `actions`.
     *
     * @template TType of 'cp'|'web'|'actions'
     *
     * @var array<TType, string>
     */
    protected $routes = [
        'cp' => __DIR__ . '/../routes/cp.php',
    ];


    protected $vite = [
        'input' => [
            'resources/js/addon.js',
            'resources/css/addon.css'
        ],
        'publicDirectory' => 'resources/dist',
    ];

    public function bootAddon()
    {
        Nav::extend(function ($nav) {
            $nav->create('Settings') // deze naam verschijnt in je navigatie
                ->section('Rating Addon') // onder welke sectie moet dit komen (bestaande of nieuw)
                ->route('rating.index') // de route die moet worden geopend, addon-slug . actie
                ->icon('pro-ribbon'); // een icoon
        });
    }
}
