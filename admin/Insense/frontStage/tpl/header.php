<style>
    .header-bg{
        background: rgba(219, 229, 240);
    }

</style>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 header-bg border-bottom shadow-sm">
    <h4 class="my-0 mr-md-auto font-weight-normal">
        <a href="." class="text-dark">InSense</a>
    </h4>

    <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="./itemList.php"><i class="zmdi zmdi-globe-alt"></i>找香水</a>
    <a class="p-2 text-dark" href="./myCart.php">
        <span><i class="zmdi zmdi-shopping-cart"></i>購物車</span>
        <?php 
        if(isset($_SESSION["cart"])){
            echo "(".count($_SESSION["cart"]).")";
        } else {
            echo "(0)";
        }
        ?>
    </a>

    <?php if(isset($_SESSION["username"])) { ?>
    <a class="p-2 text-dark" href="./order.php"><i class="zmdi zmdi-file-text"></i>我的訂單</a>
    <?php } ?>

    </nav>

    <?php if(!isset($_SESSION["username"])){ ?>
        <a class="btn btn-outline-primary" href="./register.php">註冊</a>
    <?php } else { ?>
        <span><?php echo $_SESSION["name"] ?></span>
    <?php } ?>

    <?php require_once("./tpl/login.php") ?>
</div>