<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registeration</title>
    <style>
    nav{
        padding:10px;
       background:white;
       display:flex;
       align-items:center;
       justify-content:space-around; 
       width:360px;
       border-radius:10px 10px 10px 10px;
    }
    nav div a{
        padding:8px;
        font-weight:bold;
        cursor:pointer;
        color:black;
        text-decoration:none;
        border-radius:5px 5px 5px 5px;
    }
    nav div a:hover{
        color:white;
        background:#100f0f;
    }
    .box{
        padding:20px;
        border-radius:5px 5px 5px 5px;
        margin-top:20vh;
    }
    #registeration{
        background:khaki;
        max-width:300px;
    }
    #registeration input{
        border:none;
        outline:none;
        padding:5px;
    }
    
    #registered{
        background:#5bb35b;
        max-width:340px;
        color:white;
    }
    #registered table{
        border:2px solid black; 
        padding:5px;
    }
    #registered table td{
        padding:3px;
    }
    #not-registered{
        background:#ff2828;
        width:200px;
    }
    .btn{
        cursor: pointer;
        background:grey;
        color:white;
    }
    .btn:hover{
        background:white;
        color:black;
        font-weight:bold;
        transform:scale(1.2);
    }
</style>
</head>
<body style="background-color:#100f0f;">

<!-- the nav bar code -->
    <center>
        <nav>
            <div>
            <a href="user.php">
            User Registeration
            </a>
            </div>
            <div>
            <a href="disp.php">
            Display data
            </a>
            </div>
        </nav>
    </center>

<!-- the conatiner where the user registeration happens -->

    <div id="container">

        <?php 

        //code to check what component to render the form or the success/failure message
            if(isset($_POST["scholarNo"])){
                //this renders the result
                $scholarNo = strtoupper($_POST["scholarNo"]);
                $name = $_POST["name"];
                $email = $_POST["email"];
                $date = date("Y-m-d H:i:s");

                //to handle the situation when user donot fill the fields provided
                if($scholarNo=='' || $email=='' || $name==''){
                    echo "<script>alert('Please fill all the details');</script>
                    <center><div id='not-registered' class='box'>
                    <h2>Try again</h2>
                    <a href='user.php' ><button class='btn'>Go back</button></a>
                    </div></center>";
                }
                else{
                    $conn = new mysqli('localhost','root','','registerassignment');
                    if ($conn->connect_error) {
                        echo "<center><div id='not-registered' class='box'>
                        <h2>No connection</h2>
                        <a href='user.php' ><button class='btn'>Go back</button></a>
                        </div></center>";
                    }
                    else{
                        //sql query insert the data into database
                        $sql = "INSERT INTO `userdata`(`ScholarNumber`, `userName`, `Email`, `regdDate`) VALUES ('$scholarNo','$name','$email','$date')";
                
                        if ($conn->query($sql) === TRUE) {
                            //if everything goes fine do this
                            echo "<script>alert('Congrats {$name}, you have been registered successfully. ');</script>
                            <center><div id='registered' class='box'>
                            <h2>Your credentials are:</h2>
                            <table>
                            <tr>
                            <td>Name: </td>
                            <td>{$name} </td>
                            </tr>
                            <tr>
                            <td>Scholar Number: </td>
                            <td>{$scholarNo} </td>
                            </tr>
                            <tr>    
                            <td>Email: </td>
                            <td>{$email} </td>
                            </tr>
                            </table>
                            <br><hr><br>
                            <a href='user.php'><button  class='btn'>Go back</button></a>
                            </div></center>";
                        } 
                        else 
                        {
                            //error message
                            echo "<center><div id='not-registered' class='box'>
                            <h2>Try again</h2>
                            <a href='user.php' ><button class='btn'>Go back</button></a>
                            </div></center>";
                        }
                    }   
            
                    $conn->close();
                }
    
            }
            else
            {
                //this renders the form
                echo "<center><div id='registeration' class='box'>
                <h2>User Registeration</h2>
                <hr><br><br>
                <form action='user.php' method='POST'>
                <input name='scholarNo' type='text' placeholder='Scholar Number'>
                <br><br>
                <input name='name' type='text' placeholder='Name'>
                <br><br>
                <input name='email' type='text' placeholder='Email id'>
                <br><br><br>
                <input type='submit' value='Register' class='btn'>
                </form>
                </div></center>";
            }
        ?>
    </div>
</body>
</html>

