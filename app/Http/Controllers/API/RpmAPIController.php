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
use App\Models\Rpm as RpmModel;
use Utilities\Files\UploadFiles;

class RpmAPIController extends AppBaseController
{
    public function getAllRpms(Request $request, BoatModel $boatModel)
    {
        $id = $request->get("boatId");
        $boat = $boatModel->find($id);
        $rpms = $boat->rpms;
        foreach ($rpms as $rpm) {
            unset( $rpm->updated_at, $rpm->deleted_at, $rpm->created_at);
        }
        return $this->sendResponse(["rpms"=> $rpms]);
    }

    public function createRpm(Request $request, BoatModel $boatModel, RpmModel $rpmModel)
    {
        $data = $request->all();
        $id = $request->get("boatId");
        $data["boat_id"] = $id;
        $rpm = $rpmModel->create($data);
        unset( $rpm->updated_at, $rpm->deleted_at, $rpm->created_at);
        return $this->sendResponse($rpm);
    }
    public function editRpm(Request $request, BoatModel $boatModel, RpmModel $rpmModel)
    {
        $data        = $request->all();
        $id          = $request->get("rpmId");
        $rpm = $rpmModel->find($id);
        $data["boat_id"] = $rpm->boat_id;
        $rpm->update($data);
        unset( $rpm->updated_at, $rpm->deleted_at, $rpm->created_at);
        return $this->sendResponse($rpm);
    }
    public function deleteRpm(Request $request, RpmModel $rpmModel)
    {
        $id  = $request->get("rpmId");
        $rpm = $rpmModel->find($id);
        $rpm->delete();
        return $this->sendResponse(["message" => "deleted"]);
    }
}