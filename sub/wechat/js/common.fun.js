/**
 * 
 */
function dialog_show(text)
{
	document.getElementById("massagebox_text").innerHTML=text
	//window.alert(text)
	document.getElementById("massagebox").style.display="block"
}
function dialog_close()
{
	document.getElementById("massagebox").style.display="none"
}