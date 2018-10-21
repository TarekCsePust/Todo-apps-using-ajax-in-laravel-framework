<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Item;
use App\User;

class listController extends Controller
{
	public function index()
	{
        $items = Item::all();
        //return $items;
		return view('list',compact('items'));
	}

    public function create(request $request)
    {
        $ite = new Item;
        $ite->item = $request->input('text');

        $ite->save();
        
            	//DB::insert('insert into items (item) values (?)', 
    		//[$request->text]);
    	
    	return "Done";
    }

    public function delete(Request $request)
    {
        Item::where('id',$request->id)->delete();
        return "Done";
    }

    public function update(Request $request)
    {
        $item = Item::find($request->id);
        $item->item = $request->text;
        $item->save();
        return "Done";
    }


    public function search(Request $request)
    {
        $term = $request->term;
        $items = Item::where('item','LIKE','%'.$term.'%')->get();
        if(count($items)==0)
        {
            $searchResult[] = "no found";
        }
        else{
             foreach ($items as$value) {
                 $searchResult[] = $value->item;
             }
         } 
        return $searchResult;
        $availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];

    return $availableTags;
    }
}
