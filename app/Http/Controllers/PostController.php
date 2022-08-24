<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(10);

        $data = [
            'posts' => $posts,
        ];
        return view('posts.index', $data);
    }


    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {
        //不得超過5120KB=5MB
        $request->validate([
            'title' => 'required',
            'files.*' => 'nullable|max:5120',
            //'pics.*' => 'nullable|max:5120',
        ]);
        $att['title'] = $request->input('title');
        $att['content'] = $request->input('content');
        $att['file_desc'] = $request->input('file_desc');
        $att['pic_desc'] = $request->input('pic_desc');
        $att['link'] = $request->input('link');
        $att['user_id'] = auth()->user()->id;
        $att['views'] = 0;

        $post = Post::create($att);

        //處理檔案上傳
        if ($request->hasFile('files')) {
            $folder = 'posts/' . $post->id . '/files';
            $files = $request->file('files');
            foreach ($files as $file) {
                $file->storeAs('public/' . $folder, $file->getClientOriginalName());
            }
        }
        //處理相片上傳
        if ($request->hasFile('pics')) {
            $folder = 'posts/' . $post->id . '/photos';
            $pics = $request->file('pics');
            foreach ($pics as $pic) {
                $pic->storeAs('public/' . $folder, $pic->getClientOriginalName());

                $img = Image::make($pic);
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/posts/' . $post->id . '/photos/' . $pic->getClientOriginalName()));
            }
        }

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        $s_key = "pv" . $post->id;
        if (!session($s_key)) {
            $att['views'] = $post->views + 1;
            $post->update($att);
        }
        session([$s_key => '1']);

        $next_post = Post::where('id', '>', $post->id)->first();
        $last_post = Post::where('id', '<', $post->id)
            ->orderBy('id', 'DESC')
            ->first();

        $last_id = (empty($last_post)) ? null : $last_post->id;
        $next_id = (empty($next_post)) ? null : $next_post->id;

        $data = [
            'post' => $post,
            'last_id' => $last_id,
            'next_id' => $next_id,
        ];

        return view('posts.show', $data);
    }

    public function edit(Post $post)
    {
        if (auth()->user()->id != $post->user_id) {
            return back();
        }

        //有無附件
        $files = get_files(storage_path('app/public/posts/' . $post->id . '/files'));
        $pics = get_files(storage_path('app/public/posts/' . $post->id . '/photos'));

        $data = [
            'post' => $post,
            'files' => $files,
            'pics' => $pics,
        ];

        return view('posts.edit', $data);
    }

    public function del_file($file, $id)
    {
        $file = str_replace('**', '/', $file);
        if (file_exists(storage_path('app/public/posts/' . $file))) {
            unlink(storage_path('app/public/posts/' . $file));
        }
        return redirect()->route('posts.edit', $id);
    }

    public function update(Request $request, Post $post)
    {
        if (auth()->user()->id != $post->user_id) {
            return back();
        }
        //不得超過5120KB=5MB
        $request->validate([
            'title' => 'required',
            'files.*' => 'nullable|max:5120',
            'pics.*' => 'nullable|max:5120',
        ]);

        $att['title'] = $request->input('title');
        $att['content'] = $request->input('content');
        $att['file_desc'] = $request->input('file_desc');
        $att['pic_desc'] = $request->input('pic_desc');
        $att['link'] = $request->input('link');

        $post->update($att);

        //處理檔案上傳
        if ($request->hasFile('files')) {
            $folder = 'posts/' . $post->id . '/files';
            $files = $request->file('files');
            foreach ($files as $file) {
                $file->storeAs('public/' . $folder, $file->getClientOriginalName());
            }
        }
        //處理相片上傳
        if ($request->hasFile('pics')) {
            $folder = 'posts/' . $post->id . '/photos';
            $pics = $request->file('pics');
            foreach ($pics as $pic) {
                $pic->storeAs('public/' . $folder, $pic->getClientOriginalName());
            }
        }

        return redirect()->route('posts.index');
    }


    public function destroy(Post $post)
    {
        /** 
        if (auth()->user()->id != $post->user_id) {
            return back();
        }
         */

        //刪除整個該post上傳目錄
        $folder = storage_path('app/public/posts/' . $post->id);
        if (is_dir($folder)) {
            deldir($folder);
        }

        //刪除該post
        $post->delete();

        return redirect()->route('posts.index');
    }
}
