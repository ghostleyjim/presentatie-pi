<?php
error_reporting(E_ALL);
$s = $_REQUEST["s"];
if ($s == "0" || $s == "1"){
$statusfile = fopen("laststatus.txt", "w+") or die ("unable to open statusfile!");
}
else {
$rstatusfile = fopen("laststatus.txt", "r") or die ("unable to open statusfile!");
}


if ($s == "0"){
    fwrite($statusfile, "red");
    fclose($statusfile);
    $output = shell_exec("sudo vcgencmd display_power 0");
if (strpos($output, "=0") !== false){
    echo "red";
}
else
{
    echo "orange";
}

header( "refresh:3; url=index.html");
}

if ($s == "1"){
    fwrite($statusfile, "green");
    fclose($statusfile);
    $output = shell_exec("sudo vcgencmd display_power 1");
    sleep(1);
    exec("sudo /bin/chvt 6");
    sleep(1);
    exec("sudo /bin/chvt 7");
if(strpos($output, "=1") !== false)
{
    echo "green";
}
else{
    echo "orange";
}
header( "refresh:3; url=index.html");

}

if ($s == "status")
{
    $disstatus = shell_exec("sudo vcgencmd display_power");
    if(strpos($disstatus, "0") !== false){
        echo "red";
    }
    else if (strpos($disstatus, "1") !== false){
        echo "green";
}   
    else{
        echo "orange";
    }
}
?>