<?php

namespace App\Comment;

use Illuminate\Support\ServiceProvider;

class CommentProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([
            \App\Comment\Commands\HandlerCommentEvent::class,
        ]);
    }
}
