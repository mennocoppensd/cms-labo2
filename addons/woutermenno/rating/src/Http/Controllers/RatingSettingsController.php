<?php

namespace Woutermenno\Rating\Http\Controllers;

use App\Http\Controllers\Controller;
use Statamic\Facades\Yaml;

class RatingSettingsController extends Controller
{
    public function index()
    {
        return view('rating::cp.index', [
          'foo' => 'bar'
        ]);
    }

    public function add($collection)
    {
        // save collection to a yaml file
        $path = resource_path('rating/ratings.yaml');
        $ratingsFile = file_get_contents($path);

        $ratings = collect(Yaml::parse($ratingsFile));
        
        $ratings->put('collections', [$collection->handle()]);
        dd($ratings->all());

        $yamlContent = Yaml::dump($ratings->toArray());
        file_put_contents($path, $yamlContent);

    }
}