<?php

namespace App\Http\Controllers\Services\Post;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostService
{
    private Post $post;

    public function published()
    {
        return Post::query()->get();
    }

    /**
     * Store a newly created post in storage.
     *
     * @param PostStoreRequest $request
     * @return Post
     */
    public function store(PostStoreRequest $request): Post
    {
        $post = $request->user()->posts()->create([
            'title' => $request->input('title'),
        ]);

        $post->bodies()->create([
            'sub_title' => $request->input('sub_title'),
            'body' => $request->input('body'),
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->storePublicly('images/post','public');

            $post->images()->create([
                'path' => config('app.url') . Storage::url($path),
            ]);
        }

        return $post;
    }

    /**
     * Update the specified post in storage.
     *
     * @param PostUpdateRequest $request
     * @return Post
     * @throws \Exception
     */
    public function update(PostUpdateRequest $request): Post
    {
        if (!$this->post) {
            throw new \Exception('Post not set');
        }

        $this->post->update([
            'title' => $request->input('title'),
        ]);

        $this->post->bodies()->updateOrCreate(
            ['post_id' => $this->post->id],
            [
                'sub_title' => $request->input('sub_title'),
                'body' => $request->input('body'),
            ]
        );

        return $this->post;
    }

    /**
     * Set the post to be updated.
     *
     * @param Post $post
     * @return $this
     */

    public function setPost(Post $post): self
    {
        $this->post = $post;
        return $this;
    }
}
