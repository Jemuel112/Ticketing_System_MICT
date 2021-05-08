<?php

namespace App\Widgets;

use App\mTicket;
use App\Department;
use App\Endorsement;
use App\EndorsementSeen;
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
		
		
		        $user = Auth::user()->id;
        $dept = Department::select('id')->where('dept_name', Auth::user()->department)->first();
        $endors = Endorsement::all();
        $endorsements = null;
        $read = 0;
        $unread = 0;
        foreach ($endors as $endor) {
            $assign = explode(', ', $endor->assigned_to_id);
            $depts = explode(', ', $endor->assigned_dept_id);
            if ($user != null && in_array($user, $assign)) {
                $endorsements[] = $endor;
            }
            if ($dept != null && in_array($dept->id, $depts)) {
                $endorsements[] = $endor;
            }
        }
        if (!is_null($endorsements)) {
            $seens = EndorsementSeen::Where('seen_id', $user)->get()->pluck('endorsement_id')->toArray();
            foreach ($endorsements as $endorsement) {
                $seen = explode(', ', $endorsement->seen_by);
                if (in_array($endorsement->id, $seens)) {
                    $read++;
                } else {
                    $unread++;
                }
            }
        }

        return view('widgets.sound_notification', [
            'config' => $this->config,
            'notify' => $notify,
            'myActive' => $myActive,
			'unread' => $unread
        ]);
    }
}
