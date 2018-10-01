<?php
/**
 * Created by PhpStorm.
 * User: Gandanga
 * Date: 2017-12-20
 * Time: 03:09 PM
 */
//require __DIR__ . '/vendor/autoload.php';
require '/var/www/html/orbit/vendor/autoload.php';
$options = array(
    'cluster' => 'ap2',
    'encrypted' => true
);
$pusher = new Pusher\Pusher(
    '347d0dccd5f2a3e703a2',
    '26968dfd3ac865624705',
    '443701',
    $options
);
$event_type =  $_POST['event_type'];
if($event_type=="Comment"){
    $comment = new stdClass();
    $comment->user_id = $_POST['user_id'];
    $comment->team_id = $_POST['team_id'];
    $comment->comment_text = $_POST['comment_text'];
    $comment->first_name = $_POST['first_name'];
    $comment->last_name = $_POST['last_name'];
    $comment->created_at = $_POST['created_at'];
    $comment->id = $_POST['id'];
    $comment->user_picture_url = $_POST['user_picture_url'];
    $comment->picture_url = $_POST['picture_url'];
    $pusher->trigger('my-channel', 'my-event', $comment);
}
else if($event_type == "Shift Swap"){
    $shift_swap = new stdClass();
    $shift_swap->id = $_POST['id'];
    $shift_swap->swap_shift = $_POST['swap_shift'];
    $shift_swap->with_shift = $_POST['with_shift'];
    $shift_swap->employee_id = $_POST['employee_id'];
    $shift_swap->reason = $_POST['reason'];
    $shift_swap->requestor_id = $_POST['requestor_id'];
    $shift_swap->created_at = $_POST['created_at'];
    $pusher->trigger('my-channel', 'my-swap-event', $shift_swap);
}
else if($event_type == "Send_Message"){
    $message = new stdClass();
    $message->id = $_POST['id'];
    $message->first_name = $_POST['first_name'];
    $message->last_name = $_POST['last_name'];
    $message->user_picture_url = $_POST['user_picture_url'];
    $message->message_text = $_POST['message_text'];
    $message->message_picture_url = $_POST['message_picture_url'];
    $pusher->trigger('my-channel', 'my-message-event', $message);
}

