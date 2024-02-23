<?php
	if (!function_exists('ddr')) {
	    function ddr($values) {
	    	echo "<pre>"; print_r($values); echo "</pre>"; exit();
	    }
	}

	if (!function_exists('uploadImage')) {
	    /*This is last modified function for upload any image*/
	    function uploadImage($file,$directory = null,$width = null,$height = null) {        
	        $data = getimagesize($file);
	        $filename = $file->getClientOriginalName(); 
	        // $name = pathinfo($filename, PATHINFO_FILENAME);
	        $name = 'img_'.rand();
	        $logoExtension = $file->getClientOriginalExtension();

	        if (!file_exists($directory)) {
	            mkdir($directory);
	        }

	        $logoUrl = $directory.($name.'.'.$logoExtension);
	        // dd($logoUrl);

	        if (@$width == null && @$height == null) {
	            move_uploaded_file($file, "$directory$name".'.'."$logoExtension");
	        }

	        if (@$width != null && @$height != null) {
	            Image::make($file)->resize($width, $height)->save($logoUrl);
	        }

	        return $logoUrl;
	    }
	}


	if (!function_exists('numberToWords')) {
	    function numberToWords($num) {    
	        $ones = array(
	            0 =>"Zero",1 => "One",2 => "Two",3 => "Three",4 => "Four",5 => "Five",6 => "Six",7 => "Seven",8 => "Eight",9 => "Nine",10 => "Ten",11 => "Eleven",12 => "Twelve",13 => "Thirteen",14 => "Fourteen",15 => "Fifteen",16 => "Sixteen",17 => "Seventeen",18 => "Eighteen",19 => "Nineteen"
	        );

	        $tens = array(
	            0 => "Zero",1 => "Ten",2 => "Twenty",3 => "Thirty",4 => "Forty",5 => "Fifty",6 => "Sixty",7 => "Seventy",8 => "Eighty",9 => "Ninety" 
	        );

	        $hundreds = array(
	            "Hundred","Thousand","Million","Billion","Trillion","Quardrillion" 
	        ); // limit t quadrillion

	        $num = number_format($num,2,".",","); 
	        $num_arr = explode(".",$num); 
	        $wholenum = $num_arr[0]; 
	        $decnum = $num_arr[1]; 
	        $whole_arr = array_reverse(explode(",",$wholenum)); 
	        krsort($whole_arr,1); 
	        $rettxt = "";

	        foreach($whole_arr as $key => $i) {
	            while (substr($i,0,1) == "0") {
	                $i = substr($i,1,5);
	            }
	            if($i < 20) {
	            	// echo "getting:".$i;
	            	$rettxt .= @$ones[$i];
	            } elseif($i < 100) {
	                if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)];
	                if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)];
	            } else {
	                if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0];
	                if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)];
	                if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)];
	            }

	            if ($key > 0) {
	                $rettxt .= " ".$hundreds[$key]." ";
	            }
	        }

	        if ($decnum > 0) {
	            $rettxt .= " and ";
	            if ($decnum < 20) {
	                $rettxt .= $ones[$decnum];
	            } elseif($decnum < 100) {
	                $rettxt .= $tens[substr($decnum,0,1)];
	                $rettxt .= " ".$ones[substr($decnum,1,1)];
	            }
	        }
	       return $rettxt;            
	    }
	}

	if (!function_exists('numberFromEnglishToBangla')) {
	    function numberFromEnglishToBangla($number) {
	        $search_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
	        $replace_array = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
	        $banglaNumber = str_replace($search_array, $replace_array, $number);
	        return $banglaNumber;
	    }
	}

    if (!function_exists('numberFromBanglaToEnglish')) {
	    function numberFromBanglaToEnglish($number) {
	        $search_array = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
	        $replace_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
	        $englishNumber = str_replace($search_array, $replace_array, $number);
	        return $englishNumber;
	    }
    }

	if (!function_exists('generate_random_string')) {
		function generate_random_string($length = 10, $dashed_number = 0, $string_type = 'all', $user_def_characters = '') {
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $random_string = '';

		    if ($string_type == 'num') { $characters = '0123456789'; }
		    else if ($string_type == 'up') { $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; }
		    else if ($string_type == 'low') { $characters = 'abcdefghijklmnopqrstuvwxyz'; }
		    else if ($string_type == 'num-up') { $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; }
		    else if ($string_type == 'num-low') { $characters = '0123456789abcdefghijklmnopqrstuvwxyz'; }
		    else if ($string_type == 'up-low') { $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; }
		    else if ($string_type == 'user-def') { $characters = $user_def_characters; }

		    if ($dashed_number > 0) {
		        for ($i = 0; $i < $dashed_number; $i++) {
		            $random_string .= substr(str_shuffle(str_repeat($characters, ceil($length/strlen($characters)))),1,$length)."-";
		        }
		        $random_string .= substr(str_shuffle(str_repeat($characters, ceil($length/strlen($characters)))),1,$length);
		    } else {
		        $random_string = substr(str_shuffle(str_repeat($characters, ceil($length/strlen($characters)))),1,$length);
		    }
		    
		    return $random_string;
		}
	}
?>