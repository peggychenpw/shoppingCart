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
            $sql = "SELECT `id`, `userId`, `name`, `gender`, `birthday`, 
                            `userCity`, `address`, `userEmail`,`phoneNumber`,`userImg`,
                            `username`,`pwd`,`userPoint`,`userLoyalty`,`userCreditCard`,
                            `isActivated`,`created_at`,`updated_at`
                    FROM `users`
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
                            <label class="" for="userId">會員編號：</label>
                            <input type="text" id="userId" name="userId" value="<?php echo $arr['userId']; ?>" maxlength="9" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="username">會員帳號：</label>
                            <input type="text" name="username" value="<?php echo $arr['username']; ?>" maxlength="10" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="pwd">會員密碼：</label>
                            <input type="text" name="pwd" value="<?php echo $arr['pwd']; ?>" maxlength="10" />
                        </div>
                    </div>
                    <div class="_accountInfo_right">
                        <div class="infoLine">
                            <label class="" for="userCreditCard">信用卡號：</label>
                            <input type="text" name="userCreditCard" value="<?php echo $arr['userCreditCard']; ?>" maxlength="10" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="userPoint">會員點數：</label>
                            <input type="text" name="userPoint" value="<?php echo $arr['userPoint']; ?>" maxlength="10" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="userLoyalty">會員等級：</label>
                            
                            <select class="userLoyalty" id="userLoyalty" name="userLoyalty">
                                    <option value="<?php echo $arr['userLoyalty']; ?>" selected><?php echo $arr['userLoyalty']; ?></option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                            </select>
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
                                <label class="" for="userImg">大頭貼：</label>

                            </div>
                            <figure class="fig">
                                <!-- <img class="w100px" src="data:image/gif;base64,R0lGODlhAQABAAAAACwAAAAAAQABAAA=" alt=""> -->
                                <?php
                                    if($arr['userImg'] !== NULL) { ?>
                                    <img class="w100px" src="./files/<?php echo $arr['userImg']; ?>" />
                                <?php } ?>
                            </figure>
                            <div class="fileBtn">
                                
                                <input type="file" name="userImg" />
                            </div>
                            
                        </div>
                             
                    </div>
                    <div class="_personalInfo_right">
                        <div class="infoLine">
                            <label class="" for="name">會員姓名：</label>
                            <input type="text" id="name" name="name" value="<?php echo $arr['name']; ?>" maxlength="10" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="birthday">會員生日：</label>
                            <input type="date" id="birthday" name="birthday" value="<?php echo $arr['birthday']; ?>" maxlength="10" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="gender">會員性別：</label>
                            <select class="gender" id="gender" name="gender">
                                    <option value="<?php echo $arr['gender']; ?>" selected><?php echo $arr['gender']; ?></option>
                                    <option value="男">男</option>
                                    <option value="女">女</option>
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
                            <label class="" for="userCity">居住城市：</label>
                            
                            <select class="userCity" id="userCity" name="userCity">
                                <option value="<?php echo $arr['userCity']; ?>" selected><?php echo $arr['userCity']; ?></option>
                                <option value="台北市">台北市</option>
                                <option value="新北市">新北市</option>
                                <option value="桃園市">桃園市</option>
                                <option value="新竹市">新竹市</option>
                                <option value="台中市">台中市</option>
                                <option value="嘉義市">嘉義市</option>
                                <option value="台南市">台南市</option>
                                <option value="高雄市">高雄市</option>
                            </select>
                        </div>
                        <div class="infoLine">
                            <label class="" for="address">會員地址：</label>
                            <input type="text" name="address" value="<?php echo $arr['address']; ?>" maxlength="10" />
                        </div>
                    </div>
                    <div  class="_contactInfo_right">
                        <div class="infoLine">
                            <label class="" for="userEmail">會員信箱：</label>
                            <input type="text" name="userEmail" value="<?php echo $arr['userEmail']; ?>" maxlength="10" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="phoneNumber">會員電話：</label>
                            <input type="text" name="phoneNumber" value="<?php echo $arr['phoneNumber']; ?>" maxlength="10" />
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