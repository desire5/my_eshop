<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("create dir");
include($_SERVER["DOCUMENT_ROOT"]."/create-dir/.left.menu.php");
//echo "<pre>";
//print_r($aMenuLinks);
//echo "</pre>";
?>
<?
/*//use \Bitrix\Main\IO\File;
//
//class AddCatalogs
//{
//
//    private $filePath;
//    public $catalog;
//    public $count;
//    public $buffer;
//
//
//    public function __construct()
//    {
//        echo 'status ok "create-dir/"<br>';
//    }
//
//    public function rus2translit($string)
//    {
//        $converter = array(
//            'а' => 'a', 'б' => 'b', 'в' => 'v',
//            'г' => 'g', 'д' => 'd', 'е' => 'e',
//            'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
//            'и' => 'i', 'й' => 'y', 'к' => 'k',
//            'л' => 'l', 'м' => 'm', 'н' => 'n',
//            'о' => 'o', 'п' => 'p', 'р' => 'r',
//            'с' => 's', 'т' => 't', 'у' => 'u',
//            'ф' => 'f', 'х' => 'h', 'ц' => 'c',
//            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
//            'ь' => '\'', 'ы' => 'y', 'ъ' => '\'',
//            'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
//
//            'А' => 'A', 'Б' => 'B', 'В' => 'V',
//            'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
//            'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
//            'И' => 'I', 'Й' => 'Y', 'К' => 'K',
//            'Л' => 'L', 'М' => 'M', 'Н' => 'N',
//            'О' => 'O', 'П' => 'P', 'Р' => 'R',
//            'С' => 'S', 'Т' => 'T', 'У' => 'U',
//            'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
//            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
//            'Ь' => '\'', 'Ы' => 'Y', 'Ъ' => '\'',
//            'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
//        );
//        return strtr($string, $converter);
//    }
//
//    public function getRoot()
//    {
//        return $this->filePath = $_SERVER["DOCUMENT_ROOT"].'/create-dir/.left.menu.php';
//
//    }
//
//    public function addLeftMenu()
//    {
//
//        if( File::isFileExists($this->getRoot()))
//        {
//            echo "file okkk1w";
//            //include file with name of dir
//            include ($this->filePath);
//            //pre($aMenuLinks);
//
//
//            foreach ($this->catalog as $item) {
//                foreach ($item as $el) {
//                    $el= $this->rus2translit($el);
//                    $aMenuLinks[] = 'Array(
//                        "'.$el.'",
//                        "/create-dir/'.$el.'/index.php",
//                        Array(),
//                        Array(),
//                        ""
//                    ),';
//                }
//
//            }
//            echo "aaa";
//            //pre($aMenuLinks);
//
//        }
//
//
////        File::putFileContents(
////            $_SERVER["DOCUMENT_ROOT"] . "/create-dir/.left.menu.php", $aMenuLinks,1);
//    }
////here pipec
//    public function addDir()
//    {
//        $this->buffer = explode(" ",$this->buffer);
//        //foreach ($this->buffer as $item)
//
//
//
//                //pre($this->buffer);
//                $content = '<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//            $APPLICATION->SetTitle("TESTOVA");*/?>
//            delivery1
/*            <?/*//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");*/*/?>';*/
//
//                $content2 = '--><?/*/*// $sSectionName = " $el";
//            $arDirProperties = Array();
/*            ?>';*/
//
////                File::putFileContents(
////                    $_SERVER["DOCUMENT_ROOT"] . "/create-dir/$el/index.php", $content);
////                File::putFileContents(
////                    $_SERVER["DOCUMENT_ROOT"] . "/create-dir/$el/.section.php", $content2);
//
//// create left.menu
////        File::putFileContents(
////            $_SERVER["DOCUMENT_ROOT"] . "/create-dir/.left.menu.php", $left_menu);
//
//        }
//
//
//
//    public function doing()
//    {
//
//    }
//
//    public function openFile()
//    {
//        $fp = fopen($_SERVER["DOCUMENT_ROOT"] . "/create-dir/set_catalogs.txt", "r");
//        if ($fp)
//        {
//            while (($this->buffer = fgets($fp, 4096)) !== false) {
//                $this->buffer = ltrim($this->buffer," ");
//                $this->buffer = $this->rus2translit($this->buffer);
//                //echo $this->buffer;
//                //echo "1w1";
//                $this->catalog[] = explode(" ", $this->buffer);
//                foreach ($this->catalog as $id => $item) {
//                    //$this->addDir($item);
//
//                        echo "w";
//                        pre($item);
//
//                }
//                //return $this->catalog;
//            }
//            if (!feof($fp)) {
//                echo "Ошибка: fgets() неожиданно потерпел неудачу\n";
//            }
//
//            fclose($fp);
//        }
//    }
//}
//
//
////(new AddCatalogs())->openFile();
//$obj = new AddCatalogs();
//$obj->openFile();
//$obj->addDir();
////$obj->addLeftMenu();
//
////foreach ($i as $item) {
////    pre(trim($item));
////}*/




?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>