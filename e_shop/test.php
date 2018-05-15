<?
$string = "2018-04-27";
$pattern = "/([0-9]{4})-([0-9]{2})-([0-9]{2})/";
// day 27, mouth 04, year 2018

$replacement = "day $3, mouth $2, year $1";
echo preg_replace($pattern,$replacement,$string );

define('ROOT', dirname(__FILE__));
//echo dirname(__FILE__);

$array_path = array(

    "/model/",
    "/components/"
);

foreach ($array_path as $path)
{
    $path = ROOT. $path . "ProductController".".php";
}

echo $path;

?>