<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function index(){
        $comment=Comment::orderBy('id','desc')->paginate(4);
        return view('comment.index',compact('comment'));
    }
    public function create(Request $request){
        $msg="پیام ذخیره نشد";
if(!empty($request->content)){
    $comment=new Comment($request->all());
    $comment->name="مدیر";
    $comment->email="shima1366_rahmani@yahoo.com";
    $comment->status=1;
    if($comment->save()){
        $msg="پیام با موفقیت ذخیره شد";
    }
}
        return redirect()->back()->with('msg',$msg);
    }
    public function set_status(Request $request){
        // dd("hi");
        if($request->ajax()){
            // dd($request);
            $comment=Comment::find($request->id);
             if($comment){
                if($comment->status==0){
                    $comment->status=1;
                    $comment->update();
                    return "1";
                }
                elseif($comment->status==1){
                    $comment->status=0;
                    $comment->update();
                    return "2";

                }
             }
        }
    }
    public function destroy(Request $request){
        $comment=Comment::findOrfail($request->id);
        $comment->delete();
        return redirect()->back();

    }
}
