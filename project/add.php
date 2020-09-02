
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form{
            margin: 0 auto;
            
            background:rgb(243, 240, 240);
             height:440px;
            width:500px;
            border:solid black 1px;
            padding:15px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    
        }
        body{
             background-image: url('lib.jpg');
             color:black;
              font-size:100%;
              background-size: cover;
             background-repeat: no-repeat;
  }
        h1{
           
            text-align:center;
            margin: 0 auto;
            border:1px solid;
            padding:3px;
            margin-bottom:55px;
            height:45px;
            background:rgb(255, 249, 237);
            


        }form{
            opacity:0.9;    
        }
        </style>

</head>
<body>
    <h1><b>ADD NEW BOOK INFORMATION</b></h1>
    
    <form method="POST" action="add.php"  enctype="multipart/form-data" >
        <table>
            
            <tr>
                <td>Book Name:</td>
                <td><input type="text" name="bk_name" required></td>
            </tr>
            <tr>
                <td>Author's Email:</td>
                <td><input type="email" name="author_email" required> </td>
            </tr>
            <tr>
                <td>  Select image (less than 2MB jpg/jpeg format):</td>
               <td><input type="file" name="uploadfile" id="fileToUpload" required></td>
              
               </tr>
            <tr>
                <td>Date published:</td>
                <td><input type="date" name="date_pub" required> </td>
           </tr>
           <tr>
               <td> Review:</td>
               <td><textarea rows="5%" cols="40%" name="review"></textarea></td>
           </tr>
           <tr>
               <td> ISBN Number:</td>
               <td> <input type="text" name="isbn_number" required></td>
           </tr>
           <tr>
               <td>Price:</td>
               <td><input type="number" name="price" required></td>
           </tr>
           <tr>
               <td>Type:</td>
               <td><select name = "types">
                <option value = "1">Magazine</option>
                <option value = "2">Novel</option>
                <option value = "3">textbook</option></select></td>
           </tr>
           
           <tr>
               <td>Rating(1-10):  </td>
               <td> <input type="number" name="rating"> </td>
           </tr>
           <tr>
            <td>Paperback:</td>
            <td><select name="paperback">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>  </td>
        </tr>
        
            <td>Hardback:</td>
            <td><select name="hardback">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>  </td>
            <tr>
            <td>Ebook:</td>
            <td><select name="ebook">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>  </td>
        </tr>
        <tr>
            <td>In Stock:</td>
            <td><select name="in_stock">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>  </td>
        </tr>
        <tr>
        <select  name="category" value="" style="width:200px;" required>
         
         <?php
       include "connection.php";
       //SELECT * from contacts C ,info I   where(C.Cid = I.did)
       //
       $sql1="SELECT *  From categories  ";
                   $result=mysqli_query($conn,$sql1);
                   
                   
                       while($row =$result-> fetch_assoc()){
       
                       
       
       
       ?>
       
       
         <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['category']; ?></option>
       <?php
       
       
       }
       
       
       
         ?>
        </tr>
        <tr>
            <td><input type="submit" name="txtbutton" value="SUBMIT" /></td>

        </tr>
     </table>
     </form>

</body>
</html>
<?php
include "connection.php";
$book_nameerr=$author_emailerr=$cover_pictureerr=$dt_publisherr=$reviewerr=$isbn_numbererr=$priceerr=$typeerr=$ratingerr=$is_paperbackerr=$is_hardbackerr=$is_ebookerr=$in_stockerr=" ";
$book_name=$category=$author_email=$cover_picture=$dt_publish=$review=$isbn_number=$price=$type=$rating=$is_paperback=$is_hardback=$is_ebook=$in_stock=" ";
    if(isset($_POST['txtbutton']))
        {
            
            $filename = $_FILES["uploadfile"]["name"]; 
            $tempname = $_FILES["uploadfile"]["tmp_name"];     
            $folder = "image/".$filename; 
            $category= $_POST['category'];
            $book_name = $_POST['bk_name'];
            $author_email = $_POST['author_email'];
            $dt_publish = $_POST['date_pub'];
            $review = $_POST['review'];
            $isbn_number = $_POST['isbn_number'];
            $price = $_POST['price'];
            $type = $_POST['types'];
            $rating = $_POST['rating'];
            $is_paperback = $_POST['paperback'];
            $is_hardback = $_POST['hardback'];
            $is_ebook = $_POST['ebook'];
            $in_stock=$_POST['in_stock'];
            
            $result = $conn->query("INSERT INTO `books` (`book_id`, `book_name`, `author_email`, `cover_picture`, `dt_publish`, `review`, `isbn_number`, `price`, `type`, `rating`, `is_paperback`, `is_hardback`, `is_ebook`, `in_stock`) VALUES (NULL,'$book_name','$author_email','$filename','$dt_publish','$review','$isbn_number','$price','$type','$rating','$is_paperback','$is_hardback','$is_ebook','$in_stock')");
            if (move_uploaded_file($tempname, $folder))  { 
                $msg = "Image uploaded successfully"; 
            }else{ 
                $msg = "Failed to upload image"; 
          } 
          $result1 = $conn->query("INSERT INTO book_categories (book_id,cat_id) VALUES ((select book_id from books where book_name='$book_name' LIMIT 1),(select cat_id from categories where cat_id='$category' LIMIT 1))");
          echo "<b>Successfully Inserted <br /></b>";
        } 
            
    
        
        
    


?>
