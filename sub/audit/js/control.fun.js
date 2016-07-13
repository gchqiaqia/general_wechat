function get_audit_status(id)
{
	//window.alert(id);
    var data='Ajax_FunName=GetAuditStatus&sceneid='+id;//后台方法
    $.getJSON("include/bn_submit.switch.php",data,function (json){
		$('#status').html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+json.status);
    })  
}
function audit_approve(obj,id)
{
    var data='Ajax_FunName=AuditApprove&id='+id;//后台方法
    $('.small_loading').fadeIn(100);
    $.getJSON("include/bn_submit.switch.php",data,function (json){
    	table_refresh(table);
    })	 
}
function audit_reject(obj,id)
{
    var data='Ajax_FunName=AuditReject&id='+id;//后台方法
    $('.small_loading').fadeIn(100);
    $.getJSON("include/bn_submit.switch.php",data,function (json){
    	table_refresh(table);
    })	 
}
