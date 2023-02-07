<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use App\Models\Vote;
use Illuminate\Http\Request;

class SuggestionVotesController extends Controller {

    public function store(Request $request, Suggestion $suggestion)
    {
        // updateOrCreate to prevent creating multiple votes for the same suggestion
        $suggestion->votes()->updateOrCreate($request->validate([
            'fingerprint' => 'required',
        ]));

        return back();
    }

    public function destroy(Request $request, Vote $vote)
    {
        abort_unless($vote->fingerprint == $request->input('fingerprint'), 403);

        $vote->delete();

        return back();
    }

}
