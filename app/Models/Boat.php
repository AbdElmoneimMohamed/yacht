<?php

namespace App\Models;

use App\Entities\Boat as BoatEntity;
use App\Entities\Engine;
use App\Entities\Image;
use App\Entities\Maintenance;
use Utilities\Files\UploadFiles;
use App\Models\Rpm;

use Edujugon\PushNotification\PushNotification;



class Boat extends BoatEntity
{
    public function saveRpms($boat, $request)
    {
        $rmps = $request->get("missedRPMS");
        foreach ($rmps as $rpm) {
            $rpm["boat_id"] = $boat->id;
            Rpm::create($rpm);
        }
    }

    public function saveImages($boat, $request)
    {
        $images = $request->get("images");
        foreach ($images as $image) {
            $image["boat_id"] = $boat->id;
            Image::create($image);
        }
    }

    public function saveEngines($boat, $request)
    {
        $engines = $request->get("engines", $request);
        foreach ($engines as $engine) {
            $engine["boat_id"] = $boat->id;
            Engine::create($engine);
        }
    }

    public function saveMaintenances($boat, $request)
    {
        $maintenances = $request->get("maintenance");
        foreach ($maintenances as $maintenance) {
            $maintenance["boat_id"] = $boat->id;
            Maintenance::create($maintenance);
        }
    }

    public function sendAndroidNotification($title, $body, $device)
    {

        $notification = new PushNotification('fcm');
        $feedBack = $notification
                ->setMessage([
                'notification' => [
                    'title'=> $title,
                    'body'=> $body,
                    'sound' => 'default'
                ]
            ])
            ->setApiKey(env("FBC_API_TOKEN"))
            ->setDevicesToken([$device])
            ->send()
            ->getFeedback();
    }

    public function sendIosNotification($title, $body, $device)
    {
        $notification = new PushNotification('apn');
        $feedBack = $notification
            ->setMessage([
                'aps' => [
                    'alert' => [
                        'title' => $title,
                        'body' => $body
                    ],
                    'sound' => 'default',
                ]
            ])
            ->setUrl('ssl://gateway.sandbox.push.apple.com:2195')
            ->setDevicesToken([$device])
            ->send()
            ->getFeedback();
    }
}
