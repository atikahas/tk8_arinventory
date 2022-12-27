<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use App\Models\ItemList;

class ItemsController extends Controller
{
    public function index() 
    {
        $items = DB::select("
            select a.id,b.name location,c.name category,a.item_name,a.initial_stock,a.current_stock,((a.current_stock/a.initial_stock)*100) percent_stock from item_list a
            left join item_location b
            on a.location_id = b.id
            left join item_category c
            on a.category_id = c.id
        ");

        return view('items.index', (compact('items')));
    }

    public function create() 
    {
        return view('items.create');
    }

    public function store(Request $request)
    {   
        $data = $request->except(['_token']);
        $data['created_by'] = Auth::user()->id;

        if($request->has('image')) {
            $image = $request->file('image');
            $image_name = uniqid().'_'.$image->getClientOriginalName();
            $image->storeAs('public/items_image/', $image_name);

            $data['item_image'] = $image_name;
        }

        $items = ItemList::create($data);

        return redirect()->route('items.index')->withSuccess(__('Items added successfully.'));
    }
}
