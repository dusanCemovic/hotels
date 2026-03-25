<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * This is the main model for your rooms. It is Twill model.
 * It has translations, revisions, media, etc.
 */
class Room extends Model implements Sortable
{
    use HasTranslation, HasMedias, HasRevisions, HasPosition;

    protected $fillable = [
        'published',    // From the main 'rooms' table
        'position',     // From the main 'rooms' table (for sorting)
        'title',        // Passed to the translation system
        'description',  // Passed to the translation system
    ];

    // These are the specific fields that Twill will store in 'room_translations'
    public $translatedAttributes = [
        'title',
        'description',
    ];

    public $mediasParams = [
        'cover' => [
            'default' => [
                [
                    'name' => 'default',
                    'ratio' => 16 / 9,
                ],
            ],
            'mobile' => [
                [
                    'name' => 'mobile',
                    'ratio' => 1,
                ],
            ],
        ],
    ];


    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    // revisions and translations are enabled by default and inherit by twill model

}
