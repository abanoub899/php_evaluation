<?php

include('catsubcat-script.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<title>Category and SubCategory in PHP</title>
<style type="text/css">
  
.right-col{
    width: 75%;
    float: right;}

body{
    overflow-x: hidden;}
.left-col form {
    height: 100vh;
    border: 2px solid #f1f1f1;
    padding: 16px;
    background-color: white; }
.left-col{
    width: 20%;
    float: left;
    background: #f1f1f1;
    height: 100vh;}
.left-col a{
  text-decoration: none;
  font-size: 20px;
  color: orangered;
  line-height: 30px}
.left-col ul{
  list-style-type:none;
}
.form input, .form select{
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;}
.form select{
    width:109%;}
.form input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;}
.form button[type=submit] {
    background-color: #434140;
    color: #ffffff;
    padding: 10px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 111%;
    opacity: 0.9;
    font-size: 20px;}
.form label{
  font-size: 18px;;}
.form button[type=submit]:hover {
  background-color:#3d3c3c;}
.form-title a, .form-title h2{
   display: inline-block;}
.form-title a{
      text-decoration: none;
      font-size: 20px;
      background-color: green;
      color: honeydew;
      padding: 2px 10px;}
 .form{
  width:30%;}
</style>
</head>
<body>
<!--====form section start====-->

<div class="left-col">
<ul>
  <li><a href="catsubcat-form.php?add=add-category">Add Category</a></li>
  <li><a href="catsubcat-form.php?add=add-subcategory">Add Subcatgory</a></li> 
</ul>       
</div>
<!--====form section start====-->

<div class="right-col">
<div class="form">

<p style="color:red">
        
<?php if(!empty($msg)){echo $msg; }?>

        </p> 
        
<?php

 echo $add=$_GET['add']??'';
 switch ($add) {
 case 'add-category':
         
?>

<!--==== category form=====-->
<div class="form-title">
<h2>Create Category</h2>
</div>
<form method="post" action="">
   <label>Category</label>
   <input type="text" placeholder="Enter Full Name" name="category_name" required>
    <button type="submit" name="addcat">Add category</button>
</form>
<!--=======subcategory form====-->
             
<?php

     break;
     case 'add-subcategory':
         
?>

 <!--==== subcategory form=====-->
 <div class="form-title">
 <h2>Create Subcategory</h2>
 </div>
<form method="post" action="">
     <label>Category</label>
     <select name="parent_id">
             
<?php
foreach ($catData as $cat) {
?> <option value="<?php echo $cat['id']; ?>"> <?php echo $cat['category_name']; ?>
</option>
<?php } ?>

      </select>
    <label>Subcategory</label>
    <input type="text" placeholder="Enter Full Name" name="subcategory_name" required>
    <button type="submit" name="addsubcat">Add subcategory</button>
 </form>
 
 <!--=======subcategory form====-->
             
<?php

      break;
      
      default:
     
?>

<h3>Category and subcategory </h3>
             
<?php

      break;
    }
    
?>

        
    </div>
  </div>

</body>
</html>