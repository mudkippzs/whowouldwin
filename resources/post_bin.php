<?php

$postList = new post();
$list = $postList->get_post();
$editPostData = array();
$c = 0;
foreach($list as $page){	
	foreach($page as $key=>$data){
		$editPostData[$c][$key] = $data;
		
	}
	$c += 1;
}
echo "<div class='admin_edit_post_nav'><ul>";
echo '<legend>Choose a page to edit!</legend>';
foreach($editPostData as $post){				
		echo "<li><a href='/admin.php?edit=" . $post['stub'] . "' />" . $post['stub'] . "</a></li>";	
}
echo "</ul></div>";

?>

