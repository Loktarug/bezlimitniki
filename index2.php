<?php
include_once ("engine/dbOperations.php");
if (!$_REQUEST['opid'])
{
    $_REQUEST['opid'] = 'all';
}
    $result_direct = select_operator_phones($_REQUEST['opid'], 'direct', $_REQUEST['page']*30, 30);
    $result_federal = select_operator_phones($_REQUEST['opid'], 'federal', $_REQUEST['page']*30, 30);
    $num = select_operator_phones($_REQUEST['opid'], 'federal', 0,99999);


$num = mysql_num_rows($num);

$quantity = mysql_num_rows($result_federal);
//echo $num;

$link = 'index.php?';
if (isset($_REQUEST['id']))
    $link.= 'id='.$_REQUEST['id'].'&';
if (isset($_REQUEST['opid']))
    $link.= 'opid='.$_REQUEST['opid'].'&';
if (isset($_REQUEST['tarrif']))
    $link.= 'tarrif='.$_REQUEST['tarrif'].'&';


?>


<table>
    <tr><td><a href="index.php?id=5&amp;opid=3"><img src="images/mts_smalllogo.jpg" alt="МТС"></a><a href="index.php?id=5&amp;opid=1"><img src="images/beeline_smalllogo.jpg" alt="Билайн"></a><a href="index.php?id=5&amp;opid=2"><img src="images/megafon_smalllogo.jpg" alt="Мегафон"></a></td></tr>
    <tr><td>
       <form action="<?=$link?>" method="POST">
           <input type="text" name="mask">
           <input type="submit" name="go">
       </form>
        <p>Можете подобрать по комбинации цифр, по модели: aaaa, aabb, abab, aabbcc, ababab, abcabc и тп.</p>
    </td></tr>
    <tr><td>
        <?php
    for ($i=0; $i<$num; $i+=30)
    {

        echo "<a href=\"".$link."page=".($i/30)."\">".($i/30+1)."</a> ";
    }
        ?>
    </td></tr>
    <tr>
        <td>
            <?php
            echo "<table>";
            for ($i=0; $i<$quantity; $i++)
            {
                echo '<tr>
	<td>
	'.mysql_result($result_federal, $i, 'number').'
	</td>
	<td>
	'.mysql_result($result_federal, $i, 'cost').' руб.
	</td>
	<td>
	<a href="basket.php?id='.mysql_result($result_federal, $i, 'id').'&amp;s=2">Купить</a>
	</td>';
if (mysql_result($result_direct, $i, 'number'))
{
	echo '<td>
	'.mysql_result($result_direct, $i, 'number').'
	</td>
	<td>
	'.mysql_result($result_direct, $i, 'cost').' руб.
	</td>
	<td>
	<a href="basket.php?id='.mysql_result($result_direct, $i, 'id').'&amp;s=2">Купить</a>
	</td>
	</tr>';
	}
            }
            echo "</table>";
            ?>
        </td></tr>

</table>
