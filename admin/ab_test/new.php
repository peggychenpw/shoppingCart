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
                            <label class="" for="userId">會員編號：</label>
                            <input type="text" id="userId" name="userId" value="" maxlength="9" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="username">會員帳號：</label>
                            <input type="text" name="username" value="" maxlength="10" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="pwd">會員密碼：</label>
                            <input type="text" name="pwd" value="" maxlength="10" />
                        </div>
                    </div>
                    <div class="_accountInfo_right">
                        <div class="infoLine">
                            <label class="" for="userCreditCard">信用卡號：</label>
                            <input type="text" name="userCreditCard" value="" maxlength="20" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="userPoint">會員點數：</label>
                            <input type="text" name="userPoint" value="" maxlength="10" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="userLoyalty">會員等級：</label>
                            <!-- <input type="text" name="userLoyalty" value="" maxlength="10" /> -->
                            <select class="userLoyalty" id="userLoyalty" name="userLoyalty">
                                    <option value="" selected></option>
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
                            <img class="w100px" src="data:image/gif;base64,R0lGODlhAQABAAAAACwAAAAAAQABAAA=" alt="">                                
                            </figure> 
                            <div class="fileBtn">                                
                                <input type="file" id="userImg" name="userImg" />
                            </div>
                        </div>                             
                    </div>
                    <div class="_personalInfo_right">
                        <div class="infoLine">
                            <label class="" for="name">會員姓名：</label>
                            <input type="text" id="name" name="name" value="" maxlength="10" />
                        </div>     
                        <div class="infoLine">
                            <label class="" for="birthday">會員生日：</label>
                            <input type="date" id="birthday" name="birthday" value="" maxlength="10" />
                        </div> 
                        <div class="infoLine">
                            <label class="" for="gender">會員性別：</label>
                            <select class="gender" id="gender" name="gender">
                                <option value="" selected></option>
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
                            <!-- <input type="text" name="member_city" value="" maxlength="10" /> -->
                            <select class="userCity" id="userCity" name="userCity">
                                <option value="" selected></option>
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
                            <input type="text" name="address" value="" maxlength="10" />
                            
                        </div>
                    </div>
                    <div  class="_contactInfo_right">
                        <div class="infoLine">
                            <label class="" for="userEmail">會員信箱：</label>
                            <input type="text" name="userEmail" value="" maxlength="10" />
                        </div>
                        <div class="infoLine">
                            <label class="" for="phoneNumber">會員電話：</label>
                            <input type="text" name="phoneNumber" value="" maxlength="10" />
                        </div>                    
                    </div>
                </div>                                
            </fieldset>
        </div>        
        <div class="buttons">
            <input type="button" id="show" value="test" onclick="_show()">
            <input type="submit" name="smb" value="新增">
        </div>
        
    <script>
        var _userImg=document.getElementById('userImg');
        function _show(){
            console.log(_userImg);
        }
    </script>
    
</form>

</body>
</html>