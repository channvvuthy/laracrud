<?php

namespace App\Services;

use App\Models\BibleStudy;
use App\Models\BibleType;

class BibleStudyService
{
    public static function getBibleStudies($type, $limit = 4)
    {
        $getTypeId = self::getIdOfType($type);
        
        return BibleStudy::where('type', $getTypeId)
            ->limit($limit)
            ->get();
    }


    /**
     * Get the type based on the input.
     *
     * @param $type description
     */
    public static function getType($type)
    {
        if ($type === 'bible-video') {
            return 'video';
        }
        return 'document';
    }

    /**
     * Get the ID of the specified type.
     *
     * @param mixed $type 
     * @return int|null 
     */
    public static function getIdOfType($type)
    {
        $getType = self::getType($type);
        $bibleType = BibleType::where('name', $getType)->first();
        if ($bibleType) {
            return $bibleType->id;
        }
        return null;
    }
}
