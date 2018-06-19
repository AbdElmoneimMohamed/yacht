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
use App\Models\Maintenance as MaintenanceModel;
use Utilities\Files\UploadFiles;

class MaintenanceAPIController extends AppBaseController
{
    public function getAllMaintenances(Request $request, BoatModel $boatModel)
    {
        $id   = $request->get("boatId");
        $boat = $boatModel->find($id);
        $now  = \Carbon\Carbon::today();
        $maintenances = $boat->maintenances()->where('date', ">=", $now)->get();
        foreach ($maintenances as $maintenance) {
            unset( $maintenance->updated_at, $maintenance->deleted_at, $maintenance->created_at);
        }
        return $this->sendResponse(["maintenances" => $maintenances]);
    }

    public function createMaintenance(Request $request, BoatModel $boatModel, MaintenanceModel $maintenanceModel)
    {
        $data = $request->all();
        $id = $request->get("boatId");
        $data["boat_id"] = $id;
        $maintenance = $maintenanceModel->create($data);
        unset( $maintenance->updated_at, $maintenance->deleted_at, $maintenance->created_at);
        return $this->sendResponse($maintenance);
    }
    public function editMaintenance(Request $request, BoatModel $boatModel, MaintenanceModel $maintenanceModel)
    {
        $data        = $request->all();
        $id          = $request->get("maintenanceId");
        $maintenance = $maintenanceModel->find($id);
        $data["boat_id"] = $maintenance->boat_id;
        $maintenance->update($data);
        unset( $maintenance->updated_at, $maintenance->deleted_at, $maintenance->created_at);
        return $this->sendResponse($maintenance);
    }
    public function deleteMaintenance(Request $request, MaintenanceModel $maintenanceModel)
    {
        $id          = $request->get("maintenanceId");
        $maintenance = $maintenanceModel->find($id);
        $maintenance->delete();
        return $this->sendResponse(["message" => "deleted"]);
    }
}