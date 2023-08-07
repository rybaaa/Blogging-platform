<?php

namespace App\Notifications;

use App\Models\Article;

class ModeratorNotifier implements NotificationChannel
{
    public function notifyAbout(Article $article)
    {
        /*
        $moderators = Moderators::all();

        foreach($moderators as $moderator){
            UserNotification::create([
                'message' => $author->name . " posted new article: " . $article->title;
            ])
        }
        */
        return $article->author->name . " posted new article: " . $article->title;
    }
}
