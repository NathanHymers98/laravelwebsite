<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ShopController extends Controller
{
    /**
     * 0. Gets all the items that are currently being stored in the database
     1. Returns the user to the shop view with the items.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all(); //0
        return view('shop')->with('items', $items); //1
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * 0. Tries to find a item with a specific slug, if the slug or item is not found then it doesn't run the rest of the code.
     1. Retrives a random item and assigns it to the $interested variable.
     2. Returns the item view with a random item displayed underneath.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $item = Item::where('slug', $slug)->firstOrFail(); //0
        $interested = Item::where('slug', '!=', $slug)->get()->random(1); //1
        return view ('item')->with(['item' => $item, 'interested' => $interested]); //2
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
    public function destroy($id)
    {
        //
    }

     /**
     * 0. If there is nothing entered in the search bar, it will do steps 1 and 2. 
     * 1. Displays 3 items per page
     2. Returns the the user to the shop view with the list of items
     3. Looks for an item when the name matches what a user has searched for. If more than 3 items are found, it will display 3 per page.
     4. Appends the items with only the search results that was found.
     5. Returns the the user to the shop view with the list of items that matches the users search.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function search(Request $req){
        //dd ('search');
        if ($req->search == ""){ //0
            $items = Item::paginate(3); //1
            return view('shop', compact('items')); //2
        }
        else{
            $items = Item::where('name', 'LIKE', "%" . $req->search . '%') -> 
                paginate(3); //3
            $items->appends($req->only('search')); //4
            return view('shop', compact('items')); //5
        }
    }
}
