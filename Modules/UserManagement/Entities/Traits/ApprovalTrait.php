<?php

namespace Modules\UserManagement\Entities\Traits;

trait ApprovalTrait{
    public function wasApproved(): bool
    {
        return ! is_null($this->approved_at);
    }

    public function markApprove()
    {
        if ($this->wasApproved()) {
            return "$this->first_name is already approved!"; // just check if the user is already approved
        }
        $this->update(['approved_at' => now()]);
        return null;
    }

    public function markUnApprove()
    {
        $this->update(['approved_at' => null]);
    }
}
