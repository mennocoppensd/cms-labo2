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
        return view('rating::rating-stars', [
            'averageRating' => $this->getAverageRating(),
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
        $collection = Collection::findByHandle($collectionHandle);

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

    // public function store(Request $request)
    // {
    //     $ipAddress = request()->ip();
    //     $rating = $request->input('rating');
    //     $entryId = $request->input('entry_id');

    //     // Debugging statement
    //     dd($entryId);

    //     // Validate $entryId
    //     if (!$entryId) {
    //         return response()->json(['message' => 'Invalid entry ID.'], 422);
    //     }


    //     $alreadyRated = $this->hasRated($entryId, $ipAddress);

    //     if (!$alreadyRated) {
    //         // Find the entry or create a new one
    //         $entry = Entry::find($entryId);

    //         if (!$entry) {
    //             $entry = Entry::make();
    //             $entry->id($entryId); // Set the entry ID
    //         }

    //         // Add the new rating to the existing ratings array
    //         $existingRatings = $entry->get('ratings', []);
    //         $existingRatings[] = $rating;
    //         $entry->set('ratings', $existingRatings);

    //         // Add the IP address to the associated entry's ratings
    //         $existingIpRatings = $entry->get('ip_ratings', []);
    //         $existingIpRatings[$entryId][] = $ipAddress;
    //         $entry->set('ip_ratings', $existingIpRatings);

    //         // Save the entry
    //         $entry->save();

    //         // Update local storage to indicate that the user has liked this entry
    //         echo '<script type="text/javascript">localStorage.setItem(`liked_'.$entryId.'`, true);</script>';

    //         // Redirect back to the index page or return a JSON response
    //         return redirect()->back();
    //     } else {
    //         return response()->json(['message' => 'You have already rated this entry.'], 422);
    //     }
    // }

    // private function hasRated($entryId, $ipAddress)
    // {
    //     // Find the entry
    //     $entry = Entry::find($entryId);

    //     // If the entry doesn't exist or the IP address is not in the ip_ratings array, return false
    //     if (!$entry || !in_array($ipAddress, $entry->get('ip_ratings', []))) {
    //         return false;
    //     }

    //     // Otherwise, return true
    //     return true;
    // }
}
