<?php
namespace App\Listeners;

use App\Events\CommentCreated;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdminOnUser implements ShouldQueue
{
    public function handle(CommentCreated $event)
    {
        // Логіка сповіщення адміністратора про новий коментар
    }
}
?>
