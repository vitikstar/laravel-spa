<?php
namespace App\Listeners;

use App\Events\CommentCreated;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdminOnComment implements ShouldQueue
{
    public function handle(CommentCreated $event)
    {
        // Логіка сповіщення адміністратора про новий коментар
    }
}
?>
