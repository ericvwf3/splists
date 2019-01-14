<?php 
    require_once('../controllers/boardController.php');
    $_SESSION['page'] = 'board';
?>


<?php include('../partials/_header.php'); ?>
<?php include('../partials/_form_list.php'); ?>

<!-- CONTENU DE index.php, board.php, login.php, signup.php -->
<div class="container-fluid mt-2">
    <div class="row">

        <!-- SIDEBAR : Listes des listes -->
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">

                    <?php
                    
                    foreach($lists as $l) {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="/splists/views/board.php?list=<?= $l['id']; ?>">
                                    <span data-feather="home"></span>
                                    <?= $l['title']; ?> <span class="sr-only">(current)</span>
                                </a>
                            </li>
                        <?php
                    }
                    
                    ?>

                    <li><hr></li>

                    <li class="ml-2">
                        <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#formList" >Nouvelle liste</button>
                    </li>



                </ul>
            </div>
        </nav>

        <!-- MAIN CONTENT : Tickets appartenants à une liste -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

        <?php            

            if(isset($_GET['list']) && intval($_GET['list'] > 0) ){  
                //Cas où j'ai un ID de liste

                $liste = getList( $_GET['list']);
                
                $tasks = getTasks( $_GET['list']);

                ?>
        
                <h1>
                    <?= $liste['title'];?>
                </h1>

                    <div class="accordion" id="accordionExample">

                        <?php
                            foreach($tasks as $t) {
                                ?>
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?= $t['id'];?>"
                                                aria-expanded="true" aria-controls="collapse<?= $t['id'];?>">
                                                <?= $t['title'];?>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse<?= $t['id'];?>" class="collapse show" aria-labelledby="heading<?= $t['id'];?>" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <?= $t['description'];?>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        ?>

                    </div>
                </main>

                <?php
            }
            else {
                //Cas où je n'ai pas d'ID de liste
                ?>
                <h1>Bienvenue sur votre board</h1>
                <?php
            }
        ?>

        
    </div>
</div>

<?php include('../partials/_footer.php'); ?>