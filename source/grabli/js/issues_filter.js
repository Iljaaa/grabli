

function setShowType (type) {
	$('#show').val(type);
	document.issuesFilterForm.submit();
}


function setSort (sort, direction) {
	$('#sorting').val(sort);
	$('#direction').val(direction);
	document.issuesFilterForm.submit();
}

function setPage (page){
	$('#page').val(page);
	document.issuesFilterForm.submit();
}



function clearAssignedTo (){
	$("#assigned_to").val(0);
	$("#user-setted-block-assigned_to").hide();
	$("#user-notsetted-block-assigned_to").show();
}

function clearPostedBy (){
	$("#posted_by").val(0);
	$("#user-setted-block-posted_by").hide();
	$("#user-notsetted-block-posted_by").show();
}