function setIssueByWindow (type){
    var projectCode = $("#project-code").val();
    var issueId = $("#issue-id").val();
    document.location = "/issue/create/"+projectCode+'/'+type+'/?parent_id='+issueId;
}


function setIssue (id, name)
{
    if (name == 'parentIssue') {
        updateIssueParent (id)
    }

}


function setIssueType(type, name) {

    if (name == 'changeStatus'){
        updateIssueType (type);
    }
}


/**
 * Устанавливаем родителькое иссуе
 *
 * @param id
 */
function updateIssueParent (id)
{
    sendIssueCommand({
        id      : $("#issue-id").val(),
        parent  : id
    });
}

function updateIssueType (type) {
    sendData({
        command : 'set-type',
        type    : type
    });
}

function sendData (data)
{
    var html = '<form name="sendDataForm" method="post" >';
    for (var key in data) {
        var val = data[key];
        html += '<input type="hidden" name="'+key+'" value="'+val+'" />';
    }
    html += '</form>';

    $("body").append (html);
    document.sendDataForm.submit ();
}

/**
 * Выполняем перенаправление на команду
 *
 * @param data
 */
function sendIssueCommand (data)
{
    var action = '/issues/setparent/';

    var html = '<form name="sendDataForm" method="get" action="'+action+'" >';
    for (var key in data) {
        var val = data[key];
        html += '<input type="hidden" name="'+key+'" value="'+val+'" />';
    }
    html += '</form>';

    $("body").append (html);
    document.sendDataForm.submit ();
}