<?php
//引入判斷是否登入機制
require_once './checkSession.php';

//引用資料庫連線
require_once './db.inc.php';

//SQL 敘述: 取得 students 資料表總筆數
$sqlTotal = "SELECT count(1) FROM `users`";

//取得總筆數
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0];

//每頁幾筆
$numPerPage = 10;

// 總頁數
$totalPages = ceil($total / $numPerPage);

//目前第幾頁
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

//若 page 小於 1，則回傳 1
$page = $page < 1 ? 1 : $page;

$search1 = isset($_GET['searchInput1']) ?  $_GET['searchInput1'] : "";
$search2 = isset($_GET['searchInput1']) ?  $_GET['searchInput1'] : "";





?>
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
<?php require_once './templates/title.php';?>
<hr />

    
     
        <div class="container">
            <div class="searchDiv">
                <input type="button" class="myBtn" name="searchBtn" data-toggle="collapse" data-target="#searchDivDetail" aria-expanded="false" aria-controls="searchDivDetail" value="條件查詢">    
            </div>
            
            <div class="collapse searchDivDetail" id="searchDivDetail">
                <form name="myForm1" method="POST" action="admin.php">
                    <div class="searchDD_1 d-flex">
                        
                        <input type="submit" class="searchBtn_D_1" id="searchBtn_D_0" value="關鍵字查詢">
                        <input type="text" class="searchInput" id="searchInput1" name="searchInput1">                
                        
                    </div>
                    <div class="searchDD_2 d-flex">
                        <div class="searchDD_2_1">
                            <input type="button" class="searchBtn_D_1" id="searchBtn_D_1" value="欄位查詢">
                        </div>
                        <div class="searchDD_2_2">
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr1_0" name="" checked="true" />會員姓名
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr1_1" name="" checked="true" />會員帳號
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr1_2" name="" checked="true" />會員密碼
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr1_3" name="" checked="true" />會員性別
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr1_4" name="" checked="true" />會員生日
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr1_5" name="" checked="true" />會員點數
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr1_6" name="" checked="true" />會員等級
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr1_7" name="" checked="true" />會員電話
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr1_8" name="" checked="true" />會員信箱
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr1_9" name="" checked="true" />會員地址
                            </label>
                        </div>                
                    </div>
                </form> 
                <form name="myForm2" method="POST" action="admin.php">
                    <div class="searchDD_3 d-flex">
                        <div class="searchDD_3_1">
                            <input type="submit" class="searchBtn_D_2" id="searchBtn_D_2" value="混合查詢">
                        </div>
                        <div class="searchDD_3_2">
                            <div class="searchDD_3_2_1">
                                <input type="text" class="searchInput" id="searchInput2" name="searchInput2">
                            </div>
                            <div class="searchDD_3_2_2">
                                <label class="checkLabel">
                                    <input type="checkbox" class="checkbox" id="checkArr2_0" name="" checked="true" />會員姓名
                                </label>
                                <label class="checkLabel">
                                    <input type="checkbox" class="checkbox" id="checkArr2_1" name="" checked="true" />會員帳號
                                </label>
                                <label class="checkLabel">
                                    <input type="checkbox" class="checkbox" id="checkArr2_2" name="" checked="true" />會員密碼
                                </label>
                                <label class="checkLabel">
                                    <input type="checkbox" class="checkbox" id="checkArr2_3" name="" checked="true" />會員性別
                                </label>
                                <label class="checkLabel">
                                    <input type="checkbox" class="checkbox" id="checkArr2_4" name="" checked="true" />會員生日
                                </label>
                                <label class="checkLabel">
                                    <input type="checkbox" class="checkbox" id="checkArr2_5" name="" checked="true" />會員點數
                                </label>
                                <label class="checkLabel">
                                    <input type="checkbox" class="checkbox" id="checkArr2_6" name="" checked="true" />會員等級
                                </label>
                                <label class="checkLabel">
                                    <input type="checkbox" class="checkbox" id="checkArr2_7" name="" checked="true" />會員電話
                                </label>
                                <label class="checkLabel">
                                    <input type="checkbox" class="checkbox" id="checkArr2_8" name="" checked="true" />會員信箱
                                </label>
                                <label class="checkLabel">
                                    <input type="checkbox" class="checkbox" id="checkArr2_9" name="" checked="true" />會員地址
                                </label>
                            </div>
                        </div>                                
                    </div>
                </form>    
            </div>
    
    <form name="myForm3" method="POST" action="deleteMultipleChecks.php">
            <div class="btnDiv">
                <input type="submit" class="myBtn" name="smb" value="刪除勾選">
            </div>
            <div class="tableWrap">
                <table>
                    <thead class="myThead" id="myThead">
                        <tr class="myTheadTr" id="myTheadTr">
                            <th class="border head_check_w padd5_0" id="headTh_0">
                                <div class="clickAll_d">
                                    <label class="checkBoxLabel">
                                        <input type="checkbox" class="checkbox clickAll" id="clickAll" name="clickAll" />全選
                                    </label>                            
                                </div>
                                <div class="clickReverse_d">
                                    <label class="checkBoxLabel">
                                        <input type="checkbox" class="checkbox clickReverse" id="clickReverse" name="clickReverse" />反選
                                    </label>
                                </div>

                            </th>

                        </tr>
                    </thead>
                    <tbody class="myTbody" id="myTbody">
    <?php

    //SQL 敘述
    $sql = "SELECT `id`, `userId`, `name`, `gender`, `birthday`,
                    `userCity`, `address`, `userEmail`,`phoneNumber`,
                    `username`,`pwd`,`userPoint`,`userLoyalty`
            FROM `users`" ;
    if(isset($_POST['searchInput1'])){
        $sql .= " WHERE `userId` LIKE '%{$_POST['searchInput1']}%' ";
        $sql .= " OR `name` LIKE '%{$_POST['searchInput1']}%' ";
        $sql .= " OR `username` LIKE '%{$_POST['searchInput1']}%' ";
        $sql .= " OR `pwd` LIKE '%{$_POST['searchInput1']}%' ";
        $sql .= " OR `gender` LIKE '%{$_POST['searchInput1']}%' ";
        $sql .= " OR `birthday` LIKE '%{$_POST['searchInput1']}%' ";
        $sql .= " OR `address` LIKE '%{$_POST['searchInput1']}%' ";
        $sql .= " OR `userEmail` LIKE '%{$_POST['searchInput1']}%' ";
        $sql .= " OR `phoneNumber` LIKE '%{$_POST['searchInput1']}%' ";
        $sql .= " OR `userPoint` LIKE '%{$_POST['searchInput1']}%' ";
        $sql .= " OR `userLoyalty` LIKE '%{$_POST['searchInput1']}%' ";
    }
    if(isset($_POST['searchInput2'])){
        $sql .= " WHERE `userId` LIKE '%{$_POST['searchInput2']}%' ";
        $sql .= " OR `name` LIKE '%{$_POST['searchInput2']}%' ";
        $sql .= " OR `username` LIKE '%{$_POST['searchInput2']}%' ";
        $sql .= " OR `pwd` LIKE '%{$_POST['searchInput2']}%' ";
        $sql .= " OR `gender` LIKE '%{$_POST['searchInput2']}%' ";
        $sql .= " OR `birthday` LIKE '%{$_POST['searchInput2']}%' ";
        $sql .= " OR `address` LIKE '%{$_POST['searchInput2']}%' ";
        $sql .= " OR `userEmail` LIKE '%{$_POST['searchInput2']}%' ";
        $sql .= " OR `phoneNumber` LIKE '%{$_POST['searchInput2']}%' ";
        $sql .= " OR `userPoint` LIKE '%{$_POST['searchInput2']}%' ";
        $sql .= " OR `userLoyalty` LIKE '%{$_POST['searchInput2']}%' ";
    }
                    
    $sql .= " ORDER BY `id` ASC ";
    $sql .= " LIMIT ?, ? ";

    //設定繫結值
    $arrParam = [($page - 1) * $numPerPage, $numPerPage];

    //查詢分頁後的學生資料
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);
    
    //資料數量大於 0，則列出所有資料
    if ($stmt->rowCount() > 0) {
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < count($arr); $i++) {
            ?>                        
                        <tr class="myTbodyTr" id="myTbodyTr">
                        <td class="border padd5_0 tbodyTd0">
                                <input type="checkbox" class="ifdelete" id="ifdelete" name="chk[]" value="<?php echo $arr[$i]['id']; ?>" />
                            </td>                            
                            <td class="border head_id_w padd5_0 tbodyTd1"><?php echo $arr[$i]['userId']; ?></td>
                            <td class="border head_name_w padd5_0 tbodyTd2"><?php echo $arr[$i]['name']; ?></td>
                            <td class="border head_acc_w padd5_0 tbodyTd3"><?php echo $arr[$i]['username']; ?></td>
                            <td class="border head_pwd_w padd5_0 tbodyTd4"><?php echo $arr[$i]['pwd']; ?></td>
                            <td class="border head_gender_w padd5_0 tbodyTd5"><?php echo $arr[$i]['gender']; ?></td>
                            <td class="border head_birth_w padd5_0 tbodyTd6"><?php echo $arr[$i]['birthday']; ?></td>
                            <td class="border head_points_w padd5_0 tbodyTd7"><?php echo $arr[$i]['userPoint']; ?></td>
                            <td class="border head_loyalty_w padd5_0 tbodyTd8"><?php echo $arr[$i]['userLoyalty']; ?></td>
                            <td class="border head_phone_w padd5_0 tbodyTd9"><?php echo $arr[$i]['phoneNumber']; ?></td>
                            <td class="border head_email_w padd5_0 tbodyTd10"><?php echo $arr[$i]['userEmail']; ?></td>
                            <td class="border head_address_w padd5_0 tbodyTd11"><?php echo $arr[$i]['address']; ?></td>
                            <td class="border head_features_w padd5_0 tbodyTd12">
                                <!-- <a href="">詳細資料</a> -->

                                <button type="button" class="btn btn-primary" id="_test" data-toggle="modal" data-target="#exampleModal" data-id="<?php echo $arr[$i]['id']; ?>" 
                                data-whatever="<?php echo $arr[$i]['id']; ?>">編輯</button>
                                
                                <a class="btn btn-danger" href="./delete.php?deleteId=<?php echo $arr[$i]['id']; ?>">刪除</a>

                            </td>
                        </tr>
                        <?php
        }
    } else {
        ?>
                        <tr>
                            <td class="border" colspan="9">沒有資料</td>
                        </tr>
                    <?php
    }
    ?>                    
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="border page_" colspan="13">
                            <?php for ($i = 1; $i <= $totalPages; $i++) {?>
                                <a href="?page=<?=$i?>"><?=$i?></a>
                            <?php }?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="testtest">testtest</button> -->
            </div>
        </div>
    </form>

    <script>
                                        
        var ifOutput1 = [true, true, true, true, true, true, true, true, true, true, true, true, true];
        var ifOutput2 = [true, true, true, true, true, true, true, true, true, true, true, true, true];
        var tableTitle = []; 
        var tableBody = [];   
        var checkArr1 = [];
        var checkArr2 = [];
        var deleteCheckArr = [];
        var searchBtn1,searchBtn2,searchBtn3;
        // 抓button
        searchBtn2= document.getElementById('searchBtn_D_1');
        searchBtn2.addEventListener('click', turn1);
        searchBtn3= document.getElementById('searchBtn_D_2');
        searchBtn3.addEventListener('click', turn2);

        // 抓到全選、反選
        var clickAll= document.getElementById('clickAll');
        clickAll.checked=false;
        clickAll.addEventListener('click', click_all);
        var clickReverse= document.getElementById('clickReverse');
        clickReverse.checked=false;
        clickReverse.addEventListener('click', click_Reverse);
        var ifDeleteArr=document.getElementsByClassName("ifdelete");
        // console.log(ifDeleteArr.length);
        // console.log(ifDeleteArr[0].checked,ifDeleteArr[1].checked);

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

        // 找到第二排checkbox丟進arr2
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
        // var newHeadTh0 = document.createElement('th');
        // newHeadTh0.className = "border head_check_w padd5_0";
        //     // 全選勾勾
        // var clickAll_d = document.createElement('div');
        // clickAll_d.className= "clickAll_d";
        // var clickLabel_all = document.createElement('label');        
        // var headCheckBox0_all = document.createElement('checkbox');
        // headCheckBox0_all.className= "checkbox clickAll";
        // var textTheadTh0_all = document.createTextNode("全選");
        // clickLabel_all.appendChild(headCheckBox0_all);
        // clickLabel_all.appendChild(textTheadTh0_all);
        // clickAll_d.appendChild(clickLabel_all);
        //     // 反選勾勾
        // var clickReverse_d = document.createElement('div');
        // clickReverse_d.className= "clickReverse_d";
        // var clickLabel_rev = document.createElement('label');
        // var headCheckBox0_rev = document.createElement('checkbox');
        // headCheckBox0_rev.className= "checkbox clickReverse";
        // var textTheadTh0_rev = document.createTextNode("反選");
        // clickLabel_rev.appendChild(headCheckBox0_rev);
        // clickLabel_rev.appendChild(textTheadTh0_rev);
        // clickReverse_d.appendChild(clickLabel_rev);
        //     // 兩個勾勾接到th
        // newHeadTh0.appendChild(clickAll_d);
        // newHeadTh0.appendChild(clickReverse_d);



        var newHeadTh0=document.getElementById('headTh_0');
            // 丟進arr
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
                        if($('.tbodyTd'+[i]).is(':hidden')){　　
                            $('.tbodyTd'+[i]).show();　
                        }
                        
                    }  
                    if(ifOutput1[i]==false){                    
                        $('.tbodyTd'+[i]).hide();
                    }                                                             
                }
            }
            if(sw==2){
                for(let i=2;i<12;i++){                                        
                    if(ifOutput2[i]==true){                    
                        myThead.appendChild(tableTitle[i]);
                        if($('.tbodyTd'+[i]).is(':hidden')){　　
                            $('.tbodyTd'+[i]).show();　
                        }
                    }  
                    if(ifOutput2[i]==false){                    
                        $('.tbodyTd'+[i]).hide();
                    }                                                 
                }
            }            
            myThead.appendChild(tableTitle[12]);
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
        function click_all(){            
            clickReverse.checked=false;
            if (clickAll.checked == true){                                
                console.log("clicl all = true");
                for(var i=0;i<ifDeleteArr.length;i++){
                    
                    ifDeleteArr[i].checked=true;
                    
                }
                
            }
            else{                
                console.log("clicl all = false");
                for(var i=0;i<ifDeleteArr.length;i++){
                    ifDeleteArr[i].checked=false;
                }
            }
        }
        function click_Reverse(){
            clickAll.checked == false;
            for(var i=0;i<ifDeleteArr.length;i++){
                if (ifDeleteArr[i].checked == true){              
                    ifDeleteArr[i].checked = false;
                    
                }
                else{                
                    ifDeleteArr[i].checked = true;
                
            }
                }
            if (clickReverse.checked == true){              
                console.log("clicl Reverse = true");
                
            }
            else{                
                console.log("clicl Reverse = false");
                
            }
        }
        // 清除內容 
        function theadCls() {
            while (myThead.firstChild) {
                myThead.removeChild(myThead.firstChild);
            }
        }
        // function tbodyCls() {
        //     while (myTbody.firstChild) {
        //         myTbody.removeChild(myTbody.firstChild);
        //     }
        // }
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
    <script>
        
        $('#_test').click(function(){
                alert($('#_test').attr('data-id'));
                
            });
        
        // $('#exampleModal').on('show.bs.modal', function (event) {
        //     var button = $(event.relatedTarget); // Button that triggered the modal
        //     var recipient = button.data('whatever'); // Extract info from data-* attributes
            
        //     var modal = $(this);
        //     modal.find('.modal-title').text('New message to ' + recipient);
        //     modal.find('.modal-body input').val(recipient);

        //     $('.testtest').click(function(){
        //         alert('test');
        //     });
        // })
    </script>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <?php
            // 引入修改頁面
            require_once('./edit.php');
            ?>     
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('#exampleModalLabel').val();
</script>


</body>

</html>