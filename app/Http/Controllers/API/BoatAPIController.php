<?php

namespace App\Http\Controllers\API;

use App\Entities\Notification;
use App\Jobs\SendReminderEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User as UserModel;
use App\Http\Requests\UserRequest;
use Validator;
use App\Models\User;
use App\Models\Boat as BoatModel;
use Utilities\Files\UploadFiles;
use Carbon\Carbon;
use PushNotification;

class BoatAPIController extends AppBaseController
{
    public function getAllBoats()
    {
        $user  = Auth::guard('api')->user();
        $boats = $user->boats()->orderBy('created_at', 'desc')->get();
        $now  = \Carbon\Carbon::today();
        foreach ($boats as $boat) {
            $images       = $boat->images;
            $engnies      = $boat->engines;
            $maintenances = $boat->maintenances()->where('date', ">=", $now)->get();
            $rpms         = $boat->rpms;
            $boat["tripsCount"] = count($boat->trips);
            $boat["maintenances"] = $maintenances;
            // for drawing json response
            unset($boat->user_id, $boat->updated_at, $boat->deleted_at, $boat->created_at);

            foreach ($images as $image) {
                unset($image->updated_at, $image->deleted_at, $image->created_at);
            }
            foreach ($engnies as $engnie) {
                unset($engnie->updated_at, $engnie->deleted_at, $engnie->created_at);
            }
            foreach ($maintenances as $maintenance) {
                unset( $maintenance->updated_at, $maintenance->deleted_at, $maintenance->created_at);
            }
            foreach ($rpms as $rpm) {
                unset($rpm->updated_at, $rpm->deleted_at, $rpm->created_at);
            }
        }

        $response["boats"] = $boats;

        return $this->sendResponse($response);
    }

    public function createBoat(Request $request, BoatModel $boatModel)
    {
        $user            = Auth::guard('api')->user();
        $data            = $request->all();
        $data["user_id"] = $user->id;
        $boatName        = $boatModel->where("user_id", $user->id)->where("name",$request->get("name"))->get();
        if (count($boatName) != 0) {
            return $this->sendErrorMessage('The name has already been taken');
        }
        $boat = $boatModel->create($data);
        $boatModel->saveRpms($boat, $request);
        $boatModel->saveMaintenances($boat, $request);
        $boatModel->saveEngines($boat, $request);
        $boatModel->saveImages($boat, $request);

        $images       = $boat->images;
        $engnies      = $boat->engines;
        $maintenances = $boat->maintenances;
        $rpms         = $boat->rpms;

        // for drawing json response
        unset($boat->user_id, $boat->updated_at, $boat->deleted_at, $boat->created_at);

        foreach ($images as $image) {
            unset( $image->updated_at, $image->deleted_at, $image->created_at);
        }
        foreach ($engnies as $engnie) {
            unset($engnie->updated_at, $engnie->deleted_at, $engnie->created_at);
        }
        foreach ($maintenances as $maintenance) {
            unset( $maintenance->updated_at, $maintenance->deleted_at, $maintenance->created_at);
        }
        foreach ($rpms as $rpm) {
            unset( $rpm->updated_at, $rpm->deleted_at, $rpm->created_at);
        }
        return $this->sendResponse($boat);

    }

    public function editBoat(Request $request, BoatModel $boatModel)
    {
        $data     = $request->all();
        $boat_id  = $request->get("boatId");
        $boat     = $boatModel->find($boat_id);
        if ($data["name"] != $boat->name) {
            $boatName = $boatModel->where("user_id", $boat->user_id)->where("name",$request->get("name"))->get();
            if (count($boatName) != 0) {
                return $this->sendErrorMessage('The name has already been taken');
            }
        }
        $boat->update($data);

        $images       = $request->get("images");
        $engines      = $request->get("engines");
        $maintenances = $request->get("maintenance");
        $rpms         = $request->get("missedRPMS");

        if(isset($images) && count($images) != 0) {
            $boat->images()->delete();
            $boatModel->saveImages($boat, $request);
        }
        if(isset($engines) && count($engines) != 0) {
            $boat->engines()->delete();
            $boatModel->saveEngines($boat, $request);
        }
        if(isset($maintenances) && count($maintenances) != 0) {
            $boat->maintenances()->delete();
            $boatModel->saveMaintenances($boat, $request);
        }
        if(isset($rpms) && count($rpms) != 0) {
            $boat->rpms()->delete();
            $boatModel->saveRpms($boat, $request);
        }

        $images       = $boat->images;
        $engnies      = $boat->engines;
        $maintenances = $boat->maintenances;
        $rpms         = $boat->rpms;

        // for drawing json response

        unset($boat->user_id, $boat->updated_at, $boat->deleted_at, $boat->created_at);

        foreach ($images as $image) {
            unset( $image->updated_at, $image->deleted_at, $image->created_at);
        }
        foreach ($engnies as $engnie) {
            unset($engnie->updated_at, $engnie->deleted_at, $engnie->created_at);
        }
        foreach ($maintenances as $maintenance) {
            unset( $maintenance->updated_at, $maintenance->deleted_at, $maintenance->created_at);
        }
        foreach ($rpms as $rpm) {
            unset( $rpm->updated_at, $rpm->deleted_at, $rpm->created_at);
        }

        return $this->sendResponse($boat);
    }


