<?php   

  
 $data = api('shop/shipping/gateways/country/shipping_to_country/get', "is_active=y");
 $data_disabled = api('shop/shipping/gateways/country/shipping_to_country/get', "is_active=n");
 
 $countries_used = array();
  $countries_all = array();
 if( $data == false){
	 $data = array(); 
 }
  if(is_array($data)){
	foreach($data as $key => $item){
			if(trim(strtolower($item['shiping_country']))  == 'worldwide' ){
				 $countries_all = mw('Microweber\Forms')->countries_list();
				 unset($data[$key]);
				  if(is_array($countries_all)){
					  
					  foreach($countries_all as  $countries_new){
						  $data[] = array('shiping_country' =>  $countries_new);
					  }
 	 
 					}
			}
	}
	
	
	
	
}


 
 if(is_array($data)){
	foreach($data as $key =>$item){
		$skip = false;
		if(is_array($data_disabled)){
			foreach($data_disabled as $item_disabled){
				if($item['shiping_country']  == $item_disabled['shiping_country'] ){
					$skip = 1;
					unset($data[$key]);
				}
			}
		}

	}
  }
 
 $class = '';
 if(isset($params['class']) and $params['class'] != '' and $params['class']){
	 $class = $params['class'];
	 
 }
 
 
 
  ?>
  
  
  <select name="country" class="<?php print $class  ?>">
  <?php foreach($data  as $item): ?>
  <option value="<?php print $item['shiping_country'] ?>"  <?php if(isset($_SESSION['shiping_country']) and $_SESSION['shiping_country'] == $item['shiping_country']): ?> selected="selected" <?php endif; ?>><?php print $item['shiping_country'] ?></option>
  <?php endforeach ; ?>
</select>