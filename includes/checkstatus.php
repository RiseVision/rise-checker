<?php
  /**
   * @author Jan
   * @link https://github.com/lepetitjan/rise-checker
   * @license https://github.com/lepetitjan/rise-checker/blob/master/LICENSE
   */

echo "[ STATUS ]\n";
echo "\t\t\tLet's check if our delegate is still running...\n";

// Check status with rise_manager.bash. Use PHP's ob_ function to create an output buffer
	ob_start();
  $check_status = passthru("cd $pathtoapp && bash rise_manager.bash status | cut -z -b1-3");
	$check_output = ob_get_contents();
	ob_end_clean();

// If status is not OK...
  if(strpos($check_output, $okayMsg) === false){
   		
	  // Echo something to our log file
   	echo "\t\t\tDelegate not running/healthy. Let me restart it for you...\n";
   	if($telegramEnable === true){
   		$Tmsg = "Delegate ".gethostname()." not running/healthy. I will restart it for you...";
   		passthru("curl -s -d 'chat_id=$telegramId&text=$Tmsg' $telegramSendMessage >/dev/null");
   	}
   	
    echo "\t\t\tStopping all forever processes...\n";
   		passthru("forever stopall >/dev/null");
   	echo "\t\t\tStarting Rise forever proces...\n";
   		passthru("cd $pathtoapp && forever start app.js >/dev/null");
   
  }else{
  	echo "\t\t\tDelegate is still running...\n";
  }