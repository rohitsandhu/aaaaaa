<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SHOP</title>
    <link rel="icon" href="../styles/img/logoBotiga.png">
    <!-- Bootstrap core CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="../styles/css/styles.css">
</head>

<body class="">

<nav class="navbar navbar-expand-lg  navbar-light bg-light">
    <a href="../index.php" class="navbar-brand" style=" margin='10px'">
        <img src="../styles/img/logoBotiga.png" height="50" alt=""/>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav text-uppercase mr-auto">
            <li class="nav-item mr-auto">
                <a class="btn-light btn " style="color: #6f42c1" href=""> </a>
            </li>
            <li class="nav-item mr-auto">
                <a class="btn-light btn " href=""> </a>
            </li>
            <li class="nav-item mr-auto">
                <a class="btn-light btn " href=""> </a>
            </li>
            <li class="nav-item mr-auto">
                <a class="btn-light btn" href=""> </a>
            </li>
        </ul>
        <li class="nav-item dropdown ml-auto">
            <a class="btn-light btn" href="../index.php?logout=true"> Log Out </a>
        </li>
    </div>
</nav>

<div class="container-fluid shop-body">

    <div class="row">
        <div class="col-lg-2 my-4 bg-light m-3">
            <form class="mt-3">
                <h4 class="mb-4">Filters</h4>

                <div class="accordion" id="accordionExample1">
                    <div class="card">
                        <div class="card-header" id="headerCategoria">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Categories
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headerCategoria"
                             data-parent="#accordionExample1">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios1" id="exampleRadios111" value="option111" checked>
                                    <label class="form-check-label" for="exampleRadios111">
                                        All
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios1" id="exampleRadios222" value="option222">
                                    <label class="form-check-label" for="exampleRadios222">
                                        Shirt
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios1" id="exampleRadios333" value="option333">
                                    <label class="form-check-label" for="exampleRadios333">
                                        T-Shirt
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios1" id="exampleRadios444" value="option444">
                                    <label class="form-check-label" for="exampleRadios444">
                                        Jeans
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios1" id="exampleRadios555" value="option555">
                                    <label class="form-check-label" for="exampleRadios555">
                                        Jackets
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios1" id="exampleRadios666" value="option666">
                                    <label class="form-check-label" for="exampleRadios655">
                                        Sweaters
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--/////////////////////////////-->

                <div class="accordion" id="accordionExample2">
                    <div class="card">
                        <div class="card-header" id="headerTalla">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    Sizes
                                </button>
                            </h5>
                        </div>

                        <div id="collapseTwo" class="collapse show" aria-labelledby="headerTalla"
                             data-parent="#accordionExample2">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios2" id="exampleRadios11" value="option11" checked>
                                    <label class="form-check-label" for="exampleRadios11">
                                        All
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios2" id="exampleRadios22" value="option22">
                                    <label class="form-check-label" for="exampleRadios22">
                                        Shirt
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios2" id="exampleRadios333" value="option333">
                                    <label class="form-check-label" for="exampleRadios333">
                                        T-Shirt
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios2" id="exampleRadios44" value="option44">
                                    <label class="form-check-label" for="exampleRadios44">
                                        Jeans
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios2" id="exampleRadios55" value="option55">
                                    <label class="form-check-label" for="exampleRadios55">
                                        Jackets
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios2" id="exampleRadios66" value="option66">
                                    <label class="form-check-label" for="exampleRadios65">
                                        Sweaters
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--//////////////////////////////////-->

                <div class="accordion" id="accordionExample3">
                    <div class="card">
                        <div class="card-header" id="headerPreu">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#collapseTree" aria-expanded="true" aria-controls="collapseTree">
                                   Price
                                </button>
                            </h5>
                        </div>

                        <div id="collapseTree" class="collapse show" aria-labelledby="headerPreu"
                             data-parent="#accordionExample3">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios3" id="exampleRadios111" value="option111" checked>
                                    <label class="form-check-label" for="exampleRadios111">
                                        All
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios3" id="exampleRadios222" value="option222">
                                    <label class="form-check-label" for="exampleRadios222">
                                        Shirt
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios3" id="exampleRadios333" value="option333">
                                    <label class="form-check-label" for="exampleRadios333">
                                        T-Shirt
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios3" id="exampleRadios444" value="option444">
                                    <label class="form-check-label" for="exampleRadios444">
                                        Jeans
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios3" id="exampleRadios555" value="option555">
                                    <label class="form-check-label" for="exampleRadios555">
                                        Jackets
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios3" id="exampleRadios666" value="option666">
                                    <label class="form-check-label" for="exampleRadios655">
                                        Sweaters
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-9 mr-1">
            <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img class="d-block img-fluid" src="http://placehold.it/1500x350" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" src="http://placehold.it/1500x350" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" src="http://placehold.it/1500x350" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <div class="row">

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">Item One</a>
                            </h4>
                            <h5>$24.99</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam
                                aspernatur!</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">Item Two</a>
                            </h4>
                            <h5>$24.99</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam
                                aspernatur! Lorem ipsum dolor sit amet.</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">Item Three</a>
                            </h4>
                            <h5>$24.99</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam
                                aspernatur!</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">Item Four</a>
                            </h4>
                            <h5>$24.99</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam
                                aspernatur!</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">Item Five</a>
                            </h4>
                            <h5>$24.99</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam
                                aspernatur! Lorem ipsum dolor sit amet.</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">Item Six</a>
                            </h4>
                            <h5>$24.99</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam
                                aspernatur!</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; ShoppuShop</p>
    </div>
</footer>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>


</body>

</html>
