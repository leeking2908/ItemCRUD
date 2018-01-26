<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $items = Item::orderBy('id', 'DESC')->paginate(5);
        return view('itemCRUD.index', compact('items'))
                        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

}
