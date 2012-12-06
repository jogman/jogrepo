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


echo <<< EOD
<table width="600" border="1" cellpadding="5" cellspacing="0">
<tr>
<td width="109">登録日</td>
<td>{$row['resistdt']}</td>
<td width="200" rowspan="3">&nbsp;</td>
</tr>
<tr>
<td colspan="3">タイトル</td><td>{$row['title']}</td>
</tr>
<tr>
<td colspan="3">コメント</td><td>{$row['comment']}</textarea></td>
</tr>
</table>
<input type="button" name="button7" value="削除1" onClick="location.href='delete.php?pid=1&rid={$rid}'">
<hr />
EOD;
          
}else if($pid==1){

$sql = "DELETE FROM `sample` WHERE `id` = {$rid}";//クエリ内容（削除）

@unlink("img/{$rid}.jpg");

mysql_query($sql);//クエリ送信。
echo "NO.{$rid}を削除しました。<br><input type=\"button\" name=\"button3\" value=\"戻る\" onClick=\"location.href='./'\">";

}
include 'footer.php';
?>
