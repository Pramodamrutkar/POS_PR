<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\bookTable;
use App\Http\Requests;
use Redirect;

class ManageTableController extends Controller
{
    public function getBookTables()
    {
    	$obj = new bookTable();
    	$table_result = $obj->getTables();
    	return view('backend.managetable.book_table', ['table_result' => $table_result]);
    }
    public function SetBookTable(Request $req)
    {	
    	$obj_table = new bookTable();
    	$book_table_result = $obj_table->BookingTable($req);
    	return response()->json(['book_data' => $book_table_result]); 
    }
    public function FrontTable()
    {
    	$obj = new bookTable();
    	$table_result = $obj->getTables();
    	return view('pages.frontBooktable', ['table_result' => $table_result]);
    }

}
