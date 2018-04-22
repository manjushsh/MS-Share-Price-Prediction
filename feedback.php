<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Feedback page</title>


    <link rel="shortcut icon" href="img/icons/m.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="js/myscript.js"></script>

<style>

.container2{
	margin-top: 55px;
	padding-left: 10%;
	padding-right: 10%;
	font-size: 13px;
    font-style: Verdana, Tahoma, sans-serif;
    text-align:center;
}

h2 {
	margin-bottom: 20px;
	color: #616572;
	font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
	font-size: 26px;
}
input, textarea {
	padding: 10px;
	border: 1px solid #E5E5E5;
	width: 200px;
    color: #999999;	
    border-radius: 20px;	
}

textarea {
	height: 150px;
	max-width: 400px;
	line-height: 18px;
}

input:hover, textarea:hover,
input:focus, textarea:focus
input:active {
	border-color: 1px solid #C9C9C9;	
	outline: none;
}

.form label {
	margin-left: 10px;
	color: #999999;
}
.submit input {
	width: 100px; 
	height: 40px;
	background-color: #0d47a1; 
	color: #FFF;
	border-radius: 3px;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;		
}

</style>
</head>
<body>

<!-- Navbar start -->

    <div>
        <?php include("nav.html"); ?>
    </div>

<!-- End of Navbar -->

    <div class = "container2">
	
        <form class="form">
                <h2>Contact us</h2>
            <p class="name">
                <input type="text" name="name" id="name" placeholder="Enter your name" required />
            </p>
            
            <p class="email">
                <input type="text" name="email" id="email" placeholder="Enter your Email" required />
            </p>
                
            <p class="text">
                <textarea name="text" placeholder="Write something to us" /></textarea>
            </p>
            
            <p class="submit">
                <input type="submit" value="SEND" onClick="alert('Thanks for giving your opinion');" />
            </p>
        </form>
</div><br><br>
</body>
</html>