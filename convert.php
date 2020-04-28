<?php
require_once('vendor/autoload.php');

$inputFileName = './test.xlsx';
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
$highestRow = $spreadsheet->getActiveSheet()->getHighestRow();

require_once('./db.inc.php');

for ($i = 2; $i <= $highestRow; $i++) {
    //若是某欄位值為空，代表那一列可能都沒資料，便跳出迴圈
    if ($spreadsheet->getActiveSheet()->getCell('A' . $i)->getValue() === '' || $spreadsheet->getActiveSheet()->getCell('A' . $i)->getValue() === null) break;

    $sql = "INSERT INTO `items` (`id`,`itemId`, `itemName`, `itemImg`,`itemSize`, `itemPrice`, `itemQty`, `itemCategoryId`, `brandId`,`fragranceId`,`created_at`, `updated_at`, `imgURL`) values (?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $arrParam = [
        $spreadsheet->getActiveSheet()->getCell('A' . $i)->getValue(),
        $spreadsheet->getActiveSheet()->getCell('B' . $i)->getValue(),
        $spreadsheet->getActiveSheet()->getCell('C' . $i)->getValue(),
        $spreadsheet->getActiveSheet()->getCell('D' . $i)->getValue(),
        $spreadsheet->getActiveSheet()->getCell('E' . $i)->getValue(),
        $spreadsheet->getActiveSheet()->getCell('F' . $i)->getValue(),
        $spreadsheet->getActiveSheet()->getCell('G' . $i)->getValue(),
        $spreadsheet->getActiveSheet()->getCell('H' . $i)->getValue(),
        $spreadsheet->getActiveSheet()->getCell('I' . $i)->getValue(),
        $spreadsheet->getActiveSheet()->getCell('J' . $i)->getValue(),
        $spreadsheet->getActiveSheet()->getCell('K' . $i)->getValue(),
        $spreadsheet->getActiveSheet()->getCell('L' . $i)->getValue(),
        $spreadsheet->getActiveSheet()->getCell('M' . $i)->getValue()


    ];
    $stmt->execute($arrParam);
    if ($stmt->rowCount() > 0) {
        echo $spreadsheet->getActiveSheet()->getCell('A' . $i)->getValue() . "\n";
        echo $spreadsheet->getActiveSheet()->getCell('B' . $i)->getValue() . "\n";
        echo $spreadsheet->getActiveSheet()->getCell('C' . $i)->getValue() . "\n";
        echo $spreadsheet->getActiveSheet()->getCell('D' . $i)->getValue() . "\n";
        echo $spreadsheet->getActiveSheet()->getCell('E' . $i)->getValue() . "\n";
        echo $spreadsheet->getActiveSheet()->getCell('F' . $i)->getValue() . "\n";
        echo $spreadsheet->getActiveSheet()->getCell('G' . $i)->getValue() . "\n";
        echo $spreadsheet->getActiveSheet()->getCell('H' . $i)->getValue() . "\n";
        echo $spreadsheet->getActiveSheet()->getCell('I' . $i)->getValue() . "\n";
        echo $spreadsheet->getActiveSheet()->getCell('J' . $i)->getValue() . "\n";
        echo $spreadsheet->getActiveSheet()->getCell('K' . $i)->getValue() . "\n";
        echo $spreadsheet->getActiveSheet()->getCell('L' . $i)->getValue() . "\n";
        echo $spreadsheet->getActiveSheet()->getCell('M' . $i)->getValue() . "\n";
    }
}
