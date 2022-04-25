<?php
//カテゴリ取得
$category = get_the_category();
if($category){
    $parent = $category[0]->parent;
    if ($parent){ //0に親がある場合
        //$cat = get_category($parent);
        $cat = $category[1];
        $cat2 = $category[0];
    } elseif ($category[1]){ //0に親がないけど取得カテゴリが2個ある場合（つまり0が親、1が子）
        $cat = $category[0];
        $cat2 = $category[1];
    } else { //0に親がなく、単独の場合
        $cat = $category[0];
        $cat2 = $category[0];
    }
}
?>