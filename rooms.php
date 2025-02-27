    <?php
    //get patameters

    $roomname = $_GET['roomname'];

    // Connacting to database

    include 'db_connect.php';

    //Execte sql to check whether room exists

    $sql ="SELECT * FROM `rooms` WHERE roomname = '$roomname'";

    $result = mysqli_query($conn, $sql);
    if($result)
    {
    //check if room exists
    if(mysqli_num_rows($result) ==0)
    {
    $massage="This room is dose not exist. try creating a new one ";
        
    echo '<script language="javascript">';
    echo 'alert("'.$massage.'");';  
    echo 'window.location="http://localhost:70/code";';
    echo '</script>';
    }
    }
    else
    {
    echo "Error : ". mysqli_error($conn); 
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/product.css" rel="stylesheet">
    <style>
    body {
    margin: 0 auto;
    max-width: 800px;
    padding: 0 20px;
    
    }

    .container {
    border: 2px solid #dedede;
    background-color: pink;
    border-radius: 5px;
    padding: 5px;
    margin:10px 0;
   
    }

    .darker {
    border-color: #ccc;
    background-color: #ddd;
    }

    .container::after {
    content: "";
    clear: both;
    display: table;
    }

    .container img {
    float: left;
    max-width: 60px;
    width: 100%;
    margin-right: 20px;
    border-radius: 50%;
    }

    .container img.right {
    float: right;
    margin-left: 20px;
    margin-right:0;
    }

    .time-right {
    float: right;
    color: black;
    }

    .time-left {
    float: left;
    color: #999;
    }
    .anyClass{
        height:450px;
        overflow-y:scroll;
     
    }
    </style>

    </head>
    <body>
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center link-body-emphasis text-decoration-none">
            
            <span class="fs-4">MyAnonymousChat.com</span>
        </a>

        <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="#">Home</a>
            <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="#">About</a>
            <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="#">Contact</a>
            
        </nav>
        </div>
    <h2>Chat Messages - <?php echo $roomname; ?></h2>

    <div class="container">
        <div class="anyClass" style="background-image: url('img/chatimg.jpg');
        background-repeat: no-repeat;
        background-size: cover;">
   
    </div>
    </div>

    <input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="Add message"><br>
    <button class="btn btn-default shadow border-1 border-black" name="submitmsg" id="submitmsg" >Send</button>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="text/javascript">
//check for new message 1 sec

setInterval(runFunction, 1000);
function runFunction()
{
    $.post("htcount.php", {room: '<?php echo $roomname  ?>'},
    function(data, status) {
        document.getElementsByClassName('anyClass')[0].innerHTML = data;
        }
    )
}

// Get the input field enter key
var input = document.getElementById("usermsg");

input.addEventListener("keypress", function(event) {

  if (event.key === "Enter") {
    
    event.preventDefault();

    document.getElementById("submitmsg").click();
  }
});

      //if user submit the form
    $("#submitmsg").click(function(){
        var clientmsg= $("#usermsg").val();
    $.post("postmsg.php", {text: clientmsg, room:'<?php echo $roomname  ?>' , ip:'<?php echo $_SERVER['REMOTE_ADDR']  ?>'},
    function(data, status) {
        document.getElementsByClassName('anyClass')[0].innerHTML = data;
    });
    $("#usermsg").val("");
    return false
    });
    </script>
    
    </body>


    </html>
    