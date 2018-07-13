<?php
class MD_Storelocator_Map2Controller extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
	
	Mage::getSingleton('core/session')->setSearchvalue($_GET['country']);
	$_showSearch = Mage::getStoreConfig('storelocator/general/radius');
	$radius_backend=$_showSearch/6371;
	$t=false;
	$d=array();
    $dom = new DOMDocument("1.0");
	$node = $dom->createElement("markers");
	$parnode = $dom->appendChild($node); 
	$central_lat = $_GET['lat'];
	$central_lng = $_GET['lng'];
	$country = $_GET['city'];
	$auto_search = $_GET['country'];
	$sort=$_GET['sort'];
	$tm1=$_GET['tm1'];
	$tm2=$_GET['tm2'];
	$tm3=$_GET['tm3'];
	$tm4=$_GET['tm4'];
	$tm5=$_GET['tm5'];
		
	header("Content-type: text/xml");
	$earth_radius = 3960.00; // in miles
	$matchecount = 0;
	$cntmat = 0;
	$locations = array();
	
	if(!isset($tm1)){
		if($country==''){
			//
			$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$central_lat,$central_lng&key=AIzaSyDnnBdSV0R6apiFjcQlWT69q6s_FRFL--g";
			$response = file_get_contents($url);
			
			$json = json_decode($response,true);		
			$results = $json['results'][0]['address_components'];
			foreach ($results as $result) {
				if($result['types'][0]=='country'){
				$countr=$result['short_name'];
				}
			}
			$countryc=$countr;
			//
			$collection = Mage::getModel('storelocator/location')->getCollection();
			foreach($collection as $collect)
			{			
					$ordinate=explode(',',$collect['ordinate_store']);
					if ($collect['country_code']==$countryc){
					$x1=$central_lat;
					   $y1=$central_lng;
					   $x2=$ordinate[0];
					   $y2=$ordinate[1];
					  $earthRadius = 6371;
					  $latFrom = deg2rad($x1);
					  $lonFrom = deg2rad($y1);
					  $latTo = deg2rad($x2);
					  $lonTo = deg2rad($y2);

					  $latDelta = $latTo - $latFrom;
					  $lonDelta = $lonTo - $lonFrom;

					  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
						cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
						$b=number_format($angle * $earthRadius,1);
						$b = str_replace(",","mdtest",$b);
						$b = str_replace(".","point",$b);
						$b = str_replace("mdtest",".",$b);
						$b = str_replace("point",",",$b);
						
					// $d[]= array ('name'=>$collect['title'],'address'=>$collect['address_display'],'lat'=>$ordinate[0],'lng'=>$ordinate[1],'distance'=>506.9814,'mydistance'=>$b,'moreinfo'=>$collect['open_hours'],'image1'=>$collect['image1'],'image2'=>$collect['image2'],'image3'=>$collect['image3'],'image4'=>$collect['image4'],'phone'=>$collect['phone'],'email'=>$collect['website_url'],'program_products'=>$collect['program_products'],'special_features'=>$collect['special_features'],'category_dealer'=>$collect['category_dealer'],'filter4'=>$collect['filter4'],'filter5'=>$collect['filter5']);
					
					// if($angle<=$radius_backend){	
						$locations[] = array ('name'=>$collect['title'],'address'=>$collect['address_display'],'lat'=>$ordinate[0],'lng'=>$ordinate[1],'distance'=>506.9814,'mydistance'=>$b,'moreinfo'=>$collect['open_hours'],'image1'=>$collect['image1'],'image2'=>$collect['image2'],'image3'=>$collect['image3'],'image4'=>$collect['image4'],'phone'=>$collect['phone'],'email'=>$collect['website_url'],'program_products'=>$collect['program_products'],'special_features'=>$collect['special_features'],'category_dealer'=>$collect['category_dealer'],'filter4'=>$collect['filter4'],'filter5'=>$collect['filter5']);
						// $t=true;
					// }
				}
			}
			// if($t==false){
					// $locations=$d;
				// }
		}
	}
	else{
		if($country==''){
			//
			$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$central_lat,$central_lng&key=AIzaSyDnnBdSV0R6apiFjcQlWT69q6s_FRFL--g";
			$response = file_get_contents($url);
			
			$json = json_decode($response,true);		
			$results = $json['results'][0]['address_components'];
			foreach ($results as $result) {
				if($result['types'][0]=='country'){
				$countr=$result['short_name'];
				}
			}
			$countryc=$countr;
			//
			$collection = Mage::getModel('storelocator/location')->getCollection();
			foreach($collection as $collect)
			{			
					$ordinate=explode(',',$collect['ordinate_store']);
					if ($collect['country_code']==$countryc){
					$x1=$central_lat;
					   $y1=$central_lng;
					   $x2=$ordinate[0];
					   $y2=$ordinate[1];
					  $earthRadius = 6371;
					  $latFrom = deg2rad($x1);
					  $lonFrom = deg2rad($y1);
					  $latTo = deg2rad($x2);
					  $lonTo = deg2rad($y2);

					  $latDelta = $latTo - $latFrom;
					  $lonDelta = $lonTo - $lonFrom;

					  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
						cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
						$b=number_format($angle * $earthRadius,1);
						$b = str_replace(",","mdtest",$b);
						$b = str_replace(".","point",$b);
						$b = str_replace("mdtest",".",$b);
						$b = str_replace("point",",",$b);
					// $d[]=	array ('name'=>$collect['title'],'address'=>$collect['address_display'],'lat'=>$ordinate[0],'lng'=>$ordinate[1],'distance'=>506.9814,'mydistance'=>$b,'moreinfo'=>$collect['open_hours'],'image1'=>$collect['image1'],'image2'=>$collect['image2'],'image3'=>$collect['image3'],'image4'=>$collect['image4'],'phone'=>$collect['phone'],'email'=>$collect['website_url'],'program_products'=>$collect['program_products'],'special_features'=>$collect['special_features'],'category_dealer'=>$collect['category_dealer'],'filter4'=>$collect['filter4'],'filter5'=>$collect['filter5']);
					
					// if($angle<=$radius_backend){	
						$locations[] = array ('name'=>$collect['title'],'address'=>$collect['address_display'],'lat'=>$ordinate[0],'lng'=>$ordinate[1],'distance'=>506.9814,'mydistance'=>$b,'moreinfo'=>$collect['open_hours'],'image1'=>$collect['image1'],'image2'=>$collect['image2'],'image3'=>$collect['image3'],'image4'=>$collect['image4'],'phone'=>$collect['phone'],'email'=>$collect['website_url'],'program_products'=>$collect['program_products'],'special_features'=>$collect['special_features'],'category_dealer'=>$collect['category_dealer'],'filter4'=>$collect['filter4'],'filter5'=>$collect['filter5']);
						// $t=true;
					// }
				}
				
				
			}
			// if($t==false){
					// $locations=$d;
				// }
			
		}
		else
		{
			$collection = Mage::getModel('storelocator/location')->getCollection();
			foreach($collection as $collect)
			{			
					$ordinate=explode(',',$collect['ordinate_store']);
					if ($collect['country_code']==$country){
					$x1=$central_lat;
					   $y1=$central_lng;
					   $x2=$ordinate[0];
					   $y2=$ordinate[1];
					  $earthRadius = 6371;
					  $latFrom = deg2rad($x1);
					  $lonFrom = deg2rad($y1);
					  $latTo = deg2rad($x2);
					  $lonTo = deg2rad($y2);

					  $latDelta = $latTo - $latFrom;
					  $lonDelta = $lonTo - $lonFrom;

					  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
						cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
						$b=number_format($angle * $earthRadius,1);
						$b = str_replace(",","mdtest",$b);
						$b = str_replace(".","point",$b);
						$b = str_replace("mdtest",".",$b);
						$b = str_replace("point",",",$b);
					// $d[]=array ('name'=>$collect['title'],'address'=>$collect['address_display'],'lat'=>$ordinate[0],'lng'=>$ordinate[1],'distance'=>506.9814,'mydistance'=>$b,'moreinfo'=>$collect['open_hours'],'phone'=>$collect['phone'],'email'=>$collect['website_url'],'program_products'=>$collect['program_products'],'special_features'=>$collect['special_features'],'category_dealer'=>$collect['category_dealer'],'filter4'=>$collect['filter4'],'filter5'=>$collect['filter5']);
					
					// if($angle<=$radius_backend){	
						$locations[] = array ('name'=>$collect['title'],'address'=>$collect['address_display'],'lat'=>$ordinate[0],'lng'=>$ordinate[1],'distance'=>506.9814,'mydistance'=>$b,'moreinfo'=>$collect['open_hours'],'phone'=>$collect['phone'],'email'=>$collect['website_url'],'program_products'=>$collect['program_products'],'special_features'=>$collect['special_features'],'category_dealer'=>$collect['category_dealer'],'filter4'=>$collect['filter4'],'filter5'=>$collect['filter5']);
						// $t=true;
					// }
					
				}
				
				
			}
			// if($t==false){
						// $locations=$d;
					// }
		}
	}
	
	
	// function cmp($b1, $b2){
		// return $b1['mydistance'] - $b2['mydistance'];
	// }
	// usort($locations, "cmp");
	// -----------------------------------SORT--------------------------//
	function Getfloat($str) {
	  if(strstr($str, ",")) {
		$str = str_replace(".", "", $str); // replace dots (thousand seps) with blancs
		$str = str_replace(",", ".", $str); // replace ',' with '.'
	  }
	 
	  if(preg_match("#([0-9\.]+)#", $str, $match)) { // search for number that may contain '.'
		return floatval($match[0]);
	  } else {
		return floatval($str); // take some last chances with floatval
	  }
	}
	if($sort=='distance_asc'){
		$mydistance=array();
		foreach ($locations as $key => $row)
			{
				$mydistance[$key] = Getfloat($row['mydistance']);
			}
			array_multisort($mydistance, SORT_ASC, $locations);
	}
	if($sort=='distance_desc'){
		$mydistance=array();
		foreach ($locations as $key => $row)
			{
				$mydistance[$key] = Getfloat($row['mydistance']);
			}
			array_multisort($mydistance, SORT_DESC, $locations);
	}
	if($sort=='name_asc'){
		$name=array();
		foreach ($locations as $key => $row)
			{
				$name[$key] = $row['name'];
			}
			array_multisort($name, SORT_ASC, $locations);
	}
	if($sort=='name_desc'){
		$name=array();
		foreach ($locations as $key => $row)
			{
				$name[$key] = $row['name'];
			}
			array_multisort($name, SORT_DESC, $locations);
	}
	if($sort==''){
		$mydistance=array();
		foreach ($locations as $key => $row)
			{
				$mydistance[$key] = Getfloat($row['mydistance']);
			}
			array_multisort($mydistance, SORT_ASC, $locations);
	}
	// -----------------------------------END--------------------------//

	foreach ($locations as $location) {
		if(isset($tm1)){
			if($tm5 !=''){
				if($tm4 !=''){
					if($tm1 !=''){
						if($tm2 !=''){
							if($tm3 !=''){
								if($location['category_dealer']==$tm3 && $location['special_features']==$tm2 && $location['program_products']==$tm1 && $location['filter4']==$tm4 && $location['filter5']==$tm5){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
							else
							{
								if($location['special_features']==$tm2 && $location['program_products']==$tm1 && $location['filter4']==$tm4 && $location['filter5']==$tm5){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
						}
						else
						{
							if($tm3 !=''){
								if($location['category_dealer']==$tm3 && $location['program_products']==$tm1 && $location['filter4']==$tm4 && $location['filter5']==$tm5){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
							else
							{
								if($location['program_products']==$tm1 && $location['filter4']==$tm4 && $location['filter5']==$tm5){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
						}
					}
					else{
						if($tm2 !=''){
							if($tm3 !=''){
								if($location['category_dealer']==$tm3 && $location['special_features']==$tm2 && $location['filter4']==$tm4 && $location['filter5']==$tm5){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
							else
							{
								if($location['special_features']==$tm2 && $location['filter4']==$tm4 && $location['filter5']==$tm5){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
						}
						else
						{
							if($tm3 !=''){
								if($location['category_dealer']==$tm3 && $location['filter4']==$tm4 && $location['filter5']==$tm5){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
							else
							{
								if($location['filter4']==$tm4 && $location['filter5']==$tm5){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
						}
					}
				}
				else{
					if($tm1 !=''){
						if($tm2 !=''){
							if($tm3 !=''){
								if($location['category_dealer']==$tm3 && $location['special_features']==$tm2 && $location['program_products']==$tm1 && $location['filter5']==$tm5){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
							else
							{
								if($location['special_features']==$tm2 && $location['program_products']==$tm1 && $location['filter5']==$tm5){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
						}
						else
						{
							if($tm3 !=''){
								if($location['category_dealer']==$tm3 && $location['program_products']==$tm1 && $location['filter5']==$tm5){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
							else
							{
								if($location['program_products']==$tm1 && $location['filter5']==$tm5){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
						}
					}
					else{
						if($tm2 !=''){
							if($tm3 !=''){
								if($location['category_dealer']==$tm3 && $location['special_features']==$tm2 && $location['filter5']==$tm5){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
							else
							{
								if($location['special_features']==$tm2 && $location['filter5']==$tm5){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
						}
						else
						{
							if($tm3 !=''){
								if($location['category_dealer']==$tm3 && $location['filter5']==$tm5){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
							else
							{
								if($location['filter5']==$tm5){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
						}
					}
				}
			}
			else{
				if($tm4 !=''){
					if($tm1 !=''){
						if($tm2 !=''){
							if($tm3 !=''){
								if($location['category_dealer']==$tm3 && $location['special_features']==$tm2 && $location['program_products']==$tm1 && $location['filter4']==$tm4){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
							else
							{
								if($location['special_features']==$tm2 && $location['program_products']==$tm1 && $location['filter4']==$tm4){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
						}
						else
						{
							if($tm3 !=''){
								if($location['category_dealer']==$tm3 && $location['program_products']==$tm1 && $location['filter4']==$tm4){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
							else
							{
								if($location['program_products']==$tm1 && $location['filter4']==$tm4){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
						}
					}
					else{
						if($tm2 !=''){
							if($tm3 !=''){
								if($location['category_dealer']==$tm3 && $location['special_features']==$tm2 && $location['filter4']==$tm4){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
							else
							{
								if($location['special_features']==$tm2 && $location['filter4']==$tm4){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
						}
						else
						{
							if($tm3 !=''){
								if($location['category_dealer']==$tm3 && $location['filter4']==$tm4){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
							else
							{
								if($location['filter4']==$tm4){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
						}
					}
				}
				else{
					if($tm1 !=''){
						if($tm2 !=''){
							if($tm3 !=''){
								if($location['category_dealer']==$tm3 && $location['special_features']==$tm2 && $location['program_products']==$tm1){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
							else
							{
								if($location['special_features']==$tm2 && $location['program_products']==$tm1){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
						}
						else
						{
							if($tm3 !=''){
								if($location['category_dealer']==$tm3 && $location['program_products']==$tm1){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
							else
							{
								if($location['program_products']==$tm1){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
						}
					}
					else{
						if($tm2 !=''){
							if($tm3 !=''){
								if($location['category_dealer']==$tm3 && $location['special_features']==$tm2){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
							else
							{
								if($location['special_features']==$tm2){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
						}
						else
						{
							if($tm3 !=''){
								if($location['category_dealer']==$tm3){
									$node = $dom->createElement("marker");
									$newnode = $parnode->appendChild($node);
										foreach ( $location as $key=>$value ) 
										{				
												$newnode->setAttribute($key, $value);
										}
								}
							}
							else
							{
								$node = $dom->createElement("marker");
								$newnode = $parnode->appendChild($node);
									foreach ( $location as $key=>$value ) 
									{				
											$newnode->setAttribute($key, $value);
									}
							}
						}
					}
				}
			}
			
		}
		else
		{
			$node = $dom->createElement("marker");
			$newnode = $parnode->appendChild($node);
				foreach ( $location as $key=>$value ) 
				{				
						$newnode->setAttribute($key, $value);
				}
		}
	}
	
	echo $dom->saveXML();	
    }
	
}