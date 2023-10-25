<?php

namespace Woutermenno\Rating\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Statamic\Facades\Yaml;

class RatingSettingsController extends Controller
{
    public function index()
    {
        return view('rating::cp.index', [
          'foo' => 'bar'
        ]);
    }

    // public function add($collection)
    // {
    //     // save collection to a yaml file
    //     $path = resource_path('rating/ratings.yaml');
    //     $ratingsFile = file_get_contents($path);

    //     $ratings = collect(Yaml::parse($ratingsFile));
        
    //     $ratings->put('collections', [$collection->handle()]);
    //     dd($ratings->all());

    //     $yamlContent = Yaml::dump($ratings->toArray());
    //     file_put_contents($path, $yamlContent);

    // }

    public function store(Request $request)
    {
        // rating uit request halen
        $rating = $request->input('rating');
    
        // YAML file path
        $filePath = resource_path('rating/ratings.yaml');
    
       
        $existingRatings = Yaml::parse(file_get_contents($filePath));


        // Add the new rating to the existing ratings array
        $existingRatings['ratings'][] = $rating;

        // Dump the updated ratings to YAML format
        $updatedRatings = Yaml::dump($existingRatings);

        // Write the updated content back to the file
        file_put_contents($filePath, $updatedRatings);

    }

}