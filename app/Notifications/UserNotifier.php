<?php

namespace App\Notifications;

use App\Models\Article;

class UserNotifier implements NotificationChannel
{
    public function notifyAbout(Article $article)
    {
        /*
        $author = $article->author;
        $followers = $author->followers;

        foreach($followers as $follower){
            UserNotification::create([
                'message' => $author->name . " posted new article: " . $article->title;
            ])
        }
        */
        return $article->author->name . " posted new article: " . $article->title;
    }
}
