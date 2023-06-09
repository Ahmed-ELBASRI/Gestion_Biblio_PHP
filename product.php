<?php
require("VerficationAuth.php");
require("login-form-v1/login_v1/php/connection.php");
require("changesession.php");

if (isset($_GET["search"])) {
	$search = $_GET["search"];
	if (!empty($search)) {

		$query = "SELECT L.*,A.NOM_AUTEUR, GROUP_CONCAT( A.NOM_AUTEUR SEPARATOR ', ') AS NOM_AUTEUR
		FROM livre L inner join rediger R on L.ID_LIVRE=R.ID_LIVRE inner join auteur A on R.ID_AUTEUR=A.ID_AUTEUR WHERE TITRE LIKE :searchValue";

		// Prepare the statement
		$statement = $con->prepare($query);

		// Bind the search value to the placeholder
		$statement->bindValue(':searchValue', '%' . $search . '%');

		// Execute the statement
		$statement->execute();
		$data = $statement->fetchAll(PDO::FETCH_ASSOC);

	}
} else {
	$query = "SELECT L.*, GROUP_CONCAT(A.NOM_AUTEUR SEPARATOR ',') AS NOM_AUTEUR
	FROM livre L
	INNER JOIN rediger R ON L.ID_LIVRE = R.ID_LIVRE
	INNER JOIN auteur A ON R.ID_AUTEUR = A.ID_AUTEUR
	GROUP BY L.ID_LIVRE;";
	$result = $con->query($query);
	$data = $result->fetchAll();
}



// 
// get all data from wishlist table 

//print_r($data3);
//

