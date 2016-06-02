<?php
class rtCamp {
   public static $htmlString;
   public function __construct ()
   {
   		$this->htmlString = file_get_contents('http://www.imdb.com/chart/top');

   }
   public function getMovies($n)
   {
   		$document = new DOMDocument();
		@ $document->loadHTML($this->htmlString);
		$selector = new DOMXPath($document);
		$movie_name = "";
		$results = $selector->query('//tr//td[2]//a');
		$i = 1;
		foreach($results as $node) {
				if($i> $n)
				{
					break;
				}
				
    			$movie_name = $node->nodeValue ;
    			echo $i.") ".$movie_name."\n";
				$i++;
			}

   }//getMovies

   public function getMovieActor($n , $actor)
   {
 $actor =  trim($actor,'""');
 $actor  = strtolower($actor );
$document = new DOMDocument();
		@ $document->loadHTML($this->htmlString);
		$selector = new DOMXPath($document);
		$movie_name = "";
		$movies =  array();
		$results = $selector->query('//tr//td[2]//a');
		$i = 1;
		foreach($results as $node) {
				if($i> $n)
				{
					break;
				}
				
    			$movie_name = $node->nodeValue ;
    			echo $i.") ".$movie_name."\n";
    			$movies[$i-1] = $movie_name;
				$i++;
			}
echo "\nMovie ".$actor." played in :\n";



   $html = new DOMDocument();
  @ $html->loadHTML($this->htmlString);
  $ids = array();
  $j = 1;
  $p = 0;
  //echo $n . "  ".$actor;
  foreach ($html->getElementsByTagName('a') as $link) {
    $url = $link->getAttribute('href');
    $act = $link->getAttribute('title');
   if($j>$n)
   {
   	break;
   }
    if (strstr($url, '/title/tt') && strlen($act) > 0)
    {
    	if(strpos(strtolower($act),$actor) != false)
    	{
    			echo ($p+1).") ".$movies[$j-1]."\n";
    			$p++;
    	}

  	 	//echo $j." ".$act."\n";
  	 	$j++;
    }
     

  }
  if($p==0){
  	echo "------------NO MOVIES-----------\n";
  }
  echo "\n";
  //print_r($ids); 
		
			
   }//method

}//class

$obj = new rtCamp
if(isset($argv[1]) && isset($argv[2]))
{
	$n1 = ( $argv[1] );
	$n2 = $argv[2];
	if(is_numeric($n1) && $n1 < 250 && strlen($n2)>=3 )
	{
		$obj->getMovieActor($argv[1] , $argv[2]);
	} 
	else
	{
		echo "N should be  Integer and less than 250 && Actor Name Is string type (Length >= 3)\n";
	}
}
else if(isset($argv[1]))
{
	$n1 = ( $argv[1] );
	if(is_numeric($n1) && $n1 < 250)
	{
		$obj->getMovies($argv[1]);
	} 
	else
	{
		echo "N should be  Integer and less than 250\n";
	}
	//var_dump(is_int($n1));
	//var_dump(is_numeric($n1));
	
}
else
{
	echo "\n";
	echo "Please Provide Input";
	echo "\n";
}

?>
