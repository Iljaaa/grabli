<?php $pagesCount = ceil($count / $pagesize); ?>
<?php if ($pagesCount > 1) : ?>
	<?php for ($i = 1; $i <= $pagesCount; $i++) :  ?>
		<?php if ($i == $page) : ?>
			[<?=$i ?>]
		<?php  else :?>
			<a href="javascript:setPage(<?=$i ?>)"><?=$i ?></a>
		<?php endif; ?>
	<?php endfor; ?>
<?php endif; ?>