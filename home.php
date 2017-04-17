<?php
include'logged.php';

if(isset($_SESSION['login_user'])){

  $status = 1;
}
else{
  $status = 0;
}

?>
<html>
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="main.css" type="text/css">
  <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>

<body id="page-top" class="index">
  <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container ">

      <div class="navbar-header">
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#page-top">ShoppingMart</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     <form class="navbar-form navbar-left form-inline" enctype="multipart/form-data" >
       <div class="form-group">
         <input type="text" id="query" name="q" class="form-control form-in" placeholder="Search..."/>
         <a type="button" class="btn btn-search btn-out" id="search"><span class="glyphicon glyphicon-search"></span></a>
       </div>
     </form>
     <ul class="nav navbar-nav navbar-right">
      <?php
      include'database.php';


      if($status == '0'){
        echo '
        <li>
          <a href="#login" data-toggle="modal" data-target="#myModal"> Login </a>
        </li>
        <li>
          <a href="#sign-up" data-toggle="modal" data-target="#myModal1"> Sign-UP </a>
        </li>';
      }

      else{
        echo '
        <li>
          <a href="#cart" data-toggle="modal" data-target="#myModal5"> <i class="fa fa-shopping-cart nav-icon" aria-hidden="true"></i> Cart </a>
        </li>
        <li>
          <a href="Sign-Out.php" > <i class="fa fa-sign-out nav-icon" aria-hidden="true"></i> Sign-Out </a>
        </li>';
      }
      ?>
    </ul>

  </div>
</div>
</nav>

<!-- Modal login -->
<div align="center" class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modal-my">
      <div class="modal-header modal-head">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" align="center">Login</h4>
      </div>

      <div class="modal-body">
        <form method="post" action="">
          <div class="form-group">
            <label for="usrnm" class="ui-hidden-accessible">Username</label>
            <input type="text" class="form-control form-input" name="uname" id="usrnm" placeholder="Username" required/>
          </div>
          <div class="form-group">
            <label for="pswd" class="ui-hidden-accessible">Password</label>
            <input type="password" class="form-control form-input" name="password" id="pswd" placeholder="Password" required/>
          </div>
          <input type="hidden" name="pageno" value="home" />
          <div class="form-group">
            <button type="submit" name="submit" class="btn button mar" align="center"><b><span> SIGN IN </span></b></button>
          </div>
        </form>
      </div>

      <div class="modal-footer modal-foot">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal cart -->
<div align="center" class="modal fade" id="myModal5" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modal-my">
      <div class="modal-header modal-head">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" align="center">Cart</h4>
      </div>

      <div class="modal-body">

        <?php
        include 'database.php';

        if(isset($_SESSION['login_user'])){
          $id = $_SESSION['uid'];
        }

        $user_id=$id;

        $sql = ("SELECT name,brand,price,image,img_name,item_id FROM cart WHERE user_id='$user_id'");

        $result = mysqli_query($conn,$sql);

        while($row = mysqli_fetch_array($result)){
          $name = $row['name'];
          $brand = $row['brand'];
          $price = $row['price'];
          $image = $row['image'];
          $item_id=$row['item_id'];
          $img_name = $row['img_name'];


          echo"<div class='row'>
          <div class='item_cart'>
            <img align='left' class='img-responsive img-itm_cart' src='$image$img_name' alt=''>
            <p class='citem'>$name</p>
            <p class='h5b'>$brand</p>
            <p class='h5c'><b>Rs. $price</b></p>
            <p style=\"float: right;\" class='h5c'>
              <a href=\"remove_cart.php?item_id={$row['item_id']}\" align='right' type='button' class='btn btn-danger btn-xs'>Remove</a>
            </p><hr />
          </div>
        </div>";
      }

      mysqli_close($conn);
      ?>
      <br/>
      <button type="button" class="btn button mar" ><b><span> CONTINUE </span></b></button>
    </div>
    <div class="modal-footer modal-foot">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
    </div>

  </div>
</div>
</div>



