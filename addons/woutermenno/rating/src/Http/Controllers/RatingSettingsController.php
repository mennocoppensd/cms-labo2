<?php

namespace Woutermenno\Rating\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Statamic\Facades\Yaml;

class RatingSettingsController extends Controller
{
    public function index()
    {
        // YAML file path
        $filePath = resource_path('rating/ratings.yaml');
    
        // Read and parse the YAML content
        $ratings = Yaml::parse(file_get_contents($filePath));
    
        return view('rating::cp.index', [
            'ratings' => $ratings['ratings'] ?? [], // Assuming 'ratings' is the key in your YAML file
        ]);
    }


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

        // Redirect back to the index page
        return redirect()->back();
    }

        public function delete($rating)
    {
        // YAML file path
        $filePath = resource_path('rating/ratings.yaml');

        // Read and parse the YAML content
        $ratings = Yaml::parse(file_get_contents($filePath));

        // Remove the specified rating
        $ratings['ratings'] = array_diff($ratings['ratings'], [$rating]);

        // Dump the updated ratings to YAML format
        $updatedRatings = Yaml::dump($ratings);

        // Write the updated content back to the file
        file_put_contents($filePath, $updatedRatings);

        // Redirect back to the index page or wherever you want
        return redirect()->back();
    }



}