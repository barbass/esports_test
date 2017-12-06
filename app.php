<?php

require_once(__DIR__.'/Cache.php');

$cache_result = Cache::get('video_14');
if ($cache_result) {
	$result = json_decode($cache_result, true);
}


foreach($result as $date => $list) {?>
	<div class="js-block-<?php echo $date;?>" >
		<h2>
			<a href="javascript:void(0);" class="js-date" onclick="getList('<?php echo $date;?>')">
				<?php echo $date;?>
			</a>
		</h2>

		<ul class="js-video-list" style="display:none;">
		<?php foreach($list as $l) {?>
			<li>
				<a href="<?php echo $l['link'];?>" target="_blank"><?php echo htmlentities($l['title']);?></a>
			</li>
		<?php } ?>
		</ul>
	</div>
<?php } ?>


<script type='text/javascript'>
	function getList(class_block) {
		var block = document.querySelector('.js-block-' + class_block);

		var visible = block.querySelector('ul.js-video-list').style.display;

		if (visible === 'none') {
			block.querySelector('ul.js-video-list').style.display = "block";
		} else {
			block.querySelector('.js-video-list').style.display = "none";
		}

	}
</script>
