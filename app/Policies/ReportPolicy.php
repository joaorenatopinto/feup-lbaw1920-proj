<?php

namespace App\Policies;

use App\Report;
use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ReportPolicy
{
    use HandlesAuthorization;

    /**
     * The user is a moderator
     * The report is open
     */
    public function close(User $mod, Report $report) {
        return $mod->getLastStatus()->status = 'moderator' && $report->getLastStatus()->type != 'closed';
    }

    /**
     * The user is a moderator
     * The report is closed
     */
    public function reopen(User $mod, Report $report) {
        return $mod->getLastStatus()->status = 'moderator' && $report->getLastStatus()->type == 'closed';
    }
}
 