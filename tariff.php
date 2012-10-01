<?php

$tariffData=GetTariff($_REQUEST['opid'],$_REQUEST['tarrif']);
?>
<table class="windows_css3">
    <tr class="header">
        <td align="center" width="80%">
            <h2 class="leftmenu">Тариф - <?php echo $tariffData['tariffName']; ?></h2>
        </td>
        <td align="center">
            <a href="index.php?id=5&opid=<?php echo $_REQUEST['opid'];?>&tarrif=<?php echo $_REQUEST['tarrif'];?>&s=1"><img src="images/cart.png" alt="Перейти к выбору номера"></a>
        </td>
    </tr>
    <tr>
        <td colspan="2">

            <?php
            foreach ($tariffData['values'] as $section => $subSections)
            {
                ?>
                <table class="windows_css3">
                    <tr class="header">
                        <td align="center" colspan="2">
                            <h2 class="leftmenu"><?php echo $section;?></h2>
                        </td>
                    </tr>
                    <?php
                    //print($subSections);
                    $i=0;
                    foreach($subSections as $subSectionName => $value)
                    {
                        if ($i++%2==0)
                            echo "<tr>\n";
                        else
                            echo "<tr bgcolor=eeeeee>\n";
                        ?>

                        <td width=70% align=left><?php echo $subSectionName;?></td>
                        <?php
                        if (count($value)==1)
                        {
                            ?>
                            <td width=30% align=center><p class="price"><?php echo $value[0];?></p></td>
                            <?php
                        }
                        elseif (count($value)>1)
                        {
                            $newValue = "<table><tr>";
                            foreach ($value as $k=>$v)
                                $newValue .= "<td width=".(100/count($value))."% align=center><p class=\"price\">".$v."</p></td>";
                            $newValue .= "</tr></table>";
                            ?>
                            <td width=30% align=center><?php echo $newValue;?></td>
                            <?php
                        }
                        ?>
                        </tr>
                        <?php
                    }
                    ?>


                </table>
                <br>



                <?php
            }



            ?>

        </td>
    </tr>
    <tr class="header">
        <td align="center" width="80%">
        </td>
        <td align="center">
            <a href="index.php?id=5&opid=<?php echo $_REQUEST['opid'];?>&tarrif=<?php echo $_REQUEST['tarrif'];?>&s=1"><img src="images/cart.png" alt="Перейти к выбору номера"></a>
        </td>
    </tr>
</table>


<?php
include ("index2.php");

?>


<br>
