<!--
    Student ID:LINYU80007
    Image source: All images are from Google Image Search
-->

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CE154</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Link Swipers CSS -->
    <link rel="stylesheet" href="css/swiper-bundle.min.css">
    <!-- Link iconfont CSS -->
    <link rel="stylesheet" href="font/iconfont.css">
    <!-- Link CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- jquery -->
    <script src="inc/jquery.js"></script>
</head>

<body>

<?php
    include('inc/lib.php');
    // Connect to the database
    connect();
    // Start the user session
    session_start();

    // Get the SESSION superglobal variable
    $userkey = $_SESSION['users'];

    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
?>

<!-- header-nav Start -->
<header style="position: relative;background-color: #ff0068;">
    <div class="container">
        <div class="flex">
            <!-- logo -->
            <div class="logo">
                <img src="images/logo.png" alt="logo">
            </div>

            <!-- mobile menu -->
            <div class="menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <!-- nav -->
            <nav>
                <ul class="flex">
                    <li>
                        <?php
                        if ( $page_name == "HOME") { echo "<em style='font-size:150%;'>";}
                        ?>
                        <a title="HOME" href="index.php">HOME</a>
                        <?php
                        if ( $page_name == "HOME") { echo "</em>";}
                        ?>
                    </li>
                    <li>
                        <?php if ( $page_name == "ABOUT") { echo "<em style='font-size:150%;'>";}?>
                        <a title="ABOUT" href="about.php">ABOUT</a>
                        <?php if ( $page_name == "ABOUT") { echo "</em>";}?>
                    </li>
                    <li>
                        <?php if ( $page_name == "STORE") { echo "<em style='font-size:150%;'>";}?>
                        <a title="STORE" href="store.php">STORE</a>
                        <?php if ( $page_name == "STORE") { echo "</em>";}?>
                    </li>
                    <li class="basket">
                        <!-- basket button -->
                        <a title="basket button" href="cart.php" target="_blank">
                            <span class="iconfont icon-gouwuche"></span>
                        </a>
                        <!-- login button -->
                        <a title="login button" href="javascript:;">
                            yl19022
                            <span class="iconfont icon-down" style="font-size: 15px;"></span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<!-- header-nav end -->

<script>
    $('.menu').on("click", function () {
        $(this).toggleClass('close')
        $('header nav').toggleClass('show')
    })
</script>

