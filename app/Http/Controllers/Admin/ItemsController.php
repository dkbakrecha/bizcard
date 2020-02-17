<?php

namespace App\Http\Controllers\Admin;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemsController extends Controller {

    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $items = Item::orderBy('id','DESC')->paginate(5);
        return view('admin.items.index',compact('items'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('admin.items.create');
    }


    public function store(Request $request)
    {
      $this->validate($request, [
            'item_name' => 'required',
            'price' => 'required|numeric',
        ]); 
        $image = $request->file('image');         
        $fileName = $image->getClientOriginalName();
        $fileExtension = $image->getClientOriginalExtension();
        // $imageName = date('dmY').'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(
        base_path() . '/public/images/items/', $fileName);
        $requestData = $request->all();
        $requestData['image'] = $fileName;
        Item::create($requestData);
        return redirect()->route('admin.items.index')
                        ->with('success','Record created successfully');
    }

    public function show($id)
    {
        $item = Item::find($id);
        return view('admin.items.show',compact('item'));
    }

    public function edit($id)
    {
        $item = Item::find($id);
        return view('admin.items.edit',compact('item'));
    }

    public function update(Request $request, $id)
    {
         $this->validate($request, [
            'item_name' => 'required',
            'price' => 'required|numeric',
        ]); 

        $requestData = $request->all();

        if(!empty($request->file('image'))){
            $image = $request->file('image');         
            $fileName = $image->getClientOriginalName();
            $fileExtension = $image->getClientOriginalExtension();
            // $imageName = date('dmY').'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(
            base_path() . '/public/images/items/', $fileName);
            
            $requestData['image'] = $fileName;    
        }
        
        Item::find($id)->update($requestData);
        return redirect()->route('admin.items.index')
                        ->with('success','Record updated successfully');
    }
    public function destroy($id)
    {
        Item::find($id)->delete();
        return redirect()->route('admin.items.index')
                        ->with('success','Record deleted successfully');
    }
}