//add data for livre 
if (isset($_GET["idLivre"])) {
	$idLivre = $_GET["idLivre"];
	if (!empty($idLivre)) {
		$query = "select * from livre where ID_LIVRE=:idLivre";
		$statement2 = $con->prepare($query);
		$statement2->execute(array("idLivre" => $idLivre));
		$data2 = $statement2->fetch(PDO::FETCH_ASSOC);

	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Livres</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.png" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" href="css/annotation.css">
</head>

<body class="animsition">

	<!-- Header -->
	<header class="header-v4">
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->

			<div class="wrap-menu-desktop how-shadow1">
				<nav class="limiter-menu-desktop container">

					<!-- Logo desktop -->
					<a href="index.php" class="logo">
						<img src="images/icons/logo-01.png" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li>
								<a href="index.php">Acceuil</a>
							</li>

							<li class="label1" data-label1="New">
								<a href="product.php">Livres</a>
							</li>

							<li>
								<a href="empruntlivre.php">Emprunts</a>
							</li>
							<li>
								<a href="reservation.php">Reservations</a>
							</li>
							<li>
								<a href="about.php">À propos</a>
							</li>

							<li>
								<a href="contact.php">Contact</a>
							</li>
						</ul>
					</div>

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>
						<a href="shoping-cart.php">
							<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-10 p-r-11 icon-header-noti js-show-cart"
								data-notify="0">
								<i class="zmdi zmdi-favorite-outline"></i>
							</div>
						</a>
						<div class="p-l-15">
							<div class="image-container">
								<a href="login-form-v1/Login_v1/php/logout.php">
									<img src="images/exit.png" alt="" class="annotated-image">
									<div class="annotation ">Logout</div>
								</a>
							</div>
						</div>
					</div>
				</nav>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->
			<div class="logo-mobile">
				<a href="index.php"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="2">
					<a href="shoping-cart.php"><i class="zmdi zmdi-favorite-outline"></i></a>
				</div>
				<div class="p-l-15 p-r-10">
					<div class="image-container">
						<a href="login-form-v1/Login_v1/php/logout.php">
							<img src="images/exit.png" alt="" class="annotated-image">
							<div class="annotation ">Logout</div>
						</a>
					</div>
				</div>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="main-menu-m">
			<li>
					<a href="index.php">Acceuil</a>

				</li>

				<li >
					<a class="label1" data-label1="New" href="product.php">Livres</a>
				</li>

				<li>
					<a href="empruntlivre.php">Emprunts</a>
				</li>
				<li>
					<a href="reservation.php">Reservations</a>
				</li>
				<li>
					<a href="about.php">À propos</a>
				</li>

				<li>
					<a href="contact.php">Contact</a>
				</li>
			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search" placeholder="Search...">
				</form>
			</div>
		</div>
	</header>
	<!-- Product -->
	<div class="bg0 m-t-23 p-b-140">
		<div class="container">
			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
					Tous les livres
					</button>
					<?php
					require_once "login-form-v1/Login_v1/php/connection.php";
					$query = "SELECT DISTINCT L.ID_CATEGORIE, C.LIBELLE_CATEGORIE FROM categorie C INNER JOIN livre L 
					ON C.ID_CATEGORIE = L.ID_CATEGORIE INNER JOIN rediger R 
					ON L.ID_LIVRE = R.ID_LIVRE INNER JOIN auteur A 
					ON R.ID_AUTEUR = A.ID_AUTEUR";
					$Stm = $con->query($query);
					$data1 = $Stm->fetchAll(PDO::FETCH_ASSOC);
					//print_r($data1);
					//$data=$statement->fetchAll(PDO::FETCH_ASSOC);
					
					if (!empty($data1)) {

						for ($i = 0; $i < count($data1); $i++) {
							?>
							<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5"
								data-filter=".<?= $data1[$i]["LIBELLE_CATEGORIE"] ?>">
								<?= $data1[$i]["LIBELLE_CATEGORIE"] ?>
							</button>
							<?php
						}
					}
					?>
				</div>

				<div class="flex-w flex-c-m m-tb-10">
					<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Search
					</div>
				</div>

				<!-- Search product -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>

						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product"
							placeholder="Search">
					</div>
				</div>
			</div>

			<div class="row isotope-grid">

				<?php
				for ($i = 0; $i < count($data); $i++) {
					?>
					<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?php
					for ($j = 0; $j < count($data1); $j++) {
						if ($data1[$j]["ID_CATEGORIE"] == $data[$i]["ID_CATEGORIE"]) {
							echo $data1[$j]["LIBELLE_CATEGORIE"];
							break;
						}
					}
					?>">
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="<?= $data[$i]["COUVERTURE"] ?>" alt="IMG-PRODUCT">

								<a href="product.php?idLivre=<?= $data[$i]["ID_LIVRE"] ?>"
									class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 ">
									Quick View
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="product-detail.php?id=<?= $data[$i]["ID_LIVRE"] ?>"
										class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										<?= $data[$i]["TITRE"] ?>
									</a>

									<span class="stext-105 cl3">
										<?= $data[$i]["NOM_AUTEUR"] ?>
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png"
											alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l"
											src="images/icons/icon-heart-02.png" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div>

					<?php
				}
				?>

			</div>

		</div>
	</div>


	<!-- Footer -->
	<footer class="bg3 p-t-75 p-b-32">
		<div class="container">
			<div class="row">
			<div class="col-sm-6 col-lg-3 p-b-50">
				<h4 class="stext-301 cl0 p-b-30">
						Categories
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="product.php" class="stext-107 cl7 hov-cl1 trans-04">
								litterature
							</a>
						</li>

						<li class="p-b-10">
							<a href="product.php" class="stext-107 cl7 hov-cl1 trans-04">
								histoire
							</a>
						</li>

						<li class="p-b-10">
							<a href="product.php" class="stext-107 cl7 hov-cl1 trans-04">
								horreur
							</a>
						</li>
						<li class="p-b-10">
							<a href="product.php" class="stext-107 cl7 hov-cl1 trans-04">
								science
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						AIDE
					</h4>
					<p class="stext-107 cl7 size-201">
					Des questions ? Appelez-nous au +212536533076
					</p>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Adresse
					</h4>

					<p class="stext-107 cl7 size-201">
					Des questions ? Faites-le nous savoir à Rue de la liberté – Hay Al Hikma–Oujda–Maroc
					</p>

					<div class="p-t-27">
						<a href="https://www.facebook.com/eheioujda/?locale=fr_FR"
							class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="https://www.instagram.com/eheioujda/" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-instagram"></i>
						</a>
					</div>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Newsletter
					</h4>

					<form action="AddToNewsletter.php" method="get">
						<div class="wrap-input1 w-full p-b-4">
							<input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email"
								placeholder="email@example.com" value=<?php

								//	session_open();
								$email = $_SESSION["email"];
								echo "$email";
								?>>
							<div class="focus-input1 trans-04"></div>
						</div>

						<div class="p-t-18">
							<input type="submit"
								class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04" value="<?php
								if ($_SESSION["newsletter"] == 1) {
									echo "UNSUBSCRIBE";
								} else {
									echo "SUBSCRIBE";
								}
								?>" />
						</div>

					</form>
				</div>
			</div>

			<div class="p-t-40">

				<p class="stext-107 cl6 txt-center">
					© Copyrights 2023 EHEI. All Rights Reserved.


				</p>
			</div>
		</div>
	</footer>


	<!-- Back to top -->
	<div class="btn-back-to-top m-b-10" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<!-- Modal1 -->
	<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
		<div class="overlay-modal1 js-hide-modal1"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal1">
					<img src="images/icons/icon-close.png" alt="CLOSE">
				</button>

				<div class="row">
					<div class="col-md-6 col-lg-7 p-b-30">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							<div class="wrap-slick3 flex-sb flex-w">
								<!-- <div class="wrap-slick3-dots"></div> -->
								<!-- <div class="wrap-slick3-arrows flex-sb-m flex-w"></div> -->

								<div class="slick3 gallery-lb">
									<div class="item-slick3" data-thumb="images/product-detail-01.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="<?= $data2["COUVERTURE"] ?>" alt="IMG-PRODUCT">
											<!-- 
										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-01.jpg">
											<i class="fa fa-expand"></i>
										</a> -->
										</div>
									</div>

									<div class="item-slick3" data-thumb="images/product-detail-02.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">
											<!-- 
										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-02.jpg">
											<i class="fa fa-expand"></i> -->
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="images/product-detail-03.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">

											<!-- <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-03.jpg">
											<i class="fa fa-expand"></i>
										</a> -->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6 col-lg-5 p-b-30">
						<div class="p-r-50 p-t-5 p-lr-0-lg">
							<h4 class="mtext-105 cl2 js-name-detail p-b-14">
								<?= $data2["TITRE"] ?>

							</h4>

							<span class="mtext-106 cl2">
								<?= $data2["PRIX"] ?>
							</span>

							<p class="stext-102 cl3 p-t-23">
								<?= $data2["DESCRIPTION"] ?>
							</p>

							<!--  -->
							<div class="p-t-33">
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										<button
											class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
											Reserver
										</button>
									</div>
								</div>
							</div>

							<!--  -->
							<div class="flex-w flex-m p-l-100 p-t-40 respon7">
								<div class="flex-m bor9 p-r-10 m-r-11">
									<a href="#"
										class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
										data-tooltip="Add to Wishlist">
										<i class="zmdi zmdi-favorite"></i>
									</a>
								</div>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
									data-tooltip="Facebook">
									<i class="fa fa-facebook"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
									data-tooltip="Twitter">
									<i class="fa fa-twitter"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
									data-tooltip="Google Plus">
									<i class="fa fa-google-plus"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!--===============================================================================================-->
		<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
		<!--===============================================================================================-->
		<script src="vendor/animsition/js/animsition.min.js"></script>
		<!--===============================================================================================-->
		<script src="vendor/bootstrap/js/popper.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<!--===============================================================================================-->
		<script src="vendor/select2/select2.min.js"></script>
		<script>
			$(".js-select2").each(function () {
				$(this).select2({
					minimumResultsForSearch: 20,
					dropdownParent: $(this).next('.dropDownSelect2')
				});
			})
		</script>
		<!--===============================================================================================-->
		<script src="vendor/daterangepicker/moment.min.js"></script>
		<script src="vendor/daterangepicker/daterangepicker.js"></script>
		<!--===============================================================================================-->
		<script src="vendor/slick/slick.min.js"></script>
		<script src="js/slick-custom.js"></script>
		<!--===============================================================================================-->
		<script src="vendor/parallax100/parallax100.js"></script>
		<script>
			$('.parallax100').parallax100();
		</script>
		<!--===============================================================================================-->
		<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
		<script>
			$('.gallery-lb').each(function () { // the containers for all your galleries
				$(this).magnificPopup({
					delegate: 'a', // the selector for gallery item
					type: 'image',
					gallery: {
						enabled: true
					},
					mainClass: 'mfp-fade'
				});
			});
		</script>
		<!--===============================================================================================-->
		<script src="vendor/isotope/isotope.pkgd.min.js"></script>
		<!--===============================================================================================-->
		<script src="vendor/sweetalert/sweetalert.min.js"></script>
		<script>
			$('.js-addwish-b2, .js-addwish-detail').on('click', function (e) {
				e.preventDefault();
			});

			$('.js-addwish-b2').each(function () {
				var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
				var isAdded = false;
				var hrefValue = $(this).parent().parent().find('.js-name-b2').attr('href');
				//var href = $(this).parent().parent().find('.js-name-b2').attr('href');
				//var urlParams = new URLSearchParams(hrefValue);
				//var idd = urlParams.get('id');




				var idd = null;
				var params = hrefValue.split('?')[1]; // Get the query parameters portion of the URL
				if (params) {
					var queryParams = params.split('&');
					for (var i = 0; i < queryParams.length; i++) {
						var param = queryParams[i].split('=');
						if (param[0] === 'id') {
							idd = param[1];
							break;
						}
					}
				}

				//for wishlist number
				$.ajax({
					url: 'getNumberWishlist.php',
					method: 'GET',
					dataType: 'json',
					success: function (response) {
						// Iterate over the PHP array using JavaScript
						//console.log(response);
						//console.log(response.nbr);
						if (response && response.nbr) {
							var value = response.nbr;
							console.log('Retrieved value:', value);
							var stringValue = '' + value;
							$('.js-show-cart').attr('data-notify', stringValue);
						} else {
							console.log('Empty response or missing value in JSON');
							$('.js-show-cart').attr('data-notify', '0');
						}

					},
					error: function (xhr, status, error) {
						console.log(xhr.responseText);
					}
				});
				//

				//$(this).addClass('js-addedwish-b2');
				// check is the heart is checked in bd
				var $element = $(this);
				$.ajax({
					url: 'getAllwishlist.php',
					method: 'GET',
					dataType: 'json',
					success: function (response) {
						// Iterate over the PHP array using JavaScript
						console.log(response);
						response.forEach(function (item) {
							//console.log(item);
							//console.log(idd);
							//console.log(item.ID_LIVRE);
							var idlivre = item.ID_LIVRE;
							//console.log(idd);
							//console.log(idlivre);
							if (idlivre == idd) {
								//console.log("yes");
								isAdded = true;
								$element.addClass('js-addedwish-b2');

								//alert("yes");

							}
							else {
								//console.log("no");
								//	$(this).removeClass('js-addedwish-b2');


							}
							//	$(this).addClass('js-addedwish-b2');
							//$(this).addClass('js-addedwish-detail');


							/*if(item.ID_LIVRE===idd){
								$(this).addClass('js-addedwish-b2');
								
								console.log("yes");
								

								

							}
							else{
								$(this).removeClass('js-addedwish-b2');
								console.log("no");

							}*/
							// Perform any desired operations on each item
						});
					},
					error: function (xhr, status, error) {
						console.log(xhr.responseText);
					}
				});


				//

				$(this).on('click', function () {
					if (isAdded) {
						// Remove from wishlist
						$.ajax({
							url: 'DeleteTowishList.php',
							method: 'POST',
							data: { ID_LIVRE: idd },
							success: function (response) {
								// Handle the response from the PHP script
								console.log(response);
							},
							error: function (xhr, status, error) {
								// Handle errors, if any
								console.log(xhr.responseText);
							}
						});
						swal(nameProduct, "is removed from the wishlist!", "success");

						/*	var nbrWish = $('.js-show-cart').data('notify');
							nbrWish--;
							var stringValue = '' + nbrWish;
							$('.js-show-cart').attr('data-notify', stringValue);*/





						$(this).removeClass('js-addedwish-b2');
						isAdded = false;
					} else {

						//var test = $('.js-show-cart').data('notify');
						//$('.js-show-cart').data('notify', '12');

						//$('.js-show-cart').attr('data-notify', '12');

						//alert(test);
						//update wishlist 
						// Add to wishlist
						//window.location.href = "AddTowishList.php";
						$.ajax({
							url: 'AddTowishList.php',
							method: 'POST',
							data: { ID_LIVRE: idd },
							success: function (response) {
								// Handle the response from the PHP script
								console.log(response);
							},
							error: function (xhr, status, error) {
								// Handle errors, if any
								console.log(xhr.responseText);
							}
						});


						/*	var nbrWish = parseInt($('.js-show-cart').data('notify'), 10);
							var nbr2=	nbrWish + 1;
							var stringValue1 = '' + nbr2;
							console.log('Data type:', typeof nbrWish);
							console.log("nombre wish is" + nbr2);
							console.log("nombre wish is" + stringValue1);
							$('.js-show-cart').attr('data-notify', stringValue1);*/
						swal(nameProduct, "is added to the wishlist!", "success");


						/*		$.ajax({
							url: 'getNumberWishlist.php',
								method: 'GET',
								dataType: 'json',
								success: function(response) {
									// Iterate over the PHP array using JavaScript
									//console.log(response);
									//console.log(response.nbr);
									if (response && response.nbr) {
										var value = response.nbr;
										console.log('Retrieved value: for number', value);
										var stringValue = '' + value;
										$('.js-show-cart').attr('data-notify', stringValue);
										} else {
										console.log('Empty response or missing value in JSON');
										$('.js-show-cart').attr('data-notify', '0');
										}
									
								},
								error: function(xhr, status, error) {
									console.log(xhr.responseText);
								}
								});*/
						$(this).addClass('js-addedwish-b2');




						isAdded = true;
					}
				});
			});

			$('.js-addwish-detail').each(function () {
				var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();
				var isAdded = false;

				$(this).on('click', function () {
					if (isAdded) {
						// Remove from wishlist
						swal(nameProduct, "is removed from the wishlist!", "success");

						$(this).removeClass('js-addedwish-detail');
						isAdded = false;
					} else {

						//alert("hello");
						// Add to wishlist
						swal(nameProduct, "is added to the wishlist!", "success");

						$(this).addClass('js-addedwish-detail');
						isAdded = true;



					}
				});
			});

			/*---------------------------------------------*/

			$('.js-addcart-detail').each(function () {
				var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
				var isAdded = false;

				$(this).on('click', function () {
					if (isAdded) {
						// Remove from cart
						swal(nameProduct, "is removed from the cart!", "success");
						isAdded = false;
					} else {
						// Add to cart
						swal(nameProduct, "is added to the cart!", "success");
						isAdded = true;
					}
				});
			});

		</script>
		<!--===============================================================================================-->
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script>
			$('.js-pscroll').each(function () {
				$(this).css('position', 'relative');
				$(this).css('overflow', 'hidden');
				var ps = new PerfectScrollbar(this, {
					wheelSpeed: 1,
					scrollingThreshold: 1000,
					wheelPropagation: false,
				});

				$(window).on('resize', function () {
					ps.update();
				})
			});
		</script>
		<!--===============================================================================================-->

		<script>

		</script>


		<script>

			$(document).ready(function () {
				$('input[name="search-product"]').on('keyup', function (event) {
					if (event.keyCode === 13) {
						// Get the input value
						var searchValue = $(this).val();

						// Construct the query string based on the input value
						var queryString = 'search=' + encodeURIComponent(searchValue);

						// Redirect the user to another page with the query string
						window.location.href = 'product.php?' + queryString;
					}
				});
			});
		</script>









		<!--===============================================================================================-->
		<script src="js/main.js"></script>
		<script src="https://unpkg.com/url-search-params-polyfill"></script>


</body>

</html>