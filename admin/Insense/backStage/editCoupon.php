<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線

?>
<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的優惠券</title>
    <style>
    .border {
        border: 1px solid;
    }
    img.itemImg {
        width: 250px;
    }
    .home{
        text-decoration: none;
    }
    .home:visited{
        color: blue;
    }
    </style>
</head>
<body>
<a class="home" href="./adminCoupon.php">我的優惠券</a>
<hr />
<h3>編輯優惠券</h3>
<form name="myForm" enctype="multipart/form-data" method="POST" action="updateCoupon.php">
    <table class="border">
        <thead>
            <tr>
                <th class="border">優惠券名稱</th>
                <th class="border">優惠碼</th>
                <th class="border">優惠券折扣</th>
                <th class="border">起始日期</th>
                <th class="border">結束日期</th>
                <th class="border">新增時間</th>
                <th class="border">更新時間</th>
            </tr>
        </thead>
        <tbody>
        <?php
        //SQL 敘述
        $sql = "SELECT *
                FROM `coupon` 
                WHERE `couponId` = ? ";

        $arrParam = [
           (int)$_GET['couponId']
        ];
        // $_SESSION['couponId'] = (int)$_GET['couponId'];
        //查詢
        $stmt = $pdo->prepare($sql);
        $stmt->execute($arrParam);

        //資料數量大於 0，則列出相關資料
        if($stmt->rowCount() > 0) {
            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // print_r($arr);
            // exit;
        ?>
        
            <tr>
                <input type="hidden" name="couponId" value="<?php $arr[0]['couponId']; ?>">
                <td class="border">
                    <input type="text" name="couponName" value="<?php echo $arr[0]['couponName']; ?>" maxlength="100" />
                </td>
                <td class="border">
                    <input type="text" name="couponCode" value="<?php echo $arr[0]['couponCode']; ?>" maxlength="100" />
                </td>
                <td class="border">
                    <input type="text" name="couponDiscount" value="<?php echo $arr[0]['couponDiscount']; ?>" maxlength="11" />
                </td>
                <td class="border">
                    <input type="date" name="couponStart" value="<?php echo $arr[0]['couponStart']; ?>" maxlength="20" />
                </td>
                <td class="border">
                    <input type="date" name="couponEnd" value="<?php echo $arr[0]['couponEnd']; ?>" maxlength="20" />
                </td>
                <td class="border"><?php echo $arr[0]['created_at']; ?></td>
                <td class="border"><?php echo $arr[0]['updated_at']; ?></td>
            </tr>
        <?php
        } else {
        ?>
            <tr>
                <td colspan="7">沒有資料</td>
            </tr>
        <?php
        }
        ?>
        </tbody>
        <tfoot>
            <tr>
                <td class="border" colspan="7"><input type="submit" name="smb" value="更新"></td>
            </tr>
        </tfoo>
    </table>
    <input type="hidden" name="couponId" value="<?php echo $arr[0]['couponId']; ?>">
    <!-- <input type="hidden" name="itemId" value="<?php //echo (int)$_GET['couponId']; ?>"> -->
</form>
</body>
</html>