<!-- cart-area Start -->
<section class="cart-area">
    <div class="container">
        <div class="title">
            <h5>Your cart:<span> 2 </span>items</h5>
        </div>
        <!-- cart list -->
        <ul class="cart-list">

            <!-- head -->
            <li class="flex">
                <div class="img__info__box flex" style="justify-content: flex-start;">
                    <div class="imgbox" style="width: 70%;">
                        Item Information
                    </div>

                    <div class="info" style="width: 0;">
                    </div>
                </div>
                <div class="unit-price w15">
                    Unit Price
                </div>
                <div class="Qty">
                    Qty
                </div>
                <div class="text-center w15" style="color: #000;">
                    Subtotal
                </div>
                <div class="text-center w15">
                </div>
            </li>

            <li class="flex">
                <a href="details.php" class="img__info__box flex m-w100" target="_blank"
                   style="justify-content: flex-start;">
                    <div class="imgbox">
                        <img class="w100" src="https://upload.wikimedia.org/wikipedia/en/6/6e/Pink_Floyd_-_Division_Bell.jpg" alt="thumbnail">
                    </div>
                    <div class="info">
                        <h6>
                            Division Bell - Pink Floyd
                        </h6>
                    </div>
                </a>
                <div class="unit-price w15">
                    £35.00
                </div>
                <div class="Qty flex">
                    <span class="iconfont icon-reduce"></span>
                    <input class="num" data-price="35.00" type="text" name="qty" value="1">
                    <span class="iconfont icon-plus"></span>
                </div>
                <div class="Subtotal w15" data-price="358.00">
                    £35.00
                </div>
                <div class="text-center w15">
                    <a href="javascript:;">Remove</a>
                </div>
            </li>
            <li class="flex">
                <a href="details.php" class="img__info__box flex m-w100" target="_blank"
                   style="justify-content: flex-start;">
                    <div class="imgbox">
                        <img class="w100" src="https://upload.wikimedia.org/wikipedia/en/4/42/Beatles_-_Abbey_Road.jpg" alt="thumbnail">
                    </div>
                    <div class="info">
                        <h6>
                            Abbey Road - The Beatles
                        </h6>
                    </div>
                </a>
                <div class="unit-price w15">
                    £20.99
                </div>
                <div class="Qty flex">
                    <span class="iconfont icon-reduce"></span>
                    <input class="num" data-price="20.99" type="text" name="qty" value="1">
                    <span class="iconfont icon-plus"></span>
                </div>
                <div class="Subtotal w15" data-price="20.99">
                    £20.99
                </div>
                <div class="text-center w15">
                    <a href="javascript:;">Remove</a>
                </div>
            </li>

            <!-- Check out -->
            <li class="flex last">
                <div class="img__info__box flex" style="justify-content: flex-start;">Total:</div>
                <div class="unit-price w15"></div>
                <div class="Qty" style="width: 15%;"></div>
                <div class="total-price" style="width: 10%;">
                    <span id="total-price">£55.99</span>
                </div>
                <div class="text-center w15 flex text-uppercase Check_out" style="justify-content: center;">
                    Check out
                </div>
            </li>
        </ul>
    </div>
</section>
<!-- cart-area End -->
<script>
    $(function () {
        totalPrice()
    })

    // Total price
    function totalPrice() {
        var Total = 0
        $('.Subtotal.w15').each(function () {
            Total = Total + parseInt($(this).data('price'))
        })
        $('#total-price').text('£' + Total.toFixed(2))
    }

    // Increase decrease quantity
    $('.Qty .iconfont').on('click', function () {
        var n = $(this).siblings('input').val()
        var price = $(this).siblings('input').data('price')
        var $totalPrice = $(this).parent().siblings('.Subtotal')
        if ($(this).hasClass('icon-reduce')) {
            n > 1 ? n-- : 1
        }
        if ($(this).hasClass('icon-plus')) {
            n++
        }
        $(this).siblings('input').val(n)
        $totalPrice.text('£' + (price * n).toFixed(2))
        $totalPrice.data('price', (price * n).toFixed(2))

        totalPrice()
    })
    // Keyboard input to change the value
    $('.Qty input').on('change', function () {
        var n = $(this).val()
        var price = $(this).data('price')
        var $totalPrice = $(this).parent().siblings('.Subtotal')
        $totalPrice.text('£' + (price * n).toFixed(2))
        $totalPrice.data('price', (price * n).toFixed(2))

        totalPrice()
    })
</script>

<!-- footer Start -->
<footer>
    <div class="container flex">
        <div class="left">
            © 2021 All Right Reserved.
        </div>
        <div class="right">
            <div class="flex">
                <a href="" target="_blank">
                    <span class="iconfont icon-facebook"></span>
                </a>
                <a href="" target="_blank">
                    <span class="iconfont icon-tuite"></span>
                </a>
                <a href="" target="_blank">
                    <span class="iconfont icon-ins"></span>
                </a>
            </div>
        </div>
    </div>
</footer>
<!-- footer End -->

<!-- Swiper JS -->
<script src="inc/swiper-bundle.min.js"></script>
<!-- Initialize Swiper -->
<script>
    // testimonial-area
    var testimonial = new Swiper('.testimonial-area .swiper-container', {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        autoplay: true,
        pagination: {
            el: '.testimonial-area .swiper-pagination',
            clickable: true,
        }
    });
</script>
</body>
