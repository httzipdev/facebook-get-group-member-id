<?php





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

getid("https://graph.facebook.com/".$_GET['id']."/members?fields=id&limit=100&access_token=".$token);
}else{
	echo "Invail Group ID";
}

