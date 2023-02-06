<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopicRequest;
use App\Models\Topic;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TopicsController extends Controller {

    public function __construct()
    {
        $this->authorizeResource(Topic::class);
    }

    public function index(Request $request)
    {
        return Inertia::render('Topics/Index', [
            'topics' => $request->user()->topics()->get(['id', 'name', 'created_at']),
        ]);
    }

    public function store(StoreTopicRequest $request)
    {
        Topic::create([
            'name'    => $request->input('name'),
            'user_id' => $request->user()->id,
        ]);

        return back();
    }

    public function show(Topic $topic)
    {
    }

    public function edit(Topic $topic)
    {
    }

    public function update(Request $request, Topic $topic)
    {
    }

    public function destroy(Topic $topic)
    {
    }

}
