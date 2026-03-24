<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Room;

/**
 * Twill uses the Repository Pattern to handle the complexity of its CMS features.
 * It provides a clean and organized way to interact with the database and manage data.
 * 1. Handling Translations use table room_translations
 * 2. Managing Media (Images) - handles the logic of linking that image file to your Room record. It manages the metadata, crops, and ratios you defined in the mediasParams of your Model.
 * 3. Version Control (Revisions) use table room_revisions
 * 4. Clean Controller Logic - the RoomRepository is responsible for handling the logic of the controller. It is responsible for retrieving the data from the database, applying the correct filters, and returning the data to the view.
 */
class RoomRepository extends ModuleRepository
{
    use HandleTranslations, HandleMedias, HandleRevisions;

    public function __construct(Room $model)
    {
        $this->model = $model;
    }
}
