var curPage;        //当前页数
var totalItem;      //总记录数
var pageSize;       //每一页记录数
var totalPage;      //总页数
var typeg;


$(function(){
  var index=$('select option:selected').val();
  var sort=$("input[name='sort']:checked").val();
  var search=$('.c_input').val();
  var restable=$('.c_result table');
  typeg='';
  if(search==''){
    search='*';
  }
	init();
  showmeau();
  type();

  turnPage(1,sort,index,search); 

   $('.search').click(function(){
   search=$('.c_input').val();
   if(search==''){
    search='*';
    typeg='';
   }
   	restable.find('th:eq(0)').text('搜索结果:');
    turnPage(curPage,sort,index,search); 



   });

   $(".c_input").keypress(function(e){
        if (e.keyCode == 13){
            $('.search').click();
        }
})



   $('select').change(function(){
   	 index=$('select option:selected').val();
    turnPage(curPage,sort,index,search,typeg); 
  
   });


 
    $("input[name='sort']").each(function(){//循环绑定事件  
        this.onclick = function(){  
        	 sort=$(this).val();
          turnPage(curPage,sort,index,search,typeg); 
        }  
    });

});

//获取分类

function type(){
var tag=$('.tag');
var init_data_url = "http://localhost/git_yii_library/web/index/index/list?act=inittype";
  $.get(init_data_url,function(data){
    var row_items = $.parseJSON(data);
    for( var i = 0 ; i < row_items.length ; i++) {
      var type_con='';
      var type=row_items[i]['type'];
      var typet='"'+type+'"';
      type_con="<span><a href='javascript:typesearch("+typet+");'>"+type+"</a></span>";
      tag.append(type_con);
    }
  });


}

function typesearch(type){
  var index=$('select option:selected').val();
  var sort=$("input[name='sort']:checked").val();
  var search=$('.c_input').val();
  if(search==''){
    search='*';
   }
  typeg=type;
  turnPage(curPage,sort,index,search,typeg);


}




 
//获取分页数据
function turnPage(page,sort,index,search,type)
{
   var restable=$('.c_result table');
   $('.loading').find('span').remove();

  $.ajax({
    type: 'POST',
    url: "http://localhost/git_yii_library/web/index/index/list?act=seldata",  
    data: {'pageNum':page,'sort':sort,'index':index,'search':search,'type':type,
  },
    dataType: 'json',
    beforeSend: function() {
      
      $('.loading').append('<span>加载中...</span>');
    },
    success: function(json) {
       $(".restr").remove();      //移除原来的分页数据
      $('.loading').find('span').remove();
      if(json=='0'){
        $('.loading').append('<span>无搜索结果</span>');
      }
        else{
     
      totalItem = json.totalItem;
      pageSize = json.pageSize;
      curPage = page;
      totalPage = json.totalPage;
      var data_content = json.data_content;      
      $.each(data_content,function(index,array) {
        var row_obj = $("<tr style='magin:0;' class='restr'></tr>");
        var col_td =''; 
        var id=array['id'];
        col_td="<td><a href='http://localhost/git_yii_library/web/index/book/book?id="+id+"'>"+array['bookid']+"</a></td><td><a href='http://localhost/yii_library/web/index/book/book?id="+id+"'>"+array['bookname']+"</a></td><td>"+array['author']+"</td><td>"+array['booktypeid']+"</td><td>"+array['bookcount']+"</td>"
        row_obj.append(col_td);
        restable.append(row_obj);
      });}
     
     
    },
    complete: function() {    //添加分页按钮栏
      getPageBar();
    },
    error: function() {
      alert("数据加载失败");
    }
  });
}
 
function getPageBar()
{
  var index=$('select option:selected').val();
  var sort=$("input[name='sort']:checked").val();
  var search=$('.c_input').val();

  if(search==''){
    search='*';
  }
  index ='"'+index+'"';
  sort ='"'+sort+'"';
  search ='"'+search+'"';
  if(typeg!=''){
    var typet='"'+typeg+'"';

  }

  if(curPage > totalPage) {
    curPage = totalPage;
  }
  if(curPage < 1) {
    curPage = 0;
  }
 
  pageBar = "";
 
  //如果不是第一页
  if(curPage != 1){
    pageBar += "<span class='pageBtn'><a href='javascript:turnPage(1,"+sort+","+index+","+search+","+typet+")'>首页</a></span>";
    pageBar += "<span class='pageBtn'><a href='javascript:turnPage("+(curPage-1)+","+sort+","+index+","+search+","+typet+")'><<</a></span>";
  }
 
  //显示的页码按钮(5个)
  var start,end;
  if(totalPage <= 5) {
    start = 1;
    end = totalPage;
  } else {
    if(curPage-2 <= 0) {
        start = 1;
        end = 5;
    } else {
        if(totalPage-curPage < 2) {
            start = totalPage - 4;
            end = totalPage;
        } else {
            start = curPage - 2;
            end = curPage + 2;
        }
    }
  }
 
  for(var i=start;i<=end;i++) {
    if(i == curPage) {
        pageBar += "<span class='pageBtn-selected'><a href='javascript:turnPage("+i+","+sort+","+index+","+search+","+typet+")'>"+i+"</a></span>";
    } else {
        pageBar += "<span class='pageBtn'><a href='javascript:turnPage("+i+","+sort+","+index+","+search+","+typet+")'>"+i+"</a></span>";
    }
  }
   
  //如果不是最后页
  if(curPage != totalPage){
    pageBar += "<span class='pageBtn'><a href='javascript:turnPage("+(parseInt(curPage)+1)+","+sort+","+index+","+search+","+typet+")'>>></a></span>";
    pageBar += "<span class='pageBtn'><a href='javascript:turnPage("+totalPage+","+sort+","+index+","+search+","+typet+")'>尾页</a></span>";
  }
     
  $("#pageBar").html(pageBar);
}
 
//页面加载时初始化分页



