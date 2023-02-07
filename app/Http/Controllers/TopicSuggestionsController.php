<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicSuggestionsController extends Controller {

    public function store(Request $request, Topic $topic)
    {
        abort_unless($topic->allow_suggestions || $this->authorize('update', $topic), 403);


        $topic->suggestions()->create($request->validate([
            'name' => 'required|string|min:3',
        ]));

        return back();
    }

    public function destroy(Requeust $request, Suggestion $suggestion)
    {
        //
    }

}
