<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("create dir");
?>
<?
use \Bitrix\Main\IO\File;

class AddCatalogs
{

    private $filePath;




    public function __construct()
    {
        echo 'status ok "create-dir/"<br>';
    }

    public function rus2translit($string)
    {
        $converter = array(
            'а' => 'a', 'б' => 'b', 'в' => 'v',
            'г' => 'g', 'д' => 'd', 'е' => 'e',
            'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
            'и' => 'i', 'й' => 'y', 'к' => 'k',
            'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r',
            'с' => 's', 'т' => 't', 'у' => 'u',
            'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
            'ь' => '\'', 'ы' => 'y', 'ъ' => '\'',
            'э' => 'e', 'ю' => 'yu', 'я' => 'ya',

            'А' => 'A', 'Б' => 'B', 'В' => 'V',
            'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
            'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
            'И' => 'I', 'Й' => 'Y', 'К' => 'K',
            'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R',
            'С' => 'S', 'Т' => 'T', 'У' => 'U',
            'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
            'Ь' => '\'', 'Ы' => 'Y', 'Ъ' => '\'',
            'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
        );
        return strtr($string, $converter);
    }

    public function getRoot()
    {
        return $_SERVER["DOCUMENT_ROOT"].'/create-dir/.left.menu.php';

    }

    public function addLeftMenu()
    {
        $pathMenu = $this->getRoot();


        if( File::isFileExists($pathMenu))
        {
            echo "file okkk";
            //include file with name of dir
            include ($pathMenu);

            $aMenuLinks = array();
            if(is_array($aMenuLinks))
            {
                // data of names
                $nameOfDir = self::openFile();
                foreach($nameOfDir as $dir)
                {
                    $aMenuLinks[] = array(
                        "$dir",
                        "/create/index.php",
                        array(),
                        array(),
                        ""
                    );
                }
                echo "<pre>";
                print_r($aMenuLinks);
                echo "</pre>";

                File::putFileContents(
                    $_SERVER["DOCUMENT_ROOT"] . "/create-dir/.left.menu.php", $aMenuLinks,1);

            }


        }
        else
        {
            $aMenuLinks = '<?
                        $aMenuLinks = Array(
                        
                        );
                        ?>';
            File::putFileContents(
                $_SERVER["DOCUMENT_ROOT"] . "/create-dir/.left.menu.php", $aMenuLinks);
        }



    }
//here pipec
    public function addDir()
    {
        $dirTranslit = self::openFile();
       //
         print_r($dirTranslit);
        echo "<br>";
        foreach ($dirTranslit as $el)
        {


            echo '<pre>';
            print_r($el);
            echo '<pre>';
//            echo '111';

            $content = '<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
            $APPLICATION->SetTitle("TESTOVA");?>
            
            <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>';

            $content2 = '<? $sSectionName = "atya";
            $arDirProperties = Array();
            ?>';

//            $content3 = '<? $sSectionName = "zimno";
//            $arDirProperties = Array();
/*            ?>';*/

                File::putFileContents(
                    $_SERVER["DOCUMENT_ROOT"] . "/create-dir/".$el."/index.php", $content);
                File::putFileContents(
                    $_SERVER["DOCUMENT_ROOT"] . "/create-dir/$el/.section.php", $content2);

            File::putFileContents(
                $_SERVER["DOCUMENT_ROOT"] . "/create-dir/zimno/index.php", $content);
//            File::putFileContents(
//                $_SERVER["DOCUMENT_ROOT"] . "/create-dir/zimno/.section.php", $content3);


// create left.menu
//        File::putFileContents(
//            $_SERVER["DOCUMENT_ROOT"] . "/create-dir/.left.menu.php", $left_menu);

        }
    }


    public function doing()
    {

    }

    public function openFile()
    {
        $fp = fopen($_SERVER["DOCUMENT_ROOT"] . "/create-dir/set_catalogs.txt", "r");
        $dirsArr = array();
        $translit = array();
        if ($fp) {
            while (($buffer = fgets($fp, 4096)) !== false)
            {
               $dirsArr[] = ltrim($buffer," ");

            }
            foreach ($dirsArr as $el)
            {
                $translit[] = $this->rus2translit($el);

            }
            return $translit;

            if (!feof($fp)) {
                echo "Ошибка: fgets() неожиданно потерпел неудачу\n";
            }

            fclose($fp);
        }
    }
}


//(new AddCatalogs())->openFile();
$obj = new AddCatalogs();
$res = $obj->openFile();
            echo "<pre>";
            print_r( $res);
            echo "</pre>";

$obj->addDir();
$obj->addLeftMenu();

//foreach ($i as $item) {
//    pre(trim($item));
//}




?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>