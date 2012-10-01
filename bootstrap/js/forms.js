/**
 * Created with JetBrains PhpStorm.
 * User: Sergey Tarasov
 * Date: 28.07.12
 * Time: 21:47
 * To change this template use File | Settings | File Templates.
 */
var sectionQuantity = 0;
var subSectionQuantity = 0;


function addForm(to, type)
{
    $(to).removeData().empty()
    if (type == 'addNewTariff')
    {
        if ($('#tariffName').val() != '')
        {
            var html = addNewTariff ();
            $(html).appendTo(to);
            addSection();
        }
        else
        {
            $.getJSON("getTariff.php?id="+$('#addTariffList').val(), function (tariffData){
                var html = copyFromTariff(tariffData, 'add');
                $(html).appendTo(to);
                $.each(tariffData.fields, function (fieldId, field){
                    if($("#section"+field.id[0]).length==0) {
                        insertSection(field, 'add');
                    }
                    if (field.valueOrder == "0" || field.valueOrder == null)
                        insertSubSection(field, 'add');
                    else
                    {
                        $('#addParamTariffSubSection\\['+field.id[0]+'\\]\\['+field.id[1]+'\\]\\[value\\]\\['+field.valueOrder+'\\]').val(field.value);
                    }

                    if (sectionQuantity < field.id[0])
                        sectionQuantity = field.id[0];
                    if (subSectionQuantity < field.id[1])
                        subSectionQuantity = field.id[1];
                })
                sectionQuantity++;
                subSectionQuantity++;
            });

        }

    }
    else if (type == 'editTariff')
    {
        $.getJSON("getTariff.php?id="+$('#editTariffList').val(), function (tariffData){
            var html = copyFromTariff(tariffData, 'edit');
            $(html).appendTo(to);
            $.each(tariffData.fields, function (fieldId, field){
                if($("#section"+field.id[0]).length==0) {
                    insertSection(field, 'edit');
                }
                if (field.valueOrder == "0" || field.valueOrder == null)
                    insertSubSection(field, 'edit');
                else
                {
                    $('#editParamTariffSubSection\\['+field.id[0]+'\\]\\['+field.id[1]+'\\]\\[value\\]\\['+field.valueOrder+'\\]').val(field.value);
                }

                if (sectionQuantity < field.id[0])
                    sectionQuantity = field.id[0];
                if (subSectionQuantity < field.id[1])
                    subSectionQuantity = field.id[1];
            })
            sectionQuantity++;
            subSectionQuantity++;
        });
    }

}



function addNewTariff ()
{
    var html = '';

    html += '<form action="index.php" id="addNewTariffForm"> <legend>Добавление нового тарифа</legend>'+
            '<div class="control-group">'+
            '   <label class="control-label" for="paramTariffName">Название тарифа:</label>'+
            '   <div class="controls">'+
            '       <input type="text" class="span8" name="paramTariffName" value="'+$('#tariffName').val()+'">'+
            '   </div>'+
            '</div>'+
            '<div class="control-group">'+
            '    <label class="control-label" for="paramTariffOperator">Оператор:</label>'+
            '    <div class="controls">'+
            '        <select name="paramTariffOperator">'+
            '            <option value="1">Билайн</option>'+
            '            <option value="2">Мегафон</option>'+
            '            <option value="3">МТС</option>'+
            '        </select>'+
            '    </div>'+
            '</div>'+
            '<div class="control-group">'+
            '   <label class="control-label" for="paramDirectTariff">Прямой тариф:</label>'+
            '   <div class="controls">'+
            '       <input type="checkbox" name="paramDirectTariff" value="1">'+
            '   </div>'+
            '</div>'+
            '<div class="control-group">'+
            '   <label class="control-label" for="paramFederalTariff">Федеральный тариф:</label>'+
            '   <div class="controls">'+
            '       <input type="checkbox" name="paramFederalTariff" value="1">'+
            '   </div>'+
            '</div>'+
            '<div class="control-group">'+
            '   <label class="control-label" for="paramTariffDescription">Описание:</label>'+
            '   <div class="controls">'+
            '       <textarea class="span8" name="paramTariffDescription"></textarea>'+
            '   </div>'+
            '</div>';
    html += '</form>';


    html += '<button type="submit" class="btn" id="addNewTariffBtn" onclick="addTariffToDB()">Добавить</button>';
    return html;
}

