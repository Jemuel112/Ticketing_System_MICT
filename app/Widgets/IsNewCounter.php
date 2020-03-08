<?php

namespace App\Widgets;

use App\mTicket;
use Arrilot\Widgets\AbstractWidget;

class IsNewCounter extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

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
     * The number of seconds before each reload.
     * False means no reload at all.
     *
     * @var int|float|bool
     */
    public $reloadTimeout = true;

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $new = mTicket::where('is_new',True)->count();
        return view('widgets.is_new_counter', [
            'config' => $this->config,
            'new' => $new,
        ]);
    }
}
