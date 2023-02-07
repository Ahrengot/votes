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
            'name'        => 'required|string|min:3',
            'fingerprint' => 'required',
        ]));

        return back();
    }

    public function destroy(Request $request, Suggestion $suggestion)
    {
        abort_unless(
            $suggestion->fingerprint == $request->input('fingerprint')
            || $this->authorize('update', $suggestion->topic),
            403
        );

        $suggestion->delete();

        return back();
    }

}
