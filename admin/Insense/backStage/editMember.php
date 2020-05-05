<div class="wrap_modal container">
    
    <div class="accountInfo">
        <fieldset class="accountInfo_field">
            <legend>《 帳號資料 》</legend>
            <div class="_accountInfo d-flex">
                <div class="_accountInfo_left">
                    <div class="infoLine">
                        <label class="" for="userId_edit">會員編號：</label>
                        <input type="text" id="userId_edit" name="userId_edit" value="" maxlength="9" />
                    </div>
                    <div class="infoLine">
                        <label class="" for="username_edit">會員帳號：</label>
                        <input type="text" id="username_edit" name="username_edit" value="" maxlength="10" />
                    </div>
                    <div class="infoLine">
                        <label class="" for="pwd_edit">會員密碼：</label>
                        <input type="text" id="pwd_edit" name="pwd_edit" value="" maxlength="10" />
                    </div>
                </div>
                <div class="_accountInfo_right">
                    <div class="infoLine">
                        <label class="" for="userCreditCard_edit">信用卡號：</label>
                        <input type="text" id="userCreditCard_edit" name="userCreditCard_edit" value="" maxlength="20" />
                    </div>
                    <div class="infoLine">
                        <label class="" for="userPoint_edit">會員點數：</label>
                        <input type="text" id="userPoint_edit" name="userPoint_edit" value="" maxlength="10" />
                    </div>
                    <div class="infoLine">
                        <label class="" for="userLoyalty">會員等級：</label>
                        
                        <select class="userLoyalty" id="userLoyalty_edit" name="userLoyalty_edit">
                                
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
                            <label>大頭貼：</label><label id="userImg_edit_label" name="userImg_edit_label"></label>
                        </div>
                        <figure class="fig">
                            <img class="w100px" id="userImg_edit_src" src="../images/members/user.svg" alt="">                                
                        </figure>
                        <div class="fileBtn">                                
                            <input type="file" id="userImg_edit" name="userImg_edit" onchange="changeImg_edit()" />
                        </div>
                        
                    </div>
                            
                </div>
                <div class="_personalInfo_right">
                    <div class="infoLine">
                        <label class="" for="name_edit">會員姓名：</label>
                        <input type="text" id="name_edit" name="name_edit" value="" maxlength="10" />
                    </div>
                    <div class="infoLine">
                        <label class="" for="birthday_edit">會員生日：</label>
                        <input type="date" id="birthday_edit" name="birthday_edit" value="" maxlength="10" />
                    </div>
                    <div class="infoLine">
                        <label class="" for="gender_edit">會員性別：</label>
                        <select class="gender_edit" id="gender_edit" name="gender_edit">
                                
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
                        <label class="" for="userCity_edit">居住城市：</label>
                        
                        <select class="userCity" id="userCity_edit" name="userCity_edit">
                            
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
                        <label class="" for="address_edit">會員地址：</label>
                        <input type="text" id="address_edit" name="address_edit" value="" maxlength="40" />
                    </div>
                </div>
                <div  class="_contactInfo_right">
                    <div class="infoLine">
                        <label class="" for="userEmail">會員信箱：</label>
                        <input type="text" id="userEmail_edit" name="userEmail_edit" value="" maxlength="40" />
                    </div>
                    <div class="infoLine">
                        <label class="" for="phoneNumber">會員電話：</label>
                        <input type="text" id="phoneNumber_edit" name="phoneNumber_edit" value="" maxlength="13" />
                    </div> 
                </div>
            </div>
            
                        
        </fieldset>
    </div>   
    <input type="submit" id="smb_edit" name="smb_edit" value="修改" style="display:none;">
    <!-- 用hidden的特性把editId帶到另一頁，是一種防護機制。 -->
    <!-- 原本是用php渲染取id，但用了modal變成JS給值 -->
    <input type="hidden" id="editId" name="editId" value=""> 
      
</div>
    


    



