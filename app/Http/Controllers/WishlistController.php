<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use \Cart as Cart;

class WishlistController extends Controller
{
    /**
     * 0. Returns the wishlist view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('wishlist'); //0
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
     * 0. Checks to see if the item is already in the wishlist by looking for duplicates that match the ID that it has been given.
     1. If it does not find any duplicates then it returns the success message to tell the user that it already exists in the wishlist.
     2. If it doesn't exist then it will display a different success message saying that it was added to their wishlist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($request) { //0
            return $cartItem->id === $request->id;
        });

        if (!$duplicates->isEmpty()) { //1
            return redirect('shop')->withSuccessMessage('Item is already in your wishlist.');
        }

        Cart::instance('wishlist')->add($request->id, $request->name, 1, $request->price)->associate('App\Item'); //2
        return redirect('shop')->withSuccessMessage('Item was added to your wishlist.');
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
     * 0. Removes the item from the wishlist using the ID that it has been given.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::instance('wishlist')->remove($id); //0
        return redirect('wishlist')->withSuccessMessage('Your item has been removed');
    }

    /**
     * 0. Destorys all the contents in the wishlist
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function emptyWishlist() //0
    {
        Cart::instance('wishlist')->destroy();
        return redirect('wishlist')->withSuccessMessage('Your wishlist has been cleared');
    }

    /**
     * 0. Gets the ID of the item that is in the cart
     1. Removes the item from the cart with the passed ID
     2. Checks to see if the specific item already exists in the wishlist
     3. If the item is already in the wishlist, displays the success message telling the user it is already in their wishlist.
     4. If the item is not already in the wishlist, it displays the success message telling the user that the item has been moved from their cart to the wishlist
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function switchToCart($id)
    {
        $item = Cart::instance('wishlist')->get($id); //0

        Cart::instance('wishlist')->remove($id); //1

        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($id){ //2
            return $cartItem->id === $id;
        });

        if (!$duplicates->isEmpty()) { //3
            return redirect('cart')->withSuccessMessage('Item is already in your shopping cart');
        }

        Cart::instance('default')->add($item->id, $item->name, 1, $item->price)->associate('App\Item'); //4
        return redirect('wishlist')->withSuccessMessage('Item has been moved to your shopping cart');
    }
}
