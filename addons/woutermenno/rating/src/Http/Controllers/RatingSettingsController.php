<?php

namespace Woutermenno\Rating\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Statamic\Facades\Collection;
use Statamic\Entries\Entry;
use Illuminate\Support\Str;

class RatingSettingsController extends Controller
{
    public function index()
    {
        $collectionHandle = 'ratings';

        $collections = Collection::all();

        // Get all entries in the 'ratings' collection
        $entries = Entry::query()->where('collection', $collectionHandle)->get();

        $ratings = $entries->map(function ($entry) {
            return $entry->get('rating');
        })->toArray();

        $entryId = (string) Str::uuid();
        $ratingId = (string) Str::uuid();
        $userId = (string) Str::uuid();

        return view('rating::cp.index', [
            'entries' => $entries,
            'ratings' => $ratings,
            'rating_id' => $ratingId,
            'entry_id' => $entryId,
            'user_id' => $userId,
            'averageRating' => $this->getAverageRating($entries),
            'collections' => $collections,

        ]);
    }

    public function store(Request $request)
    {
        $entryId = (string) Str::uuid();
        $ratingId = (string) Str::uuid();
        $userId = (string) Str::uuid();
        $collectionHandle = 'ratings'; // Replace with your actual collection handle

        // Create a new entry in the 'ratings' collection
        $collection = Collection::findByHandle($collectionHandle);
        $entry = Entry::make()
            ->collection($collection)
            ->data([
                'rating' => $request->input('rating'),
                'entry_id' => $entryId,
                'rating_id' => $ratingId,
                'user_id' => $userId,
            ]);

        // Save the entry
        $entry->save();

        return redirect()->back();
    }


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

            // Redirect back to the index page after updating
            $collectionHandle = 'ratings'; // Replace with your actual collection handle

            // Get all entries in the 'ratings' collection
            $entries = Entry::query()->where('collection', $collectionHandle)->get();

            $ratings = $entries->map(function ($entry) {
                return $entry->get('rating');
            })->toArray();

            return view('rating::cp.index', [
                'entries' => $entries,
                'ratings' => $ratings,
                'averageRating' => $this->getAverageRating($entries),
            ]);
        }else {
            // Handle the case when the entry does not exist
            abort(404);
        }




    }

    public function edit(Request $request)
    {
        $rating = $request->input('rating');
        $collectionHandle = 'ratings';

        $entries = Entry::query()->where('collection', $collectionHandle)->get();

        // Find the entry in the 'ratings' collection with the given rating
        $entry = Entry::query()
            ->where('collection', $collectionHandle)
            ->where('rating', $rating)
            ->first();

        // Check if the entry exists
        if ($entry) {
            return view('rating::cp.edit', [
                'entries' => $entries,
                'entry' => $entry,
                'rating' => $rating,
            ]);
        } else {
            // Handle the case when the entry does not exist
            abort(404);
        }
    }

        public function update(Request $request, $rating)
    {
        // Get the new rating from the request
        $newRating = $request->input('new_rating');
        $collectionHandle = 'ratings'; // Replace with your actual collection handle

        // Find the entry in the 'ratings' collection with the given rating
        $entry = Entry::query()
            ->where('collection', $collectionHandle)
            ->where('rating', $rating)
            ->first();

        // Check if the rating entry exists
        if ($entry) {
            // Update the rating value
            $entry->set('rating', $newRating);

            // Save the updated entry
            $entry->save();

        } else {
            // Handle the case when the rating does not exist
            abort(404);
        }

        // Redirect back to the index page after updating
                $collectionHandle = 'ratings'; // Replace with your actual collection handle

                // Get all entries in the 'ratings' collection
                $entries = Entry::query()->where('collection', $collectionHandle)->get();

                $ratings = $entries->map(function ($entry) {
                    return $entry->get('rating');
                })->toArray();

                return view('rating::cp.index', [
                    'entries' => $entries,
                    'ratings' => $ratings,
                    'averageRating' => $this->getAverageRating($entries),
                ]);
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



    public function addBlueprint(Request $request)
    {
        $collectionHandle = $request->input('collection_handle');

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
