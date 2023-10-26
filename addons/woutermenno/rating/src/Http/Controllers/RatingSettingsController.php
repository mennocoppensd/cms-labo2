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
            'ratings' => $ratings['ratings'] ?? [],
            'averageRating' => $this->getAverageRating(),
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

        // Find the index of the specified rating
        $index = array_search($rating, $ratings['ratings']);

        // If the rating is found, unset that specific index
        if ($index !== false) {
            unset($ratings['ratings'][$index]);
        }

        // Reindex the array to maintain a consecutive index
        $ratings['ratings'] = array_values($ratings['ratings']);

        // Dump the updated ratings to YAML format
        $updatedRatings = Yaml::dump($ratings);

        // Write the updated content back to the file
        file_put_contents($filePath, $updatedRatings);

        // Redirect back to the index page or wherever you want
        return redirect()->back();
    }

    public function getAverageRating()
    {
        // YAML file path
        $filePath = resource_path('rating/ratings.yaml');

        // Read and parse the YAML content
        $ratings = Yaml::parse(file_get_contents($filePath));

        // Check if there are any ratings
        if (!empty($ratings['ratings'])) {
            // Calculate the sum of all ratings
            $totalRating = array_sum($ratings['ratings']);

            // Calculate the total number of ratings
            $totalRatingsCount = count($ratings['ratings']);

            // Calculate the average rating
            $averageRating = $totalRating / $totalRatingsCount;

            // You can round the average to a certain number of decimal places if needed
            $averageRating = round($averageRating, 2);

            return $averageRating;
        } else {
            // Return a default value or handle the case when there are no ratings
            return 0;
        }
    }

    
}




