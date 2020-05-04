<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線
require_once('../templates/header.php');
require_once('../templates/leftSideBar.php');
require_once('../templates/rightContainer.php');

$search1 = isset($_GET['searchInput1']) ?  $_GET['searchInput1'] : "";
$checkBar_1_2 = isset($_POST['_1_2']) ?  "true" : "false";
$checkBar_1_3 = isset($_POST['_1_3']) ?  "true" : "false";
$checkBar_1_4 = isset($_POST['_1_4']) ?  "true" : "false";
$checkBar_1_5 = isset($_POST['_1_5']) ?  "true" : "false";
$checkBar_1_6 = isset($_POST['_1_6']) ?  "true" : "false";
$checkBar_1_7 = isset($_POST['_1_7']) ?  "true" : "false";
$checkBar_1_8 = isset($_POST['_1_8']) ?  "true" : "false";
$checkBar_1_9 = isset($_POST['_1_9']) ?  "true" : "false";
$checkBar_1_10 = isset($_POST['_1_10']) ?  "true" : "false";
$checkBar_1_11 = isset($_POST['_1_11']) ?  "true" : "false";

$checkBar_2_2 = isset($_POST['_2_2']) ?  "true" : "false";
$checkBar_2_3 = isset($_POST['_2_3']) ?  "true" : "false";
$checkBar_2_4 = isset($_POST['_2_4']) ?  "true" : "false";
$checkBar_2_5 = isset($_POST['_2_5']) ?  "true" : "false";
$checkBar_2_6 = isset($_POST['_2_6']) ?  "true" : "false";
$checkBar_2_7 = isset($_POST['_2_7']) ?  "true" : "false";
$checkBar_2_8 = isset($_POST['_2_8']) ?  "true" : "false";
$checkBar_2_9 = isset($_POST['_2_9']) ?  "true" : "false";
$checkBar_2_10 = isset($_POST['_2_10']) ?  "true" : "false";
$checkBar_2_11 = isset($_POST['_2_11']) ?  "true" : "false";

