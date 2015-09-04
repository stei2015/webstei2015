// JavaScript Document

$(document).ready(function(e) {
function tool(txt) {
	el = document.formtosub.content;
	if(!el.value) el.value = '['+txt+'] ';
	else el.value += ((el.value.charAt(el.value.length-1) == ' ') ? '' : ' ') + txt + ' ';
}
    
});
