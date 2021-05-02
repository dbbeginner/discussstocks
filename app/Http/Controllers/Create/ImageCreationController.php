<?php

namespace App\Http\Controllers\Create;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\Post;
use App\Rules\isUserSubscribedToChannel;
use App\Rules\doesFileExistInTmpStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Vinkla\Hashids\Facades\Hashids;

class ImageCreationController extends Controller {

    public function index(Request $request)
    {
        $data['subscriptions'] = Channel::whereIn('id', Auth::user()->subscriptions()->pluck('content_id'))
            ->orderBy('title')
            ->get();
        return view('post.create.image', $data);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'title'     =>      ['required'],
            'content'   =>      ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'channel_id' =>     [ new isUserSubscribedToChannel ],
        ]);

        $image_name = \Str::uuid(4) . '.' . $request->file('content')->getClientOriginalExtension();
        $request->file('content')->storeAs('public/images/tmp', $image_name);

        $data = $request->only(['title', 'content', 'channel_id']);
        $data['channel_title'] = Channel::where('id', '=', Hashids::decode($data['channel_id']))->first()['title'];

        $data['image'] = $image_name;

        return view('post.verify.image', $data );
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title'     =>      ['required'],
            'content'   =>      ['required', new doesFileExistInTmpStorage],
            'channel_id' =>     [ new isUserSubscribedToChannel ],
        ]);

        $file = $validated['content'];
        $temp = storage_path("app/public/images/tmp/$file");
        $source = storage_path("app/public/images/source/$file");

        rename($temp, $source);

        $thumbnail = $this->resizeImage($source, 200);
        $thumbnail->save(storage_path("app/public/images/thumb/$file"));

        $screen = $this->resizeImage($source, 900);
        $screen->save(storage_path("app/public/images/screen/$file"));


        $post = Post::create([
            'parent_id' => Hashids::decode($request->input('channel_id'))[0],
            'user_id' => Auth::user()->id,
            'type' => 'post',
            'subtype' => 'image',
            'title' => $validated['title'],
            'content' => $validated['content']
        ]);

        return redirect('/' . $post->hashId() )->with('success', 'Your post is created');
    }

    private function resizeImage($source_file, $width = null, $height = null)
    {
        // Resize an image and constrain its aspect ration by providing only a height argument or only a width argument
        // to this function

        $image = Image::make($source_file);

        $image->height() > $image->width() ? $width=null : $height=null;

        $image->resize($width, $height, function ($constraint) {
            $constraint->upsize();
            $constraint->aspectRatio();
        });

        return $image;
    }

}