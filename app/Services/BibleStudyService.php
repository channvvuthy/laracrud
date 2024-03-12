<?php

namespace App\Services;

use App\Models\BibleStudy;
use App\Models\BibleType;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;
use App\Models\BibleStudyLibrary;


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
        return Cache::remember('bible_type_id_' . $type, Date::now()->addMonth(), function () use ($type) {
            $getType = self::getType($type);
            $bibleType = BibleType::where('name', $getType)->first();

            return optional($bibleType)->id;
        });
    }

    /**
     * Retrieve the details of a Bible using the specified ID.
     *
     * @param int $id The ID of the Bible to retrieve
     * @return BibleStudy The details of the Bible
     */
    public static function getBibleDetail($id)
    {
        return Cache::remember('bible_study_' . $id, Date::now()->addMonth(), function () use ($id) {
            return BibleStudy::findOrFail($id);
        });
    }

    /**
     * Retrieves the libraries for a given ID from the cache, and if not found, retrieves and caches the libraries for a Bible study.
     *
     * @param $id The ID for which the libraries are retrieved.
     * @return BibleStudyLibrary The list of libraries for the given ID.
     */
    public static function getLibraries($id)
    {
        return Cache::remember('bible_study_libraries_' . $id, Date::now()->addMonth(), function () use ($id) {
            return BibleStudyLibrary::where('bible_study_id', $id)->get();
        });
    }
}
