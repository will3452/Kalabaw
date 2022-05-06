<?php

namespace Modules\MapTag\Entities\Traits;

use Modules\MapTag\Entities\MapTag;

trait MapTagTrait
{
    public function mapTag()
    {
        return $this->morphOne(MapTag::class, 'model');
    }
}
