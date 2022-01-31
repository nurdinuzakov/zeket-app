<?php

namespace App\Http\Controllers\Api\Posts;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class PostController extends BaseController
{
    public function createPost(Request $request){
        $inputs = $request->all();

        $validator = Validator::make($inputs,[
            'title'        => 'required|string',
            'text'         => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(),422);
        }

        $user = Auth::user();
        $post = Post::create(['title' => $inputs['title'], 'content' => $inputs['text'], 'user_id' => $user->id]);

        $userPath = 'users/' . $user->id;

        $file = $request->file('image');
        $img = Image::make($file)->resize(320, 240, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $thumb = Image::make($file)->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        });

        $name = uid() . time() . $file->getClientOriginalName();
        Storage::disk('local')->put('public/' . $userPath . '/' . $name, $img->stream()->detach());
        Storage::disk('local')->put('public/' . $userPath . '/thumb/' . $name, $thumb->stream()->detach());
        $user->photo = $userPath . '/' . $name;
        $user->thumb_photo = $userPath . '/thumb/' . $name;
        $user->save();



        return $this->sendSuccess('Success', [  'name'          => $user->name,
            'last_name'     => $user->last_name,
            'phone_number'  => $user->phone_number,
            'email'         => $user->email,
            'avatar'        => $user->photo ? asset('storage/' . $user->photo) : null
        ]);
        dd('done create');
    }
}
