<?php

include('config.php');
if(isset($_POST['addcat'])){
   $msg=create_category($conn);     
}
if(isset($_POST['addsubcat'])){
    $msg=create_subcategory($conn);     
}

function create_category($conn){
      $category_name= legal_input($_POST['category_name']);
      $query=$conn->prepare("INSERT INTO categories (category_name) VALUES (?)");
      $query->bind_param('s',$category_name);
      $exec= $query->execute();
      if($exec){
         $msg=" Category was created successfully";
         return $msg;
      }else{
        $msg= "Error: " . $query . "<br>" . mysqli_error($conn);
      }
}


function create_subcategory($conn){
      $parent_id= legal_input($_POST['parent_id']);
      $subcategory_name= legal_input($_POST['subcategory_name']);
      $query=$conn->prepare("INSERT INTO subcategories (parent_id,subcategory_name) VALUES (?,?)");
      $query->bind_param('is',$parent_id,$subcategory_name);
      $exec= $query->execute();
      if($exec){
        $msg="Subcategory was created sucessfully";
        return $msg;
      }else{
        $msg= "Error: " . $query . "<br>" . mysqli_error($conn);
      }
}

// fetch query

$catData=fetch_categories($conn);

function fetch_categories($conn){ 
  $parent_id=0;
  $query = $conn->prepare('SELECT * FROM categories WHERE parent_id=?');
  $query->bind_param('i',$parent_id); 
  $query->execute();
  $exec=$query->get_result();

  $catData=[];
  if($exec->num_rows>0){
    while($row= $exec->fetch_assoc())
    {
        $catData[]=[
          'id'=>$row['id'],
          'parent_id'=>$row['parent_id'],
          'category_name'=>$row['category_name'],
          'subcategories'=>fetch_subcategories($conn,$row['id'])
        ];  
   }
   return $catData;
        
  }else{
    return $catData=[];
  }
}

// fetch query

function fetch_subcategories($conn,$parent_id){
  $query = $conn->prepare('SELECT * FROM subcategories WHERE parent_id=?');
  $query->bind_param('i',$parent_id); 
  $query->execute();
  $exec=$query->get_result();

  $subcatData=[];
if($exec->num_rows>0){
    while($row= $exec->fetch_assoc())
    {
        $subcatData[]=[
          'id'=>$row['id'],
          'parent_id'=>$row['parent_id'],
          'subcategory_name'=>$row['subcategory_name'],
          
        ];  
   }
   return $subcatData;
        
  }else{
    return $subcatData=[];
  }
}
// convert illegal input to legal input
function legal_input($value) {
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
}
?>