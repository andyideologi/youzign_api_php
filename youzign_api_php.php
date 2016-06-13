<?php
/*

*/


if( ( isset($_POST['add_youzign']) )  &&  ( $_POST['add_youzign'] !== "") ){

     $youzign_token= $_POST['youzign_token']; 
     $youzign_key= $_POST['youzign_key']; 
     $user_id= $_SESSION['USER_ID']; 
     
                    
                        //verify keys.....................
                        $ch = curl_init();
						curl_setopt($ch, CURLOPT_URL,"https://www.youzign.com/api/" ); 
						
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_POST,true);
						curl_setopt($ch, CURLOPT_POSTFIELDS,"key=$youzign_key&token=$youzign_token"); 
										
					       //curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: text/plain')); 
						$result=curl_exec ($ch);
						$result_verify =  json_decode($result);
            
                       echo "Error :".$result_verify->{'error'};  // refer why this : http://fr2.php.net/function.json-decode.php
			
                        if( isset($result_verify->{'error'})){
                            
                            $_SESSION['FAILED_MESSAGE']='Invalid key or token. Please re-check and try again..';

                        }else{
                                
                             $insert_keys = parent::dbQuery("INSERT INTO `youzign`( `youzign_key`, `youzign_token`, `youzign_user_id`) VALUES ('$youzign_key','$youzign_key',$user_id)");
    
                            if($insert_keys){
                                   $_SESSION['SUCCESS_MESSAGE']='Youzign keys added successfully...';
                             }   
                        }
                        //.................................

                        // get design list..................
                        $ch = curl_init();
						curl_setopt($ch, CURLOPT_URL,"https://www.youzign.com/api/designs/" ); 
						
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_POST,true);
						curl_setopt($ch, CURLOPT_POSTFIELDS,"key=$youzign_key&token=$youzign_token"); 
										
					       //curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: text/plain')); 
						$result=curl_exec ($ch);
						$result=  json_decode($result);
			
                       echo "<pre>";
                       print_r($result);
                       echo "count:".count($result);
                       //..................................

                      // get user profile details......
                      $ch = curl_init();
						curl_setopt($ch, CURLOPT_URL,"https://www.youzign.com/api/profile/" ); 
						
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_POST,true);
						curl_setopt($ch, CURLOPT_POSTFIELDS,"key=$youzign_key&token=$youzign_token"); 
										
					       //curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: text/plain')); 
						$result=curl_exec ($ch);
						$result=  json_decode($result);
			
                       echo "<pre>";
                       print_r($result);
                       echo "count:".count($result);
}	              //....................................
//....................................


?>