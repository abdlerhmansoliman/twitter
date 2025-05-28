<?php

namespace App\Helpers;

use Illuminate\Support\Collection;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;

class PostHelper{
public static function injectIsLiked($posts, $user)
{
    if ($posts instanceof LengthAwarePaginator || $posts instanceof Paginator) {
        $posts->getCollection()->transform(function ($post) use ($user) {
            $post->is_liked = $post->likes->contains('user_id', $user->id);
            return $post;
        });
        return $posts;
    }

    if ($posts instanceof \Illuminate\Support\Collection) {
        return $posts->map(function ($post) use ($user) {
            $post->is_liked = $post->likes->contains('user_id', $user->id);
            return $post;
        });
    }

    $posts->is_liked = $posts->likes->contains('user_id', $user->id);
    return $posts;
}



}