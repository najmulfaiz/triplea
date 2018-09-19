<?php 
namespace App\Lib;
use App\Log as L;
use Request;
/**
* 
*/
class Log 
{
	
	public function log($logs,$userid){
		$log = new L;
		$log->log = $logs;
		$log->userid = $userid;
		$log->ip_address=Request::ip();
		$save = $log->save();

		return $save;
	}
}