<?php

namespace App\Widgets;

use App\Department;
use Arrilot\Widgets\AbstractWidget;

class Departments extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
    ];

    /**
     * The number of seconds before each reload.
     *
     * @var int|float
     */
//    public $reloadTimeout = 10;


    /**
     * Async and reloadable widgets are wrapped in container.
     * You can customize it by overriding this method.
     *
     * @return array
     */
    public function container()
    {
        return [
            'element' => '',
            'attributes' => '',
        ];
    }

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $deparments = Department::all();
        return view('widgets.departments', [
            'config' => $this->config,
            'departments' => $deparments,
        ]);
    }

}
