<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Request;
use Telegram\Bot\Api;
use Carbon\Carbon;

class SendTelegramNotification
{
    protected $telegram;

    public function __construct()
    {
        $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
    }

    public function handle($event)
    {
        $user = $event->user;
        $ip = Request::ip();
        $time = Carbon::now()->format('d/m/y H:i:s');
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'N/A';
        $text = '';

        if ($event instanceof Registered) {
            $text = "🆕 *Новая регистрация*\n"
                . "👤 *Имя:* `{$user->name}`\n"
                . "📧 *Email:* `{$user->email}`\n"
                . "📍 *IP:* `{$ip}`\n"
                . "⏰ *Время:* `{$time}`";
        } elseif ($event instanceof Login) {
            $text = "✅ *Log in to the system*\n"
                . "👤 *Name:* `{$user->name}`\n"
                . "📧 *Email:* `{$user->email}`\n"
                . "📍 *IP:* `{$ip}`\n"
                . "⏰ *Time:* `{$time}`\n"
                . "👂 *User Agent:* `{$userAgent}`\n";
        }

        if ($text) {
            $this->telegram->sendMessage([
                'chat_id' => env('TELEGRAM_CHAT_ID'),
                'text' => $text,
                'parse_mode' => 'Markdown',
            ]);
        }
    }
}
