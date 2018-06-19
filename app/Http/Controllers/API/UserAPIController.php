<?php

namespace App\Http\Controllers\API;

use App\Entities\Notification as NotificationModel;
use App\Jobs\SendReminderEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User as UserModel;
use App\Http\Requests\UserRequest;
use Validator;
use App\Models\User;
use Utilities\Files\UploadFiles;
use App\Models\Image as ImageModel;
use App\Entities\Image;

class UserAPIController extends AppBaseController
{
    use UploadFiles;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $email    = $request->get("email");
        $phone    = $request->get("phone");
        $password = $request->get("password");

        if (isset($email) && !empty($email)) {
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                $user = Auth::user();
                $user->update(["deviceType" => $request->deviceType, "fb_token" =>$request->fb_token]);
                $response["userInfo"]['id']       = $user->id;
                $response["userInfo"]['name']     = $user->name;
                $response["userInfo"]['email']    = $user->email;
                $response["userInfo"]['phone']    = $user->phone;
                $response["userInfo"]['imageUrl'] = $user->imageUrl;
                $response["userInfo"]['fb_token'] = $user->fb_token;
                $response["userInfo"]['token']    = $user->createToken('MyApp')->accessToken;
                $response["userInfo"]['deviceType'] = $user->deviceType;

                return $this->sendResponse($response);

            }
            return $this->sendErrorMessage('These credentials do not match our records.');
        }
        if (isset($phone) && !empty($phone)) {
            if (Auth::attempt(['phone' => $phone, 'password' => $password])) {
                $user = Auth::user();
                $user->update(["deviceType" => $request->deviceType, "fb_token" =>$request->fb_token]);                $response["userInfo"]['id']       = $user->id;
                $response["userInfo"]['name']     = $user->name;
                $response["userInfo"]['email']    = $user->email;
                $response["userInfo"]['phone']    = $user->phone;
                $response["userInfo"]['imageUrl'] = $user->imageUrl;
                $response["userInfo"]['fb_token'] = $user->fb_token;
                $response["userInfo"]['token']    = $user->createToken('MyApp')->accessToken;
                $response["userInfo"]['deviceType'] = $user->deviceType;
                return $this->sendResponse($response);

            }
            return $this->sendErrorMessage('These credentials do not match our records.');
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'phone'    => 'required|unique:users',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->getMessages());
        }

        $input                = $request->all();
        $input['password']    = bcrypt($input['password']);
        $input['imageUrl']    = "getPhoto/default_user.png";
        $user                 = User::create($input);
        $response["userInfo"]['id']       = $user->id;
        $response["userInfo"]['name']     = $user->name;
        $response["userInfo"]['email']    = $user->email;
        $response["userInfo"]['phone']    = $user->phone;
        $response["userInfo"]['imageUrl'] = $user->imageUrl;
        $response["userInfo"]['fb_token'] = $user->fb_token;
        $response["userInfo"]['token']    = $user->createToken('MyApp')->accessToken;
        $response["userInfo"]['deviceType'] = $user->deviceType;


        return $this->sendResponse($response);
    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetails()
    {
        $user = Auth::guard('api')->user();
        $response["userInfo"]['id']       = $user->id;
        $response["userInfo"]['name']     = $user->name;
        $response["userInfo"]['email']    = $user->email;
        $response["userInfo"]['phone']    = $user->phone;
        $response["userInfo"]['imageUrl'] = $user->imageUrl;
        $response["userInfo"]['fb_token'] = $user->fb_token;
        $response["userInfo"]['deviceType'] = $user->deviceType;
        return $this->sendResponse($response);
    }

    public function editProfile(Request $request, UserModel $userModle)
    {
        $data = $request->all();
        $user = Auth::guard('api')->user();
        if (isset($data["email"]) &&  $data["email"] != $user->email) {
            $userData = $userModle->where("email", "=", $data["email"])->get();
            if(count($userData) != 0 ) {
                return $this->sendErrorMessage('The email has already been taken');
            }
        }
        if (isset($data["phone"]) &&  $data["phone"] != $user->phone) {
            $userData = $userModle->where("phone", "=", $data["phone"])->get();
            if(count($userData) != 0 ) {
                return $this->sendErrorMessage('The phone has already been taken');
            }
        }
        if (isset($data["password"]) &&  !empty($data["password"])) {
            $data["password"] = bcrypt($data["password"]);
        }
        $user->update($data);
        return $this->sendResponse(["success"=>1]);
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();
        $user->update(['fb_token' => '']);
        $user->token()->delete();
        return $this->sendResponse(['response'=>'logout']);
    }

    public function uploadPhoto(Request $request)
    {
        //if ($request->hasFile('photo')) {
            $destinationPath = base_path("uploads/images");
            $image  = $this->uploadImage($request->photo, $destinationPath);
            $boatId = $request->get("boatId");
            if (isset($boatId) && !empty($boatId)) {
                $imageData["boat_id"]  = $boatId;
                $imageData["url"] = "getPhoto/".$image;
                $img = Image::create($imageData);
                return $this->sendResponse(["url" => "getPhoto/".$image, "id"=>$img->id]);
            }
            return $this->sendResponse(["url" => "getPhoto/".$image]);
       /* }
        return $this->sendErrorMessage("the photo not uploaded");*/
    }

    public function getPhoto($name)
    {
        $imagePath = base_path('uploads/images/'.$name);
        return response()->file($imagePath);
    }

    public function deletePhoto(Request $request, ImageModel $imageModel)
    {
        $id    = $request->get("photoId");
        $image = $imageModel->find($id);
        $image->delete();
        return $this->sendResponse(["message" => "deleted"]);
    }

    public function deleteNotification(Request $request, NotificationModel $notificationModel)
    {
        $data = $request->all();
        $notificationId = $data["notificationId"];

        $notification = $notificationModel->find($notificationId);
        $notification->delete();

        return $this->sendResponse(["message" => "deleted"]);
    }

    public function getNotifications()
    {
        $user = Auth::guard('api')->user();
        $notifications = $user->notifications;
        foreach ($notifications as $notification) {
            unset($notification->updated_at, $notification->deleted_at);
        }
        return $this->sendResponse(["notifications" => $notifications]);
    }

    public function resetPassword(Request $request, UserModel $userModel)
    {
        $email = $request->get("email");
        $user = $userModel->where("email", $email)->first();
        if (count($user) == 0) {
            return $this->sendErrorMessage("We can't find a user with that e-mail address.");
        }
        $password = mt_rand(100000, 999999);
        dispatch((new SendReminderEmail($user, $password)));
        $user->password = bcrypt($password);
        $user->update();
        return $this->sendResponse(["message" => "reset password email has been sent"]);
    }

    public function changePassword(Request $request, UserModel $userModel)
    {
        $email = $request->get("email");
        $password = $request->get("password");
        $new = $request->get("new");

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            $user->update(["password" => bcrypt($new)]);
            return $this->sendResponse(["success"=>1]);
        }
        return $this->sendErrorMessage('These credentials do not match our records.');
    }
}