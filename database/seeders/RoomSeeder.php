<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Repositories\RoomRepository;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    protected $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Prepare and Copy Images to Twill Uploads
        $uuid1 = Str::uuid();
        $uuid2 = Str::uuid();

        // use those images as demo images for room
        $filename1 = 'room-example-1.jpg';
        $filename2 = 'room-example-2.jpg';

        // 1.1 Create directories for images
        $destDir1 = storage_path('app/public/uploads/' . $uuid1);
        $destDir2 = storage_path('app/public/uploads/' . $uuid2);

        if (!File::exists($destDir1)) File::makeDirectory($destDir1, 0755, true);
        if (!File::exists($destDir2)) File::makeDirectory($destDir2, 0755, true);

        // 1.2 Copy images to directories
        File::copy(resource_path('images/' . $filename1), $destDir1 . '/' . $filename1);
        File::copy(resource_path('images/' . $filename2), $destDir2 . '/' . $filename2);

        // 2. Create Media records with uuid including filename for Glide
        $media1Id = DB::table('twill_medias')->insertGetId([
            'uuid' => $uuid1 . '/' . $filename1,
            'filename' => $filename1,
            'width' => 1920,
            'height' => 1080,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $media2Id = DB::table('twill_medias')->insertGetId([
            'uuid' => $uuid2 . '/' . $filename2,
            'filename' => $filename2,
            'width' => 1920,
            'height' => 1080,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Prepare Room Data

        // 3.1 Prepare Room Data for Room 1
        $room1Data = [
            'published' => true,
            'languages' => [
                [
                    'value' => 'en',
                    'published' => true,
                ],
                [
                    'value' => 'sl',
                    'published' => true,
                ],
            ],
            'title' => [
                'en' => 'Luxury Ocean Suite',
                'sl' => 'Luksuzni apartma ob oceanu',
            ],
            'description' => [
                'en' => 'A beautiful suite with ocean views and premium amenities.',
                'sl' => 'Čudovit apartma s pogledom na ocean in vrhunsko opremo.',
            ],
            'medias' => [
                'cover' => [
                    [
                        'id' => $media1Id,
                        'crop' => 'default',
                    ],
                ],
            ],
        ];

        // 3.2 Prepare Room Data for Room 2
        $room2Data = [
            'published' => true,
            'languages' => [
                [
                    'value' => 'en',
                    'published' => true,
                ],
                [
                    'value' => 'sl',
                    'published' => true,
                ],
            ],
            'title' => [
                'en' => 'Standard City Room',
                'sl' => 'Standardna mestna soba',
            ],
            'description' => [
                'en' => 'Comfortable room in the heart of the city, perfect for business or leisure.',
                'sl' => 'Udobna soba v srcu mesta, primerna za poslovneže ali turiste.',
            ],
            'medias' => [
                'cover' => [
                    [
                        'id' => $media2Id,
                        'crop' => 'default',
                    ],
                ],
            ],
        ];

        // 4. Use Repository to create rooms (this handles rooms, room_translations, room_revisions, twill_mediables)
        $this->roomRepository->create($room1Data);
        $this->roomRepository->create($room2Data);
    }
}
