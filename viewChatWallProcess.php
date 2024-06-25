'<?php

session_start();
require "connection.php";

$email = $_GET["e"];

$msg_rs = Database::search("SELECT * FROM `chat` WHERE `id` IN (SELECT MAX(`id`) FROM `chat` WHERE `to`='" . $email . "' GROUP BY `from`) ORDER BY `date_time` DESC");

$msg_num = $msg_rs->num_rows;

for ($x = 0; $x < $msg_num; $x++) {
    $msg_data = $msg_rs->fetch_assoc();

    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $msg_data["from"] . "'");
    $user_data = $user_rs->fetch_assoc();

    $messageDateTime = new DateTime($msg_data["date_time"]);
    $currentDateTime = new DateTime();
    $yesterdayDateTime = new DateTime('yesterday');

    if ($messageDateTime->format('Y-m-d') == $currentDateTime->format('Y-m-d')) {
        // Message sent today
        $formattedTime = $messageDateTime->format('h:i A');
    } elseif ($messageDateTime->format('Y-m-d') == $yesterdayDateTime->format('Y-m-d')) {
        // Message sent yesterday
        $formattedTime = 'Yesterday';
    } else {
        // Message sent before yesterday
        $formattedTime = $messageDateTime->format('Y-m-d');
    }

    // 0 = New
    // 1 = Seen
    if ($msg_data["status"] == 0) {
?>

        <!-- new msg -->
        <div class="row py-2 chat-inbox-new" style="border-bottom: 0.5px solid #00000018; cursor: pointer;" onclick="chatInbox(`<?php echo $msg_data['from'] ?>`);">
            <div class="col-3 d-flex justify-content-center">
                <img src="resources/profile_img/Kanishka_6663edd672bc0.jpeg" alt="" style="height: 50px; width: 50px; border-radius: 25px;">
            </div>
            <div class="col-6">
                <div class="row fw-bold">
                    <p class="m-0 p-0"><?php echo $user_data["fname"] . " " . $user_data["lname"] ?></p>
                </div>
                <div class="row"><?php echo $msg_data["content"] ?></div>
            </div>
            <div class="col-3 text-end d-flex justify-content-end align-items-start">
                <label for="" style="font-size: 10px;" class="label-inline"><?php echo $formattedTime; ?> <i class="bi bi-dot fs-3 text-primary doticon"></i></label>
            </div>
        </div>
        <!-- new msg -->

    <?php
    } elseif ($msg_data["status"] == 1) {
    ?>
        <!-- seen msg -->
        <div class="row py-2 chat-inbox-seen" style="border-bottom: 0.5px solid #00000018; cursor: pointer;" onclick="chatInbox(`<?php echo $msg_data['from'] ?>`);">
            <div class="col-3 d-flex justify-content-center">
                <img src="resources/profile_img/Kanishka_6663edd672bc0.jpeg" alt="" style="height: 50px; width: 50px; border-radius: 25px;">
            </div>
            <div class="col-6">
                <div class="row fw-bold">
                    <p class="m-0 p-0"><?php echo $user_data["fname"] . " " . $user_data["lname"] ?></p>
                </div>
                <div class="row"><?php echo $msg_data["content"] ?></div>
            </div>
            <div class="col-3 text-end d-flex justify-content-end align-items-start">
                <label for="" style="font-size: 10px;" class="label-inline"><?php echo $formattedTime; ?> <i class="bi bi-dot fs-3 text-primary doticon"></i></label>
            </div>
        </div>
        <!-- seen msg -->
<?php
    }
}
?>
'