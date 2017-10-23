<?php
//$nv = new View();
//$nv->render('ContactUs');
class View {

	function __construct() {
		//echo 'this is the view';
	}

	public function render($name, $args = null, $notIndexPage = false, $noInclude = false)
	{
		if ($noInclude == true) {
                        if(!$notIndexPage)
                        {
                            $name .= '/index.php';
                        }
			require 'views/' . $name;	
		}
		else {
                        if(!$notIndexPage)
                        {
                            $name .= '/index.php';
                        }
                        require 'views/general.php';
		}
	}

}