<?php

namespace App\Widgets;
use App\User;
//use App\Department;
use Arrilot\Widgets\AbstractWidget;

class Users extends AbstractWidget
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
    public $reloadTimeout = 2;

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $users = User::all();
//        $departments = Department::all();
        return view('widgets.users', [
            'config' => $this->config,
            'users' => $users,
//            'departments' => $departments,
        ]);
    }
}
