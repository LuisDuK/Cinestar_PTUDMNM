<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{ 
 
    public function viewProfile()
    {
       
        $user = Auth::user();
        
        return view('admin.profile.profile', ['employee'=>$user]);
    }
    
public function updateAvatar(Request $request, $id)
{
    $request->validate([
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Hạn chế loại file và dung lượng
    ]);

    $user = User::findOrFail($id);

    if ($request->hasFile('avatar')) {
       
        if ($user->avatar && File::exists(public_path('storage/profile/' . $user->avatar))) {
            File::delete(public_path('storage/profile/' . $user->avatar));
        }

      
        $fileName = $id . '.' . $request->file('avatar')->extension();
        
        $request->file('avatar')->storeAs('public/profile', $fileName);


        $user->avatar = $fileName;
        $user->save();


        return back()->with('success', 'Ảnh đại diện đã được cập nhật thành công');
    }

    return back()->with('error', 'Không có ảnh nào được chọn');
}
}