<?php
include 'mysql.php';
include 'function.php';
include 'header.php';

$rid=@$_REQUEST['rid'];
$pid=@$_REQUEST['pid'];
$changedt=date("Y-n-d");

if($pid==""){


$sql = "SELECT * FROM `sample` WHERE `id`={$rid}";// データベースへ引き出し記述の代入。
$result = mysql_query($sql);// sample1へsam1テーブルへクエリ送信。$resultへ代入。
$row = mysql_fetch_assoc($result);

    if(file_exists("img/{$rid}.jpg")){
$imgdis = <<< EOD

   <a href="img/{$rid}.jpg" target="_blank">
   <img src="img/{$rid}.jpg" width="200" height="150" border="0" align="right">
   </a>

EOD;
    }else{
        $imgdis="";
    }
    

echo <<< EOD
   NO.{$rid}の編集
<form name="form" method="post" enctype="multipart/form-data" action="update.php?pid=1&rid={$rid}">
<table width="600" border="0" cellpadding="5" cellspacing="0">
<tr>
<td width="109">登録日</td>
<td>{$row['resistdt']}</td>
<td width="200" rowspan="3">&nbsp;</td>
</tr>
<tr>
<td>更新日</td>
<td>{$changedt}</td>
</tr>
<tr>
<!--アップロード-->
            <td>画像</td>
            <td colspan="2">
            <input type="file" name="upfile" />
            </td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
NO.<td>{$rid}</td>
<td>{$imgdis}</td>
</tr>
<tr>
<td colspan="3">タイトル<label for="title2"></label>
<input name="title" type="text" id="title2" size="30" value="{$row['title']}" /></td>
</tr>
<tr>
<td colspan="3">コメント<label for="comment"></label>
<textarea name="comment" id="comment" cols="50" rows="8">{$row['comment']}</textarea></td>
</tr>
<tr>
<td colspan="3"><input type="reset" name="button2" id="button2" value="リセット" />
<input type="submit" name="button" id="button" value="確定" /></td>
</tr>
</table>
<p id="form">&nbsp;</p>
<hr />
</form>
EOD;
          
}else if($pid==1){

$title=@$_POST['title'];
$comment=@$_POST['comment'];
$upfile=@$_FILES['upfile']['tmp_name'];//アップリードするローカルの位置を指定する必要がある

if($upfile!=""){
    move_uploaded_file($upfile/*upファイル*/,"img/{$rid}.jpg"/*アップロード場所*/);
}

$sql = "UPDATE `mysql2`.`sample` SET 
    `changedt` = '{$changedt}', 
        `title` = '{$title}', 
        `comment` = '{$comment}' 
        WHERE `id` = {$rid}";

mysql_query($sql);
echo "NO.{$rid}を編集しました。<br><input type=\"button\" name=\"button3\" value=\"戻る\" onClick=\"location.href='./'\">";

}
include 'footer.php';
?>
