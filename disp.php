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
        padding:15px;
        border-radius:5px 5px 5px 5px;
        margin-top:20vh;
    }
    #container{
        background:khaki;
    }
    #container td{
        border:2px solid black;
        padding:4px;
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
    #err{
    background:#ff2828;
    width:200px;
    }
    </style>

</head>

<body style="background-color:#100f0f;">


<!-- the naviagtion bar -->

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


<!-- the user details container starts here -->

    <div id="container">
        <?php 

            // making connection with mysql
            $conn = new mysqli('localhost','root','','registerassignment');
            if ($conn->connect_error) {
                echo "<center><div id='not-registered' class='box'>
                <h2>No connection</h2>
                <a href='user.php' ><button class='btn'>Go back</button></a>
                </div></center>";
            }
            else{

                    //inserting the required quert to get data from database.
                    $m=mysqli_query($conn,"SELECT ScholarNumber, userName, Email, regdDate from userdata");

                    //code to display the data
                    if($m)
                    {
                        echo "<div id='conatiner' class='box'>";
                        echo "<center><table>" ; 
                        echo "<tr style='font-weight:bold;'>
                        <td>Scholar Number</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Registeration time</td>
                        </tr>";
                        while($x=mysqli_fetch_assoc($m))
                        {
                            echo "<tr>
                            <td>{$x['ScholarNumber']}</td>
                            <td>{$x['userName']}</td>
                            <td>{$x['Email']}</td>
                            <td>{$x['regdDate']}</td>
                            </tr>";
                        }
                    echo "</table></center>";
                    echo "</div>";
                    }
                    else
                    {
                        //code if any error occured
                        echo "<center><div id='err' class='box'>
                        <h2>No connection</h2>
                        <a href='user.php' ><button class='btn'>Go back</button></a>
                        </div></center>";
                    }

                    $conn->close();

                }
        ?>
    </div>

</body>
</html>

