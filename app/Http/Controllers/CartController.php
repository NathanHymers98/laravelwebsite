<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Cart as Cart;
use Validator;
use App\Order;

class CartController extends Controller
{
    /**
     * 0. Returns the cart view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart'); //0
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
     * 0. Checks to see if the item is already in the cart  by looking for duplicates that match the ID that it has been given.
     1. If it does not find any duplicates then it returns the success message to tell the user that it already exists in the cart.
     2. If it doesn't exist then it will display a different success message saying that it was added to their cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request){ //0
            return $cartItem->id === $request->id;
        });

        if (!$duplicates->isEmpty()) { //1
            return redirect('cart')->withSuccessMessage('item is already in your cart');
        }

        Cart::add($request->id, $request->name, 1, $request->price)->associate('App\Item'); //2
        return redirect('cart')->withSuccessMessage('Item was added to your cart');
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
     * 0. The validator makes a request to check that the quantity contains data, is numeric and is between 1 and 10
    1. If it fails, an error message is displayed using session flash and json
    2. If it was successful, a success message is displayed using session and json
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), ['quantity' => 'required|numeric|between:1,10'
        ]); //0

        if ($validator->fails()) { //1
            session()->flash('error_message', 'Quantity must be between 1 and 10.');
            return response()->json(['success' => false]);
        }

        Cart::update($id, $request->quantity); //2
        session()->flash('success_message', 'Quantity was updated successfully');
        return response()->json(['success' => true]);

    }


    /**
     * 0. Removes the item from the cart using the ID that it has been given.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id); //0
        return redirect('cart')->withSuccessMessage('Your item has been removed');
    }
    /**
     * 0. Destorys all the contents in the cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function emptyCart()
    {
        Cart::destroy(); //0
        return redirect('cart')->withSuccessMessage('Your items has been removed from the cart');
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

    public function switchToWishlist($id)
    {
        $item = Cart::get($id); //0

        Cart::remove($id); //1

        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($id){ //2
            return $cartItem->id === $id;
        });

        if (!$duplicates->isEmpty()) { //3
            return redirect('cart')->withSuccessMessage('Item has been added to your wishlist');
        }

        Cart::instance('wishlist')->add($item->id, $item->name, 1, $item->price)->associate('App\Item'); //4
        return redirect('cart')->withSuccessMessage('Item has been moved to your wishlist');
    }

    /**
     * 0. Returns the order view.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function checkout(){
        return view('order'); //0
    }
    /**
     * 0. Sends a validation request.
     1. Validates the information that is in the fields
     2. Creates the order form
     3. Returns the user to the order view with the success message telling them that their order details have been stored.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function storeorder(Request $request)
    {
        $order = $this->validate(request(), [ //0
            'orderdate' => 'required', //1
            'username' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'city' => 'required',
            'county' => 'required',
            'postalcode' => 'required',
            'telephone' => 'required',
            'email' => 'required',
            'total' => 'required|numeric'
            ]);

        Order::create($order); //2
        // dd($order);
        return view('payment')->with('success', 'Order details have been stored'); //3
        //return back()->with('success', 'Order details have been stored');
    }
}
