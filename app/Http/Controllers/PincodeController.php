<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PincodeController extends Controller
{

	public function index(){

		return view('pincode');
	}

	public function check_pincode(){

		$request = request()->all();

	        $pincode    = $request['pincode'];
	        $url ='https://api.postalpincode.in/pincode/'.$pincode;
	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_POST, 0);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        $response = curl_exec ($ch);
	        $err = curl_error($ch);  //if you need
	        curl_close ($ch);
	        
	        $reDecode = json_decode($response, true);

		    if ($reDecode[0]['Status'] == "Success") {
		        return response()->json(array('success'=>'Pincode is available.'));
		    }else{
		    	return response()->json(array('error'=>'Entered pincode not serviceable.'));
		    }  
	}
}