function addSection()
{
    html = '';
    html += '<div id="section'+sectionQuantity+'">';
    html += '   <div class="control-group">'+
            '      <label class="control-label" for="addParamTariffSection['+sectionQuantity+'][name]">Название раздела:</label>'+
            '      <div class="controls">'+
            '           <div class="span4">'+
            '               <input type="text" name="addParamTariffSection['+sectionQuantity+'][name]">'+
            '           </div>'+
            '           <div class="span4">'+
            '               <input type="text" name="addParamTariffSection['+sectionQuantity+'][priority]" placeholder="Приоритет">'+
            '           </div>'+
            '           <div class="span4">'+
            '               <a class="btn btn-primary" onclick="addSection()"><i class="icon-plus-sign icon-white"></i>Раздел</a>'+
            '           </div>'+
            '      </div>'+
            '   </div>';
    html += '</div>';
    $(html).appendTo('#addNewTariffForm');
    addSubSection(sectionQuantity);
    sectionQuantity++;


}

function addSubSection(sectionId)
{
    html = '';
    html += '   <div class="control-group">'+
            '      <label class="control-label" for="addParamTariffSubSection['+sectionId+']['+subSectionQuantity+'][name]">Подраздел:</label>'+
            '      <div class="controls">'+
            '          <div class="span2">'+
            '              <input type="text" class="span12" name="addParamTariffSubSection['+sectionId+']['+subSectionQuantity+'][name]">'+
            '          </div>'+
            '          <div class="span4 input-append">'+
            '              <input type="text" class="span3" id="addParamTariffSubSection['+sectionId+']['+subSectionQuantity+'][value][0]" name="addParamTariffSubSection['+sectionId+']['+subSectionQuantity+'][value][0]" placeholder="Значение 1"><span class="add-on">.руб</span>'+
            '              <input type="text" class="span3" id="addParamTariffSubSection['+sectionId+']['+subSectionQuantity+'][value][1]" name="addParamTariffSubSection['+sectionId+']['+subSectionQuantity+'][value][1]" placeholder="Значение 2"><span class="add-on">.руб</span>'+
            '              <input type="text" class="span3" id="addParamTariffSubSection['+sectionId+']['+subSectionQuantity+'][value][2]" name="addParamTariffSubSection['+sectionId+']['+subSectionQuantity+'][value][2]" placeholder="Значение 3"><span class="add-on">.руб</span>'+
            '          </div>'+
            '          <div class="span1">'+
            '              <input type="text" class="span12" name="addParamTariffSubSection['+sectionId+']['+subSectionQuantity+'][type]" value=".руб">'+
            '          </div>'+
            '          <div class="span1">'+
            '              <input type="text" class="span12" name="addParamTariffSubSection['+sectionId+']['+subSectionQuantity+'][priority]" placeholder="Приоритет">'+
            '          </div>'+
            '          <div class="span2">'+
            '               <select class="input-medium" name="addParamTariffSubSection['+sectionId+']['+subSectionQuantity+'][classField]">'+
            '                   <option value="0">---------</option>'+
            '                   <option value="1">Абоненская плата</option>'+
            '                   <option value="2">Звонки</option>'+
            '                   <option value="3">Исходящие СМС</option>'+
            '                   <option value="4">Еще что-нибудь</option>'+
            '               </select>'+
            '               <input type="checkbox" name="addParamTariffSubSection['+sectionId+']['+subSectionQuantity+'][printAsMain]" value="1">'+
            '          </div>'+
            '          <div class="span2">'+
            '              <a class="btn btn-info" onclick="addSubSection('+sectionId+')"><i class="icon-plus-sign icon-white"></i>Подраздел</a>'+
            '          </div>'+
            '      </div>'+
            '   </div>';
    $(html).appendTo('#section'+sectionId);
    subSectionQuantity++;
}

