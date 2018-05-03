<?php
/**
 * Created by PhpStorm.
 * User: Gandanga
 * Date: 2017-12-20
 * Time: 03:09 PM
 */
//require __DIR__ . '/vendor/autoload.php';
require '/var/www/orbit/vendor/autoload.php';
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
$comment = new stdClass();

$comment->user_id = $_POST['user_id'];
$comment->team_id = $_POST['team_id'];
$comment->comment_text = $_POST['comment_text'];
$comment->first_name = $_POST['first_name'];
$comment->first_name = $_POST['last_name'];
$comment->created_at = $_POST['created_at'];
$comment->id = $_POST['id'];
$comment->picture_url = $_POST['picture_url'];

$pusher->trigger('my-channel', 'my-event', $comment);