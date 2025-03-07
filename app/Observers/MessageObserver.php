<?php

namespace App\Observers;

use App\Models\BuildingAdminTenant;
use App\Models\Message;
use App\Models\Notification;
use App\Models\NotificationMaster;
use App\Models\Security_Master;
use App\Models\User; // Assuming User model exists for tenant/security
use Illuminate\Support\Facades\Auth;

class MessageObserver
{
    /**
     * Handle the Message "created" event.
     */
    public function created(Message $message): void
    {
          $notificationTemplate = NotificationMaster::where('id',1)->first();

          if (!$notificationTemplate) {
              return;
          }

          $sender_name = $this->getUserDataBasedOnType($message->sender_type, $message->sender_id);
        //   $sender_name = $sender ? $sender->name : 'Unknown';

          $notificationMessage = str_replace('{$sender_name}', $sender_name, $notificationTemplate->message_template);

          Notification::create([
              'notification_master_id' => $notificationTemplate->id,
              'for_user_id' => $message->receiver_id,
              'for_building_type' => 1,
              'for_user_type' => $message->receiver_type,
              'variable_data' => ['sender_name' => $sender_name],
              'is_read' => 0,
          ]);
    }

    public function getUserDataBasedOnType($type, $id)
    {

        $user = null;
        $name = 'Unknown';
        if ($type == Message::SENDER_TYPES['tenant']) {
            $user = BuildingAdminTenant::find($id);
            $name = $user->contact_person;
        } else if ($type == Message::SENDER_TYPES['security']) {
            $user = Security_Master::find($id);
            $name = $user->name;
        }

        return $name;
    }

    /**
     * Handle the Message "updated" event.
     */
    public function updated(Message $message): void
    {
        //
    }

    /**
     * Handle the Message "deleted" event.
     */
    public function deleted(Message $message): void
    {
        //
    }

    /**
     * Handle the Message "restored" event.
     */
    public function restored(Message $message): void
    {
        //
    }

    /**
     * Handle the Message "force deleted" event.
     */
    public function forceDeleted(Message $message): void
    {
        //
    }
}