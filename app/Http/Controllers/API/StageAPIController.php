<?php

namespace App\Http\Controllers\API;

use App\Jobs\SendReminderEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User as UserModel;
use App\Http\Requests\UserRequest;
use Validator;
use App\Models\Trip as TripModel;
use App\Models\Stage as StageModel;
use Utilities\Files\UploadFiles;

class StageAPIController extends AppBaseController
{
    public function getAllStages(Request $request, TripModel $tripModel)
    {
        $id = $request->get("tripId");
        $trip = $tripModel->find($id);
        $stages = $trip->stages;
        foreach ($stages as $stage) {
            unset( $stage->updated_at, $stage->deleted_at, $stage->created_at);
        }
        return $this->sendResponse(["stages" => $stages]);
    }

    public function createStage(Request $request, TripModel $tripModel, StageModel $stageModel)
    {
        $data = $request->all();
        $id = $request->get("tripId");
        $data["trip_id"] = $id;
        $stage = $stageModel->create($data);
        unset( $stage->updated_at, $stage->deleted_at, $stage->created_at);
        return $this->sendResponse($stage);
    }

    public function editStage(Request $request, TripModel $tripModel, StageModel $stageModel)
    {
        $data        = $request->all();
        $id          = $request->get("stageId");
        $stage = $stageModel->find($id);
        $data["trip_id"] = $stage->trip_id;
        $stage->update($data);
        unset( $stage->updated_at, $stage->deleted_at, $stage->created_at);
        return $this->sendResponse($stage);
    }
    public function deleteStage(Request $request, StageModel $stageModel)
    {
        $id    = $request->get("stageId");
        $stage = $stageModel->find($id);
        $stage->delete();
        return $this->sendResponse(["message" => "deleted"]);
    }
}