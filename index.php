<?php
  require('includes/db.php');
  include('includes/function.php');
  if(isset($_GET['page'])){
    $page=$_GET['page'];
  }
  else{
    $page=1;
  }
  $post_per_page=5;
  $result=((int)$page-1)*(int)$post_per_page;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Blog</title>
</head>
<body>
<?php include_once('includes/navbar.php'); ?>

<h2 class="py-3 text-center">Smart Data Systems and Applications Laboratory</h2>

<div class="container">
  <p>
  The Grand Challenge Fund (GCF) project aims to promote cutting-edge innovation in technology and data-driven decision-making for the development of sustainable urban communities in Pakistan, all the while ensuring that the innovation incorporates acceptability, inclusivity, equity, and transparency. It is this long-term vision that guides the project activities over the stipulated three-year duration.<br><br>
While Pakistan's urban problems are diverse and extensive, the three-year project activities have been designed to promote data-driven practices among relevant stakeholders by specifically focusing on six Verticals as pilot application domains. Each one of these Verticals are guided by intricately linked horizontal themes that have been designed to enable transdisciplinary activities as well as to ensure maximum engagement with relevant stakeholders for long-term impact. More importantly, the Horizontals serve the purpose of integrating the seemingly disparate vertical domains under one umbrella. They will not only allow investigations into the intricate linkages between the vertical domains but will also be enablers of collating insights from various domains into developing a broad framework of data-driven decision making for Pakistan’s urban ecosystem. It is these horizontal themes that guide the specific work packages described in the work plan.
  </p>
</div>

<!-- Blog Cards -->
<div class="container">
  <div class="col-12">
    <?php
      $postQuery="SELECT * FROM posts ORDER BY id LIMIT 4";
      $runPQ=mysqli_query($db,$postQuery);
      while($post=mysqli_fetch_assoc($runPQ)){
        ?>
        <div class="card-group">
          <div class="row py-5">
            <div class="col-md-3">
              <div class="card" style="width: 15rem;">
               <img class="card-img-top" src="https://media.istockphoto.com/photos/american-craftsman-house-picture-id178559422?k=20&m=178559422&s=612x612&w=0&h=EXdN4TKEqcnCfei4ynpbAT49hg8Nc--vvN6oEIThU_0=" alt="Card image cap">
                 <div class="card-body">
                  <h5 class="card-title"><?= $post['id'] ?><?= $post['title'] ?></h5>
                  <p class="card-text text-truncate" ><?= $post['content'] ?></p>
                  <a href="post.php?id=<?=$post['id']?>" style="text-decoration:none">Read more...</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
      }
    ?>
</div>
    </div>

<!-- Blogs List -->
    <div class="container m-auto mt-3 row">
        <div class="col-8">

        <?php 

        if(isset($_GET['search'])){
          $keyword=$_GET['search'];
          $postQuery="SELECT * FROM posts WHERE title LIKE '%$keyword%' ORDER BY id DESC LIMIT $result,$post_per_page";

        }
        else{
          $postQuery="SELECT * FROM posts ORDER BY id DESC LIMIT $result,$post_per_page";
        }
          $runPQ=mysqli_query($db,$postQuery);
          while($post=mysqli_fetch_assoc($runPQ)){
            ?>
          <a href="post.php?id=<?=$post['id']?>" style="text-decoration:none;color:black">
            <div class="card mb-3" style="max-width: 800px;">
            <div class="row g-0">
              <div class="col-md-5" style="background-image: url('https://images.moneycontrol.com/static-mcnews/2020/04/stock-in-the-news-770x433.jpg');background-size: cover">
                <!-- <img src="https://images.moneycontrol.com/static-mcnews/2020/04/stock-in-the-news-770x433.jpg" alt="..."> -->
              </div>
              <div class="col-md-7">
                <div class="card-body">
                  <h5 class="card-title"><?= $post['title'] ?></h5>
                  <p class="card-text text-truncate"><?= $post['content'] ?></p>
                  <p class="card-text"><small class="text-muted">Posted on <?= date('F jS,Y',strtotime($post['created_at']))?></small></p>
                </div>
              </div>
            </div>
          </a>
          </div>
            <?php
          }
        ?>
    </div>
    </div>

<!-- Search Bar -->
    <?php 

      if(isset($_GET['search'])){
        $keyword=$_GET['search'];
        $q="SELECT * FROM posts WHERE title LIKE '%$keyword%'";
      }
      else{
        $q="SELECT * FROM posts";
      }
      $r=mysqli_query($db,$q);
      $total_posts=mysqli_num_rows($r);
      $total_pages=ceil($total_posts/$post_per_page);
    ?>

<!-- Pagination -->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">

          <?php
            if($page>1){
              $switch="";
            }
            else{
              $switch="disabled";
            }

            if($page<$total_pages){
              $nswitch="";
            }
            else{
              $nswitch="disabled";
            }
          ?>

          <li class="page-item <?=$switch?>">
            <a class="page-link" href="?<?php if(isset($_GET['search'])){echo "search=$keyword&";}?>page=<?=$page-1?>" tabindex="-1" aria-disabled="true">Previous</a>
          </li>
          <?php
            for($opage=1;$opage<=$total_pages;$opage++){
              ?>
                <li class="page-item"><a class="page-link" href="?<?php if(isset($_GET['search'])){echo "search=$keyword&";}?>page=<?=$opage?>"><?=$opage?></a></li>
              <?php             
            }
          ?>
          <li class="page-item <?=$nswitch?>">
            <a class="page-link" href="?<?php if(isset($_GET['search'])){echo "search=$keyword&";}?>page=<?=$page+1?>">Next</a>
          </li>
        </ul>
      </nav>
      <?php include_once('includes/footer.php'); ?>
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>    
</body>
</html>