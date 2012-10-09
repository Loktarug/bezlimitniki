<?php
    switch ($GLOBALS['showModalWindow'])
    {
        case 'addNewTariff':
        {
            ?>

        <script type="text/javascript">
            $(function () {
                $("#tariffAdded").dialog({
                    autoOpen:true,
                    width:600,
                    height:350,
                    modal:true,
                    position: 'top',
                    show: 'slide',
                    buttons:{ "Закрыть":function () {
                        $(this).dialog("close");
                    } }
                });
            });
        </script>
        <?php
            printModalWindow('addNewTariff');
            $GLOBALS['showModalWindow'] = null;
            $_SESSION['cart']['latest'] = null;
            break;
        }
        case 'addNewPhone':
        {
            ?>

        <script type="text/javascript">
            $(function () {
                $("#phoneAdded").dialog({
                    autoOpen:true,
                    width:600,
                    height:350,
                    modal:true,
                    position: 'top',
                    show: 'slide',
                    buttons:{ "Перейти к оплате":function () {
                        $(this).dialog("close");
                        window.location.replace("/index.php?p=cart");
                    },
                    "Закрыть":function () {
                        $(this).dialog("close");
                    }}
                });
            });
        </script>
        <?php
            printModalWindow('addNewPhone');
            $GLOBALS['showModalWindow'] = null;
            $_SESSION['cart']['latest'] = null;
            break;
        }
    }


?>



