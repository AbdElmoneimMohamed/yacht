<?php

namespace App\Http\Controllers\API;

use App\Jobs\SendReminderEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User as UserModel;
use App\Http\Requests\UserRequest;
use Validator;
use App\Models\User;
use App\Models\Trip as TripModel;
use App\Models\Boat as BoatModel;
use Utilities\Files\UploadFiles;

class TripAPIController extends AppBaseController
{

    public function getAllTrips(Request $request, BoatModel $boatModel, TripModel $tripModel)
    {
        $user = Auth::guard('api')->user();
        $trips  = $tripModel->getTrips($user, $request);
        foreach ($trips as $trip) {
            $trip["boatId"] = "$trip->boat_id";
            $trip["boatName"] = $trip->boat->name;
            $trip["boatType"] = $trip->boat->type;
            $trip["boatType"] = $trip->boat->type;
            $trip["missedRpms"] = $trip->boat->rpms;

            $stages = $trip->stages;
            unset($trip["boat"], $trip->updated_at, $trip->deleted_at, $trip->created_at);

            foreach ($stages as $stage) {
                unset($stage->updated_at, $stage->deleted_at, $stage->created_at);
            }
        }
        $response["trips"] = $trips;
        return $this->sendResponse($response);
    }

    public function createTrip(Request $request, TripModel $tripModel, BoatModel $boatModel)
    {
        $user            = Auth::guard('api')->user();
        $data            = $request->all();
        $data["boat_id"] = $data["boatId"];
        $trip            = $tripModel->create($data);
        $trip["boatId"]  = $data["boat_id"];
        $tripModel->saveStages($trip, $request);
        $stages          = $trip->stages;
        $boat            = $boatModel->find($data["boat_id"]);
        $newTankSize = $boat->tankSize - $trip->liters;
        $boat->update(["tankSize" => $newTankSize]);
        unset($trip->updated_at, $trip->deleted_at, $trip->created_at);

        foreach ($stages as $stage) {
            unset($stage->updated_at, $stage->deleted_at, $stage->created_at);
        }
        return $this->sendResponse($trip);

    }

    public function editTrip(Request $request, TripModel $tripModel)
    {
        $data    = $request->all();
        $trip_id = $request->get("tripId");
        $trip    = $tripModel->find($trip_id);
        $data["boat_id"] = $data["boatId"];
        $trip->update($data);
        $stages = $request->get("stages");
        if(isset($stages) && count($stages) != 0) {
            $trip->stages()->delete();
            $tripModel->saveStages($trip, $request);
        }
        $trip["boatId"] = "$trip->boat_id";
        $stages = $trip->stages;
        unset($trip->updated_at, $trip->deleted_at, $trip->created_at);

        foreach ($stages as $stage) {
            unset($stage->updated_at, $stage->deleted_at, $stage->created_at);
        }
        return $this->sendResponse($trip);
    }


    public function deleteTrip(Request $request, TripModel $tripModel, BoatModel $boatModel)
    {
        $trip_id = $request->get("tripId");
        $trip = $tripModel->find($trip_id);
        $boat        = $boatModel->find($trip->boat_id);
        $newTankSize = $boat->tankSize + $trip->liters;
        $boat->update(["tankSize" => $newTankSize]);
        $trip->delete();
        $trip->stages()->delete();
        return $this->sendResponse(["message" => "deleted"]);
    }

    public function getTrip(Request $request, TripModel $tripModel)
    {
        $trip_id = $request->get("tripId");
        $trip    = $tripModel->find($trip_id);
        $trip["boatId"] = "$trip->boat_id";
        $stages  = $trip->stages;
        unset($trip->updated_at, $trip->deleted_at, $trip->created_at);
        foreach ($stages as $stage) {
            unset($stage->updated_at, $stage->deleted_at, $stage->created_at);
        }
        return $this->sendResponse($trip);

    }
}