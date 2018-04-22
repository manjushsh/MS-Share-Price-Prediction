<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock Predictor by MS</title>

    <link rel="shortcut icon" href="img/icons/m.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/style1.css">
    <script src="js/myscript.js"></script>

</head>
<body>

<!-- Navbar start -->

    <div>
        <?php include("nav.html"); ?>
    </div>

<!-- End of Navbar -->


<script>
function getRan() {
    return Math.random();
}
</script>


<!-- Main Body -->

        <div class="container">
            <div class="liveStockGrapher" id="liveStockGrapher">
                
                <div>
                    <label for="dummyText" class"stock_headding">Select one: &nbsp;&nbsp; </label>
                    <form method="POST">
                        <?php include('choice.html'); ?>
                        <input type="submit" value="check" class="check" name="check">
                    </form>

                    <?php
                        if(isset($_POST['check'])){
                            $ch = $_POST['share'];
                            $temp = exec("python index2.py " . $ch);
                        }
                    ?>

                    <FORM action="action.php">
                        <input type="submit" class="refresh1" value="">
                    </FORM>
                </div>

                <div class="imgContainer">
                
                    <br><img id="plot" src="img/plots/plot.png" alt="live-stock">
                
                </div>
                
            </div><br><br>


            <div class="phsC" name="productHoriScroll_Container"><br>

                <label for="category_title" class="cat_label">Predictions</label><br>
            
                <div class="proC" name="productContainer">
                <pre><span style="float:right"><label for="">Apple</label></span></pre><br>
                    <img id="AAPLPred"><br><br>
                    <script>
                        document.getElementById('AAPLPred').src = "img/plots/AAPL.png?r="+getRan();
                    </script>
                </div>

                <div class="proC">
                <pre><span style="float:right"><label for="">Amazon</label></span></pre><br>
                    <img id="AMZNPred"><br><br>
                    <script>
                        document.getElementById('AMZNPred').src = "img/plots/AMZN.png?r="+getRan();
                    </script>
                </div>

                <div class="seperator"></div>

                <div class="proC">
                <pre><span style="float:right"><label for="">Google</label></span></pre><br>
                    <img id="GOOGPred"><br><br>
                    <script>
                        document.getElementById('GOOGPred').src = "img/plots/GOOG.png?r="+getRan();
                    </script>
                </div>

                <div class="proC">
                <pre><span style="float:right"><label for="">Microsoft</label></span></pre><br>
                    <img id="MSFTPred"><br><br>
                    <script>
                        document.getElementById('MSFTPred').src = "img/plots/MSFT.png?r="+getRan();
                    </script>
                </div>
                <div class="proC extra2"> <!-- This div is only visible on desktop.   -->
                <pre><span style="float:right"><label for="">NVIDIA</label></span></pre><br>
                    <img id="NVDAPred"><br><br>
                    <script>
                        document.getElementById('NVDAPred').src = "img/plots/NVDA.png?r="+getRan();
                    </script>
                </div><br><br>

            </div>

        </div><br><br>

            <div class="row">
            
                <div class="col-md-6">
                    <div class="interactiveMS " style="width:100%;height:auto;overflow:hidden;">
                        <?php include("plot.html"); ?>
                    </div>
                </div><br><br>

                <div class="col-md-6" style="overflow:hidden;">
                    <div class="interactiveMS" style="width:100%;height:auto;overflow:hidden;">
                        <?php include("plot2.html"); ?>
                    </div>
                </div>
            
            </div>

            <div class="pe phsC news-div" >

                <label for="category_title" class="cat_label petitle">P/E ratio variations:</label><br>
                <img id="pe1" src="" style="width:50%;height:auto;">

            </div><br><br>
            
            <div class="news-div phsC">
                <div class="cat_label" style="padding-top:12px;padding-bottom:8px;padding-left:10px;">Top News <br></div>
                <?php include("news.html"); ?>
            </div><br>

            
            <script>
            
            var x = parseInt(<?php echo $ch  ?>); // passing choice to x for stock selection.
            var stk;
            switch(x)
            {
                case 1: stk = "AAPL";
                break;
                case 2: stk = "AMZN";
                break;
                case 3: stk = "GOOG";
                break;
                case 4: stk = "MSFT";
                break;
                case 5: stk = "NVDA";
                break;
            }
            document.getElementById("pe1").src = "https://www.nasdaq.com//charts/"+stk+"_per.jpeg?r="+getRan();
            
            </script>
        
           

    <!-- Main body Ends --> <br><br>

    <!-- Footer -->

        <footer class="foot1 footer-fixed-bottom">
        
            &copy; 2018+ | All rights reserved to MS.
        
        </footer>

    <!-- End of footer -->


       <!-- Sometimes,due to cache,image wasn't replaced as per user choice. So I added timestamp.(GOOGLE) -->
<script language="javascript" type="text/javascript">

var d = new Date(); 
document.getElementById("plot").src = "img/plots/plot.png?ver=" + d.getMilliseconds();

</script>   

</body>
</html>