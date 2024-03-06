<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="1.css">
    <title>Document</title>
</head>
<body>
    <h1 class="Not">NotPad</h1>
    <div class="container">
        <div class="ss box">
            <p>
            <?php
            if($_SERVER['REQUEST_METHOD']=="POST"){
                if(isset($_POST['sub']) && !empty($_POST['sub'])){
                    $sub = $_POST['sub'];
                    if(isset($_POST['content']) && !empty($_POST['content'])){
                        $content = $_POST['content'];
                        $conn = mysqli_connect("localhost","root","","emp");
                        $insert ="INSERT INTO `notpad`(`subject`, `content`) VALUES ('$sub','$content')";
                        $query = mysqli_query($conn,$insert);
                        if($query){
                            echo "data saved";
                        }else{
                            echo "Something there is problem";
                        }
                        
                    }else{
                        echo "Please enter your content";
                    }
                }else{
                    echo "Pleas enter the subject";
                }
            }
        ?>
            </p>
            <form method="POST">
                <input type="text" name="sub" placeholder="Enter heading" class="txt">
                <textarea name="content" cols="24" rows="8" placeholder="Enter the content"></textarea>
                <input type="submit" class="sub">
            </form>
        </div>
        <div class="ss box1">
            <table >
                <tr>
                    <th>Sr.no</th>
                    <th>Subject</th>
                    <th>Content</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                    $conn = mysqli_connect("localhost","root","","emp");
                    $sql ="SELECT `id`, `subject`, `content` FROM `notpad`";
                    $query = mysqli_query($conn,$sql);

                    if($query){
                        if(mysqli_num_rows($query)>0){
                            while($data=mysqli_fetch_assoc($query)){
                                
                            echo ' 
                                   <tr>
                                 <td>'.$data['id'].'</td>
                                 <td>'.$data['subject'].'</td>
                                 <td>'.$data['content'].'</td>
                                 <td><a href="">Edit</a></td>
                                 <td><a href="">Delete</a></td>
                                 </tr>
                                 ';
                              
                            }
                        }
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>