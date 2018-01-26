<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postcomment($id, Request $request) {
        $item_id = $id;
        //$item = Item::find($id);
        $comment = new Comment;
        $comment->item_id = $item_id;
        $comment->user_id = Auth::user()->id;
        $comment->description = $request->description;
        $comment->save();

        return redirect()->route('show.comment', ['id' => $id]);
    }

}
