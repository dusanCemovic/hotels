<?php

namespace App\Models\Translations;

use A17\Twill\Models\Model;
use App\Models\Room;

/**
 * This table is used to store all content that needs to be available in multiple languages.
 * It handles dynamic translations of your content.
 */
class RoomTranslation extends Model
{
    protected $baseModuleModel = Room::class;
}
