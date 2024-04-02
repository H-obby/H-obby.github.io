<?php
if($limit < $datas["totalMatching"]){
    $curPage = isset($_GET["curPage"]) ? $_GET["curPage"] : 1;
    $isTooMuchEarly = false;
    $isTooMuchLate = false;
    $allPagesHTML = "";
    $totalPages = ceil($datas["totalMatching"] / $limit);

    if ($curPage-2 > 0) $allPagesHTML .= '<li class="page__numbers"><a href="search&search='.$_GET["search"].'&type='.$_GET["type"].'&curPage='.($curPage-2).'">'.($curPage-2).'</a></li>';
    if ($curPage-1 > 0) $allPagesHTML .= '<li class="page__numbers"><a href="search&search='.$_GET["search"].'&type='.$_GET["type"].'&curPage='.($curPage-1).'">'.($curPage-1).'</a></li>';
    $allPagesHTML .= '<li class="page__numbers active"><a>'.($curPage).'</a></li>';
    if ($curPage+1 < $totalPages) $allPagesHTML .= '<li class="page__numbers"><a href="search&search='.$_GET["search"].'&type='.$_GET["type"].'&curPage='.($curPage+1).'">'.($curPage+1).'</a></li>';
    if ($curPage+2 < $totalPages) $allPagesHTML .= '<li class="page__numbers"><a href="search&search='.$_GET["search"].'&type='.$_GET["type"].'&curPage='.($curPage+2).'">'.($curPage+2).'</a></li>';

    if($curPage > 3 && !$isTooMuchEarly) {
        $isTooMuchEarly = true;
    }
    if($curPage < $totalPages-3 && !$isTooMuchLate) {
        $isTooMuchLate = true;
    }
    
    echo '
    <div id="pagination" class="container">  
        <ul class="page">
            '.($curPage > 1 ? 
            '<a href="search&search='.$_GET["search"].'&type='.$_GET["type"].'&curPage='.($curPage-1).'">
            <li class="page__btn">
                <span class="material-symbols-outlined">
                chevron_left
                </span>
            </li>
            </a>' : '').'
            '.($isTooMuchEarly ? '<li class="page__dots">...</li>' : '').'
            '.$allPagesHTML.'
            '.($isTooMuchLate ? '<li class="page__dots">...</li>' : '').'
            '.($curPage < $totalPages-1 ? 
            '<a href="search&search='.$_GET["search"].'&type='.$_GET["type"].'&curPage='.($curPage+1).'">
            <li class="page__btn">
                <span class="material-symbols-outlined">
                chevron_right
                </span>
            </li>
            </a>' : '').'
        </ul>
    </div>
    ';
}