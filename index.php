<?php

include 'mysql.php';
include 'function.php';
include 'header.php';

$pid=@$_REQUEST['pid'];
$search=@$_POST['search'];

/*重要*/echo <<< FORM
<form name="form" method="post" action="./?pid=1">
    <input type="text" name="search" size="30" value="{$search}"></input>
    <input type="submit" name="submit" value="検索">
    <input type="reset" name="reset" value="リセット">
    <input type="button" name="button" value="クリア" onClick="location.href='./'">
    <input type="button" name="entry" value="新規登録" onClick="location.href='resist.php'">
</form>
<hr>
FORM;
    
if($pid==1 && $search!=""){
    $sqltail=" WHERE `title` LIKE \"%{$search}%\" || `comment` LIKE \"%{$search}%\"";
}else{
    $sqltail = "";
    
    }

$sql = "SELECT * FROM `sample`{$sqltail}";// データベースへのクエリ内容。

echo "検索文字列：{$search}";

$result = mysql_query($sql);// sample1へsam1テーブルへのクエリ送信。$resultへ代入。

while ($row = mysql_fetch_array($result)){// データベース情報出力に使うループ文。
    
    $id=$row['id'];
    $resistdt=$row['resistdt'];
    $changedt=$row['changedt'];
    $title=$row['title'];
    $comment=$row['comment'];
    
    if(file_exists("img/{$id}.jpg")){
$imgdis = <<< EOD
   <a href="img/{$id}.jpg" target="_blank">
   <img src="img/{$id}.jpg" width="200" height="150" border="0" align="right">
   </a>
EOD;
    }else{
        $imgdis="";
    }
    
    
echo <<< EOD
<table width="600" border="1" cellpadding="5" cellspacing="0">
    <tr>
        <td width="109">NO.</td>
        <td>${id}</td>
        <td width="200" rowspan="4">{$imgdis}</td>
    </tr>
    <tr>
        <td>登録日</td>
        <td>${resistdt}</td>
    </tr>
    <tr>
        <td>更新日</td>
        <td>${changedt}</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="3">${title}</td>
    </tr>
    <tr>
        <td colspan="3">${comment}</td>
    </tr>
    <tr>
        <td colspan="3"><input type="button" name="button" value="編集" onClick="location.href='update.php?rid={$id}'">
        <input type="button" name="button" value="削除" onClick="location.href='delete.php?rid={$id}'"></td>
    </tr>
    </table><!--テーブル-->
    <br>\n
EOD;
          
}
include 'footer.php';
?>
