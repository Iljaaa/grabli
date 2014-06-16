<?php

/**
 * @var $this IssuesListPagenationWidget
 *
 *
 */

/** @var CHttpRequest $request */
$request = yii::app()->getRequest();

/** @var int $pagesCount */
$pagesCount = $this->getPageCount();

/** @var CPagination $pager */
$pager = $this->pages;

/** @var int $currentPage */
$currentPage = $pager->getCurrentPage() +1;

?>

<div class="f-pager">
<?php if ($pagesCount > 1) : ?>
    <ul>
        <?php for ($i = 1; $i <= $pagesCount; $i++) :

            $queryParams = $url_data;
            $queryParams['page'] = $i;
        ?>
            <li <?php echo $i == $currentPage ? 'class="active"' : ''; ?>>
                <?php if ($i == $currentPage) : ?>
                    [<?=$i ?>]
                <?php else : ?>
                    <a href="<?=$this->getController()->createUrl('', $queryParams) ?>" ><?=$i ?></a>
                <?php endif; ?>
            </li>
        <?php /* endforeach; */ endfor; ?>
    </ul>
<?php endif; ?>
</div>