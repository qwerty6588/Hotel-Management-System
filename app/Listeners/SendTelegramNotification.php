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
        $time = Carbon::now()->format('Y-m-d H:i:s');
        $text = '';

        if ($event instanceof Registered) {
            $text = "🆕 *Новая регистрация*\n"
                . "👤 *Имя:* `{$user->name}`\n"
                . "📧 *Email:* `{$user->email}`\n"
                . "📍 *IP:* `{$ip}`\n"
                . "⏰ *Время:* `{$time}`";
        } elseif ($event instanceof Login) {
            $text = "✅ *Вход в систему*\n"
                . "👤 *Имя:* `{$user->name}`\n"
                . "📧 *Email:* `{$user->email}`\n"
                . "📍 *IP:* `{$ip}`\n"
                . "⏰ *Время:* `{$time}`";
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
