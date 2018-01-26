<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\Auth;

class ItemCRUDController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $items = Item::orderBy('id', 'DESC')->paginate(5);
        return view('itemCRUD.index', compact('items'))
                        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('ItemCRUD.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
//        Item::create($request->all());
        $item = new Item;
//        dd($request->User());
        $item->user_id = Auth::user()->id;
        $item->title = $request->title;
        $item->description = $request->description;
        $item->save();
        return redirect()->route('itemCRUD.index')
                        ->with('success', 'Item created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $item = Item::find($id);
        $item->user->name;
        $comment = Comment::where('item_id', $id)->get();
        return view('itemCRUD.show', compact('item', 'comment', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
//        $item = Item::find($id);
//        return view('itemCRUD.edit',compact('item'));

        $item = Item::find($id);
        if ($item->user_id != Auth::user()->id) {
            return redirect()->route('itemCRUD.index')
                            ->with('success', 'You can not edit');
        }
        return view('itemCRUD.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        Item::find($id)->update($request->all());
        return redirect()->route('itemCRUD.index')
                        ->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $item = Item::find($id);
        if ($item->user_id != Auth::user()->id) {
            return redirect()->route('itemCRUD.index')
                            ->with('success', 'You can not delete');
        }
        Item::find($id)->delete();
        return redirect()->route('itemCRUD.index')
                        ->with('success', 'Item deleted successfully');
    }

}
