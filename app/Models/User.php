<?php

namespace App\Models;

use App\Entities\User as UserEntity;
use Utilities\Files\UploadFiles;

class User extends UserEntity
{
    use UploadFiles;
    public function findUser($userId)
    {
        $user = $this->find($userId);
        return $user;
    }
    public function findAllBy($key, $value)
    {
        $users = \DB::table("users")
            ->where($key, "like", "%". $value ."%")
            ->pluck($key,'id');
        return $users;
    }

    public function uploadAvatar($file, $request)
    {
        $destinationPath = base_path("uploads/users");
        if ($request->hasFile($file)) {
            $image = $this->uploadImage($request->$file, $destinationPath);
            return $image;
        }
        return null;
    }
}
