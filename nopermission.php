<?php 
	include 'segments/header.php';
	include 'segments/navigation.php';
	
	$rand = rand(0, 5);
	switch ($rand){
		case 0: $pic = "https://cdn.meme.am/instances/57829446.jpg";
			break;
		case 1: $pic = "http://www.dzcomposer.com/images/howaboutno.jpg";
			break;
		case 2: $pic = "https://cdn.meme.am/instances/500x/65852377.jpg";
			break;
		case 3: $pic = "http://s2.quickmeme.com/img/54/540d756af966c114e578e6eac0414ae4921534428fd9b2a70c4f25b38120e11b.jpg";
			break;
		case 4: $pic = "http://65.media.tumblr.com/7729dbc922c1dbccef4d0f56da4562fe/tumblr_inline_nj44tkzzEQ1t9y4lk.jpg";
			break;
		case 5: $pic = "http://www.relatably.com/m/img/do-you-even-meme-generator/you-cant-handle-the-truth-meme-generator-you-want-the-truth-you-can-t-handle-the-truth-9789dd.jpg";
			break;
	}
?>
<row centered>
	<div style = "margin-top:200px">
		<img src='<?=$pic?>'/>
	</div>
</row>
	
<?php include 'segments/footer.php'; ?>