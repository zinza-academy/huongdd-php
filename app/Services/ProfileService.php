<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class ProfileService {

    public function update($request) {
        if (isset($request->avatar)) {
            $avatar = uploadFile($request->avatar, 'avatars');
        }

        $request->user()->fill($request->validated());
        if(isset($avatar)) {
            $request->user()->avatar = $avatar;
        }
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        Session::flash('success', 'Profile updated successfully');
        return $request->user()->save();
    }
}