<!-- Modal signup -->
<div align="center" class="modal fade" id="myModal1" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modal-my">
      <div class="modal-header modal-head">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" align="center">Register</h4>
      </div>

      <div class="modal-body">
        <form method="post" action="Register.php">
          <div class="form-group">
            <label for="usrnm" class="ui-hidden-accessible">Username</label>
            <input type="text" class="form-control form-input" name="uname" id="usrnm" placeholder="Username" maxlength="15" required/>
          </div>
          <div class="form-group">
            <label for="emails" class="ui-hidden-accessible">E-Mail</label>
            <input type="text" class="form-control form-input" name="email" id="emails" placeholder="E-Mail" maxlength="40" required/>
          </div>
          <div class="form-group">
            <label for="pswd" class="ui-hidden-accessible">Password</label>
            <input type="password" class="form-control form-input" name="password" id="pswd" placeholder="Password (At Least 6 Characters)" maxlength="15"  minlength="6" required/>
          </div>
          <div class="form-group">
            <label for="masg" class="ui-hidden-accessible">Address</label>
            <textarea class="form-control form-input" rows="4" name="address" id="adrs" placeholder="Address" maxlength="490" required/></textarea>
          </div>
          <div class="form-group">
            <button type="submit" class="btn button mar" align="center"><b><span> REGISTER </span></b></button>
          </div>
        </form>
      </div>

      <div class="modal-footer modal-foot">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal contact -->
<div align="center" class="modal fade" id="myModal2" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modal-my">
      <div class="modal-header modal-head">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" align="center">Contact</h4>
      </div>

      <div class="modal-body">
        <form method="post" action="contact.php">
          <div class="form-group">
            <label for="nm" class="ui-hidden-accessible">Name</label>
            <input type="text" class="form-control form-input" name="name" id="nm" placeholder="Name" maxlength="15" required/>
          </div>
          <div class="form-group">
            <label for="emails" class="ui-hidden-accessible">E-Mail</label>
            <input type="text" class="form-control form-input" name="email" id="emails" placeholder="E-Mail" maxlength="40" required/>
          </div>
          <div class="form-group">
            <label for="masg" class="ui-hidden-accessible">Massage</label>
            <textarea class="form-control form-input" rows="4" name="massage" id="masg" placeholder="Massage" maxlength="490" required/></textarea>
          </div>
          <div class="form-group">
            <button type="submit" class="btn button mar" align="center"><b><span> SEND </span></b></button>
          </div>
        </form>
      </div>

      <div class="modal-footer modal-foot">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>





<div id = "searchResult" class="row">
</div>

<section id="category">
  <br/>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2> Category </h2>
        <br>
      </div>
    </div>
    <div class="row">

      <?php
      include 'database.php';

      $sql = ("SELECT * FROM category");

      $result = mysqli_query($conn,$sql);

      while($row = mysqli_fetch_array($result)){
        $title = $row['title'];
        $image = $row['image'];
        $img_name = $row['img_name'];
        $id = $row['category_id'];


        echo"<div class='col-sm-4 portfolio-item'>
        <a href=\"sub-category.php?id={$row['category_id']}\" class='portfolio-link'>
          <img class='img-responsive img-br' src=\"$image$img_name\" alt=''>
          <h3 align='center'>$title</h3>
        </a>
      </div>";
    }
    mysqli_close($conn);
    ?>

  </div>
</div>
</section>


<br/>
<br/>
<br/>

<div id="footing">
  <footer class="text-center" id="contact">
  <div class="footer-above">
    <div class="container">
      <div class="row">
        <div class="footer-col col-md-4">
          <h3 style="color: #00b3fe">Location</h3>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3720.62417787462!2d72.78291311493487!3d21.167349585923454!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04dede93ea7d1%3A0x238a612304b01088!2sSardar+Vallabhbhai+National+Institute+of+Technology!5e0!3m2!1sen!2s!4v1492402288774" width="150px" height="150ox" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
          <div class="footer-col col-md-4">
            <h3>Social</h3>
            <ul class="list-inline">
              <li>
                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
              </li>
              <li>
                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
              </li>
              <li>
                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
              </li>
              <li>
                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
              </li>
            </ul>
          </div>
          <div class="footer-col col-md-4">
            <h3 style="color: #00b3fe">About</h3>
            <p>ShoppingMart is a E-Commercial <br> Web-Site <a href="#contact" data-toggle="modal" data-target="#myModal2"> Contact Us </a></p>

          </div>
        </div>
      </div>
    </div>
    <div class="footer-below">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
           <p class="small">Developed By </p><h4 style="color: #00b3fe">Ram Narayan Singh</h4>
         </div>
       </div>
     </div>
   </div>
 </footer>
</div>


 <script type="text/javascript" src="js/script.js"></script>
</body>
</html>
