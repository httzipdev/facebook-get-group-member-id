<?php
// Coded by HTTZIP
// Share on httzip.com
function getid($link)
{
	$get = file_get_contents($link);
	$decode = json_decode($get);
	
	$count = count($decode->data);
	$i= 0;
	foreach ($decode->data as $data) {
		$file = 'list.txt';
		$current = file_get_contents($file);
		$current .= $data->id."\n";
		file_put_contents($file, $current);
		$i++;
		
		if($i == $count)
		{
			if(empty($link = $decode->paging->next))
			{
				echo "Hoàn tất ";
				return false;
			}
			else{
				$link = $decode->paging->next;
				return getid($link);
			}
			
		}
	}
}
if(!empty($_GET['id']))
{
$token = ""; // Access_Token
$limit = "500"; // Số lượng UID sẽ được lấy mỗi lượt foreach

getid("https://graph.facebook.com/".$_GET['id']."/members?fields=id&limit=".$limit."&access_token=".$token);
}else{
	echo "Invail Group ID";
}

