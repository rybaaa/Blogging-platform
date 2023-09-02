<?php

namespace App\Notifications;

use App\Models\Article;

class TwitterNotifier implements NotificationChannel
{
    public function notifyAbout(Article $article)
    {
        //post request to twitter api with body "Check out this cool new article! $article->title"
        return "Check out this cool new article! $article->title";
    }
}
