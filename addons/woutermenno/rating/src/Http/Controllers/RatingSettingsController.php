<?php

namespace Woutermenno\Rating\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Statamic\Facades\Collection;
use Statamic\Entries\Entry;

class RatingSettingsController extends Controller
{
    public function index()
    {
        $collectionHandle = 'ratings'; // Replace with your actual collection handle

        // Get all entries in the 'ratings' collection
        $entries = Entry::query()->where('collection', $collectionHandle)->get();

        $ratings = $entries->map(function ($entry) {
            return $entry->get('rating');
        })->toArray();

        return view('rating::cp.index', [
            'ratings' => $ratings,
            'averageRating' => $this->getAverageRating($entries),
        ]);
    }

    public function store(Request $request)
    {
        $collectionHandle = 'ratings'; // Replace with your actual collection handle

        // Create a new entry in the 'ratings' collection
        $collection = Collection::findByHandle($collectionHandle);
        $entry = Entry::make()
            ->collection($collection)
            ->data([
                'rating' => $request->input('rating'),
                'entry_id' => $request->input('entry_id'), // assuming you have an entry_id field
            ]);

        // Save the entry
        $entry->save();

        return redirect()->back();
    }

    // Other methods remain the same

    // private function hasRated($entryId, $ipAddress)
    // {
    //     if (!$entryId) {
    //         return false;
    //     }

    //     $collectionHandle = 'ratings'; // Replace with your actual collection handle

    //     // Get all entries in the 'ratings' collection for the given entryId
    //     $entries = Entry::query()
    //         ->where('collection', $collectionHandle)
    //         ->where('entry_id', $entryId)
    //         ->get();

    //     foreach ($entries as $entry) {
    //         $ipRatings = $entry->get('ip_ratings', []);
    //         if (in_array($ipAddress, $ipRatings)) {
    //             return true;
    //         }
    //     }

    //     return false;
    // }

    public function delete(Request $request)
    {
        $rating = $request->input('rating');
        $collectionHandle = 'ratings';

        // Find the entry in the 'ratings' collection with the given rating
        $entry = Entry::query()
            ->where('collection', $collectionHandle)
            ->where('rating', $rating)
            ->first();

        // Delete the entry if found
        if ($entry) {
            $entry->delete();
        }

        return redirect()->back();
    }

    public function edit(Request $request)
    {
        $rating = $request->input('rating');
        $collectionHandle = 'ratings';

        // Find the entry in the 'ratings' collection with the given rating
        $entry = Entry::query()
            ->where('collection', $collectionHandle)
            ->where('rating', $rating)
            ->first();

        // Check if the entry exists
        if ($entry) {
            return view('rating::cp.edit', [
                'rating' => $rating,
            ]);
        } else {
            // Handle the case when the entry does not exist
            abort(404);
        }
    }

    // Update the getAverageRating method to accept entries as a parameter
    public function getAverageRating($entries)
    {
        $totalRating = 0;
        $count = $entries->count();

        foreach ($entries as $entry) {
            $totalRating += $entry->get('rating');
        }

        $averageRating = ($count > 0) ? $totalRating / $count : 0;

        return $averageRating;
    }



    public function addBlueprint()
        {
            $collectionHandle = 'ratings';

            // blueprint aanpassen
            $collection = Collection::findByHandle($collectionHandle);
            $blueprint = $collection->entryBlueprint();

            $blueprint->ensureField('rating', [
                'type' => 'select',
                'display' => 'Rating'
            ]);
            $blueprint->save();

            // redirect back
            return redirect()->back();
        }
}

