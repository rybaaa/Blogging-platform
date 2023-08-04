<?php

namespace App\Notifications;

use App\Models\Article;

interface NotificationChannel
{
    public function notifyAbout(Article $article);
}
