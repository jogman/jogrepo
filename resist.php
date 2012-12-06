<?php
include 'mysql.php';
include 'function.php';
include 'header.php';

$pid=@$_REQUEST['pid'];
$resistdt=date("Y-n-d");
$changedt=$resistdt;

if($pid==""){
echo <<< EOD
<form name="form" method="post" enctype="multipart/form-data" action="resist.php?pid=1">
<table width="600" border="0" cellpadding="5" cellspacing="0">
<tr>
<td width="109">登録日</td>
<td>{$resistdt}</td>
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
<td colspan="3">タイトル<label for="title2"></label>
<input name="title" type="text" id="title2" size="30" /></td>
</tr>
<tr>
<td colspan="3">コメント<label for="comment"></label>
<textarea name="comment" id="comment" cols="50" rows="8"></textarea></td>
</tr>
<tr>
<td colspan="3"><input type="reset" name="button2" id="button2" value="リセット" />
<input type="submit" name="button" id="button" value="登録" /></td>
</tr>
</table>
<p id="form">&nbsp;</p>
<hr />
</form>
EOD;
          
}else if($pid==1){

$title=@$_POST['title'];
$comment=@$_POST['comment'];
$upfile=@$_FILES['upfile']['tmp_name'];//アップリードするローカルの位置を指定する必要がある。

$sql = "INSERT INTO `sample` (
    `id`, `resistdt`, `changedt`, `title`, `comment`
    ) VALUES (
    NULL, '{$resistdt}', '{$changedt}', '{$title}', '{$comment}')";

    mysql_query($sql);

$insert_id = mysql_insert_id();

if($upfile != ""){
    move_uploaded_file($upfile/*upファイル*/,"img/{$insert_id}.jpg"/*アップロード場所*/);
}

echo "NO.{$insert_id}に登録しました。<br><input type=\"button\" name=\"button3\" value=\"戻る\" onClick=\"location.href='./'\">";

}
include 'footer.php';
?>
