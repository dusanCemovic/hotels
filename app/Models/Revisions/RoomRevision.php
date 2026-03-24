<?php

namespace App\Models\Revisions;

use A17\Twill\Models\Revision;

/**
 * This table acts as a "history" or "version control" for your rooms.
 * Every time an admin saves a room in the CMS, Twill creates a new entry in this table with a snapshot of the data.
 */
class RoomRevision extends Revision
{
    protected $table = "room_revisions";
}
