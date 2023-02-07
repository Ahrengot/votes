<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class SetAllowTopicSuggestionsController extends Controller {

    public function __invoke(Request $request, Topic $topic)
    {
        $this->authorize('update', $topic);

        $topic->update($request->validate([
            'allow_suggestions' => 'bool',
        ]));

        return back();
    }

}
