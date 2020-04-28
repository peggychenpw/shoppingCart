<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <title>我的 PHP 程式</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> 
    <link rel="stylesheet" href="css/member_admin.css">    
</head>
<body>
    <form name="myForm" method="POST" action="deleteIds.php">
        <div class="container">
            <div class="searchDiv">
                <input type="button" class="myBtn" name="searchBtn" data-toggle="collapse" data-target="#searchDivDetail" aria-expanded="false" aria-controls="searchDivDetail" value="條件查詢">    
            </div>
            <div class="collapse searchDivDetail" id="searchDivDetail">
                <div class="searchDD_1 d-flex">
                    <input type="button" class="searchBtn_D_1" id="searchBtn_D_0" value="關鍵字查詢">
                    <input type="text" class="searchInput">
                </div>
                <div class="searchDD_2 d-flex">
                    <div class="searchDD_2_1">
                        <input type="button" class="searchBtn_D_1" id="searchBtn_D_1" value="欄位查詢">
                    </div>
                    <div class="searchDD_2_2">
                        <label class="checkLabel">
                            <input type="checkbox" class="checkbox" id="checkArr1_0" name="" />會員姓名
                        </label>
                        <label class="checkLabel">
                            <input type="checkbox" class="checkbox" id="checkArr1_1" name="" />會員帳號
                        </label>
                        <label class="checkLabel">
                            <input type="checkbox" class="checkbox" id="checkArr1_2" name="" />會員密碼
                        </label>
                        <label class="checkLabel">
                            <input type="checkbox" class="checkbox" id="checkArr1_3" name="" />會員性別
                        </label>
                        <label class="checkLabel">
                            <input type="checkbox" class="checkbox" id="checkArr1_4" name="" />會員生日
                        </label>
                        <label class="checkLabel">
                            <input type="checkbox" class="checkbox" id="checkArr1_5" name="" />會員點數
                        </label>
                        <label class="checkLabel">
                            <input type="checkbox" class="checkbox" id="checkArr1_6" name="" />會員等級
                        </label>
                        <label class="checkLabel">
                            <input type="checkbox" class="checkbox" id="checkArr1_7" name="" />會員電話
                        </label>
                        <label class="checkLabel">
                            <input type="checkbox" class="checkbox" id="checkArr1_8" name="" />會員信箱
                        </label>
                        <label class="checkLabel">
                            <input type="checkbox" class="checkbox" id="checkArr1_9" name="" />會員地址
                        </label>
                    </div>                
                </div>
                <div class="searchDD_3 d-flex">
                    <div class="searchDD_3_1">
                        <input type="button" class="searchBtn_D_2" id="searchBtn_D_2" value="混合查詢">
                    </div>
                    <div class="searchDD_3_2">
                        <div class="searchDD_3_2_1">
                            <input type="text" class="searchInput">
                        </div>
                        <div class="searchDD_3_2_2">
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr2_0" name="" />會員姓名
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr2_1" name="" />會員帳號
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr2_2" name="" />會員密碼
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr2_3" name="" />會員性別
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr2_4" name="" />會員生日
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr2_5" name="" />會員點數
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr2_6" name="" />會員等級
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr2_7" name="" />會員電話
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr2_8" name="" />會員信箱
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr2_9" name="" />會員地址
                            </label>
                        </div>
                    </div>                                
                </div>
            </div>
            <div class="btnDiv">
                <input type="submit" class="myBtn" name="smb" value="刪除勾選">
            </div>
            <div class="tableWrap">
                <table>
                    <thead class="myThead" id="myThead">
                        <tr class="myTheadTr" id="myTheadTr">

                        </tr>
                    </thead>
                    <tbody class="myTbody" id="myTbody">
                        <tr class="myTbodyTr" id="myTbodyTr">

                        </tr>
                    </tbody>
                </table>


            </div>


        </div>



    </form>

    <script>
        var ifOutput1 = [true, true, true, true, true, true, true, true, true, true, true, true, true];
        var ifOutput2 = [true, true, true, true, true, true, true, true, true, true, true, true, true];
        var tableTitle = [];    
        var checkArr1 = [];
        var checkArr2 = [];
        var searchBtn1,searchBtn2,searchBtn3;
        // 抓button
        searchBtn2= document.getElementById('searchBtn_D_1');
        searchBtn2.addEventListener('click', turn1);
        searchBtn3= document.getElementById('searchBtn_D_2');
        searchBtn3.addEventListener('click', turn2);

        // 找到第一排checkbox丟進arr1
        checkArr1[0]= document.getElementById('checkArr1_0');
        checkArr1[0].addEventListener('click', checked_1);
        checkArr1[1]= document.getElementById('checkArr1_1');
        checkArr1[1].addEventListener('click', checked_1);
        checkArr1[2]= document.getElementById('checkArr1_2');
        checkArr1[2].addEventListener('click', checked_1);
        checkArr1[3]= document.getElementById('checkArr1_3');
        checkArr1[3].addEventListener('click', checked_1);
        checkArr1[4]= document.getElementById('checkArr1_4');
        checkArr1[4].addEventListener('click', checked_1);
        checkArr1[5]= document.getElementById('checkArr1_5');
        checkArr1[5].addEventListener('click', checked_1);
        checkArr1[6]= document.getElementById('checkArr1_6');
        checkArr1[6].addEventListener('click', checked_1);
        checkArr1[7]= document.getElementById('checkArr1_7');
        checkArr1[7].addEventListener('click', checked_1);
        checkArr1[8]= document.getElementById('checkArr1_8');
        checkArr1[8].addEventListener('click', checked_1);
        checkArr1[9]= document.getElementById('checkArr1_9');
        checkArr1[9].addEventListener('click', checked_1);

        // 找到第一排checkbox丟進arr2
        checkArr2[0]= document.getElementById('checkArr2_0');
        checkArr2[0].addEventListener('click', checked_2);
        checkArr2[1]= document.getElementById('checkArr2_1');
        checkArr2[1].addEventListener('click', checked_2);
        checkArr2[2]= document.getElementById('checkArr2_2');
        checkArr2[2].addEventListener('click', checked_2);
        checkArr2[3]= document.getElementById('checkArr2_3');
        checkArr2[3].addEventListener('click', checked_2);
        checkArr2[4]= document.getElementById('checkArr2_4');
        checkArr2[4].addEventListener('click', checked_2);
        checkArr2[5]= document.getElementById('checkArr2_5');
        checkArr2[5].addEventListener('click', checked_2);
        checkArr2[6]= document.getElementById('checkArr2_6');
        checkArr2[6].addEventListener('click', checked_2);
        checkArr2[7]= document.getElementById('checkArr2_7');
        checkArr2[7].addEventListener('click', checked_2);
        checkArr2[8]= document.getElementById('checkArr2_8');
        checkArr2[8].addEventListener('click', checked_2);
        checkArr2[9]= document.getElementById('checkArr2_9');
        checkArr2[9].addEventListener('click', checked_2);

        // 找到thead和tbody的tr
        var myThead = document.getElementById('myTheadTr');
        var myTbody = document.getElementById('myTbodyTr');

        // 做出全部title
        var newHeadTh0 = document.createElement('th');
        newHeadTh0.className = "border head_check_w padd5_0";
        var textTheadTh0 = document.createTextNode("全選");
        newHeadTh0.appendChild(textTheadTh0);
        tableTitle[0]=newHeadTh0;

        var newHeadTh1 = document.createElement('th');
        newHeadTh1.className = "border head_id_w padd5_0";
        var textTheadTh1 = document.createTextNode("會員編號");
        newHeadTh1.appendChild(textTheadTh1);
        tableTitle[1]=newHeadTh1;

        var newHeadTh2 = document.createElement('th');
        newHeadTh2.className = "border head_name_w padd5_0";
        var textTheadTh2 = document.createTextNode("會員姓名");
        newHeadTh2.appendChild(textTheadTh2);
        tableTitle[2]=newHeadTh2;

        var newHeadTh3 = document.createElement('th');
        newHeadTh3.className = "border head_acc_w padd5_0";
        var textTheadTh3 = document.createTextNode("會員帳號");
        newHeadTh3.appendChild(textTheadTh3);
        tableTitle[3]=newHeadTh3;

        var newHeadTh4 = document.createElement('th');
        newHeadTh4.className = "border head_pwd_w padd5_0";
        var textTheadTh4 = document.createTextNode("會員密碼");
        newHeadTh4.appendChild(textTheadTh4);
        tableTitle[4]=newHeadTh4;

        var newHeadTh5 = document.createElement('th');
        newHeadTh5.className = "border head_gender_w padd5_0";
        var textTheadTh5 = document.createTextNode("會員性別");
        newHeadTh5.appendChild(textTheadTh5);
        tableTitle[5]=newHeadTh5;

        var newHeadTh6 = document.createElement('th');
        newHeadTh6.className = "border head_birth_w padd5_0";
        var textTheadTh6 = document.createTextNode("會員生日");
        newHeadTh6.appendChild(textTheadTh6);
        tableTitle[6]=newHeadTh6;

        var newHeadTh7 = document.createElement('th');
        newHeadTh7.className = "border head_points_w padd5_0";
        var textTheadTh7 = document.createTextNode("會員點數");
        newHeadTh7.appendChild(textTheadTh7);
        tableTitle[7]=newHeadTh7;

        var newHeadTh8 = document.createElement('th');
        newHeadTh8.className = "border head_loyalty_w padd5_0";
        var textTheadTh8 = document.createTextNode("會員等級");
        newHeadTh8.appendChild(textTheadTh8);
        tableTitle[8]=newHeadTh8;

        var newHeadTh9 = document.createElement('th');
        newHeadTh9.className = "border head_phone_w padd5_0";
        var textTheadTh9 = document.createTextNode("會員電話");
        newHeadTh9.appendChild(textTheadTh9);
        tableTitle[9]=newHeadTh9;

        var newHeadTh10 = document.createElement('th');
        newHeadTh10.className = "border head_email_w padd5_0";
        var textTheadTh10 = document.createTextNode("會員信箱");
        newHeadTh10.appendChild(textTheadTh10);
        tableTitle[10]=newHeadTh10;

        var newHeadTh11 = document.createElement('th');
        newHeadTh11.className = "border head_address_w padd5_0";
        var textTheadTh11 = document.createTextNode("會員地址");
        newHeadTh11.appendChild(textTheadTh11);
        tableTitle[11]=newHeadTh11;

        var newHeadTh12 = document.createElement('th');
        newHeadTh12.className = "border head_features_w padd5_0";
        var textTheadTh12 = document.createTextNode("功能");
        newHeadTh12.appendChild(textTheadTh12);
        tableTitle[12]=newHeadTh12;
        
        // ========================================  onload  ========================================
        window.onload = function () {          
            showThead(1);
        };
        // ========================================  函式  ========================================
        function showThead(sw){
            theadCls();
            myThead.appendChild(tableTitle[0]);
            myThead.appendChild(tableTitle[1]);
            if(sw==1){
                for(let i=2;i<12;i++){                    
                    if(ifOutput1[i]==true){                    
                        myThead.appendChild(tableTitle[i]);
                    }                                                                
                }
            }
            if(sw==2){
                for(let i=2;i<12;i++){                                        
                    if(ifOutput2[i]==true){                    
                        myThead.appendChild(tableTitle[i]);
                    }                                                    
                }
            }            
            myThead.appendChild(tableTitle[12]);
        }

        function showTbody(){

        }

        function turn1(){
            showThead(1);
        }
        function turn2(){
            showThead(2);
        }
        function checked_1() {
            for(let i=0;i<10;i++){
                if (checkArr1[i].checked == true) {
                    ifOutput1[i+2] = true;
                }
                else {
                    ifOutput1[i+2] = false;
                }                   
            }                
                          
        }
        function checked_2() {
            for(let i=0;i<10;i++){
                if (checkArr2[i].checked == true) {
                    ifOutput2[i+2] = true;
                }
                else {
                    ifOutput2[i+2] = false;
                }
            }
                
              
                            
        }
        

        // 清除內容 
        function theadCls() {
            while (myThead.firstChild) {
                myThead.removeChild(myThead.firstChild);
            }
        }
        function tbodyCls() {
            while (myTbody.firstChild) {
                myTbody.removeChild(myTbody.firstChild);
            }
        }
    </script>

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