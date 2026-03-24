<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Room;

class RoomRepository extends ModuleRepository
{
    use HandleTranslations, HandleMedias, HandleRevisions;

    public function __construct(Room $model)
    {
        $this->model = $model;
    }
}