    public function deleteBoat(Request $request, BoatModel $boatModel)
    {
        $boat_id = $request->get("boatId");
        $boat    = $boatModel->find($boat_id);
        $boat->delete();
        $boat->images()->delete();
        $boat->engines()->delete();
        $boat->maintenances()->delete();
        $boat->trips()->delete();
        $boat->rpms()->delete();

        return $this->sendResponse(["message" => "deleted"]);
    }

    public function getBoat(Request $request, BoatModel $boatModel)
    {
        $boat_id      = $request->get("boatId");
        $boat         = $boatModel->find($boat_id);
        $images       = $boat->images;
        $engnies      = $boat->engines;
        $maintenances = $boat->maintenances;
        $rpms         = $boat->rpms;
        $boat["tripsCount"] = count($boat->trips);
        // for drawing json response
        unset($boat->user_id, $boat->updated_at, $boat->deleted_at, $boat->created_at);

        foreach ($images as $image) {
            unset( $image->updated_at, $image->deleted_at, $image->created_at);
        }
        foreach ($engnies as $engnie) {
            unset( $engnie->updated_at, $engnie->deleted_at, $engnie->created_at);
        }
        foreach ($maintenances as $maintenance) {
            unset( $maintenance->updated_at, $maintenance->deleted_at, $maintenance->created_at);
        }
        foreach ($rpms as $rpm) {
            unset($rpm->updated_at, $rpm->deleted_at, $rpm->created_at);
        }

        return $this->sendResponse($boat);
    }

    public function getImages(Request $request, BoatModel $boatModel)
    {
        $boat_id      = $request->get("boatId");
        $boat         = $boatModel->find($boat_id);
        $images       = $boat->images;

        // for drawing json response
        unset($boat->user_id, $boat->updated_at, $boat->deleted_at, $boat->created_at);

        foreach ($images as $image) {
            unset( $image->updated_at, $image->deleted_at, $image->created_at);
        }

        return $this->sendResponse(["images" => $images]);
    }

    public function cronjobs(BoatModel $boatModel)
    {
        $now   = Carbon::now()->addHour(2);
        $date  = $now->copy()->toDateString();
        $time  = $now->copy()->toTimeString();
        $boats = $boatModel->get();
        foreach ($boats as $boat) {
            $maintainances = $boat->maintenances;
            foreach ($maintainances as $maintainance) {

                if ($maintainance->date == $date && $maintainance->notified == 0) {
                    $notificationTime = Carbon::createFromFormat('Y-m-d H:i:s', $date . ' '. "12:00:00");
                    if ($now->copy()->gte($notificationTime->copy())) {
                        $title  = $boat->boatId . " Maintenance";
                        $body   = "Your " . $boat->name. " boat has a maintenance today ";
                        $device = $boat->user->fb_token;
                        if($boat->user->deviceType == 'ios') {
                            $boatModel->sendIosNotification($title, $body, $device);
                        } else {
                            $boatModel->sendAndroidNotification($title, $body, $device);
                        }
                        $maintainance->notified = 1;
                        $maintainance->update();
                        Notification::create(["messageTitle"=>$title,"messageBody"=>$body,"user_id"=>$boat->user->id,"date" => $now->copy()->toDateString() ]);
                    }
                }
            }

            $trips = $boat->trips;
            foreach ($trips as $trip) {
                $tripDate = $trip->creationDate. ' ' . $trip->timeEnd;
                $dueDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $tripDate);
                if ($dueDateTime->copy()->subHours(2)->gte($now->copy()) && $trip->notified == 0) {
                    $title  = $boat->boatId . " Trip";
                    $body   = "Your " . $boat->name. " boat has a trip at ". $dueDateTime->copy();
                    $device = $boat->user->fb_token;
                    if($boat->user->deviceType == 'ios') {
                        $boatModel->sendIosNotification($title, $body, $device);
                    } else {
                        $boatModel->sendAndroidNotification($title, $body, $device);
                    }
                    $trip->notified = 1;
                    $trip->update();
                    Notification::create(["messageTitle"=>$title,"messageBody"=>$body,"user_id"=>$boat->user->id,"date" => $now->copy()->toDateString()]);
                }
            }
        }
    }

    function get_local_time()
    {

        $url = "http://ipecho.net/plain";
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        $ip = curl_exec($ch);

        $url1 = 'http://ip-api.com/json/'.$ip;
        curl_setopt ($ch, CURLOPT_URL, $url1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        $tz = curl_exec($ch);

        $tz = json_decode($tz,true)['timezone'];

        return $tz;

    }
}