<?php
require("VerficationAuth.php");
$query = "select * from livre";
require("login-form-v1/login_v1/php/connection.php");
$result = $con->query($query);
$data = $result->fetchAll();
print_r($data);
?>

<?php
for ($i = 0; $i < count($data); $i++) {
    ?>
    <div class="">
        <div class="">
            <div class="">
                <img src="<?= $data[$i]["COUVERTURE"] ?>" alt="IMG-PRODUCT">

                <a href="#"
                    class="">
                    Quick View
                </a>
            </div>

            <div class="">
                <div class=" ">
                    <a href="" class="">
                        <?= $data[$i]["TITRE"] ?>
                    </a>

                    <span class="stext-105 cl3">
                        <?= $data[$i]["PRIX"] ?>
                    </span>
                </div>

                <div class="">
                    <a href="#" class="">
                        <img class="" src="images/icons/icon-next.png" alt="ICON">
                        <img class="" src="images/icons/icon-heart-02.png" alt="ICON">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php
}
?>