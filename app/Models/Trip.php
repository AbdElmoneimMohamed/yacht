<?php

namespace App\Models;

use App\Entities\Stage;
use App\Entities\Trip as TripEntity;
use App\Entities\Engine;
use App\Entities\Image;
use App\Entities\Maintenance;
use Utilities\Files\UploadFiles;
use App\Models\Rpm;
use Carbon\Carbon;

class Trip extends TripEntity
{
    public function saveStages($trip, $request)
    {
        $stages = $request->get("stages");
        foreach ($stages as $stage) {
            $stage["trip_id"] = $trip->id;
            Stage::create($stage);
        }
    }

    public function getTrips($user, $request)
    {
        $now = Carbon::now();
        $date = $now->copy()->toDateString();
        $trips = [];
        if ($request->get("status") == TripEntity::STATUS_OLD) {
            $trips = \App\Entities\Trip::where('creationDate', "<", $date)
                ->whereHas('boat', function($q) use($user){
                    $q->where('user_id', '=', $user->id);
                })->get();
        } else if ($request->get("status") == TripEntity::STATUS_NEW) {
            $trips = \App\Entities\Trip::where('creationDate', ">=", $date)
                ->whereHas('boat', function ($q) use ($user) {
                    $q->where('user_id', '=', $user->id);
                })->get();
        }
         return $trips;
    }
}
