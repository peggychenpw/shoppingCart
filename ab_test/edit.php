<?php
//引入判斷是否登入機制
require_once('./checkSession.php');

//引用資料庫連線
require_once('./db.inc.php');
?>
<!DOCTYPYE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>我的 PHP 程式</title>
        <link rel="stylesheet" href="css/member_edit.css">        
    </head>
<body>
<?php require_once('./templates/title.php'); ?>
<hr />

<form name="myForm" method="POST" action="updateEdit.php" enctype="multipart/form-data">
    <div class="wrap_edit container">
        <?php
            //SQL 敘述
            $sql = "SELECT `id`, `member_id`, `member_name`, `member_gender`, `birth_date`, 
                            `member_city`, `member_address`, `member_email`,`member_phone`,`member_img`,
                            `member_account`,`member_password`,`member_points`,`member_loyalty`,`member_credit_card`,
                            `isActivated`,`created_at`,`updated_at`
                    FROM `members`
                    WHERE `id` = ?";

            //設定繫結值
            $arrParam = [(int)$_GET['editId']];

            //查詢
            $stmt = $pdo->prepare($sql);
            $stmt->execute($arrParam);
            if( $stmt->rowCount() > 0 ){
                $arr = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
            }
            

            if(count($arr) > 0) {
        ?>
        <div class="accountInfo">
            <fieldset class="accountInfo_field">
                <legend>《 帳號資料 》</legend>
                <div class="_accountInfo d-flex">
                    <div class="_accountInfo_left">
                        <div class="infoLine">
                            <label class="" for="member_id">會員編號：</label>
                            <input type="text" id="member_id" name="member_id" value="<?php echo $arr['member_id']; ?>" maxlength="9" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="member_account">會員帳號：</label>
                            <input type="text" name="member_account" value="<?php echo $arr['member_account']; ?>" maxlength="10" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="member_password">會員密碼：</label>
                            <input type="text" name="member_password" value="<?php echo $arr['member_password']; ?>" maxlength="10" />
                        </div>
                    </div>
                    <div class="_accountInfo_right">
                        <div class="infoLine">
                            <label class="" for="member_credit_card">信用卡號：</label>
                            <input type="text" name="member_credit_card" value="<?php echo $arr['member_credit_card']; ?>" maxlength="10" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="member_points">會員點數：</label>
                            <input type="text" name="member_points" value="<?php echo $arr['member_points']; ?>" maxlength="10" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="member_loyalty">會員等級：</label>
                            <input type="text" name="member_loyalty" value="<?php echo $arr['member_loyalty']; ?>" maxlength="10" />
                        </div>
                    </div>
                </div>
                
                
                
            
            </fieldset>
        </div>

        <div class="personalInfo">
            <fieldset class="personalInfo_field">
                <legend>《 個人資料 》</legend>
                <div class="_personalInfo d-flex">
                    <div class="_personalInfo_left">
                        <div class="card">
                            <div class="banner">
                                <label class="" for="member_img">大頭貼：</label>

                            </div>
                            <figure class="fig">
                                <img class="w100px" src="data:image/gif;base64,R0lGODlhAQABAAAAACwAAAAAAQABAAA=" alt="">
                                <?php
                                    if($arr['member_img'] !== NULL) { ?>
                                    <img class="w100px" src="./files/<?php echo $arr['member_img']; ?>" />
                                <?php } ?>
                            </figure>
                            <div class="fileBtn">
                                
                                <input type="file" name="member_img" />
                            </div>
                            
                        </div>
                             
                    </div>
                    <div class="_personalInfo_right">
                        <div class="infoLine">
                            <label class="" for="member_name">會員姓名：</label>
                            <input type="text" id="member_name" name="member_name" value="<?php echo $arr['member_name']; ?>" maxlength="10" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="birth_date">會員生日：</label>
                            <input type="text" id="birth_date" name="birth_date" value="<?php echo $arr['birth_date']; ?>" maxlength="10" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="member_gender">會員性別：</label>
                            <select class="member_gender" id="member_gender" name="member_gender">
                                    <option value="<?php echo $arr['member_gender']; ?>" selected><?php echo $arr['member_gender']; ?></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                            </select>
                        </div>                                                                                                                                   
                    </div>                       
                </div>                                            
            </fieldset>
        </div>
        <div class="contactInfo">
            <fieldset class="contactInfo_field">
                <legend>《 通訊資料 》</legend>  
                <div class="_contactInfo d-flex">
                    <div class="_contactInfo_left">
                        <div class="infoLine">
                            <label class="" for="member_city">居住城市：</label>
                            <input type="text" name="member_city" value="<?php echo $arr['member_city']; ?>" maxlength="10" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="member_address">會員地址：</label>
                            <input type="text" name="member_address" value="<?php echo $arr['member_address']; ?>" maxlength="10" />
                        </div>
                    </div>
                    <div  class="_contactInfo_right">
                        <div class="infoLine">
                            <label class="" for="member_email">會員信箱：</label>
                            <input type="text" name="member_email" value="<?php echo $arr['member_email']; ?>" maxlength="10" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="member_phone">會員電話：</label>
                            <input type="text" name="member_phone" value="<?php echo $arr['member_phone']; ?>" maxlength="10" />
                        </div> 
                    </div>
                </div>
                
                           
            </fieldset>
        </div>   
        <div class="buttons">
            <a href="./delete.php?deleteId=<?php echo $arr['id']; ?>">刪除</a> 
            <?php
            } else {
            ?>
                <h1>沒有資料</h1>            
            <?php
            }
            ?>     
            <input type="submit" name="smb" value="修改">  
            <!-- 用hidden的特性把editId帶到另一頁，是一種防護機制。 -->
            <input type="hidden" name="editId" value="<?php echo (int)$_GET['editId']; ?>">            
        </div>     
    </div>
    


    



</body>
</html>