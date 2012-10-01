<?php
$title='Выгодные безлимитные тарифы МТС, Мегафон, Билайн. Красивые Номера';
$keywords='безлимитные тарифы, МТС, Мегафон, Билайн, красивые номера';
$description='Выгодные безлимитные тарифы МТС, Мегафон, Билайн. Красивые Номера';
$textbody='<h1>Выгодные безлимитные тарифы МТС, Мегафон, Билайн. Красивые Номера</h1>';
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==3 AND $_REQUEST['tarrif']==8)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=1");
}
if ($_REQUEST['id']==5)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=2");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==3 AND $_REQUEST['operator']=='preview')
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=3");
}
if ($_REQUEST['id']==4)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=4");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==3 AND $_REQUEST['tarrif']==1)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=5");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==2 AND $_REQUEST['operator']=='preview')
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=7");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==1 AND $_REQUEST['operator']=='preview')
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=8");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==3 AND $_REQUEST['tarrif']==10)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=9");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==2 AND $_REQUEST['tarrif']==3)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=10");
}
if (!$_REQUEST['id'])
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=11");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==3 AND $_REQUEST['tarrif']==6)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=12");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==3 AND $_REQUEST['tarrif']==7)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=13");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==3 AND $_REQUEST['tarrif']==9)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=14");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==2 AND $_REQUEST['tarrif']==5)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=15");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==2 AND $_REQUEST['tarrif']==6)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=16");
}

if ($_REQUEST['id']==3 AND $_REQUEST['opid']==1 AND $_REQUEST['tarrif']==1)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=17");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==1 AND $_REQUEST['tarrif']==2)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=18");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==1 AND $_REQUEST['tarrif']==13)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=19");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==1 AND $_REQUEST['tarrif']==4)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=20");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==1 AND $_REQUEST['tarrif']==12)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=21");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==1 AND $_REQUEST['tarrif']==6)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=22");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==1 AND $_REQUEST['tarrif']==7)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=23");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==1 AND $_REQUEST['tarrif']==8)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=24");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==1 AND $_REQUEST['tarrif']==9)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=25");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==1 AND $_REQUEST['tarrif']==10)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=26");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==1 AND $_REQUEST['tarrif']==11)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=27");
}
if ($_REQUEST['id']==5)
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=30");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==2 AND $_REQUEST['operator']=='preview')
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=31");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==3 AND $_REQUEST['operator']=='preview')
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=32");
}
if ($_REQUEST['id']==3 AND $_REQUEST['opid']==1 AND $_REQUEST['operator']=='preview')
{
	$additionalData=mysql_query("SELECT * FROM `keyWords` WHERE `id`=33");
}
if(mysql_num_rows($additionalData))
{
	$title=mysql_result($additionalData,0,'title');
	$keywords=mysql_result($additionalData,0,'keywords');
	$description=mysql_result($additionalData,0,'description');
	$textbody=mysql_result($additionalData,0,'word');
}
?>