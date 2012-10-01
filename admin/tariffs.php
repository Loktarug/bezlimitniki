<div class="container-fluid">
    <div class="row-fluid">
        <div class="span2">
            <div class="tabbable"> <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#addTariff" data-toggle="tab">Добавить</a></li>
                    <li><a href="#editTariff" data-toggle="tab">Редактировать</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="addTariff">
                        <div class="well">
                            <legend>Добавить новый тариф</legend>
                            <div class="control-group">
                                <label class="control-label" for="tariffName">Название тарифа</label>
                                <div class="controls">
                                    <input type="text" class="input-large" id="tariffName">
                                </div>
                            </div>
                            <span class="help-block">ИЛИ</span>
                            <div class="control-group">
                                <label class="control-label" for="addTariffList">Выбрать существующий тариф</label>
                                <div class="controls">
                                    <select id="addTariffList">
                                        <?php
                                        $tariffs = dbGetTariffShort();
                                        foreach ($tariffs as $idTariff => $tariffName)
                                        {
                                            echo "<option value=\"$idTariff\">$tariffName</option>";
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn" id="addNewTariffBtn" onclick="addForm('#tariffParamsList', 'addNewTariff')">Добавить</button>
                        </div>
                    </div>
                    <div class="tab-pane" id="editTariff">
                        <div class="well">
                            <legend>Редактировать тариф</legend>
                            <div class="control-group">
                                <label class="control-label" for="editTariffList">Выбрать существующий тариф</label>
                                <div class="controls">
                                    <select id="editTariffList">
                                        <?php
                                        $tariffs = dbGetTariffShort();
                                        foreach ($tariffs as $idTariff => $tariffName)
                                        {
                                            echo "<option value=\"$idTariff\">$tariffName</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn" id="addTariffBtn" onclick="addForm('#tariffParamsList', 'editTariff')">Редактировать</button>
                        </div>
                    </div>
                </div>
            </div>

        </div><!--/span-->
        <div class="span10">
            <div class="well form-horizontal" id="tariffParamsList">
                <legend>Добавление нового тарифа</legend>

            </div>
        </div><!--/span-->
    </div><!--/row-->

    <hr>

    <footer>
        <p>&copy; Bezlimitniki.ru | Admin Panel</p>
    </footer>

</div>