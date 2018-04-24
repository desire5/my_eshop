<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("create dir");
?>
<?
use \Bitrix\Main\IO\File;

class AddCatalogs
{

    //private $filePath = $_SERVER["DOCUMENT_ROOT"]."/create-dir/set_catalogs.txt";


//    public function __construct()
//    {
//        $this->addDir();
//    }



    function rus2translit($string)
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



    private function addDir($nameFolder)
    {
        $nameFolder = trim($nameFolder);
        $nameFolder = rus2translit($nameFolder);
        $content = '<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
            $APPLICATION->SetTitle("TESTOVA");?>
            delivery1
            <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>';
        $content2 = '<? $sSectionName = "' . $nameFolder . '";
            $arDirProperties = Array();
            ?>';

        File::putFileContents(
            $_SERVER["DOCUMENT_ROOT"] . "/create-dir/$nameFolder/index.php", $content);
        File::putFileContents(
            $_SERVER["DOCUMENT_ROOT"] . "/create-dir/$nameFolder/.section.php", $content2);

    }

    public function openFile()
    {
        $fp = fopen("$_SERVER["DOCUMENT_ROOT"].'/create-dir/set_catalogs.txt'", "r");
        if ($fp)
        {
            while (($buffer = fgets($fp, 4096)) !== false)
            {
                $catalog = explode(" ", $buffer);
                foreach ($catalog as $id => $item)
                {
                    $this->addDir($catalog[$id]);
                    //pre($catalog[$id]);
                }

            }
            if (!feof($fp))
            {
                echo "Ошибка: fgets() неожиданно потерпел неудачу\n";
            }

           fclose($fp);
        }

    }

}

(new AddCatalogs)->openFile();



?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>