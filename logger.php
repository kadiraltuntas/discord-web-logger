<?php

 if(isset($_SESSION["login"])){
     $giris = $kbilgi["login"];
 }else{
     $giris = "Yapılmamış";
 }
 
 ?>
<?php
function GetIP(){
    if(getenv("HTTP_CLIENT_IP")) {
    $ip = getenv("HTTP_CLIENT_IP");
    } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
    $ip = getenv("HTTP_X_FORWARDED_FOR");
    if (strstr($ip, ',')) {
    $tmp = explode (',', $ip);
    $ip = trim($tmp[0]);
    }
    } else {
    $ip = getenv("REMOTE_ADDR");
    }
    return $ip;
   } 
   $ip_adresi = GetIP(); 

   $url = "http://ip-api.com/json/".$ip_adresi;
   $content = file_get_contents($url);
   $json = json_decode($content,true);
   $sehir =  $json["city"];
   $saglayici = $json["isp"];
   $songiris = date('Y-m-d');


$webhookurl = "https://ptb.discord.com/api/webhooks/779634183852916768/eofuFUENMKwMNB5Twop73XkAtCJlf2Tmd0g984s3inB2waa-ovUAsrelf_z4Xd-KAuJf";



$timestamp = date("c", strtotime("now"));

$json_data = json_encode([
    
    
    
   
    "username" => "EndStar Web Log",

   
    "avatar_url" => "https://cdn.discordapp.com/attachments/754032973418070217/779635218789302292/logo25_1.png?size=512",

    
    "tts" => false,

    
    // "file" => "",

   
    "embeds" => [
        [
            
            "title" => "Kullanıcının Bilgileri ",

            
            "type" => "rich",

            
            

            
            "url" => "",

           
            "timestamp" => $timestamp,

            
            "color" => hexdec( "fc0339" ),

            
            "footer" => [
                "text" => "EndStar Tarfından Yapılmıştır",
                "icon_url" => "https://cdn.discordapp.com/avatars/750016258216296449/a_7164e8b781898f859aa16ed3489284f0.gif?size=512"
            ],
          
            "author" => [
                "name" => "EndStar",
                "url" => "https://github.com/EndStarr"
            ],

            "fields" => [
                
                [
                    "name" => "İp Adresi",
                    "value" => "$ip_adresi",
                    "inline" => false
                ],
                [
                    "name" => "Giriş yaptığı Şehir",
                    "value" => "$sehir",
                    "inline" => false
                ],
                [
                    "name" => "İnternet Sağlayıcısı",
                    "value" => "$saglayici",
                    "inline" => false
                ],
                [
                    "name" => "Giriş Tarihi",
                    "value" => "$songiris",
                    "inline" => true
                ],
                [
                    "name" => "Kullanıcı Girişi",
                    "value" => "$giris",
                    "inline" => true
                ]
                
                // Etc..
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


$ch = curl_init( $webhookurl );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
curl_close( $ch );
?>
