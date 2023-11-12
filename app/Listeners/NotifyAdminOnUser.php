<?php
namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdminOnUser implements ShouldQueue
{
    public function handle(UserCreated $event)
    {
        // Логіка сповіщення адміністратора про новий коментар
    }
}