function addTariffToDB()
{
    var fields = $(':input').serializeArray();
    $.post("addTariff.php", fields);
    $('#modalAddTariff').modal('show');
}

function editTariffInDB()
{
    var fields = $(':input').serializeArray();
    $.post("editTariff.php", fields);
    $('#modalEditTariff').modal('show');
}

function copyFromTariff(tariffData, actionType)
{
    var html = '';

    if (actionType == 'add')
    {
        html += '<form action="index.php" id="addNewTariffForm"> <legend>Добавление нового тарифа</legend>'+
            '<input type="hidden" name="paramTariffId" value="'+$('#addTariffList').val()+'">';
    }

    else if (actionType == 'edit')
    {
        html += '<form action="index.php" id="editNewTariffForm"> <legend>Изменение тарифа</legend>'+
            '<input type="hidden" name="paramTariffId" value="'+$('#editTariffList').val()+'">';
    }


    html += '<div class="control-group">'+
        '   <label class="control-label" for="paramTariffName">Название тарифа:</label>'+
        '   <div class="controls">'+
        '       <input type="text" class="span8" id="paramTariffName" name="paramTariffName" value="'+tariffData.tariff.name+'">'+
        '   </div>'+
        '</div>'+
        '<div class="control-group">'+
        '    <label class="control-label" for="paramTariffOperator">Оператор:</label>'+
        '    <div class="controls">'+
        '        <select name="paramTariffOperator">'+
        '            <option value="1"'+(tariffData.tariff.idOperator == 1?' selected':'')+'>Билайн</option>'+
        '            <option value="2"'+(tariffData.tariff.idOperator == 2?' selected':'')+'>Мегафон</option>'+
        '            <option value="3"'+(tariffData.tariff.idOperator == 3?' selected':'')+'>МТС</option>'+
        '        </select>'+
        '    </div>'+
        '</div>'+
        '<div class="control-group">'+
        '   <label class="control-label" for="paramDirectTariff">Прямой тариф:</label>'+
        '   <div class="controls">'+
        '       <input type="checkbox" name="paramDirectTariff" value="1" '+(tariffData.tariff.isDirect == 1?'checked':'')+'>'+
        '   </div>'+
        '</div>'+
        '<div class="control-group">'+
        '   <label class="control-label" for="paramFederalTariff">Федеральный тариф:</label>'+
        '   <div class="controls">'+
        '       <input type="checkbox" name="paramFederalTariff" value="1" '+(tariffData.tariff.isFederal == 1?'checked':'')+'>'+
        '   </div>'+
        '</div>'+
        '<div class="control-group">'+
        '   <label class="control-label" for="paramTariffDescription">Описание:</label>'+
        '   <div class="controls">'+
        '       <textarea class="span8" name="paramTariffDescription">'+tariffData.tariff.shortDescription+'</textarea>'+
        '   </div>'+
        '</div>';
    html += '</form>';

    if (actionType == 'add')
        html += '<button type="submit" class="btn" id="addNewTariffBtn" onclick="addTariffToDB()">Добавить</button>';
    else if (actionType == 'edit')
        html += '<button type="submit" class="btn" id="addNewTariffBtn" onclick="editTariffInDB()">Редактировать</button>';
    return html;

}

function insertSection(field, actionType) {
    html = '';
    html += '<div id="section' + field.id[0] + '">';
    html += '   <div class="control-group">' +
        '      <label class="control-label" for="'+actionType+'ParamTariffSection[' + field.id[0] + '][name]">Название раздела:</label>' +
        '      <div class="controls">' +
        '           <div class="span4">' +
        '               <input type="text" name="'+actionType+'ParamTariffSection[' + field.id[0] + '][name]" value="' + field.name[0] + '">' +
        '           </div>' +
        '           <div class="span4">' +
        '               <input type="text" name="'+actionType+'ParamTariffSection[' + field.id[0] + '][priority]" placeholder="Приоритет" value="' + field.priority[0] + '">' +
        '           </div>' +
        '           <div class="span4">' +
        '               <a class="btn btn-primary" onclick="addSection()"><i class="icon-plus-sign icon-white"></i>Раздел</a>' +
        '           </div>' +
        '      </div>' +
        '   </div>';
    html += '</div>';

    if (actionType == 'add') {
        $(html).appendTo('#addNewTariffForm');
    } else if (actionType == 'edit'){
        $(html).appendTo('#editNewTariffForm');
    }



}

