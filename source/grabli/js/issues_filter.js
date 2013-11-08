

function setShowType (type) {
	$('#show').val(type);
	document.issuesFilterForm.submit();
}


function setSort (sort) {
	$('#sorting').val(sort);
	document.issuesFilterForm.submit();
}