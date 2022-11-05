<!Doctype html>
<html lang="en">

<head>
    <title>Homepage</title>
    <meta charset="utf-8" name="viewport" content="width=device-width , initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
	<div class="container-fluid p-0">
	<!-- menu start -->
		
        <nav class="navbar navbar-expand-lg navbar-light homeNav">
            <div class="container navContainer">
               
				<a class="navbar-brand" href="#">Icecream</a>
				 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
					<i class="fa fa-bars" aria-hidden="true"></i>
				  </button>
				<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav ml-auto">
				  <div class="topNav">
					  <div class="search_box">
						<form class="search-form" role="search">
							<div class="form-group pull-right inside_search" id="search">
							  <input type="text" class="form-control search custom_formControl" placeholder="Search">
							  <button type="submit" class="form-control custom_formControl form-control-submit search_submit">Submit</button>
							  <span class="search-label"><i class="fa fa-search" aria-hidden="true"></i></span>
							</div>
						</form>
					  </div>
					  <a href="#" class="user_icon"><i class="far fa fa-user" aria-hidden="true"></i></a>
					  <a href="#" class="user_icon"><i class="fal fa fa-heart"></i></a>
				  </div>
				  <li class="nav-item">
					<a class="nav-link" href="#">About Us</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" href="#">Contact Us</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" href="#">Shop</a>
				  </li>
				   @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
				</ul>
				</div>
				<div class="black-ribbon">
					<a href="#">
						<span class="cartBl_content">
							<span class="bucket" style="background-image: url(public/public/images/cart-icon.png);"></span>
							<span class="number">0</span>
						</span>
				
						<span class="bucket-bottom"></span>
					</a>
				</div>
            </div> 
        </nav>

		<div id="banner" class="carousel slide" data-ride="carousel">

            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="bannerImg" src="public/images/banner.jpg" alt="Los Angeles" width="1100" height="500">
                </div>
               <!--  <div class="carousel-item">
                    <img class="bannerImg" src="public/images/black-barre.jpg" alt="Chicago" width="1100" height="500">
                </div>
                <div class="carousel-item">
                    <img class="bannerImg" src="public/images/vigilant-wine-cellar-kirley02.jpg" alt="New York" width="1100" height="500">
                </div> -->
            </div>

            <!-- Left and right controls -->
            <!-- <a class="carousel-control-prev" href="#banner" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#banner" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a> -->
        </div>
    </div>
	<div class="container">
		<div class="row">
			<p class="clothes_quotation">Your clothes describes you.</p>
			<img src="public/images/lines.png" class="img-fluid lines">
			<!-- <div class="col-12">
				<ul class="row category">
					<li class="col-6 col-md-3">
						<a href="#">
							<div class="imgBox">
								<img src="public/images/jacket.png" class="img-fluid" alt="jacket" width="69%;">
							</div>
							<p>Mens</p>
							
						</a>
					</li>
					<li class="col-6 col-md-3">
						<a href="#">
							<p class="d-md-block d-none">womens</p>
							<div class="imgBox">
								<img src="public/images/womens.png" class="img-fluid" alt="jacket" width="56%;">	
							</div>
							<p class="d-md-none d-block">womens</p>
							</a>
					</li>
					<li class="col-6 col-md-3">
						<a href="#">		
							<div class="imgBox">
								<img src="public/images/AF-10110-800x1200.png" class="img-fluid" alt="jacket" width="64%;">
							</div>
							<p>Kids</p>
						</a>
					</li>
					<li class="col-6 col-md-3">
						<a href="#">
							<p class="d-md-block d-none">plus size</p>
							<div class="imgBox">
								<img src="public/images/ab.png" class="img-fluid" alt="jacket" width="67%;">
							</div>
							<p class="d-md-none d-block">plus size</p>
						</a>
					</li>
				</ul>
			</div> -->
			
			<p class="PageSubtitle"><span>Featured Items</span></p>
			
			<div class="col-12">
				<div class="row">
					<div class="col-6 col-md-3 pro_Column">
						<div class="product_div">
							<div class="img_block">
								<img src="public/images/wineDress.png" class="img-fluid" alt="pro">
							</div>
							<div class="pro_info">
								<p class="pro_name">Wine Dress<span>$20.00</span></p>
								<p class="pro_category">Dresses</p>
									<!-- Rating Stars Box -->
									  <div class='rating-stars'>
										<ul id='stars'>
										  <li class='star' title='Poor' data-value='1'>
											<i class='fa fa-star fa-fw'></i>
										  </li>
										  <li class='star' title='Fair' data-value='2'>
											<i class='fa fa-star fa-fw'></i>
										  </li>
										  <li class='star' title='Good' data-value='3'>
											<i class='fa fa-star fa-fw'></i>
										  </li>
										  <li class='star' title='Excellent' data-value='4'>
											<i class='fa fa-star fa-fw'></i>
										  </li>
										  <li class='star' title='WOW!!!' data-value='5'>
											<i class='fa fa-star fa-fw'></i>
										  </li>
										</ul>
										<a href="#"><i class="far fa fa-shopping-cart"></i></a>
									  </div>
									
							</div>
						</div>
					</div>
					
					<div class="col-6 col-md-3 pro_Column">
						<div class="product_div">
							<div class="img_block">
								<img src="public/images/pinkTop.png" class="img-fluid" alt="pro">
							</div>
							<div class="pro_info">
								<p class="pro_name">Wine Dress<span>$20.00</span></p>
								<p class="pro_category">Dresses</p>
									<!-- Rating Stars Box -->
									  <div class='rating-stars'>
										<ul id='stars'>
										  <li class='star' title='Poor' data-value='1'>
											<i class='fa fa-star fa-fw'></i>
										  </li>
										  <li class='star' title='Fair' data-value='2'>
											<i class='fa fa-star fa-fw'></i>
										  </li>
										  <li class='star' title='Good' data-value='3'>
											<i class='fa fa-star fa-fw'></i>
										  </li>
										  <li class='star' title='Excellent' data-value='4'>
											<i class='fa fa-star fa-fw'></i>
										  </li>
										  <li class='star' title='WOW!!!' data-value='5'>
											<i class='fa fa-star fa-fw'></i>
										  </li>
										</ul>
									<a href="#"><i class="far fa fa-shopping-cart"></i></a>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-6 col-md-3 pro_Column">
						<div class="product_div">
							<div class="img_block">
								<img src="public/images/123.png" class="img-fluid" alt="pro">
							</div>
							<div class="pro_info">
								<p class="pro_name">Wine Dress<span>$20.00</span></p>
								<p class="pro_category">Dresses</p>
									<!-- Rating Stars Box -->
									  <div class='rating-stars'>
										<ul id='stars'>
										  <li class='star' title='Poor' data-value='1'>
											<i class='fa fa-star fa-fw'></i>
										  </li>
										  <li class='star' title='Fair' data-value='2'>
											<i class='fa fa-star fa-fw'></i>
										  </li>
										  <li class='star' title='Good' data-value='3'>
											<i class='fa fa-star fa-fw'></i>
										  </li>
										  <li class='star' title='Excellent' data-value='4'>
											<i class='fa fa-star fa-fw'></i>
										  </li>
										  <li class='star' title='WOW!!!' data-value='5'>
											<i class='fa fa-star fa-fw'></i>
										  </li>
										</ul>
									<a href="#"><i class="far fa fa-shopping-cart"></i></a>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-6 col-md-3 pro_Column">
						<div class="product_div">
							<div class="img_block">
								<img src="public/images/abc.png" class="img-fluid" alt="pro">
							</div>
							<div class="pro_info">
								<p class="pro_name">Wine Dress<span>$20.00</span></p>
								<p class="pro_category">Dresses</p>
									 <!-- Rating Stars Box -->
									  <div class='rating-stars'>
										<ul id='stars'>
										  <li class='star' title='Poor' data-value='1'>
											<i class='fa fa-star fa-fw'></i>
										  </li>
										  <li class='star' title='Fair' data-value='2'>
											<i class='fa fa-star fa-fw'></i>
										  </li>
										  <li class='star' title='Good' data-value='3'>
											<i class='fa fa-star fa-fw'></i>
										  </li>
										  <li class='star' title='Excellent' data-value='4'>
											<i class='fa fa-star fa-fw'></i>
										  </li>
										  <li class='star' title='WOW!!!' data-value='5'>
											<i class='fa fa-star fa-fw'></i>
										  </li>
										</ul>
									<a href="#"><i class="far fa fa-shopping-cart"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<p class="PageSubtitle"><span>Blog</span></p>
			
			<div class="col-12">
				<div class="row">
					<div class="col-sm-6 col-md-4">
						<img src="public/images/bag.jpg" class="blogImg img-fluid">
						<p class="blog_title">Silk of dreamer</p>
						<p class="date_posted"><i>January 20, 2019</i></p>
						<p class="blog_text">
							Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
						</p>
					</div>
					<div class="col-sm-6 col-md-4">
						<img src="public/images/beautiful.jpg" class="blogImg img-fluid">
						<p class="blog_title">Silk of dreamer</p>
						<p class="date_posted"><i>January 20, 2019</i></p>
						<p class="blog_text">
							Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
						</p>
					</div>
					<div class="col-sm-6 col-md-4">
						<img src="public/images/dangerous.jpg" class="blogImg img-fluid">
						<p class="blog_title">Silk of dreamer</p>
						<p class="date_posted"><i>January 20, 2019</i></p>
						<p class="blog_text">
							Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
						</p>
					</div>
				</div>
			</div>
			
			<div class="col-12">
			<p class="Sale">On Sale</p>
				<div class="row">
					<div class="col-sm-4 SaleBlock">
						<div class="saleImg">
							<img src="public/images/floral.png" class="img-fluid">
						</div>
						<div class="sale_info">
							<p class="saleTitle">Floral dress</p>
							<p class="saleCategory">Dress</p>
							<p class="salePrice">$10.00<del>$15.00</del></p>
						</div>
					</div>
					<div class="col-sm-4 SaleBlock">
						<div class="saleImg">
							<img src="public/images/floral.png" class="img-fluid">
						</div>
						<div class="sale_info">
							<p class="saleTitle">Floral dress</p>
							<p class="saleCategory">Dress</p>
							<p class="salePrice">$10.00<del>$15.00</del></p>
						</div>
					</div>
					<div class="col-sm-4 SaleBlock">
						<div class="saleImg">
							<img src="public/images/floral.png" class="img-fluid">
						</div>
						<div class="sale_info">
							<p class="saleTitle">Floral dress</p>
							<p class="saleCategory">Dress</p>
							<p class="salePrice">$10.00<del>$15.00</del></p>
						</div>
					</div>
				</div>
			</div>
			
			<!--<div class="col-12">
			<p class="Sale">Low Price</p>
				<div class="row">
					<div class="col-sm-4 SaleBlock">
						<div class="saleImg">
							<img src="public/images/floral.png" class="img-fluid">
						</div>
						<div class="sale_info">
							<p class="saleTitle">Floral dress</p>
							<p class="saleCategory">Dress</p>
							<p class="salePrice">$10.00 - $15.00</p>
						</div>
					</div>
					<div class="col-sm-4 SaleBlock">
						<div class="saleImg">
							<img src="public/images/floral.png" class="img-fluid">
						</div>
						<div class="sale_info">
							<p class="saleTitle">Floral dress</p>
							<p class="saleCategory">Dress</p>
							<p class="salePrice">$10.00 - $15.00</p>
						</div>
					</div>
					<div class="col-sm-4 SaleBlock">
						<div class="saleImg">
							<img src="public/images/floral.png" class="img-fluid">
						</div>
						<div class="sale_info">
							<p class="saleTitle">Floral dress</p>
							<p class="saleCategory">Dress</p>
							<p class="salePrice">$10.00 - $15.00</p>
						</div>
					</div>
				</div>
			</div>-->
		</div>
	</div>
	
	<div class="container-fluid">
		<!--<div class="row">
			<div class="bg_blur"></div>
			<div class="container">
				<div class="themeBuy">
					<span class="logoBuy">Shop</span><span class="semititle"> - an eCommerce theme</span>
					<button class="btn buyBtn" type="btn">Buy Theme</button><br>
					<span class="buySub">A theme exclusively built for your shop.</span>	
					<p class="text-center buyp"><button class="btn buyBtn1" type="btn">Buy Theme</button></p>
				</div>
			</div> 
		</div>-->
		<div class="row footer-row">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-md-3">
						<p class="footer-title">Womens</p>
						<ul class="footer_list">
							<li><a href="#">T-shirts</a></li>
							<li><a href="#">Shirts</a></li>
							<li><a href="#">Accessories</a></li>
							<li><a href="#">Jacket</a></li>
						</ul>
					</div>
					<div class="col-sm-6 col-md-3">
						<p class="footer-title">Mens</p>
						<ul class="footer_list">
							<li><a href="#">T-shirts</a></li>
							<li><a href="#">Shirts</a></li>
							<li><a href="#">Accessories</a></li>
							<li><a href="#">Jacket</a></li>
						</ul>
					</div>
					<div class="col-sm-6 col-md-3">
						<p class="footer-title">Kids</p>
						<ul class="footer_list">
							<li><a href="#">T-shirts</a></li>
							<li><a href="#">Shirts</a></li>
							<li><a href="#">Accessories</a></li>
							<li><a href="#">Jacket</a></li>
						</ul>
					</div>
					<div class="col-sm-6 col-md-3">
						<p class="footer-title">Plus Size</p>
						<ul class="footer_list">
							<li><a href="#">T-shirts</a></li>
							<li><a href="#">Shirts</a></li>
							<li><a href="#">Accessories</a></li>
							<li><a href="#">Jacket</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="footer-bottom">
						<hr>
						<ul class="bottom_list">
							<li><a href="#">Home</a></li>
							<li><a href="#">Shop</a></li>
							<li><a href="#">Blog</a></li>
							<li><a href="#">Page</a></li>
						</ul>
						<ul class="social_icon">
							<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
						</ul>
						
					</div>
					<div class="copyright">
						<ul class="copyright_list">
							<li>@Copyright 2019</li>
						</ul>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	
	<!-- footer area end -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="public/js/custom.js"></script>

</body>