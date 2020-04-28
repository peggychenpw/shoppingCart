<?php
//引入判斷是否登入機制
require_once('./checkSession.php');

//引用資料庫連線
require_once('./db.inc.php');

//SQL 敘述: 取得 students 資料表總筆數
$sqlTotal = "SELECT count(1) FROM `members`";

//取得總筆數
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0];

//每頁幾筆
$numPerPage = 5;

// 總頁數
$totalPages = ceil($total/$numPerPage); 

//目前第幾頁
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

//若 page 小於 1，則回傳 1
$page = $page < 1 ? 1 : $page;
?>
<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
    <style>
    .border {
        border: 1px solid;
    }
    </style>
</head>
<body>
這裡是後端管理頁面 - <a href="./logout.php?logout=1">登出</a>
<hr />
<form name="myForm" method="POST" action="_update.php">
    <table class="border">
        <thead>
            <tr>
            <th class="border">流水號</th>
                <th class="border">會員編號</th>
                <th class="border">會員姓名</th>
                <th class="border">性別</th>
                <th class="border">生日</th>
                <th class="border">所在地/城市</th>
                <th class="border">地址</th>
                <th class="border">email信箱</th>
                <th class="border">手機號碼</th>
                <th class="border">大頭貼</th>
                <th class="border">會員帳號</th>
                <th class="border">會員密碼</th>
                <th class="border">會員點數</th>
                <th class="border">VIP/Rank</th>
                <th class="border">信用卡號</th>
                <th class="border">開通狀況</th>                
                <th class="border">功能</th>
            </tr>
        </thead>
        <tbody>
        <?php
        //SQL 敘述
        $sql = "SELECT `id`, `member_id`, `member_name`, `member_gender`, `birth_date`, 
                `member_city`, `member_address`, `member_email`,`member_phone`,`member_img`,
                `member_account`,`member_password`,`member_points`,`member_loyalty`,`member_credit_card`,
                `isActivated` ";
        $sql.= "FROM `members` ";
        $sql.= "ORDER BY `id` ASC ";
        $sql.= "LIMIT ?, ? ";

        //設定繫結值
        $arrParam = [($page - 1) * $numPerPage, $numPerPage];

        //查詢
        $stmt = $pdo->prepare($sql);
        $stmt->execute($arrParam);
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //整理 primary key
        $strPk = '';

        if($total > 0) {
            for($i = 0; $i < count($arr); $i++) {
                if($strPk === '') 
                    $strPk = $arr[$i]['id']; 
                else 
                    $strPk.= ",".$arr[$i]['id'];
        ?>
            <tr>
                <td class="border"><?php echo $arr[$i]['id']; ?></td>
                <td class="border">
                    <input type="text" name="member_id_<?php echo $arr[$i]['id']; ?>" value="<?php echo $arr[$i]['member_id']; ?>" maxlength="9" />
                </td>
                <td class="border">
                    <input type="text" name="member_name_<?php echo $arr[$i]['id']; ?>" value="<?php echo $arr[$i]['member_name']; ?>" maxlength="10" />
                </td>
                <td class="border">
                    <select name="member_gender_<?php echo $arr[$i]['id']; ?>">
                        <option value="<?php echo $arr[$i]['member_gender']; ?>" selected><?php echo $arr[$i]['member_gender']; ?></option>
                        <option value="男">男</option>
                        <option value="女">女</option>
                    </select>

                </td>
                <td class="border">
                    <input type="text" name="birth_date_<?php echo $arr[$i]['id']; ?>" value="<?php echo $arr[$i]['birth_date']; ?>" maxlength="10" />
                </td>
                <td class="border">
                    <input type="text" name="member_city_<?php echo $arr[$i]['id']; ?>" value="<?php echo $arr[$i]['member_city']; ?>" maxlength="10" />
                </td>
                <td class="border">
                    <input type="text" name="member_address_<?php echo $arr[$i]['id']; ?>" value="<?php echo $arr[$i]['member_address']; ?>" maxlength="10" />
                </td>
                <td class="border">
                    <input type="text" name="member_email_<?php echo $arr[$i]['id']; ?>" value="<?php echo $arr[$i]['member_email']; ?>" maxlength="10" />
                </td>
                <td class="border">
                    <input type="text" name="member_phone_<?php echo $arr[$i]['id']; ?>" value="<?php echo $arr[$i]['member_phone']; ?>" maxlength="10" />
                </td>
                <td class="border">
                    <label class="" for="member_img">大頭貼：</label>                                        
                    <?php
                   
                        if($arr[$i]['member_img'] !== NULL) { ?>
                        <img class="w100px" src="./files/<?php echo $arr[$i]['member_img']; ?>" />
                    <?php } ?>                                                             
                    <input type="file" name="member_img_<?php echo $arr[$i]['id']; ?>" />
                </td>

                <td class="border">
                    <input type="text" name="member_account_<?php echo $arr[$i]['id']; ?>" value="<?php echo $arr[$i]['member_account']; ?>" maxlength="10" />
                </td>
                <td class="border">
                    <input type="text" name="member_password_<?php echo $arr[$i]['id']; ?>" value="<?php echo $arr[$i]['member_password']; ?>" maxlength="10" />
                </td>
                <td class="border">
                    <input type="text" name="member_points_<?php echo $arr[$i]['id']; ?>" value="<?php echo $arr[$i]['member_points']; ?>" maxlength="10" />
                </td>
                <td class="border">
                    <input type="text" name="member_loyalty_<?php echo $arr[$i]['id']; ?>" value="<?php echo $arr[$i]['member_loyalty']; ?>" maxlength="10" />
                </td>

                <td class="border">
                    <input type="text" name="member_credit_card_<?php echo $arr[$i]['id']; ?>" value="<?php echo $arr[$i]['member_credit_card']; ?>" maxlength="10" />
                </td>
                <td class="border">
                    <input type="text" name="isActivated_<?php echo $arr[$i]['id']; ?>" value="<?php echo $arr[$i]['isActivated']; ?>" maxlength="10" />
                </td>
                


                <td class="border">
                    <a href="./edit.php?editId=<?php echo $arr[$i]['id']; ?>">編輯</a>
                    <a href="./delete.php?deleteId=<?php echo $arr[$i]['id']; ?>">刪除</a>
                </td>
            </tr>
        <?php
            }
        } else {
        ?>
            <tr>
                <td class="border" colspan="6">沒有資料</td>
            </tr>
        <?php
        }
        ?>
        </tbody>
        <tfoot>
            <tr>
                <td class="border" colspan="6">
                <?php for($i = 1; $i <= $totalPages; $i++){ ?>
                    <a href="?page=<?= $i ?>"><?= $i ?></a>
                <?php } ?>
                </td>
            </tr>
            <tr>
            <td class="border" colspan="6"><input type="submit" name="smb" value="修改"></td>
            </tr>
        </tfoo>
    </table>
    <input type="hidden" name="pk" value="<?php echo $strPk; ?>">
</form>

<hr />


</body>
</html>