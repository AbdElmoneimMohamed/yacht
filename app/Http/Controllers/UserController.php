<?php

namespace App\Http\Controllers;

use App\Jobs\SendReminderEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User as UserModel;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index(Request $request, UserModel $userModel)
    {

        $filter = $request->get("filter");
        $search = $request->get("q");
        if ($filter == "deactivated") {
            $users = $userModel->onlyTrashed();
        } elseif ($filter == "all"){
            $users = $userModel->withTrashed();
        } else {
            $users = $userModel;
        }
        if (isset($search) && !empty($search)) {
            $users = $users->where("name", "like", "%$search%")
                    ->orwhere("email", "like", "%$search%");
        }
        $users = $users->paginate(10);
        return view('users/index', ['users' => $users, 'search' => $search]);

    }

    public function create()
    {
        return view('users/create');
    }

    public function store(UserRequest $request, UserModel $userModel)
    {
        $data             = $request->all();
        $password         = $data['password'];
        $data['password'] = bcrypt($password);
        $image            = $userModel->uploadAvatar("avatar", $request);
        $data["avatar"]   = $image;
        $user             = $userModel->create($data);
        //dispatch((new SendReminderEmail($user, $password))->onQueue('mails'));
        return redirect('users');
    }

    public function edit($id, UserModel $userModel)
    {
        $user  = $userModel->withTrashed()->find($id);
        return view('users/edit', ['user' => $user]);
    }

    public function update($id, UserRequest $request, UserModel $userModel)
    {
        $user             = $userModel->withTrashed()->find($id);
        $data             = $request->all();
        $data['password'] = bcrypt($data['password']);
        $image            = $userModel->uploadAvatar("avatar", $request);
        $data["avatar"]    = isset($image) ? $image : $user->avatar;
        $user->update($data);
        return redirect('users');
    }

    public function destroy($id, UserModel $userModel)
    {
        $user           = $userModel->find($id);
        $user['status'] = UserModel::STATUS_INACTIVE;
        $user->update();
        $user->delete();
        return redirect()->back();
    }

    public function activate($id, UserModel $userModel)
    {
        $user           = $userModel->withTrashed()->find($id);
        $user['status'] = UserModel::STATUS_ACTIVE;
        $user->update();
        $user->restore();
        return redirect()->back();
    }

    public function show($id, UserModel $userModel)
    {
        $currentUser = $userModel->withTrashed()->find($id);
        return view('users/show', ['user' => $currentUser]);
    }

    public function profile()
    {
        $currentUser = Auth::user();
        return view('users/profile', ['user' => $currentUser]);
    }

    public function autocomplete(Request $request, UserModel $userModel)
    {
        $term    = $request->get('owner_email');
        $results = $userModel->findAllBy("email", $term);
        return response()->json($results);
    }

    public function exist(Request $request, UserModel $userModel)
    {
        $data    = $request->all();
        $results = $userModel->where("email", $data["email"])->first();
        return $results;
    }
    public function avatar($id, UserModel $userModel)
    {
        $user  = $userModel->withTrashed()->find($id);
        $imagePath = base_path('uploads/users/'.$user->avatar);
        return response()->file($imagePath);
    }
}