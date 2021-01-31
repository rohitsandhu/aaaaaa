<?php
session_start();

?>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />




    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="../styles/css/styles.css">
</head>

<body class="custom-body">

<nav class="navbar navbar-expand-lg  mb-2 navbar-light bg-light">
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

            </li>
            <li class="nav-item mr-auto">
                <a class="btn-light btn " style="color: #6f42c1" href="shopMen.php"> <strong> Men</strong></a>
            </li>
            <li class="nav-item mr-auto">
                <a class="btn-light btn " href="shopWomen.php"> Women</a>
            </li>
            <li class="nav-item mr-auto">
            </li>
        </ul>
        <?php if (isset($_SESSION['usuariLogged'])) : ?>

        <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item ml-auto">
                <a class="btn-light btn" href="paginaCarrito.php">Your Cart</a>
            </li>
            <li class="nav-item ml-auto">
                <a class="btn-light btn" href="../index.php?logout=true">Log Out</a>
            </li>
        </ul>

        <?php endif; ?>
    </div>
</nav>



<div class="container-fluid mt-2" style="min-height: 80vh">

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
                                    <input class="form-check-input" type="radio" name="radio1" id="categoria-all" value="all" checked>
                                    <label class="form-check-label" for="categoria-all">
                                        All
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio1" id="categoria-shirt" value="shirt">
                                    <label class="form-check-label" for="categoria-shirt">
                                        Shirt
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio1" id="categoria-tshirt" value="tshirt">
                                    <label class="form-check-label" for="categoria-tshirt">
                                        T-Shirt
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio1" id="categoria-jeans" value="jeans">
                                    <label class="form-check-label" for="categoria-jeans">
                                        Jeans
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio1" id="categoria-jackets" value="jackets">
                                    <label class="form-check-label" for="categoria-jackets">
                                        Jackets
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio1" id="categoria-sweaters" value="sweaters">
                                    <label class="form-check-label" for="categoria-sweaters">
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
                        <input type="hidden" name="sexe" id="sexe" value="home">
                        <div id="collapseTwo" class="collapse" aria-labelledby="headerTalla"
                             data-parent="#accordionExample2">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio2" id="size-all" value="all" checked>
                                    <label class="form-check-label" for="size-all">
                                        All
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio2" id="size-s" value="s">
                                    <label class="form-check-label" for="size-s">
                                        S
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio2" id="size-m" value="m">
                                    <label class="form-check-label" for="size-m">
                                        M
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio2" id="size-l" value="l">
                                    <label class="form-check-label" for="size-l">
                                        L
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio2" id="size-xl" value="xl">
                                    <label class="form-check-label" for="size-xl">
                                        XL
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio2" id="size-xxl" value="xxl">
                                    <label class="form-check-label" for="size-xxl">
                                        XXL
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio2" id="size-xxxl" value="xxxl">
                                    <label class="form-check-label" for="size-xxxl">
                                        XXXL
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
                        <div id="collapseTree" class="collapse" aria-labelledby="headerPreu"
                             data-parent="#accordionExample3">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio3" id="price-any" value="any" checked>
                                    <label class="form-check-label" for="price-any">
                                        Any
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio3" id="price-1" value="<1">
                                    <label class="form-check-label" for="price-1">
                                        < 1 €
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio3" id="price-10" value="between 1 and 10">
                                    <label class="form-check-label" for="price-10">
                                        1€ - 10 €
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio3" id="price-50" value="between 10 and 50">
                                    <label class="form-check-label" for="price-50">
                                        10€ - 50€
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio3" id="price-100" value="between 50 and 100">
                                    <label class="form-check-label" for="price-100">
                                        50€ - 100€
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio3" id="price-more100" value="> 100">
                                    <label class="form-check-label" for="price-more100">
                                         > 100€
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" d-flex justify-content-center my-2">
                    <a href="#" class="btn btn-light" onclick="getList()"><span>Filter</span></a>
                    <a href="#" onclick="resetAll()" class="btn btn-secondary btn-sm" style="padding-top: 10px">Reset</a>
                </div>



            </form>
        </div>

        <div class="col-lg-9 mr-1 mt-3">

            <div class="container-fluid mt-2" >

                <div class="row">

                    <div class="col-lg-2">
                    </div>

                    <div class="col-lg-10" style=" height: 40px">

                        <div  class="d-flex flex-row-reverse mt-2">
                            <div style="border: 1px solid grey; background-color: #f8f9fa" class="ml-1">
                                <div class="form-check form-check-inline"  onchange="getList()" style="margin-left: 10px">
                                    <input class="form-check-input" type="radio" name="ordenar" id="moreToLess" value="ASC" checked>
                                    <label class="form-check-label" for="moreToLess">Price less to more</label>
                                </div>
                                <div class="form-check form-check-inline" onchange="getList()">
                                    <input class="form-check-input" type="radio" name="ordenar" id="lessToMore" value="DESC">
                                    <label class="form-check-label" for="lessToMore">Price more to less</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="list_wrapper">

                <div id="placeholder" class="d-none ">
                    <div class="fa-5x d-flex justify-content-center mt-5">
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
                </div>

                <div class="row" id="list">

                </div>
            </div>
        </div>
    </div>