?>         
        <div class="container">
            <div class="searchDiv">
                <input type="button" class="myBtn btn btn-outline-dark mx-2 my-3" name="searchBtn" data-toggle="collapse" data-target="#searchDivDetail" aria-expanded="false" aria-controls="searchDivDetail" value="條件查詢">    
            </div>
            
            <div class="collapse searchDivDetail" id="searchDivDetail">
                <form name="myForm1" method="POST" action="members.php">
                    <div class="searchDD_1 d-flex ml-4">
                        
                        <input type="submit" class="searchBtn_D_1 btn btn-outline-secondary mx-4" id="searchBtn_D_0" value="關鍵字與欄位">
                        <input type="text" class="searchInput" id="searchInput1" name="searchInput1">                
                        
                    </div>
                    <div class="searchDD_2 d-flex ml-4">
                        <div class="searchDD_2_1 ml-5">
                            <!-- <input type="button" class="searchBtn_D_1" id="searchBtn_D_1" value="欄位查詢"> -->
                        </div>
                        <div class="searchDD_2_2 my-3">
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr1_0" name="_1_2" checked="true" />會員姓名
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr1_1" name="_1_3" checked="true" />會員帳號
                                
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr1_2" name="_1_4" checked="true" />會員密碼
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr1_3" name="_1_5" checked="true" />會員性別
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr1_4" name="_1_6" checked="true" />會員生日
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr1_5" name="_1_7" checked="true" />會員點數
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr1_6" name="_1_8" checked="true" />會員等級
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr1_7" name="_1_9" checked="true" />會員電話
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr1_8" name="_1_10" checked="true" />會員信箱
                            </label>
                            <label class="checkLabel">
                                <input type="checkbox" class="checkbox" id="checkArr1_9" name="_1_11" checked="true" />會員地址
                            </label>
                        </div>                
                    </div>
                <!-- </form> 
                <form name="myForm2" method="POST" action="admin.php"> -->
                    <div class="searchDD_3 d-flex ml-4 my-4">
                        <div class="searchDD_3_1">
                            <input type="button" class="searchBtn_D_2 btn btn-outline-secondary mx-4" id="searchBtn_D_2" value="欄位顯示">
                        </div>
                        <div class="searchDD_3_2">
                            <!-- <div class="searchDD_3_2_1">
                                <input type="text" class="searchInput" id="searchInput2" name="searchInput2">
                            </div> -->
                            <div class="searchDD_3_2_2">
                                <label class="checkLabel">
                                    <input type="checkbox" class="checkbox" id="checkArr2_0" name="_2_2" checked="true" />會員姓名
                                </label>
                                <label class="checkLabel">
                                    <input type="checkbox" class="checkbox" id="checkArr2_1" name="_2_3" checked="true" />會員帳號
                                </label>
                                <label class="checkLabel">
                                    <input type="checkbox" class="checkbox" id="checkArr2_2" name="_2_4" checked="true" />會員密碼
                                </label>
                                <label class="checkLabel">
                                    <input type="checkbox" class="checkbox" id="checkArr2_3" name="_2_5" checked="true" />會員性別
                                </label>
                                <label class="checkLabel">
                                    <input type="checkbox" class="checkbox" id="checkArr2_4" name="_2_6" checked="true" />會員生日
                                </label>
                                <label class="checkLabel">
                                    <input type="checkbox" class="checkbox" id="checkArr2_5" name="_2_7" checked="true" />會員點數
                                </label>
                                <label class="checkLabel">
                                    <input type="checkbox" class="checkbox" id="checkArr2_6" name="_2_8" checked="true" />會員等級
                                </label>
                                <label class="checkLabel">
                                    <input type="checkbox" class="checkbox" id="checkArr2_7" name="_2_9" checked="true" />會員電話
                                </label>
                                <label class="checkLabel">
                                    <input type="checkbox" class="checkbox" id="checkArr2_8" name="_2_10" checked="true" />會員信箱
                                </label>
                                <label class="checkLabel">
                                    <input type="checkbox" class="checkbox" id="checkArr2_9" name="_2_11" checked="true" />會員地址
                                </label>
                            </div>
                        </div>                                
                    </div>
                    <!-- <input type="hidden" id="iList1_data" name="iList1_data" value="" />
                    <input type="hidden" id="iList2_data" name="iList2_data" value="" />
                    <input type="hidden" id="iList3_data" name="iList3_data" value="" />
                    <input type="submit" id="postSort" name="postSort" style="display:none;" /> -->
                </form>    
            </div>                

    <form name="myForm3" method="POST" action="../action/deleteMultipleMember.php">
            <div class="btnDiv d-flex">
                <input type="submit" class="myBtn btn btn-outline-danger mx-2" name="smb" onclick="return confirm('是否刪除?')" value="刪除勾選">
                <button type="button" class="myBtn btn btn btn-outline-success mx-2" onclick="newFunc()" data-toggle="modal" data-target="#newModel" 
                data-whatever="">新增</button>
            </div>
            <div class="tableWrap">
                
                <table class="thead-dark ">
                    <thead class="table-striped myThead " id="myThead">
                        <tr class="myTheadTr" id="myTheadTr">
                            <th class="border head_check_w padd5_0" id="headTh_0">
                                <div class="clickAll_d">
                                    <label class="checkBoxLabel pl-1">
                                        <input type="checkbox" class="checkbox clickAll" id="clickAll" name="clickAll" />全選
                                    </label>                            
                                </div>
                                <div class="clickReverse_d">
                                    <label class="checkBoxLabel pl-1">
                                        <input type="checkbox" class="checkbox clickReverse" id="clickReverse" name="clickReverse" />反選
                                    </label>
                                </div>

                            </th>

                        </tr>
                    </thead>
                    <tbody class="myTbody" id="myTbody">
    <?php
    
    $sql = "SELECT `id`, `userId`, `name`, `gender`, `birthday`,`userCreditCard`,
                    `userCity`, `address`, `userEmail`,`phoneNumber`,
                    `username`,`pwd`,`userPoint`,`userLoyalty`";
    
    $sql .= "FROM `users`" ;
    
    if(isset($_POST['searchInput1'])){
        
        $sql .= " WHERE `userId` = '-1' ";
        
        if($checkBar_1_2=="true"){
            $sql .= " OR `name` LIKE '%{$_POST['searchInput1']}%' ";
        }
        if($checkBar_1_3=="true"){
            $sql .= " OR `username` LIKE '%{$_POST['searchInput1']}%' ";
        }
        if($checkBar_1_4=="true"){
            $sql .= " OR `pwd` LIKE '%{$_POST['searchInput1']}%' ";
        }
        if($checkBar_1_5=="true"){
            $sql .= " OR `gender` LIKE '%{$_POST['searchInput1']}%' ";
        }
        if($checkBar_1_6=="true"){
            $sql .= " OR `birthday` LIKE '%{$_POST['searchInput1']}%' ";
        }
        if($checkBar_1_7=="true"){
            $sql .= " OR `userPoint` LIKE '%{$_POST['searchInput1']}%' ";
        }
        if($checkBar_1_8=="true"){
            $sql .= " OR `userLoyalty` LIKE '%{$_POST['searchInput1']}%' ";
        }
        if($checkBar_1_9=="true"){
            $sql .= " OR `phoneNumber` LIKE '%{$_POST['searchInput1']}%' ";
        }
        if($checkBar_1_10=="true"){
            $sql .= " OR `userEmail` LIKE '%{$_POST['searchInput1']}%' ";
        }
        if($checkBar_1_11=="true"){
            $sql .= " OR `address` LIKE '%{$_POST['searchInput1']}%' ";
        }

    }
    
                        
    $sql .= " ORDER BY `id` ASC ";
    
    //SQL 敘述: 取得 students 資料表總筆數
    $sqlTotal = "SELECT count(1) FROM ({$sql}) AS `requireSql`";

    // 取得總筆數
    $total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0];

    //每頁幾筆
    $numPerPage = 10;

    // 總頁數
    $totalPages = ceil($total / $numPerPage);

    //目前第幾頁
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

    //若 page 小於 1，則回傳 1
    $page = $page < 1 ? 1 : $page;

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
                            <td class="border pl-2 tbodyTd0">
                                <input type="checkbox" class="ifdelete" id="ifdelete" name="chk[]" value="<?php echo $arr[$i]['id']; ?>" />
                            </td>                            
                            <td class="border head_id_w pl-1 tbodyTd1"><?php echo $arr[$i]['userId']; ?></td>
                            <td class="border head_name_w pl-1 tbodyTd2"><?php echo $arr[$i]['name']; ?></td>
                            <td class="border head_acc_w pl-1 tbodyTd3"><?php echo $arr[$i]['username']; ?></td>
                            <td class="border head_pwd_w pl-1 tbodyTd4"><?php echo $arr[$i]['pwd']; ?></td>
                            <td class="border head_gender_w pl-1 tbodyTd5"><?php echo $arr[$i]['gender']; ?></td>
                            <td class="border head_birth_w pl-1 tbodyTd6"><?php echo $arr[$i]['birthday']; ?></td>
                            <td class="border head_points_w pl-1 tbodyTd7"><?php echo $arr[$i]['userPoint']; ?></td>
                            <td class="border head_loyalty_w pl-1 tbodyTd8"><?php echo $arr[$i]['userLoyalty']; ?></td>
                            <td class="border head_phone_w pl-1 tbodyTd9"><?php echo $arr[$i]['phoneNumber']; ?></td>
                            <td class="border head_email_w pl-1 tbodyTd10"><?php echo $arr[$i]['userEmail']; ?></td>
                            <td class="border head_address_w pl-1 tbodyTd11"><?php echo $arr[$i]['address']; ?></td>
                            <td class="border head_features_w pl-1 tbodyTd12 d-flex">
                                <!-- <a href="">詳細資料</a> -->
                                <!-- onclick function(this)this就是送自己 -->
                                <button type="button" class="myFeatureBtn btn btn-outline-primary mx-2" onclick="editFunc(this)" data-toggle="modal" data-target="#editModel" data-id="<?php echo $arr[$i]['id']; ?>" 
                                data-whatever="<?php echo $arr[$i]['id']; ?>">編輯</button>
                                
                                <button type="button" class="myFeatureBtn btn btn-outline-danger mx-2" onclick="if(confirm('是否刪除?'))location.href='../action/deleteMember.php?deleteId=<?php echo $arr[$i]['id']; ?>'" >刪除</button>

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
                                <a class="myPageBtn btn btn-outline-secondary" href="?page=<?=$i?>"><?=$i?></a>
                            <?php }?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModel" data-whatever="testtest">testtest</button> -->
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
        // searchBtn2= document.getElementById('searchBtn_D_1');
        // searchBtn2.addEventListener('click', turn1);
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

        // 找到tbody
        var myTbody = document.getElementById('myTbody');
        
        
        // 找到thead和tbody的tr
        var myTheadTr = document.getElementById('myTheadTr');
        var myTbodyTr = document.getElementById('myTbodyTr');

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
        newHeadTh1.className = "border head_id_w pl-1 d-flex";
        var textTheadTh1 = document.createTextNode("編號");        
        var iTheadTh1 = document.createElement('i');
        iTheadTh1.className="zmdi zmdi-caret-down-circle myIList mx-2";
        iTheadTh1.id="iList1";
        iTheadTh1.setAttribute('name','iList1');        
        iTheadTh1.addEventListener('click', iList1Func);        
        newHeadTh1.appendChild(textTheadTh1);
        newHeadTh1.appendChild(iTheadTh1);
        tableTitle[1]=newHeadTh1;

        var newHeadTh2 = document.createElement('th');
        newHeadTh2.className = "border head_name_w pl-1";
        var textTheadTh2 = document.createTextNode("會員姓名");
        newHeadTh2.appendChild(textTheadTh2);
        tableTitle[2]=newHeadTh2;

        var newHeadTh3 = document.createElement('th');
        newHeadTh3.className = "border head_acc_w pl-1";
        var textTheadTh3 = document.createTextNode("會員帳號");
        var iTheadTh3 = document.createElement('i');
        iTheadTh3.className="zmdi zmdi-caret-down-circle myIList mx-2";
        iTheadTh3.id="iList2";
        iTheadTh3.setAttribute('name','iList2');
        iTheadTh3.addEventListener('click', iList2Func);
        newHeadTh3.appendChild(textTheadTh3);
        newHeadTh3.appendChild(iTheadTh3);
        tableTitle[3]=newHeadTh3;

        var newHeadTh4 = document.createElement('th');
        newHeadTh4.className = "border head_pwd_w pl-1";
        var textTheadTh4 = document.createTextNode("會員密碼");
        newHeadTh4.appendChild(textTheadTh4);
        tableTitle[4]=newHeadTh4;

        var newHeadTh5 = document.createElement('th');
        newHeadTh5.className = "border head_gender_w pl-1 d-flex";
        var textTheadTh5 = document.createTextNode("性別");
        var iTheadTh5 = document.createElement('i');
        iTheadTh5.className="zmdi zmdi-caret-down-circle myIList mx-2";
        iTheadTh5.id="iList3";
        iTheadTh5.setAttribute('name','iList3');
        iTheadTh5.addEventListener('click', iList3Func);
        newHeadTh5.appendChild(textTheadTh5);
        newHeadTh5.appendChild(iTheadTh5);
        tableTitle[5]=newHeadTh5;

        var newHeadTh6 = document.createElement('th');
        newHeadTh6.className = "border head_birth_w pl-1";
        var textTheadTh6 = document.createTextNode("會員生日");
        newHeadTh6.appendChild(textTheadTh6);
        tableTitle[6]=newHeadTh6;

        var newHeadTh7 = document.createElement('th');
        newHeadTh7.className = "border head_points_w pl-1";
        var textTheadTh7 = document.createTextNode("會員點數");
        newHeadTh7.appendChild(textTheadTh7);
        tableTitle[7]=newHeadTh7;

        var newHeadTh8 = document.createElement('th');
        newHeadTh8.className = "border head_loyalty_w pl-1";
        var textTheadTh8 = document.createTextNode("會員等級");
        newHeadTh8.appendChild(textTheadTh8);
        tableTitle[8]=newHeadTh8;

        var newHeadTh9 = document.createElement('th');
        newHeadTh9.className = "border head_phone_w pl-1";
        var textTheadTh9 = document.createTextNode("會員電話");
        newHeadTh9.appendChild(textTheadTh9);
        tableTitle[9]=newHeadTh9;

        var newHeadTh10 = document.createElement('th');
        newHeadTh10.className = "border head_email_w pl-1";
        var textTheadTh10 = document.createTextNode("會員信箱");
        newHeadTh10.appendChild(textTheadTh10);
        tableTitle[10]=newHeadTh10;

        var newHeadTh11 = document.createElement('th');
        newHeadTh11.className = "border head_address_w pl-1";
        var textTheadTh11 = document.createTextNode("會員地址");
        newHeadTh11.appendChild(textTheadTh11);
        tableTitle[11]=newHeadTh11;

        var newHeadTh12 = document.createElement('th');
        newHeadTh12.className = "border head_features_w pl-1";
        var textTheadTh12 = document.createTextNode("功能");
        newHeadTh12.appendChild(textTheadTh12);
        tableTitle[12]=newHeadTh12;
        
        // ========================================  onload  ========================================
        window.onload = function () {          
            showThead(2);
            // console.log($('#iList1_data').val()); 
            // console.log($('#iList2_data').val()); 
            // console.log($('#iList3_data').val()); 
            console.log($('#myTbody').children('tr').length);
        };
        // ========================================  函式  ========================================
        function showThead(sw){
            theadCls();
            myThead.appendChild(tableTitle[0]);
            myThead.appendChild(tableTitle[1]);
            // if(sw==1){
            //     for(let i=2;i<12;i++){                    
            //         if(ifOutput1[i]==true){                    
            //             myThead.appendChild(tableTitle[i]);
            //             if($('.tbodyTd'+[i]).is(':hidden')){　　
            //                 $('.tbodyTd'+[i]).show();　
            //             }
                        
            //         }  
            //         if(ifOutput1[i]==false){                    
            //             $('.tbodyTd'+[i]).hide();
            //         }                                                             
            //     }
            // }
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

        // 變更圖片
        function changeImg_new(){
            var showImg_new =$("#userImg_new").get(0).files ;
            if(showImg_new[0].name){                                
                $("#userImg_new_src").attr('src','../images/members/'+showImg_new[0].name);
            }            
        }
        
        function changeImg_edit(){
            var showImg_edit =$("#userImg_edit").get(0).files ;
            if(showImg_edit[0].name){                                
                $("#userImg_edit_src").attr('src','../images/members/'+showImg_edit[0].name);
                $("#userImg_edit_label").text(showImg_edit[0].name);
            }            
        }

        // 排序圖示
        function iList1Func(){  
            console.log('按了1 : '+$('#iList1_data').val());          
            if(($('#iList1_data').val()=='down')||($('#iList1_data').val()=='')){                
                // $('#iList1').attr('sort','up');
                $('#iList1').attr('class','zmdi zmdi-caret-up-circle myIList mx-2');
                $('#iList1_data').val('up');
            }
            else{
                // $('#iList1').attr('sort','down');
                $('#iList1').attr('class','zmdi zmdi-caret-down-circle myIList mx-2');
                $('#iList1_data').val('down');
            }     
            $('#iList2').attr('class','zmdi zmdi-caret-down-circle myIList mx-2');
            $('#iList3').attr('class','zmdi zmdi-caret-down-circle myIList mx-2');
            $('#iList2_data').val('down');
            $('#iList3_data').val('down');  
            sortClick(1);   
        }
        function iList2Func(){
            console.log('按了2 : '+$('#iList2_data').val());  
            if($('#iList2_data').val()=='down'){                
                // $('#iList2').attr('sort','up');
                $('#iList2').attr('class','zmdi zmdi-caret-up-circle myIList mx-2');
                $('#iList2_data').val('up');
            }
            else{
                // $('#iList2').attr('sort','down');
                $('#iList2').attr('class','zmdi zmdi-caret-down-circle myIList mx-2');
                $('#iList2_data').val('down');
            }
            $('#iList1').attr('class','zmdi zmdi-caret-down-circle myIList mx-2');
            $('#iList3').attr('class','zmdi zmdi-caret-down-circle myIList mx-2');
            $('#iList1_data').val('down');
            $('#iList3_data').val('down'); 
            sortClick(3);  
        }
        function iList3Func(){
            console.log('按了3 : '+$('#iList3_data').val());  
            if($('#iList3_data').val()=='down'){                
                // $('#iList3').attr('sort','up');
                $('#iList3').attr('class','zmdi zmdi-caret-up-circle myIList mx-2');
                $('#iList3_data').val('up');
            }
            else{
                // $('#iList3').attr('sort','down');
                $('#iList3').attr('class','zmdi zmdi-caret-down-circle myIList mx-2');
                $('#iList3_data').val('down');
            }
            $('#iList1').attr('class','zmdi zmdi-caret-down-circle myIList mx-2');
            $('#iList2').attr('class','zmdi zmdi-caret-down-circle myIList mx-2');
            $('#iList1_data').val('down');
            $('#iList2_data').val('down'); 
            sortClick(5); 
        }                    

        // modal按鈕觸發Form裡面的submit
        function newGo(){            
            $('#smb_new').click();
        }
        function editGo(){            
            $('#smb_edit').click();
        }
        
        // 新增按鈕Func
        function newFunc(){

        }

        // 編輯按鈕Func
        function editFunc(selfone){
            var linkId=$(selfone).attr('data-id');  // btn this data
            // alert(getId);
            // selfone就是傳過來的this                    
            // console.log(selfone);
            // alert(linkId);
            // alert(selfone.getAttribute('data-id'));
            $.ajax({ 
                method: 'POST', // GET 
                url: "editMemberLink.php ", // 23-1-1.php?getMethod=1 
                data: { 
                    postMethod: "1",
                    postId: linkId
                }
            })
            .done(function(data) {  // suc
                var dataJson=JSON.parse(data);
                console.log(JSON.parse(data));                
                // alert(data['pwd']);
                // alert(data['address']);
                console.log(dataJson["name"]);
                // 給editId值，該值是修改鈕送過來的值
                $("#editId").val(linkId);
                // 把傳回來的data裡的值用jquery丟進input
                $("#userId_edit").val(dataJson['userId']);
                $("#username_edit").val(dataJson['username']);
                $("#pwd_edit").val(dataJson['pwd']);
                $("#userPoint_edit").val(dataJson['userPoint']);
                $("#userLoyalty_edit").val(dataJson['userLoyalty']);
                $("#userCreditCard_edit").val(dataJson['userCreditCard']);
                $("#name_edit").val(dataJson['name']);
                $("#birthday_edit").val(dataJson['birthday']);
                $("#gender_edit").val(dataJson['gender']);
                $("#userCity_edit").val(dataJson['userCity']);
                $("#address_edit").val(dataJson['address']);
                $("#userEmail_edit").val(dataJson['userEmail']);
                $("#phoneNumber_edit").val(dataJson['phoneNumber']);
                // 顯示大頭貼  
                if(dataJson['userImg']){
                    $("#userImg_edit_src").attr('src','../images/members/'+dataJson['userImg']); 
                    $("#userImg_edit_label").text(dataJson['userImg']);   
                }              
                else{
                    $("#userImg_edit_src").attr('src','../images/members/user.svg');
                    $("#userImg_edit_label").text('未指定大頭貼');   
                }                                           
                // var imgFile_edit = $("#userImg_edit").get(0).files;
                // $("#userImg_edit").get(0).files=dataJson['userImg'];
                // imgFile[0].name.append(data['userImg']);
                // console.log("imgFile = "+imgFile);
                // console.log("imgFile[0] = "+imgFile[0]);
                // console.log("imgFile[0].name = "+imgFile[0].name);
                // console.log("imgFile[0].size = "+imgFile[0].size);
                // console.log("imgFile[1] = "+imgFile[1]);                                              
            })
            .fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });            
        } 

        // 排序勾選欄位
        function sortClick(_sort){
            var _arrNew=[];
            var _arrSort=[];
            var _arr=$('#myTbody').children('tr');
            for( let i = 0 ; i < _arr.length ; i++ ){
                
                _arrSort[i]=_arr[i].getElementsByTagName("td");
                console.log(_arrSort[i][_sort].innerHTML);
                // _arrSort[i].append(_arr[i].getElementsByTagName("td"));                  
                // console.log(_arrSort[i]);
                // console.log(_arrSort[i][0].innerHTML);
            }                        
        }               
    </script>

        <div class="modal fade" id="newModel" tabindex="-1" role="dialog" aria-labelledby="newModelLabel" aria-hidden="true">
            <div class="modal-dialog vertical-align-center" role="document">
                <div class="modal-content" style="width:700px;height:auto;">
                    <div class="modal-header">
                        <h1 class="modal-title" id="newModelLabel">新增會員資料</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div style="width:auto;height:auto;overflow:auto;">
                            <form name="myForm_new" method="POST" action="../action/insertMember.php" enctype="multipart/form-data">
                                <?php
                                // 引入新增頁面
                                require_once('./newMember.php');
                                ?>     
                            </form>
                        </div>
                    </div> 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" id="newGo" onclick="newGo()">新增</button>
                    </div>                   
                </div>
            </div>
        </div>


        <div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="editModelLabel" aria-hidden="true">
            <div class="modal-dialog vertical-align-center" role="document">
                <div class="modal-content" style="width:700px;height:auto;">
                    <div class="modal-header">
                        <h1 class="modal-title" id="editModelLabel">編輯會員資料</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div style="width:auto;height:auto;overflow:auto;">
                            <form name="myForm_edit" method="POST" action="../action/updateEditMember.php" enctype="multipart/form-data">
                                <?php
                                // 引入修改頁面
                                require_once('./editMember.php');
                                ?>     
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" id="editGo" onclick="editGo()">執行更新</button>
                         
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" id="iList1_data" name="iList1_data" value="down" />
        <input type="hidden" id="iList2_data" name="iList2_data" value="down" />
        <input type="hidden" id="iList3_data" name="iList3_data" value="down" />

<?php
require_once('../templates/footer.php');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="../backstageCss/members.css">
