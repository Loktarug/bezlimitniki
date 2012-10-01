<?php
if (!$_REQUEST['idnews'])
{
    $newsData=mysql_query("SELECT * FROM `news` WHERE `id`>0 ORDER BY `id` DESC");

    ?>
<ul class="list-1">
    <?php
    for ($i=0; $i<mysql_num_rows($newsData); $i++)
    {
        ?>
        <li>
            <h2><strong><?php echo mysql_result($newsData,$i,'name');?></strong></h2>
            <a href="index.php?id=news&amp;idnews=<?php echo mysql_result($newsData,$i,'id');?>">подробнее</a>
            <div class="clear"></div>
        </li>

        <?php
    }

    ?>
</ul>

<?php
}
else
{
    $newsData=mysql_query("SELECT * FROM `news` WHERE `id`=".$_REQUEST['idnews']);
    ?>
<h2><strong><?php echo mysql_result($newsData,0,'name');?></strong></h2>
<?php
    echo mysql_result($newsData,0,'news');

}
?>