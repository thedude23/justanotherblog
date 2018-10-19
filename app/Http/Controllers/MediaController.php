<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Http\Requests; //??

use App\User;
use App\Role;
use App\Post;
use App\Photo;
use App\Comment;
use App\CommentReply;
use App\Category;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();

        return view('admin.media.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');

        $name = $file->getClientOriginalName();

        $file->move('images', $name);

        Photo::create(['file'=>$name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        // $photo = Photo::findOrFail($id);

        // unlink(public_path() . $photo->file);

        // $photo->delete();


        // return "it works";


    }

    public function deleteMedia(Request $request)
    {
        // if(isset($request->delete_single)) {
        //     $this->destroy($request->photo);
        //     return redirect()->back();
        // }
        
        if(isset($request->delete_selected) && !empty($request->checkBoxArray)){
            
            $photos = Photo::findOrFail($request->checkBoxArray);
            
            foreach($photos as $photo){
                $photo->delete();
            }
            
            return redirect()->back();

        } else {
            
            return redirect()->back();
        }

    }
}
