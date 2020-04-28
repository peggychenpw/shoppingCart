<?php
//引入判斷是否登入機制
require_once './checkSession.php';

//引用資料庫連線
require_once './db.inc.php';

//SQL 敘述: 取得 students 資料表總筆數
$sqlTotal = "SELECT count(1) FROM `members`";

//取得總筆數
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0];

//每頁幾筆
$numPerPage = 5;

// 總頁數
$totalPages = ceil($total / $numPerPage);

//目前第幾頁
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

//若 page 小於 1，則回傳 1
$page = $page < 1 ? 1 : $page;
?>
<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> 
    <link rel="stylesheet" href="css/member_admin.css">
    
</head>
<body>
<?php require_once './templates/title.php';?>
<hr />
<form name="myForm" method="POST" action="deleteIds.php">
    <div class="container">
        <div class="searchDiv">
            <input type="button" class="myBtn" name="searchBtn" data-toggle="collapse" data-target="#searchDivDetail" aria-expanded="false" aria-controls="searchDivDetail" value="條件查詢">    
        </div>
        <div class="collapse searchDivDetail" id="searchDivDetail">
            <div class="searchDD_1 d-flex">
                <input type="button" class="searchBtn_D_1" value="關鍵字查詢">
                <input type="text" class="searchInput">
            </div>
            <div class="searchDD_2 d-flex">
                <div class="searchDD_2_1">
                    <input type="button" class="searchBtn_D_1" value="欄位查詢">
                </div>
                <div class="searchDD_2_2">
                    <label class="checkLabel">
                        <input type="checkbox" class="checkbox" name="" />會員姓名
                    </label>
                    <label class="checkLabel">
                        <input type="checkbox" class="checkbox" name="" />會員帳號
                    </label>
                    <label class="checkLabel">
                        <input type="checkbox" class="checkbox" name="" />會員性別
                    </label>
                    <label class="checkLabel">
                        <input type="checkbox" class="checkbox" name="" />會員生日
                    </label>
                    <label class="checkLabel">
                        <input type="checkbox" class="checkbox" name="" />會員點數
                    </label>
                    <label class="checkLabel">
                        <input type="checkbox" class="checkbox" name="" />會員等級
                    </label>
                    <label class="checkLabel">
                        <input type="checkbox" class="checkbox" name="" />會員電話
                    </label>
                    <label class="checkLabel">
                        <input type="checkbox" class="checkbox" name="" />會員信箱
                    </label>
                    <label class="checkLabel">
                        <input type="checkbox" class="checkbox" name="" />會員地址
                    </label>
                </div>                
            </div>
            <div class="searchDD_3 d-flex">
                <div class="searchDD_3_1">
                    <input type="button" class="searchBtn_D_2" value="混合查詢">
                </div>
                <div class="searchDD_3_2">
                    <div class="searchDD_3_2_1">
                        <input type="text" class="searchInput">
                    </div>
                    <div class="searchDD_3_2_2">
                        <label class="checkLabel">
                            <input type="checkbox" class="checkbox" name="" />會員姓名
                        </label>
                        <label class="checkLabel">
                            <input type="checkbox" class="checkbox" name="" />會員帳號
                        </label>
                        <label class="checkLabel">
                            <input type="checkbox" class="checkbox" name="" />會員性別
                        </label>
                        <label class="checkLabel">
                            <input type="checkbox" class="checkbox" name="" />會員生日
                        </label>
                        <label class="checkLabel">
                            <input type="checkbox" class="checkbox" name="" />會員點數
                        </label>
                        <label class="checkLabel">
                            <input type="checkbox" class="checkbox" name="" />會員等級
                        </label>
                        <label class="checkLabel">
                            <input type="checkbox" class="checkbox" name="" />會員電話
                        </label>
                        <label class="checkLabel">
                            <input type="checkbox" class="checkbox" name="" />會員信箱
                        </label>
                        <label class="checkLabel">
                            <input type="checkbox" class="checkbox" name="" />會員地址
                        </label>
                    </div>
                </div>                                
            </div>
        </div>
        <div class="btnDiv">
            <input type="submit" class="myBtn" name="smb" value="刪除勾選">
        </div>
        <div class="tableDiv">
            <table class="table border" >
                <thead>
                    <tr>
                        <th class="border head_check_w padd5_0">
                            <div class="clickAll_d">
                                <label>
                                <input type="checkbox" class="checkbox clickAll" name="clickAll" />全選
                                </label>
                            </div>
                            <div class="clickReverse_d">
                                <label>
                                <input type="checkbox" class="checkbox clickReverse" name="clickReverse" />反選
                                </label>
                            </div>

                        </th>
                        <!-- <th class="border">流水號</th> -->
                        <th class="border head_id_w padd5_0">會員編號</th>
                        <th class="border head_name_w padd5_0">會員姓名</th>
                        <th class="border head_acc_w padd5_0">會員帳號</th>
                        <th class="border head_pwd_w padd5_0">會員密碼</th>
                        <th class="border head_gender_w padd5_0">會員性別</th>
                        <th class="border head_birth_w padd5_0">會員生日</th>
                        <th class="border head_points_w padd5_0">會員點數</th>
                        <th class="border head_loyalty_w padd5_0">會員等級</th>
                        <th class="border head_phone_w padd5_0">會員電話</th>
                        <th class="border head_email_w padd5_0">會員信箱</th>
                        <th class="border head_address_w padd5_0">會員地址</th>
                        <th class="border head_features_w padd5_0">功能</th>
                    </tr>
                </thead>
                <tbody>
    <?php
    //SQL 敘述
    $sql = "SELECT `id`, `member_id`, `member_name`, `member_gender`, `birth_date`,
                                    `member_city`, `member_address`, `member_email`,`member_phone`,
                                    `member_account`,`member_password`,`member_points`,`member_loyalty`
            FROM `members`
            ORDER BY `id` ASC
            LIMIT ?, ? ";

    //設定繫結值
    $arrParam = [($page - 1) * $numPerPage, $numPerPage];

    //查詢分頁後的學生資料
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);

    //資料數量大於 0，則列出所有資料
    if ($stmt->rowCount() > 0) {
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < count($arr); $i++) {
            ?>
                        <tr>
                            <td class="border padd5_0">
                                <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['id']; ?>" />
                            </td>                            
                            <td class="border head_id_w padd5_0"><?php echo $arr[$i]['member_id']; ?></td>
                            <td class="border head_name_w padd5_0"><?php echo $arr[$i]['member_name']; ?></td>
                            <td class="border head_acc_w padd5_0"><?php echo $arr[$i]['member_account']; ?></td>
                            <td class="border head_pwd_w padd5_0"><?php echo $arr[$i]['member_password']; ?></td>
                            <td class="border head_gender_w padd5_0"><?php echo $arr[$i]['member_gender']; ?></td>
                            <td class="border head_birth_w padd5_0"><?php echo $arr[$i]['birth_date']; ?></td>
                            <td class="border head_points_w padd5_0"><?php echo $arr[$i]['member_points']; ?></td>
                            <td class="border head_loyalty_w padd5_0"><?php echo $arr[$i]['member_loyalty']; ?></td>
                            <td class="border head_phone_w padd5_0"><?php echo $arr[$i]['member_phone']; ?></td>
                            <td class="border head_email_w padd5_0"><?php echo $arr[$i]['member_email']; ?></td>
                            <td class="border head_address_w padd5_0"><?php echo $arr[$i]['member_address']; ?></td>
                            <td class="border head_features_w padd5_0">
                                <a href="">詳細資料</a>
                                <a href="./edit.php?editId=<?php echo $arr[$i]['id']; ?>">編輯</a>
                                <a href="./delete.php?deleteId=<?php echo $arr[$i]['id']; ?>">刪除</a>
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
                <tfoot>
                    <tr>
                        <td class="border page_" colspan="13">
                        <?php for ($i = 1; $i <= $totalPages; $i++) {?>
                            <a href="?page=<?=$i?>"><?=$i?></a>
                        <?php }?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>        
    </div>
</form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>