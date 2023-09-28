<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class CommentController extends Controller
{
    public function commentSomething(Request $request, $id){
        $request->validate([
            'content' => 'required',
        ],[
            'content.required' => 'The comment is required',
        ]);

        DB::table('comments')->where('id', $id)->insert([
            'post_id' =>$id,
            'content' => $request->content,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        return redirect()->back()->with('success', 'Comment added successfully');
    }
}
