<?php
/* @var $this yii\web\View */
?>
<link rel="stylesheet" type="text/css" href='<?php echo Yii::$app->homeUrl ?>/../css/book.css'>
<script type="text/javascript" src='<?php echo Yii::$app->homeUrl ?>/../js/book.js'></script>
<div class='index'>
  <div><a href="<?php echo Yii::$app->homeUrl ?>index/index">首页</a></div>
  <div>></div>
  <div>书目</div>
  <div>></div>
  <div class="bookname"></div>
</div> 
<div class="book_content">
  <table class="book_table" id="<?php echo $_GET['id'] ?>">
    <tr><td class='book_index'>索引号：</td><td class="book_res"></td></tr>
    <tr><td class='book_index'>书名：</td><td class="book_res"></td></tr>
    <tr><td class='book_index'>作者：</td><td class="book_res"></td></tr>
    <tr><td class='book_index'>作品类型：</td><td class="book_res"></td></tr>
    <tr><td class='book_index'>作品标签：</td><td class="book_res"></td></tr>
    <tr><td class='book_index'>作品简介：</td><td class="book_res"></td></tr>
    <tr><td class='book_index'>热度：</td><td class="book_res"></td></tr>
    <tr><td class='book_index'>剩余数量：</td><td class="book_res"></td></tr>

  </table>
  <div class="book_footer">
  <form action="<?php echo Yii::$app->homeUrl ?>index/book/borrowbook" method="post">
  <input type="text" name="bookid" class="book_inp" value="<?php echo $_GET['id'] ?>" >
  <input type="text" name="userid" class="book_inp" value="<?php \Yii::$app->session->open();echo $_SESSION['userid'] ?>">
  <input type="submit"  class="book_btn"  value="申请借书">
  </form>
  </div>

</div>