</div>


<footer class="py-5 bg-dark custom-footer">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" integrity="sha512-F5QTlBqZlvuBEs9LQPqc1iZv2UMxcVXezbHzomzS6Df4MZMClge/8+gXrKw2fl5ysdk4rWjR0vKS7NNkfymaBQ==" crossorigin="anonymous"></script>


<script>
    function getList() {
        let url = new URL("http://<?php echo $_SERVER["SERVER_NAME"]; ?>/botigaRoba/controller/itemController.php");
        url.searchParams.append("radio1", $('[name="radio1"]:checked').val());
        url.searchParams.append("radio2", $('[name="radio2"]:checked').val());
        url.searchParams.append("radio3", $('[name="radio3"]:checked').val());
        url.searchParams.append("ordenar", $('[name="ordenar"]:checked').val());
        url.searchParams.append("sexe", $('[name="sexe"]').val());

        let xd =document.querySelector('#placeholder');
        xd.classList.remove('d-none');
        let e = document.querySelector('#list')
        e.classList.add('d-none');

        fetch(url).then((response) => {return response.text()})
            .then(data => {
                e.classList.remove('d-none');
                e.innerHTML = data;

                xd.classList.add('d-none');
            });
    }
    function setAsSessionStorage() {
        let val1 = sessionStorage.getItem('radio1');
        let radios1 = $('[name="radio1"]');
        radios1.filter(`[value='${val1}']`).prop('checked', true);

        let val2 = sessionStorage.getItem('radio2');
        let radios2 = $('[name="radio2"]');
        radios2.filter(`[value='${val2}']`).prop('checked', true);

        let val3 = sessionStorage.getItem('radio3');
        let radios3 = $('[name="radio3"]');
        radios3.filter(`[value='${val3}']`).prop('checked', true);

        let val4 = sessionStorage.getItem('ordenar');
        let order = $('[name="ordenar"]');
        order.filter(`[value=${val4}]`).prop('checked', true);


    }


    $('[name="radio1"]').change(function (event) {
        console.log({event});
        sessionStorage.setItem('radio1', $('[name="radio1"]:checked').val());
    });
    $('[name="radio2"]').change(function (event) {
        console.log({event});
        sessionStorage.setItem('radio2', $('[name="radio2"]:checked').val());
    });
    $('[name="radio3"]').change(function (event) {
        console.log({event});
        sessionStorage.setItem('radio3', $('[name="radio3"]:checked').val());
    });
    $('[name="ordenar"]').change(function (event) {
        console.log({event});
        sessionStorage.setItem('ordenar', $('[name="ordenar"]:checked').val());
    });

    function resetAll() {
        sessionStorage.clear();

        let radios1 = $('[name="radio1"]');
        radios1.filter(`[value='all']`).prop('checked', true);

        let radios2 = $('[name="radio2"]');
        radios2.filter(`[value='all']`).prop('checked', true);

        let radios3 = $('[name="radio3"]');
        radios3.filter(`[value='any']`).prop('checked', true);

        let order = $('[name="ordenar"]');
        order.filter(`[value='ASC']`).prop('checked', true);

        getList();
    }

    setAsSessionStorage();
    resetAll();


</script>

</body>


</html>
