<?php
include "connection.php";

$sql1="SELECT * from books B join book_categories D on B.book_id= D.book_id join categories C where D.cat_id= c.cat_id";
            $result=mysqli_query($conn,$sql1);
            
            
                while($row =$result-> fetch_assoc()){

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    a{
    color:black;
  }
  body{
    background-image: url('bac1.jpg');
    color:white;
    font-size:100%;
    background-size: cover;
 background-repeat: no-repeat;
  }
  </style>
  
</head>

<body>

  <div class="card">
  <h1><?php echo "<img height='40%' width='50%' src='image/".$row['cover_picture']."' >" ?>  </h1>
  <h1><?php echo $row["book_name"]; ?> </h1>
  <p><?php echo $row["author_email"] ; ?></p>
  <p>Date: <?php echo $row["dt_publish"]; ?></p>
  <p>Review: <?php echo $row["review"]; ?></p>
  <p>IDBN: <?php echo $row["isbn_number"]; ?></p>
  <p>Price:Rs. <?php echo $row["price"]; ?></p>
  <p><?php 
  if($row["type"]==1)
                  {
                    echo "Magazine";
                  }
                  elseif($row["type"]==2)
                  {
                    echo "Novel" ;

                  }
                  else{
                    echo "Textbok";
                  }
                  ?> </p>
<p>Rating: <?php echo $row["rating"]; ?></p>
<p> <?php 
      if($row["is_paperback"]==1)
      {
        echo "Paperback";
      }
      elseif($row["is_hardback"]==1)
      {
        echo "Hardback ";
      }
      else{
        echo "Ebook";
      }
        ?></p>
<p><b> <?php
if($row["in_stock"]==1)
  {
    echo "In Stock";
  }
  else{
    echo "Out Of Stock";
  }; ?></b></p>
  <p>Date Modified:<i><b><?php echo $row["dt_modified"] ; ?></b></i></p>
  <p><p>Category:<i><b><?php echo $row["category"] ; ?></b></i></p></p>
  <p><a href="update3.php?book_id=<?php echo $row["book_id"]; ?>"><button>Update</button></a></p>
  <a href="delete.php?book_id=<?php echo $row["book_id"]; ?>" onclick="return confirm('Are you sure?');"><button>Delete</button></a>
  

</div>
  
<?php

                }

                ?>
<button class="btn"><a href="add.php">ADD BOOK</a></button>

</body>
</html>
