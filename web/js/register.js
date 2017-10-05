// var flag=new Array();
$(document).ready(function($) {
	init();
	// for(var i=0;i<4;i++)
	// {
	// 	flag[i]="0";
	// }
	// $(".re_input:eq(0)").on("mouseleave",function(){
	// 	if($(this).val()==""){
	// 		flag[0]="0";
	// 		$(".msg:eq(0)").text("用户名不能空");
	// 	}
	// 	else{
	// 		$(".msg:eq(0)").text("");
	// 		var user=$(this).val();		
	// 		if(user.length>'12'){
	// 			flag[0]="0";
	// 			$(".msg:eq(0)").text("用户名不能超过12位");
	// 		}
	// 		else{
	// 			var mode=/^[\w\u4e00-\u9fa5]*$/;
	// 			if(user.match(mode)){
	// 			$.ajax({
	// 				type:"POST",
	// 				url:checknameurl,
	// 				data:{
	// 					"user":user
	// 				},
	// 				success:function(response,status,xhr){
	// 					switch(parseInt(response))
	// 					{
	// 						case 1:flag[0]="1";$(".msg:eq(0)").text("用户名可用");break;
	// 						case 2:flag[0]="0";$(".msg:eq(0)").text("用户名已存在");break;
	// 						case 3:alert('啊搞事啊？');break;

	// 					}
	// 				}
	// 			});
	// 		}
	// 		else{
	// 			flag[0]="0";
	// 			$(".msg:eq(0)").text("只包含汉字，字母，数字,_");
	// 		}

	// 		}
	// 		}
	// });
	// $(".re_input:eq(1)").on("mouseleave",function(){
	// 	if($(this).val()==""){
	// 		flag[1]="0";
	// 		$(".msg:eq(1)").text("密码不能为空");
	// 	}
	// 	else{
	// 		$(".msg:eq(1)").text("");
	// 		pwd=$(this).val();		
	// 		if(pwd.length>'20'){
	// 			flag[1]="0";
	// 		$(".msg:eq(1)").text("密码不能超过20位");
	// 		}
	// 		else{
	// 			if(pwd.length<'6'){
	// 				flag[1]="0";
	// 				$(".msg:eq(1)").text("密码不小于6位");
	// 			}
	// 			else{
	// 			flag[1]="1";
	// 			}
	// 		}
	// 	}

	// });

	// $(".re_input:eq(2)").on("mouseleave",function(){
	// 	if($(this).val()==pwd){
	// 		flag[2]="1";
	// 		$(".msg:eq(2)").text("两次密码一致");
	// 	}
	// 	else{
	// 		flag[2]="0";
	// 		$(".msg:eq(2)").text("两次密码不一致");
	// 	}
	// });

	// $(".re_input:eq(3)").on("mouseleave",function(){

	// 	if($(this).val()==""){
	// 		flag[3]="0";
	// 		$(".msg:eq(3)").text("邮箱不能为空");
	// 	}
	// 	else{
	// 		$(".msg:eq(3)").text("");
	// 		var mail=$(this).val();
	// 		var mode=/([\w\.]{2,255})@([\w\-]{2,255}).([a-z]{2,4})/;
	// 		if(mail.match(mode)){
	// 			flag[3]="1";
	// 		$(".msg:eq(3)").text("邮箱格式正确");
	// 		}
	// 		else{
	// 			flag[3]="0";
	// 	    $(".msg:eq(3)").text("邮箱格式不正确");
	// 		}
	// 	}

	// });

});


// function register(){
// 		var sum=0;
// 		for(var i=0;i<4;i++)
// 		{
//                if(flag[i]=="1")
//                {
//                	sum++;
//                }
// 		}
// 		alert(sum);
// 		alert(flag);
// 		if(sum=="4"){
// 			alert("1");
//             return true;
// 		}
// 		else{
// 			return false;
// 		}

// 	}