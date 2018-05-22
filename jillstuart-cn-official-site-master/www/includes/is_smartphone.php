<?
	function is_smartphone() {
		$target = '/iPhone|iPod|Android.*Mobile|Blackberry|IEMobile/';
//	/*	tablet 			$target = '/iPad|Android(?!.*Mobile)|Kindle|Silk|PlayBook|RIM\sTablet/'; */
//	/* 	ios 			$target = '/iPhone|iPad/'; */
//	/*	Android			$target = '/Android/'; */
//	/*	Kindle			$target = '/Kindle|Silk/'; */
//	/*	Blackberry		$target = '/Blackberry|PlayBook|rim\sTablet/'; */
//	/*	windowsphone	$target = '/IEMobile/'; */
		$ua = getenv( 'HTTP_USER_AGENT' );
		if( preg_match( $target, $ua )){
			return true;
		}
		else {
			return false;
		}
	}
?>