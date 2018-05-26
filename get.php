<?php
// coded by HTTZIP
// Share on httzip.com
function getid($link)
{
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => $link,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => false
	));
	$get = curl_exec($curl);
	curl_close($curl);

	$decode = json_decode($get,JSON_UNESCAPED_UNICODE);
	
	$count = count($decode['data']);
	$i= 0;
	foreach ($decode['data'] as $data) {
		
		$file = fopen($list, 'a');
		fwrite($file, $data['id']."\n");
		fclose($file);
		$i++;
		
		if($i == $count)
		{
			if(empty($link = $decode['paging']['next']))
			{
				echo "Hoàn tất ";
				return false;
			}
			else{
				$link = $decode['paging']['next'];
				return getid($link);
			}
			
		}
	}
}
if(!empty($_GET['id']))
{
$token = ""; // Access_Token
$limit = "400"; // So Luong ID moi lan lay , cang nho cang it ton CPU
getid("https://graph.facebook.com/".$_GET['id']."/members?fields=id&limit=".$limit."&access_token=".$token);
}else{
	echo "Invaild Group ID";
}

