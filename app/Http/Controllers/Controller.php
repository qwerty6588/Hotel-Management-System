<?php

namespace App\Http\Controllers;

use App\Events\TelegramNotificationEvent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Throwable;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function storeData(callable $func, string $redirectUrl, $data = null)
    {
        try {
            call_user_func($func);

            if (is_null($data)) {
                $data = ['success' => 'Operation successfully ended'];
            }
            return redirect($redirectUrl)->with($data);
        } catch (Throwable $t) {
            TelegramNotificationEvent::dispatch($t);
            return redirect()->back()->with([
                'error' => $t->getMessage()
            ])->withInput(request()->all());
        }
    }
}