function insertSubSection(field, actionType)
{
    html = '';
    html += '   <div class="control-group">'+
        '      <label class="control-label" for="'+actionType+'ParamTariffSubSection['+field.id[0]+']['+field.id[1]+'][name]">Подраздел:</label>'+
        '      <div class="controls">'+
        '          <div class="span2">'+
        '              <input type="text" class="span12" name="'+actionType+'ParamTariffSubSection['+field.id[0]+']['+field.id[1]+'][name]" value="'+field.name[1]+'">'+
        '          </div>'+
        '          <div class="span4 input-append">'+
        '              <input type="text" class="span3" id="'+actionType+'ParamTariffSubSection['+field.id[0]+']['+field.id[1]+'][value][0]" name="'+actionType+'ParamTariffSubSection['+field.id[0]+']['+field.id[1]+'][value][0]" placeholder="Значение 1" value="'+field.value+'"><span class="add-on">'+field.valueType+'</span>'+
        '              <input type="text" class="span3" id="'+actionType+'ParamTariffSubSection['+field.id[0]+']['+field.id[1]+'][value][1]" name="'+actionType+'ParamTariffSubSection['+field.id[0]+']['+field.id[1]+'][value][1]" placeholder="Значение 2" value=""><span class="add-on">'+field.valueType+'</span>'+
        '              <input type="text" class="span3" id="'+actionType+'ParamTariffSubSection['+field.id[0]+']['+field.id[1]+'][value][2]" name="'+actionType+'ParamTariffSubSection['+field.id[0]+']['+field.id[1]+'][value][2]" placeholder="Значение 3" value=""><span class="add-on">'+field.valueType+'</span>'+
        '          </div>'+
        '          <div class="span1">'+
        '              <input type="text" class="span12" name="'+actionType+'ParamTariffSubSection['+field.id[0]+']['+field.id[1]+'][type]" value="'+field.valueType+'">'+
        '          </div>'+
        '          <div class="span1">'+
        '              <input type="text" class="span12" name="'+actionType+'ParamTariffSubSection['+field.id[0]+']['+field.id[1]+'][priority]" placeholder="Приоритет" value="'+field.priority[1]+'">'+
        '          </div>'+
        '          <div class="span2">'+
        '               <select class="input-medium" name="'+actionType+'ParamTariffSubSection['+field.id[0]+']['+field.id[1]+'][classField]">'+
        '                   <option value="0">---------</option>'+
        '                   <option value="1" '+(field.classField==1?'selected':'')+'>Абоненская плата</option>'+
        '                   <option value="2" '+(field.classField==2?'selected':'')+'>Звонки</option>'+
        '                   <option value="3" '+(field.classField==3?'selected':'')+'>Исходящие СМС</option>'+
        '                   <option value="4" '+(field.classField==4?'selected':'')+'>Еще что-нибудь</option>'+
        '               </select>'+
        '               <input type="checkbox" name="'+actionType+'ParamTariffSubSection['+field.id[0]+']['+field.id[1]+'][printAsMain]" value="1" '+(field.printAsMain==1?'checked':'')+'>'+
        '          </div>'+
        '          <div class="span2">'+
        '              <a class="btn btn-info" onclick="addSubSection('+field.id[0]+')"><i class="icon-plus-sign icon-white"></i>Подраздел</a>'+
        '          </div>'+
        '      </div>'+
        '   </div>';
    $(html).appendTo('#section'+field.id[0]);
}