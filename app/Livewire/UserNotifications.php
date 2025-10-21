<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\View\View;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UserNotifications extends Component
{
    use WithPagination;

    /**
     * The component's listeners.
     *
     * @var array
     */
    protected $listeners = [
        'refresh-notifications' => '$refresh',
    ];

    /**
     * The component's state.
     *
     * @var DatabaseNotification
     */
    public $state;

    /**
     * The component for showing notifications.
     *
     * @var bool
     */
    public $notificationsManager = false;

    /**
     * Handeling listener togle notifications.
     *
     * @param bool $value
     */
    public function handleNotificationsToggle(bool $value = false): void
    {
        $this->notificationsManager = $value;
    }

    /**
     * Read specific notification and mark the notification as read.
     *
     * @param DatabaseNotification $notification
     */
    public function readNotification(DatabaseNotification $notification): void
    {
        $notification->markAsRead();
        $this->state = [];//$notification;
        $this->showNotification($notification);
    }

    public function showNotification(DatabaseNotification $notification)
    {
        $nId = $notification->data['event']['id'];

        switch ($notification->type) {
            case 'Zaimea\Notifications\Calendar\DeleteEvent':
                return $this->toCalendarEvent($nId);
            case 'Zaimea\Notifications\Calendar\DropEvent':
                return $this->toCalendarEvent($nId);
            case 'Zaimea\Notifications\Calendar\NewEvent':
                return $this->toCalendarEvent($nId);
            case 'Zaimea\Notifications\Calendar\UnscheduleEvent':
                return $this->toCalendarEvent($nId);
            case 'Zaimea\Notifications\Calendar\UpdateEvent':
                return $this->toCalendarEvent($nId);
            default:
                return false;
        }
    }

    private function toCalendarEvent($eventId)
    {
        session()->flash('notificationRecord', $eventId);
        redirect()->route('group.records', ['group' => $this->user->currentGroup->id]);
    }

    /**
     * Mark all user notifications as read.
     */
    public function markAllAsRead(): void
    {
        $this->user->unreadNotifications->markAsRead();
        $this->dispatch('refresh-notifications');
    }

    /**
     * Mark user notification as read. not used
     *
     * @param DatabaseNotification $notification
     */
    public function markAsRead(DatabaseNotification $notification): void
    {
        $notification->markAsRead();
        $this->state = [];
        $this->dispatch('refresh-notifications');
    }

    /**
     * Delete user all readed notifications.
     *
     * @param DatabaseNotification $notification
     */
    public function deleteReadNotifications(DatabaseNotification $notification): void
    {
        $this->user->notifications()->whereNotNull('read_at')->delete();
        $this->state = [];
        $this->dispatch('refresh-notifications');
    }

    /**
     * Delete user notification.
     *
     * @param DatabaseNotification $notification
     */
    public function deleteNotification(DatabaseNotification $notification): void
    {
        $this->user->notifications()->where('id', $notification->id)->delete();
        $this->state = [];
        $this->dispatch('refresh-notifications');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render(): View
	{
		return view('partials.user-notifications', [
            'userNotifications' => $this->user->notifications()->paginate(10),
        ]);
	}

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty(): Authenticatable
    {
        return Auth::user();
    }
}
