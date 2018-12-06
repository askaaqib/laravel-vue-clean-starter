<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Tag;
use App\Models\User;
use App\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BlogController extends FrontendController
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Repositories\Contracts\PostRepository $posts
     */
    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        return view('frontend.blog.index')->withPosts(
        );
    }

    public function tag(Tag $tag)
    {
        $this->setTranslatable($tag);

        return view('frontend.blog.tag')->withTag($tag)->withPosts(
        );
    }

    public function owner(User $user)
    {
        $this->setLocalesAttributes(['user' => $user->slug]);

        return view('frontend.blog.owner')
            ->withUser($user)
    }

    public function show(Post $post, Request $request)
    {
        // If not published, only user with edit access can see it
        if (! $post->published && ! Gate::check('update', $post)) {
            abort(404);
        }

        SEOMeta::setTitle($post->meta_title);
        SEOMeta::setDescription($post->meta_description);

        $this->setTranslatable($post);

        return view('frontend.blog.show')->withPost($post);
    }
}
