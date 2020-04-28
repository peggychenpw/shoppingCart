<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
    <link rel="stylesheet" href="css/member_new.css"> 
</head>
<body>
<?php require_once('./templates/title.php'); ?>
<hr />
<form name="myForm" method="POST" action="./insert.php" enctype="multipart/form-data">
    <div class="wrap_new container">
        <div class="accountInfo">
            <fieldset class="accountInfo_field">
                <legend>《 帳號資料 》</legend>
                <div class="_accountInfo d-flex">
                    <div class="_accountInfo_left">
                        <div class="infoLine">
                            <label class="" for="member_id">會員編號：</label>
                            <input type="text" id="member_id" name="member_id" value="" maxlength="9" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="member_account">會員帳號：</label>
                            <input type="text" name="member_account" value="" maxlength="10" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="member_password">會員密碼：</label>
                            <input type="text" name="member_password" value="" maxlength="10" />
                        </div>
                    </div>
                    <div class="_accountInfo_right">
                        <div class="infoLine">
                            <label class="" for="member_credit_card">信用卡號：</label>
                            <input type="text" name="member_credit_card" value="" maxlength="20" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="member_points">會員點數：</label>
                            <input type="text" name="member_points" value="" maxlength="10" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="member_loyalty">會員等級：</label>
                            <input type="text" name="member_loyalty" value="" maxlength="10" />
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
                            </figure> 
                            <div class="fileBtn">                                
                                <input type="file" name="member_img" />
                            </div>
                        </div>                             
                    </div>
                    <div class="_personalInfo_right">
                        <div class="infoLine">
                            <label class="" for="member_name">會員姓名：</label>
                            <input type="text" id="member_name" name="member_name" value="" maxlength="10" />
                        </div>     
                        <div class="infoLine">
                            <label class="" for="birth_date">會員生日：</label>
                            <input type="text" id="birth_date" name="birth_date" value="" maxlength="10" />
                        </div> 
                        <div class="infoLine">
                            <label class="" for="member_gender">會員性別：</label>
                            <select class="member_gender" id="member_gender" name="member_gender">
                                <option value="" selected></option>
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
                            <input type="text" name="member_city" value="" maxlength="10" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="member_address">會員地址：</label>
                            <input type="text" name="member_address" value="" maxlength="10" />
                        </div>
                    </div>
                    <div  class="_contactInfo_right">
                        <div class="infoLine">
                            <label class="" for="member_email">會員信箱：</label>
                            <input type="text" name="member_email" value="" maxlength="10" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="member_phone">會員電話：</label>
                            <input type="text" name="member_phone" value="" maxlength="10" />
                        </div>                    
                    </div>
                </div>                                
            </fieldset>
        </div>        
        <div class="buttons">
            <input type="submit" name="smb" value="新增">
        </div>
        
    

    </div>
</form>

</body>
</html>