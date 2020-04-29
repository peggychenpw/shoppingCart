<?php
    require_once('./checkAdmin.php'); //引入登入判斷
    require_once('../db.inc.php'); //引用資料庫連線





    $StrSearch = $_POST['ProductSearch'];

    if (!isset($_POST['ProductSearch'])) {
        $_POST['ProductSearch']="";

    }



    $sqlProductSearch = "   SELECT `items`.`itemId`, `items`.`itemName`,
                                    `items`.`itemImg`, `items`.`itemPrice`, 
                                    `items`.`itemQty`, `items`.`itemCategoryId`,
                                    `items`.`created_at`, `items`.`updated_at`,
                                    `categories`.`categoryName`
                                
                            FROM `items` INNER JOIN `categories`
                            ON `items`.`itemCategoryId` = `categories`.`categoryId` ";

if(isset($_POST['option'])){
    switch ($_POST['option']) {
        case "options1":
            $sqlProductSearch .= " WHERE `items`.`itemName`
                                       LIKE '%{$_POST['ProductSearch']}%' ";
            $NameCheck = 'checked="true"';
            break;
        case 'options2':
            $sqlProductSearch .= " WHERE `items`.`itemPrice`
                                        LIKE '%{$_POST['ProductSearch']}%' ";
            $QtyCheck = 'checked="true"';
            break;
        case 'options3':
            $sqlProductSearch .= " WHERE `categoryName`
                                       LIKE '%{$_POST['ProductSearch']}%' ";
            $kindCheck = 'checked="true"';
            break;    
    }
}
else{

            $sqlProductSearch .= " WHERE `items`.`itemName` 
                                   LIKE '%{$_POST['ProductSearch']}%' ";
            $NameCheck = 'checked="true"';
       
       
}

   

    $stmtProduct = $pdo->prepare($sqlProductSearch);
    $stmtProduct->execute();
    $arrProduct = $stmtProduct->fetchAll(PDO::FETCH_ASSOC);
    ?>

 <!DOCTYPYE html>
     <html>

     <head>
         <meta charset="UTF-8">
         <title>商品列表</title>
         <style>
             img.itemImg {
                 width: 250px;
                 height: 200px;
             }

             .td-div {
                 height: 180;
             }

             p {
                 width: 100px;
             }

             .border {
                 border: 1px solid;
             }

             img.payment_type_icon {
                 width: 50px;
             }

             .check {
                 width: 40px;
                 height: 40px;
             }

             .border {
                 text-align: center;
                 font-size: 18px;
             }
         </style>
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
     </head>

     <body>
         <?php require_once('./templates/title.php'); ?>
         <div class="container mt-3">
             <h3>商品列表</h3>
             <p>
                 <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">商品搜尋</button>
             </p>
             <div class="collapse" id="collapseExample">
                 <div class="card card-body">
                     <form name="myForm" method="POST" action="./ProductSearch.php">
                         <div class="btn-group btn-group-toggle" data-toggle="buttons" name="titleMethod">
                             <label class="btn btn-secondary active">
                                 <input type="radio" name="option" value="options1" id="option1"> 名稱
                             </label>
                             <label class="btn btn-secondary">
                                 <input type="radio" name="option" value="options2" id="option2"> 價格
                             </label>
                             <label class="btn btn-secondary">
                                 <input type="radio" name="option" value="options3" id="option3"> 種類
                             </label>
                         </div>
                         <br>
                         <p>商品搜尋 <input type="text" name="ProductSearch" required></p>
                         <tr>
                             <td class="border" colspan="2"><button class="btn btn-outline-dark" type="submit" name="smb_add">搜尋</button></td>
                         </tr>
                     </form>
                 </div>
             </div>


             <form name="myForm" entype="multipart/form-data" method="POST" action="delete.php">
                 <table class="border table table-hover">
                     <thead class="thead-dark ">
                         <tr>
                             <th class="border">勾選</th>
                             <th class="border">名稱</th>
                             <th class="border">照片</th>
                             <th class="border">價格</th>
                             <th class="border">數量</th>
                             <th class="border">種類</th>
                             <th class="border">新增時間</th>
                             <th class="border">更新時間</th>
                             <th class="border">功能</th>
                         </tr>
                     </thead>
                     <tbody>
                     <?php
                     if ($stmtProduct->rowCount() > 0) {
                                for ($i = 0; $i < count($arrProduct); $i++) {
                     ?>
                     <tr>
                          <td class="border">
                               <input type="checkbox" class="check" name="chk[]" value="<?php echo $arrProduct[$i]['itemId']; ?>" />
                                        </td>
                                        <td class="border"><?php echo $arrProduct[$i]['itemName']; ?></td>
                                        <td class="border"><img class="itemImg" src="../images/items/<?php echo $arrProduct[$i]['itemImg']; ?>" /></td>
                                        <td class="border"><?php echo $arrProduct[$i]['itemPrice']; ?></td>
                                        <td class="border"><?php echo $arrProduct[$i]['itemQty']; ?></td>
                                        <td class="border"><?php echo $arrProduct[$i]['categoryName']; ?></td>
                                        <td class="border"><?php echo $arrProduct[$i]['created_at']; ?></td>
                                        <td class="border"><?php echo $arrProduct[$i]['updated_at']; ?></td>

                                        <td class="border">
                                            <div class="d-flex flex-column justify-content-between td-div">
                                                <a href="./edit.php?itemId=<?php echo $arrProduct[$i]['itemId']; ?>">商品編輯</a>
                                                <a href="./multipleImages.php?itemId=<?php echo $arrProduct[$i]['itemId']; ?>">多圖設定</a>
                                                <a href="./comments.php?itemId=<?php echo $arrProduct[$i]['itemId']; ?>">回覆評論</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="border" colspan="9">沒有資料</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>

         </div>
         
     </body>

     </html>