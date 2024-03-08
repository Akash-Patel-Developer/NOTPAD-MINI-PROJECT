<?php

        $conn = new mysqli("localhost","root","","emp");

    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(isset($_POST['sub']) && !empty($_POST['sub'])){
            $subject = $_POST['sub'];
            
            if(isset($_POST['content']) && !empty($_POST['content'])){
                $content = $_POST['content'];

                
                if($_POST['save']){
                    $sql = "INSERT INTO `notpad`(`subject`, `content`) VALUES ('$subject','$content')";
    
                    $query = $conn->query($sql);

                    if($conn->affected_rows>0){
                        echo '
                            <script>
                            alert("data has been saved");
                            window.location.href="1.php";
                            </script>
                        ';
                    }
                    else{
                        echo '
                            <script>
                            alert("data can not save");
                            window.location.href="1.php";
                            </script>
                        ';
                    }


                }
                else if(isset($_POST['update'])){
                    if(isset($_POST['id'])){
                        $id = $_POST['id'];
                    }
                }
                else{
                    echo '
                        <script>
                            alert("Submit button is not working");
                        </script>
                    ';
                }
            }else{
                echo '
                    <script>
                        alert("plz enter you content");
                    </script>
                ';
            }
        }else{
            echo '
                <script>
                    alert("plz enter you subject");
                </script>
            ';
        }
    }


    $subject=$content=$id="";
    $show=false;

    if(isset($_GET['edit']) && !empty($_GET['edit']) && ctype_digit($_GET['edit'])){
        $edit = $_GET['edit'];
        $sql = "SELECT `id`, `subject`, `content` FROM `notpad` WHERE `id`=$edit";

        $query = $conn->query($sql);
        if($query->num_rows==1){
            $show=true;
            $data = $query->fetch_assoc();
            $i = $data['id'];
            $subject = $data['subject'];
            $content = $data['content'];
        }
        else{
            echo '
                    <script>
                        alert("No record found");
                        window.location.href="1.php";
                    </script>
            ';
        }
    }

    if(isset($_GET['delete']) && !empty($_GET['delete']) && ctype_digit($_GET['delete'])){
        $id = $_GET['delete'];
        $delete = "DELETE FROM `notpad` WHERE `id`='$id'";
        $query = $conn->query($delete);
        if($conn->affected_rows==1){
            echo '
                    <script>
                            alert("This data has been deleted");
                            window.location.href="1.php";
                    </script>
            ';
        }else{
            echo '
                    <script>
                            alert("No record found");
                            window.location.href=1.php";
                    </script>
            ';
        }
    }
?>

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
            <form method="POST">
                <?php
                    if($show){
                        echo '
                            <input type="hidden" name="id" value="'.$id.'">
                        ';
                    }
                ?>
                <input type="text" name="sub" placeholder="Enter heading" class="txt" value="<?php echo $subject; ?>">
                <textarea name="content" cols="24" rows="8" placeholder="Enter the content"><?php echo $content; ?></textarea>
                <div class="save">
                    <input type="submit" name="save" class="sub">
                    <input type="submit" value="Update" name="update" class="sub">
                </div>
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
                            $select = "SELECT `id`, `subject`, `content` FROM `notpad`";
                            $query = $conn->query($select);
                            
                            if($query->num_rows>0){
                                while($data = $query->fetch_assoc()){
                                   echo '
                                        <tr>
                                            <td>'.$data['id'].'</td>
                                            <td>'.$data['subject'].'</td>
                                            <td>'.$data['content'].'</td>
                                            <td><a href="?edit='.$data["id"].'">Edit</a></td>
                                            <td><a href="?delete='.$data['id'].'">Delete</a></td>
                                        </tr>
                                   '; 
                                }
                            }
                      ?>
            </table>
        </div>
    </div>
</body>
</html>