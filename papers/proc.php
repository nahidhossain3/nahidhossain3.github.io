<?php
session_start();
if(isset($_SESSION['nahid_faculty_user'])){
    if($_SESSION['nahid_faculty_user']=="NHn"){
        include_once('../assigner/db.php');
        ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Nahid Hossain </title>
  <link href="../img/favicon.ico" rel="icon">
  <link href="../img/favicon.ico" rel="apple-touch-icon">
  
   <style>
* {
  box-sizing: border-box;
}


table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
tr{
  height:25px;
}
tr:hover {
          background-color: #ffff99;
        }

</style>


  </head>

<body>
<?php 
$conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
	$sql = "SELECT * FROM nahid_messages ORDER BY id DESC LIMIT 20";
	$result = $conn->query($sql);
	echo "<center><h1>Messages</h1></center>";
	if ($result->num_rows > 0) {
	  echo "<table style=\"text-align: justify; width:100%; \" border=\"1px solid\"  align=\"center\"><th>ID</th><th>NAME</th><th>EMAIL</th><th>MESSAGE</th><th>TIME STAMP</th><th>IP</th><td>Reply</td>";
	  while($row = $result->fetch_assoc()) {
	    echo "<tr style=\"border:1px solid\"><td>$row[id]</td><td>$row[name]</td><td>$row[email]</td><td>$row[message]</td><td>$row[mes_date]</td><td>$row[user_ip]</td><td><a href=\"https://mail.google.com/mail/?view=cm&fs=1&to=$row[email]&su=REPLY to $row[name] from nahid.org&body=Dear $row[name], Hope this email finds you in good health. \">Click to Reply</a></td></tr>"; 
	  }
	  echo "</table>";
	} else {
	  echo "<font style=\"font-size:24px\">0 messages</font>";
	}
	echo "<br><br><br>";
	echo "<center><h1>Course Assignment Logs</h1></center>";
	?>
	<table style="text-align: justify; width:100%;" border="1px solid"  align="center">
    
<thead>
        <tr><th>ID</th><th>INITIAL</th><th>IP<br></th><th>TIMESTAMP</th><th>COMMENTS</th></tr>
</thead>
      
     <?php
            

            $sql = "SELECT * FROM assigner_log WHERE `comments`='moni' ORDER BY `id` DESC LIMIT 20";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              // output data of each row
              echo "<tbody>";
              while($row = $result->fetch_assoc()) {
                 echo "<tr id='p2'>";
                echo  "<td>$row[id]</td><td  align='center'>$row[user]</td><td align='center' style='width:150px'>$row[user_ip]</td><td  align='center' style='width:150px'>$row[log_time]</td><td  align='center' style='width:150px'>$row[comments]</td></tr>";
                }
            } else {
              echo "0 Course Assignment Logs";
            }

            echo "</tbody></table>";
    
	
	
	echo "<br><br><br>";
	$sql = "SELECT * FROM browsing_his ORDER BY id DESC LIMIT 20";
	$result = $conn->query($sql);
	echo "<center><h1>Footprints </h1></center>";
	if ($result->num_rows > 0) {
	    
	  echo "<table style=\"text-align: justify; width:100%;\" border=\"1px solid\"  align=\"center\"><th>ID</th><th>TIMESTAMP</th><th>IP</th><th>BROWSER</th><th>OS</th><th>AGENT</th><th>REFER</th><th>Location</th><th>Flag</th>";
	  
	 
function getOS($user_agent) { 
  
    $os_platform  = "Unknown OS Platform";
    $os_array     = array(
                          '/windows nt 11/i'      =>  'Windows 11',
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;

    return $os_platform;
}
function getBrowser($user_agent) {
    
    $browser        = "Unknown Browser";

    $browser_array = array(
                            '/msie/i'      => 'Internet Explorer',
                            '/firefox/i'   => 'Firefox',
                            '/safari/i'    => 'Safari',
                            '/chrome/i'    => 'Chrome',
                            '/edge/i'      => 'Edge',
                            '/opera/i'     => 'Opera',
                            '/netscape/i'  => 'Netscape',
                            '/maxthon/i'   => 'Maxthon',
                            '/konqueror/i' => 'Konqueror',
                            '/mobile/i'    => 'Mobile Browser'
                     );

    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;

    return $browser;
}

          
          
	  while($row = $result->fetch_assoc()) {
	      $user_agent = $row['useragent'];
	      $user_os        = getOS($user_agent);
          $user_browser   = getBrowser($user_agent);
          $curl_handle=curl_init();
          curl_setopt($curl_handle,CURLOPT_URL,"https://api.iplocation.net/?ip=$row[us_ip]");
          curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
          curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
          $buffer = curl_exec($curl_handle);
          curl_close($curl_handle);
          if (empty($buffer)){
              print "Nothing returned from url.<p>";
          }
          else{
              
              $json = json_decode($buffer, true);
              $country_name = $json['country_name'];
              $isp = $json['isp'];
              $cncode = strtolower($json['country_code2']);
              $cncode = $cncode.".png";
          }
          
	      
	    echo "<tr style=\"border:1px solid\"><td>$row[id]</td><td>$row[timestamp]</td><td>$row[us_ip]</td><td>$user_browser</td><td>$user_os</td><td style=\"width:50%;\">$row[useragent]</td><td>$row[ref]</td><td>$isp, $country_name</td><td><img src=\"https://ipdata.co/flags/$cncode\"></td></tr>"; 
	  }
	  echo "</table>";
	} else {
	  echo "<font style=\"font-size:24px\">No browsing history</font>";
	}


    

$conn->close();
?>


        <?php
    }
    else{
        header("Location: index.php"); 
    }
}
else{
    header("Location: index.php"); 
}

?>