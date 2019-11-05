<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;

use Auth;

class ItemController extends Controller
{
    /**
     * This code below shows the standard items index view which the user will see.
    The pagination allows me to dictate how many items are show per page.
     *
     * @return \Illuminate\Http\Response
     */

    /**
    public function index()
    {
        //   $items = Item::all()->toArray();
        $items = Item::paginate(2);
        return view('items.index', compact('items'));
    }
    */

    /**
     * 
    This code below shows the admin items index view which will allow the admin to access the CRUD functionalilty.
    1. The pagination allows me to dictate how many items are show per page. 

     *
     * @return \Illuminate\Http\Response
     */

    public function index()
     {
        //   $items = Item::all()->toArray();
        $items = Item::paginate(10); //1
        return view('items.dashboard', compact('items'));
    }

    /**
     * This code below will return the items.create view which the admin will use to create a new item
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * 
    0.This code below validatates a request that has been sent to it. It checks the inforamtion is valid.
    1. If it is suceesful it will give a message telling the admin the item has been created.
    If it fails it will give a prompt on the page saying what feilds are not valid. 

     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = $this->validate(request(), [ //0
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'quantity' => 'required|numeric'
    ]);
        
        Item::create($item);
         return back()->with('success', 'New Item has been added'); //1

    }

    /**
     * 
     0.The code below allows a user to pick a specific item by its ID.
     1.This line allows the user to look at a full page view of it's details by taking the items ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $item = Item::findOrFail($id); //0
        return view('items.show')->with('item', $item); //1
    }

    /**
     * The code below allows the admin to select a specific item by using its ID.
    It then takes the admin to the items.edit view where they will be able to change the details of that specific item

     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('items.edit',compact('item','id'));
    }

    /**
     * The code below is what updates the database with the new information about the item.
    It updates the specific ID in the database with the information that has been editied.
    If it is successful it gives a message telling the admin that the item has been updated
    0. Finds specific ID of item
    1. Sends a validation request
    2. Validates the information that is in the fields
    3. Changes the informaiton that is in the fields
    4. Saves the changes that have been made to the items inforamtion
    5. Redirects the admin to the items index page with the success message.

     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id); //0
        $this->validate(request(), [ //1
          'name' => 'required', //2
          'category' => 'required',
          'price' => 'required|numeric',
          'description' => 'required',
          'quantity' => 'required|numeric'
        ]);
         $item->name = $request->get('name');//3
         $item->category = $request->get('category');
         $item->price = $request->get('price');
         $item->description = $request->get('description');
         $item->quantity = $request->get('quantity');
         $item->save(); //4
         return redirect('items')->with('success','Item has been updated');//5

    }

    /**
     * The code below deletes a specific item from the database.
    Whatever ID it is passed will be deleted from the database
    If it is successful it will give a message telling the admin that it has been removed. 
    0. Finds the specific ID of the item
    1. Deletes the item with the matching ID
    2. Redirects the admin back to the items index page with the success page.

     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id); //0
        $item->delete(); //1
        return redirect('items')->with('success','Item has been  deleted'); //2
    }

    /**
     *
    0. Attempts to authorise the user by requesting their email and password
    1. Checks to see if the email address that has been used is related to an admin account.
    2. If the user is an admin, they will be redirected to the items index page
    3. If the user is not an admin, they will be redirected to the shop page 
    4. Redirects the user to the previous page.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function __construct(Request $request)
    {
        //$this->middleware('auth', ['except' => ['index', 'show']]);
        if(Auth::attempt([ //0
            'email' => $request->email,
            'password' => $request->password
        ]))
        {
            $user = User::where('email', $request->email)->first(); //1
            if ($user->is_admin()) //2
            {
                //dd($user->is_admin())
                return redirect()->route('item.index'); 
            }

            return redirect()->route('/shop');//3
        }
        return redirect()->back(); //4
    }
    
}
