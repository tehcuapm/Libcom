<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view("profile.public", ["user" => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function editForm(User $user)
    {
        return view("profile.edit-profile", ["user" => $user]);
    }

    /**
     * @param Request $request
     * @param int $id
     */
    public function edit(Request $request, User $user)
    {
        $public = (bool)$request->input('public_profile');
        $validated = $request->validate([
            "name" => "required",
            "email" => "required|email",
            "current_avatar" => "required",

        ]);
        $validated["public_profile"] = $public;

        $user->update($validated);
        return redirect()->to(route("profile.show", ["id" => $user->id]));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Request $request
     * @param User $user
     * @throws ValidationException
     */
    public function addAvatar(Request $request, User $user)
    {
        $validated = $request->validate([
            "avatar_img" => "required|mimes:png,jpg"
        ]);
        $user = Auth::user();
        $name_file = $request->file('avatar_img')->getClientOriginalName();
        $image_path = ("storage/assets/avatars/" . $name_file);
        //si l'avatar existe deja
        if ($user->avatars->where("path_file", "=", $image_path)->count() != 0) {
            throw ValidationException::withMessages(["avatar_img" => "Avatar already exist : please select it"]);
        }
        $request->file('avatar_img')->storeAs("assets/avatars", $name_file);
        if (Avatar::query()->where("path_file", "=", $image_path)->count() == 0) {
            $av = Avatar::create(["name" => $name_file, "path_file" => $image_path]);
        } else {
            $av = Avatar::query()->where("path_file", "=", $image_path)->first();
        }
        $user->avatars()->attach($av);
        return redirect()->back();

    }
}
