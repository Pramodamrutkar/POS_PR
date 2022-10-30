<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class bookTable extends Model
{
    protected $table ='booking_tables';	
	public $primaryKey='id';
	public $timestamps = false;
	
	public function getTables(){
   		$result = $this->newquery()->get();
    	return $result;
  	}

  	public function BookingTable($req)
  	{	
  		$id = $req->id;
  		$name = $req->name;
  		$email = $req->email;
  		$phone = $req->phone;
  		$book_time = $req->book_time;
  		$end_book_time = $req->end_book_time;
  		$is_admin = $req->is_admin;

  		$booking_tables_result = DB::table('booking_tables')->where('id', $id)->update(['name' => $name, 'phone' => $phone, 'email' => $email, 'book_time' => $book_time, 'end_book_time' => $end_book_time, 'is_admin' => $is_admin ]);
  		if($booking_tables_result){
  			$record = DB::table('booking_tables')->where('id', $id)->get();
  		}
  		$start_time = strtotime($record[0]->book_time);
  		$end_time = strtotime($record[0]->end_book_time);
		$difference_in_second = $end_time - $start_time;
		$record['remaining_time'] = gmdate('H:i:s',$difference_in_second);
  		return $record;
  	}		

}
