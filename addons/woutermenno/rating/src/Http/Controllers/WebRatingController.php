<?php

namespace Woutermenno\Rating\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Statamic\Facades\Yaml;
use Statamic\Facades\Collection;
use Statamic\Entries\Entry;
use Statamic\Fieldtypes\Collections;

class WebRatingController extends Controller
{

    public function index()
    {
        $averageRating = $this->getAverageRating();
    
    // This will display the variable and stop execution

    return view('rating::rating-stars', [
        'averageRating' => $averageRating,
    ]);
    }

   public function store(Request $request)
{
    // Extract the entry ID from the request
    $entryId = $request->input('entryId');

    // Check if the entry has already been liked (optional)
    // You can perform additional checks or validations here

    // Create a new entry in the 'ratings' collection
    $collection = Collection::findByHandle('ratings');
    $entry = Entry::make()
        ->collection($collection)
        ->data([
            'rating' => $request->input('rating'),
            // Add other necessary data
        ]);

    // Save the entry
    $entry->save();

    // Generate JavaScript code to set local storage
    $jsCode = "<script>localStorage.setItem('liked', true);</script>";

    // Return the response with JavaScript code
    return redirect()->back()->with('jsCode', $jsCode);
}

    
    public function getAverageRating()
    {
        $collectionHandle = 'ratings'; // Replace with your actual collection handle
       

        // Get all entries in the 'ratings' collection
        $entries = Entry::query()->where('collection', $collectionHandle)->get();

        // Calculate the average rating
        $totalRating = 0;
        $count = $entries->count();

        foreach ($entries as $entry) {
            // Assuming 'rating' is the field handle for your rating value
            $totalRating += $entry->get('rating');
        }

        $averageRating = ($count > 0) ? $totalRating / $count : 0;

        return $averageRating;
    }

}
