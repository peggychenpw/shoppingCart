<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線

						
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

<?php
$sql = "SELECT *
FROM `coupon` 
WHERE `couponId` = ? ";
?>
<a class="home" href="./adminCoupon.php">我的優惠券</a>
<hr />
<h3>新增優惠券</h3>
<form name="myForm" enctype="multipart/form-data" method="POST" action="addCoupon.php">
<table class="border">
    <thead>
        <tr>
            <th class="border">優惠券名稱</th>
            <th class="border">優惠碼</th>
            <th class="border">優惠券折扣</th>
            <th class="border">起始日期</th>
            <th class="border">結束日期</th>

        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="border">
                <input type="text" name="couponName" value="" maxlength="100" required />
            </td>
            <td class="border">
                <input type="text" name="couponCode" value="" maxlength="11" required/>
            </td>
            <td class="border">
                <input type="text" name="couponDiscount" value="" maxlength="5" required />
            </td>
            <td class="border">
                <input name="couponStart" id="date" type="date" required> 
                </input>
            </td>
            <td class="border">
                <input name="couponEnd" id="date" type="date" required>
                </input>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td class="border" colspan="5"><input type="submit" name="smb" value="新增"></td>
        </tr>
    </tfoot>
</table>
</form>
</body>
</html>