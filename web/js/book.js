$(document).ready(function($) {
	init();
	showmeau();
	var id=$('.book_table').attr('id');
	var url='http://localhost/git_yii_library/web/index/book/getbook?id='+id;
	$.get(url,function(data){
		var items = $.parseJSON(data);	
		var i=0;
		$('.bookname').append(items['bookname']);
		
			for(var k in items){
				if(k!='id'){
				var tr=$('.book_table tr:eq('+i+')');
				var td = $('.book_res:eq('+i+')');
				td.html(items[k]);
				tr.append(td);
				i++;}
		
		}
	});

    // $('.book_btn').on('click',function(){
    // 	var userid=$('.h_user').attr('userid');
    // 	$.ajax({
    //             type: 'POST',
    //             url: "http://localhost/yii_library/web/index.php?r=book/borrowbook",
    //             data: {
    //              	'userid':userid,
    //              	'bookid':id

    //                   },
  
    //              success: function(date) {
    //                  	switch(parseInt(date)){
    //                 		case 1:alert('借书成功，请至管理员处确认信息');break;
    // 	                	case 0:alert('借书失败，请刷新重试');break;
    //                       	}  
    //                      },

    //              error: function() {
    //                       alert('服务器爆炸了，请联系管理员');
    //                    }
    //                      });
    //             });


});

