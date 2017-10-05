$(document).ready(function($) {
	init();





});

function login(){
	var mode1=/^[\w\u4e00-\u9fa5]*$/;
	var mode2=/^[0-9a-zA-Z]*$/;
	var username=$(".re_table input:eq(0)").val();
	var pwd=$(".re_table input:eq(1)").val();
	if(username==''){
		alert('请认真填写用户名');
		return false;
	}
	else{
		if(username.match(mode1)){
			if(pwd.match(mode2)){
				return true;
			}
		}
		alert('数据不符合规范');
		return false;

	}
	

}