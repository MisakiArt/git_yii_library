<?php
/* @var $this yii\web\View */
?>
<script type="text/javascript" src='<?php echo Yii::$app->homeUrl ?>/../js/index.js'></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->homeUrl ?>/../css/page.css">
<div class='index'>
  <div><a href="<?php echo Yii::$app->homeUrl ?>index/index">首页</a></div>
</div> 
<div class="c_index">     
           <input class="c_input" type="text" name="" value="">
           <span class="search"><a href="javascript:void(0);" >search</a></span>
           <div class="sort">
           <select>
            <option value ="bookname">名称</option>
            <option value ="bookid">索书号</option>
            <option value="bookcount" selected = "selected">热度</option>
            <option value ="author">作者</option>
           </select>
           升序&nbsp<input type="radio"  name="sort" value="ASC" />
           降序&nbsp<input type="radio" checked="checked" name="sort" value="DESC" />
           </div>
           <div class="tag">
           </div>

           
        </div>
        <hr>
        <div class="c_result">
        <table >
         <tr><th>热门图书：</th></tr>
         <tr><th>索引号</th><th>书名</th><th>作者</th><th>类型</th><th>人气</th>
        </table>
        <div class='loading' style="height: 20px; margin-left: 30px;"></div>
        <div id="pageBar"><!--这里添加分页按钮栏--></div>
        </div>
