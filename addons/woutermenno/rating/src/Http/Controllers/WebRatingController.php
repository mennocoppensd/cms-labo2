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
      
        // Create a new entry in the 'ratings' collection
        $collection = Collection::findByHandle('ratings');
        $entry = Entry::make()
            ->collection($collection)
            ->data([
                'rating' => $request->input('rating'),
                //didnt work to remove title from blueprint yet
                'title' => 'rating',
                
            ]);
    
        // Save the entry
        $entry->save();
    
        return redirect()->back();
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
