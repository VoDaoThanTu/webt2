<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', ['tags' => $tags]);
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(StoreTagRequest $request)
    {
        $tag = new Tag();
        $tag->name = $request->input('name');
        $tag->save();

        return redirect()->route('tags.index');
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit', ['tag' => $tag]);
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->name = $request->input('name');
        $tag->save();

        return redirect()->route('tags.index');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index');
    }
}
