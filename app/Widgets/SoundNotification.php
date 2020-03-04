<?php

namespace App\Widgets;

use App\mTicket;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Auth;

class SoundNotification extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * The number of seconds before each reload.
     *
     * @var int|float
     */
    public $reloadTimeout = 5;

    /**
     * Async and reloadable widgets are wrapped in container.
     * You can customize it by overriding this method.
     *
     * @return array
     */
    public function container()
    {
        return [
            'element'       => 'span',
            'attributes'    => '',
        ];
    }

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $notify = mTicket::where('is_new', 1)->count();
        $myActive = mTicket::where([['assigned_to', 'Like', '%' . Auth::user()->fname . '%']])->where([['status', '=', 'Active']])->count();
        return view('widgets.sound_notification', [
            'config' => $this->config,
            'notify' => $notify,
            'myActive' => $myActive,
        ]);
    }
}
