<div class="wrap_modal container">
  <div class="accountInfo">
    <fieldset class="accountInfo_field">
      <legend>《 帳號資料 》</legend>
      <div class="_accountInfo d-flex">
        <div class="_accountInfo_left">
          <div class="infoLine">
            <label class="" for="userId_new">會員編號：</label>
            <input type="text" id="userId_new" name="userId_new" maxlength="9" required />


          </div>
          <div class="infoLine">
            <label class="" for="username_new">會員帳號：</label>
            <input type="text" name="username_new" value="" maxlength="10" />
          </div>
          <div class="infoLine">
            <label class="" for="pwd_new">會員密碼：</label>
            <input type="text" name="pwd_new" value="" maxlength="10" />
          </div>
        </div>
        <div class="_accountInfo_right">
          <div class="infoLine">
            <label class="" for="userCreditCard_new">信用卡號：</label>
            <input type="text" name="userCreditCard_new" value="" maxlength="20" />
          </div>
          <div class="infoLine">
            <label class="" for="userPoint_new">會員點數：</label>
            <input type="text" name="userPoint_new" value="" maxlength="10" />
          </div>
          <div class="infoLine">
            <label class="" for="userLoyalty_new">會員等級：</label>
            <!-- <input type="text" name="userLoyalty" value="" maxlength="10" /> -->
            <select class="userLoyalty" id="userLoyalty_new" name="userLoyalty_new">
              <option value="" selected>請選擇等級</option>
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
              <label>大頭貼：</label>
            </div>
            <figure class="fig">
              <img class="w100px" id="userImg_new_src" src="../images/members/user.svg" alt="">
            </figure>
            <div class="fileBtn">
              <input type="file" id="userImg_new" name="userImg_new" onchange="changeImg_new()" />
            </div>
          </div>
        </div>
        <div class="_personalInfo_right">
          <div class="infoLine">
            <label class="" for="name_new">會員姓名：</label>
            <input type="text" id="name_new" name="name_new" value="" maxlength="10" />
          </div>
          <div class="infoLine">
            <label class="" for="birthday_new">會員生日：</label>
            <input type="date" id="birthday_new" name="birthday_new" value="" maxlength="10" />
          </div>
          <div class="infoLine">
            <label class="" for="gender_new">會員性別：</label>
            <select class="gender" id="gender_new" name="gender_new">
              <option value="" selected>請選擇性別</option>
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
            <label class="" for="userCity_new">居住城市：</label>
            <!-- <input type="text" name="member_city" value="" maxlength="10" /> -->
            <select class="userCity" id="userCity_new" name="userCity_new">
              <option value="" selected>請選擇城市</option>
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
            <label class="" for="address_new">會員地址：</label>
            <input type="text" name="address_new" value="" maxlength="40" />

          </div>
        </div>
        <div class="_contactInfo_right">
          <div class="infoLine">
            <label class="" for="userEmail_new">會員信箱：</label>
            <input type="text" name="userEmail_new" value="" maxlength="40" />
          </div>
          <div class="infoLine">
            <label class="" for="phoneNumber_new">會員電話：</label>
            <input type="text" name="phoneNumber_new" value="" maxlength="10" />
          </div>
        </div>
      </div>
    </fieldset>
  </div>
  <input type="submit" class="btn btn-primary" id="smb_new" name="smb_new" value="新增" style="display:none;">


</div>