<?php

session_start();
require "connection.php";

$sender_mail = $_SESSION["u"]["email"];
$recever_mail = $_GET["rec-email"];


$msg_rs = Database::search("SELECT * FROM `chat` WHERE `from`='" . $sender_mail . "' OR `to`='" . $sender_mail . "'");
$msg_num = $msg_rs->num_rows;

for ($x = 0; $x < $msg_num; $x++) {
    $msg_data = $msg_rs->fetch_assoc();

    if ($msg_data["from"] == $sender_mail && $msg_data["to"] == $recever_mail) {

        $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $msg_data["from"] . "'");
        $user_data = $user_rs->fetch_assoc();

?>

        <!-- sender -->
        <div class="offset-3 w-75">
            <div class="media-body me-4">
                <div class="send-msg rounded py-2 px-3">
                    <p class="mb-0 fw-bold text-dark"><?php echo $msg_data["content"]; ?></p>
                </div>
                <p class="small fw-bold text-black-50 text-end"><?php echo $msg_data["date_time"]; ?></p>
                <p class="invisible" id="rmail"><?php echo $msg_data["from"];?></p>
            </div>
        </div>
        <!-- sender -->

    <?php

    } elseif ($msg_data["to"] == $sender_mail && $msg_data["from"] == $recever_mail) {

       
    ?>
        <!-- receiver -->
        <div class="col-9 mb-3 w-75">
            <div class="media-body">
                <div class="rec-msg rounded py-2 px-3 mb-2">
                    <p class="mb-0 text-dark"><?php echo $msg_data["content"]; ?></p>
                </div>
                <p class="small fw-bold text-black-50 text-end"><?php echo $msg_data["date_time"]; ?></p>
            </div>
        </div>
        <!-- receiver -->
<?php

    }
}
