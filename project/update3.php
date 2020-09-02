  
<?php
include_once 'connection.php';
$bname_error = $email_error=$image_error=$review_error=$isbn_error=$rating_error='';

  if(isset($_GET['book_id']))

    {

    $book_id=$_GET['book_id'];
    
    if(isset($_POST['submit'])) {

		$book_name=$_POST['book_name'];
    $author_email=$_POST['author_email'];
    $dt_publish=$_POST['dt_publish'];
    $review=$_POST['review'];
    $isbn_number=$_POST['isbn_number'];
		$price=$_POST['price'];
    $type=$_POST['type'];
		$rating=$_POST['rating'];
		$is_paperback=$_POST['is_paperback'];
    $is_hardback=$_POST['is_hardback'];
		$is_ebook=$_POST['is_ebook'];
    $in_stock=$_POST['in_stock'];
    $file=$_FILES['cover_picture'];

           $file = basename($_FILES["cover_picture"]["name"]);
           $uploadOk = 1;
           $imageFileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));

    
    if(!preg_match("/^[a-zA-Z ]*$/", $book_name))  
      {  
        $bname_error= "<p style='color:red';>Only Letters and spaces allowed</p>";  
      }
      elseif(!filter_var($_POST["author_email"], FILTER_VALIDATE_EMAIL))  
           {  
            $email_error= "<p style='color:red';>Invalid Email format</p>";  
           } 
           elseif($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") 
           {
            $image_error= "<p style='color:red';>Sorry, only JPG, JPEG, PNG  files are allowed.</p>";
             $uploadOk = 0;
           }  else if ($_FILES["cover_picture"]["size"] > 200000) 
           {
               $image_error ="<p style='color:red'>Sorry, your file is too large.</p>";
               
                   $uploadOk = 0;
                 }elseif(!is_numeric($isbn_number) )
                 {

          $isbn_error= "<p style='color:red';>Please enter Numbers only </p>"; 

        }elseif( strlen($isbn_number) != 13)
                 {

          $isbn_error= "<p style='color:red';>Total numbers to be added is 13 </p>"; 

        }elseif($rating >5)
        {

          $rating_error= "<p style='color:red';>Please enter rating out of 5 </p>"; 
        }
           
           else{

        $query3=mysqli_query($conn," UPDATE books set book_name='$book_name',author_email='$author_email',cover_picture='$file',dt_publish='$dt_publish', review='$review',isbn_number='$isbn_number',price='$price',
        type='$type',rating='$rating',is_paperback='$is_paperback',is_hardback='$is_hardback',is_ebook='$is_ebook',in_stock='$in_stock' where book_id = '$book_id'");
	
		$message = "Record Modified Successfully";
  }
}
		$result = mysqli_query($conn,"SELECT * from books WHERE book_id = '$book_id'");
    $row= mysqli_fetch_array($result);
    
?>


<html>
<head>
<title>Update Books</title>
<link rel="stylesheet" type="text/css" href="styles.css">
<style>
    body{ 
    background-image: url('backlight.jpg');
    color:white;
    font-size:100%;
    background-size: cover;
 background-repeat: no-repeat;
    }
    a{
        color:green;
    }
</style>
</head>

<body>



<form method="post" action="" enctype="multipart/form-data" style="text-align:center;">

<h1> <p>Update Book Details</p></h1>
<div><?php if(isset($message)) { echo $message; } ?></div>
<p> 
<h2><a  href="book_list.php">Book List</a></h2></p>
</div>

ID: 
<input type="hidden" name="book_id" class="txtField" value="<?php echo $row['book_id']; ?>">
<input type="text" name="book_id"  value="<?php echo $row['book_id']; ?>"><br>
<br>

Book Name :
<input type="text" name="book_name" size="50" class="txtField" value="<?php echo $row['book_name']; ?>"><span><br>
<span class="text-danger"><?php echo $bname_error; ?></span><br>

Author Email"
<input type="text" name="author_email"  size="50" class="txtField" value="<?php echo $row['author_email']; ?>"><br>
<span class="text-danger"><?php echo $email_error; ?></span><br>

<p> Picture:
<input type="file" name="cover_picture" value="<?php echo $row['cover_picture']; ?>" required ><br><br>
<span class="text-danger"><?php echo $image_error; ?></span><br>
</p>

Date Published:
<input type="date" name="dt_publish"  value="<?php echo $row['dt_publish']; ?>"><br><br>

Review:
<textarea name="review" rows="5%" cols="40%" value=""><?php echo $row['review']; ?></textarea><br><br>
<span class="text-danger"><?php echo $review_error; ?></span><br>

ISBN Number:
<input type="text" name="isbn_number"  max_lenght="13" value="<?php echo $row['isbn_number']; ?>"><br><br>
<span class="text-danger"><?php echo $isbn_error; ?></span><br>

Price:
<input type="number" name="price" class="txtField" value="<?php echo $row['price']; ?>"><br><br>

Type:
<select  name="type"  >
<option value="<?php echo $row['type']; ?>"><?php echo $row['type']; ?></option>
            <option value="1">1- Magazine</option>
            <option value="2">2- Novel</option>
            <option value="3">3- Textbook</option>
          </select><br><br>
Rating:
<input type="number" name="rating"  value="<?php echo $row['rating']; ?>"><br><br>
<span class="text-danger"><?php echo $rating_error; ?></span><br>

Paper Back:(
<select name="is_paperback" >
        <option value="<?php echo $row['is_paperback']; ?>"><?php echo $row['is_paperback']; ?></option>
            <option value="1">YES</option>
            <option value="0">NO</option>
          </select>

Hard Back: 
<select  name="is_hardback" >
        <option value="<?php echo $row['is_hardback']; ?>"><?php echo $row['is_hardback']; ?></option>
            <option value="1">YES</option>
            <option value="0">NO</option>
          </select>

E-Book:
<select  name="is_ebook"  r>
        <option value="<?php echo $row['is_ebook']; ?>"><?php echo $row['is_ebook']; ?></option>

            <option value="1">YES</option>
            <option value="0">NO</option>
          </select>
 
IN Stock:
<select  name="in_stock" >
        <option value="<?php echo $row['in_stock']; ?>"><?php echo $row['in_stock']; ?></option>
            <option value="1">Available</option>
            <option value="0">Out Of Stock</option>
          </select><br><br>

<input type="submit" name="submit" value="Update" class="buttom">

</form>
<?php 

	}
	
	?>
</body>
</html>