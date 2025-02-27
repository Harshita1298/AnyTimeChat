    <?php
    //Geting the valuse of post parameter
    $room = $_POST['room'];

    // checking for sting size
    if(strlen($room)>20 or strlen($room)<2)
    {
        $massage="Please choose a name between 2 to 20 characters";
        
    echo '<script language="javascript">';
    echo 'alert("'.$massage.'");';  
    echo 'window.location="http://localhost:70/code";';
    echo '</script>';


    }
    //checking whether room name is alphanumeic 
    else if(!ctype_alnum($room))
    {
        $massage="Please choose an aphanumeric room name";
        
        echo '<script language="javascript">';
        echo 'alert("'.$massage.'");';  
        echo 'window.location="http://localhost:70/code";';
        echo '</script>';
    
    }

    else{
        //connect to database
        include 'db_connect.php';
    }

    // check if room alrdy exists

    $sql ="SELECT * FROM `rooms` WHERE roomname ='$room'";
    $result =mysqli_query($conn, $sql);
    if($result)
    {
    if(mysqli_num_rows($result) > 0)
    {
        
        $massage="Please choose a different room name. this is already claimed ";
        
    echo '<script language="javascript">';
    echo 'alert("'.$massage.'");';  
    echo 'window.location="http://localhost:70/code";';
    echo '</script>';
    }
    else{
        $sql ="INSERT INTO `rooms` ( `roomname`, `stime`) VALUES ('$room', CURRENT_TIMESTAMP);";
        if(mysqli_query($conn, $sql))
        {
        $massage="Your room is ready and you can chat now! ";
        
        echo '<script language="javascript">';
        echo 'alert("'.$massage.'");';  
        echo 'window.location="http://localhost:70/code/rooms.php?roomname=' . $room . '";';
        echo '</script>';
        }
    }
    }
    else{
        echo"Error: ". mysqli_error($conn);
    }
    ?>