<?php

namespace App\Http\Controllers\API;

use App\Jobs\SendReminderEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User as UserModel;
use App\Http\Requests\UserRequest;
use Validator;
use App\Models\Boat as BoatModel;
use App\Models\Engine as EngineModel;
use Utilities\Files\UploadFiles;

class EngineAPIController extends AppBaseController
{
    public function getAllEngines(Request $request, BoatModel $boatModel)
    {
        $id = $request->get("boatId");
        $boat = $boatModel->find($id);
        $engines = $boat->engines;
        foreach ($engines as $engine) {
            unset( $engine->updated_at, $engine->deleted_at, $engine->created_at);
        }
        return $this->sendResponse(["engines" => $engines]);
    }

    public function createEngine(Request $request, BoatModel $boatModel, EngineModel $engineModel)
    {
        $data = $request->all();
        $id = $request->get("boatId");
        $data["boat_id"] = $id;
        $engine = $engineModel->create($data);
        unset( $engine->updated_at, $engine->deleted_at, $engine->created_at);
        return $this->sendResponse($engine);
    }
    public function editEngine(Request $request, BoatModel $boatModel, EngineModel $engineModel)
    {
        $data        = $request->all();
        $id          = $request->get("engineId");
        $engine = $engineModel->find($id);
        $data["boat_id"] = $engine->boat_id;
        $engine->update($data);
        unset( $engine->updated_at, $engine->deleted_at, $engine->created_at);
        return $this->sendResponse($engine);
    }
    public function deleteEngine(Request $request, EngineModel $engineModel)
    {
        $id     = $request->get("engineId");
        $engine = $engineModel->find($id);
        $engine->delete();
        return $this->sendResponse(["message" => "deleted"]);
    }
}