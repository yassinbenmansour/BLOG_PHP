<?php
    require('./includes/header.php');
?>

<div class="container ">
  <div class="row g-2 mb-3">
    <div class="col-lg-8 col-md-12 col-sm-12 border mt-5 rounded shadow">
      <div class="p-3">
            <div class="row ">

            <?php

                $start = 0 ;
                $limit = 4 ;
                $page = isset($_GET['post']) ? $_GET['post'] : 1 ;
                $start = ($page * 4 ) - 4 ; //mnin ray recuupere article 

                $sql = "SELECT * FROM articles ORDER BY created DESC limit $start,$limit ";
                $output = mysqli_query($con,$sql);

                while($articles = $output->fetch_assoc()):
            ?>

            <?php
            $categorie = affCategorie($con,$articles['category_id']);
            ?>
                    <div class="col-4 mt-2 ">
                        <img
                        src="https://cdn.pixabay.com/photo/2015/05/31/15/07/coffee-792113_1280.jpg"
                        class="img-fluid rounded"
                        alt="Hollywood Sign on The Hill"
                        />
                    </div>
                    <div class="col-8  ">
                        <h1 class=""><?php echo $articles['title']?></h1>
                        <span class="badge rounded-pill badge-success "><?php echo $categorie["name"]  ?></span>
                        <span class="badge rounded-pill text-primary"><?php echo $articles['created']?></span>
                        <p><?php echo $articles['body']?></p>        
                        <p class="badge badge-primary">Created by : <?php echo $articles['author']?></p> 
                        <a href="viewPost.php?id=<?php echo $articles['id']?>" class="float-end btn btn-primary">Read more</a>
                    </div>
                    
                    <?php
                endwhile;
            ?>
            </div>


            <div class="col-md-4">
                <?php 

                $query = " SELECT count(id) FROM articles " ;
                $output = mysqli_query($con,$query);
                $articles = $output->fetch_row();

                $totalArticles = $articles[0] ; // total dyal les articles

                $totalpost = ceil($totalArticles / $limit); // les pages

                ?>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-12 col-sm-12 mt-5">
            
                <ul class="list-group">
                    <li class="list-group-item bg-primary text-white ">Catégories</li>
                    <?php
                        $sql = "SELECT * FROM categories";
                        $result = mysqli_query($con,$sql);
                        while($categorie = $result->fetch_assoc()):
                    ?>
                    <li class="list-group-item text-dark bg-light border border-primary p-2">
                        <a href="categoriePost.php?id=<?php echo $categorie['id']?>">
                        <?php echo $categorie['name']?></li>
                    </a>
               
                <?php
                endwhile;
            ?>
             </ul>
        <ul class="list-group mt-3">
            <li class="list-group-item bg-primary text-white">Derniers articles</li>

            <?php

                $sql = "SELECT * FROM articles ORDER BY created DESC LIMIT 3";
                $output = mysqli_query($con,$sql);

                while($articles = $output->fetch_assoc()):
            ?>
            <li class="list-group-item bg-light border border-primary p-2">
                <div class="row">
                    <div class="col-4">
                        <img
                            src="https://cdn.pixabay.com/photo/2015/05/31/15/07/coffee-792113_1280.jpg"
                            class="img-fluid rounded"
                            alt="Hollywood Sign on The Hill"
                        />                    
                    </div>
                    <div class="col-8">
                        <h4><a href="viewPost.php?id=<?php echo $articles['id']?>"><?php echo $articles['title']?></a></h4>
                        <p><?php echo $articles['body']?></p>
                    </div>
                </div>
            </li>
            <?php
                endwhile;
            ?>
        </ul>
    

    </div>


    </div>
</div>

<?php
require('./includes/footer.php');
?>