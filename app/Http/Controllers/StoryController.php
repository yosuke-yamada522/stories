<?php

namespace App\Http\Controllers;
use App\Story;
use App\Tag;
use App\Http\Requests\StoryRequest;
use Illuminate\Http\Request;


class StoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Story::class, 'story');
    }

    public function index()
    {
        $stories = Story::all()->sortByDesc('created_at')
        ->load(['user','likes','tags']);

        return view('stories.index', ['stories' => $stories]);
    }
    
    //小説の作成
    public function create()
    {

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('stories.create',[
            'allTagNames' => $allTagNames,
        ]);
    }

    //小説の投稿
    public function store(StoryRequest $request, Story $story)
    {
        $story->fill($request->all());
        $story->user_id = $request->user()->id;
        $story->save();
        $request->tags->each(function ($tagName) use ($story) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $story->tags()->attach($tag);
        });

        return redirect()->route('stories.index');
    }

    
    public function edit(Story $story)
    {
        $tagNames = $story->tags->map(function ($tag){
            return ['text' => $tag->name];
        });

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' =>$tag->name];
        });

        return view('stories.edit', [
            'story' => $story,
            'tagNames' => $tagNames,
            'allTagNames' => $allTagNames,
        ]);
    }

    //小説の更新
    public function update(StoryRequest $request, Story $story)
    {
        $story->fill($request->all())->save();

        $story->tags()->detach();
        $request->tags->each(function ($tagName) use ($story) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $story->tags()->attach($tag);
        });

        return redirect()->route('stories.index');
    }

    //小説の削除
    public function destroy(Story $story)
    {
        $story->delete();
        return redirect()->route('stories.index');
    }

    //小説の詳細
    public function show(Story $story)
    {
        return view('stories.show',['story' => $story]);
    }

    public function like(Request $request, Story $story)
    {
        $story->likes()->detach($request->user()->id);
        $story->likes()->attach($request->user()->id);

        return [
            'id' => $story->id,
            'countLikes' => $story->count_likes,
        ];
    }

    public function unlike(Request $request, Story $story)
    {
        $story->likes()->detach($request->user()->id);

        return [
            'id' => $story->id,
            'countLikes' => $story->count_likes,
        ];
    }
}