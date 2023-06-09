<?php
require("VerficationAuth.php");
require("login-form-v1/login_v1/php/connection.php");
require("changesession.php");

$ID_PERSONNE = $_SESSION["ID_PERSONNE"];
$query = "SELECT c.LIBELLE_CATEGORIE,L.TITRE,L.ID_LIVRE,L.COUVERTURE_MIN, GROUP_CONCAT(DISTINCT A.NOM_AUTEUR SEPARATOR ', ') AS NOM_AUTEUR,
E.DATEEMPRUNTE,E.DATE_RETURN_EMPRUNTE,E.DATE_RETURN_EMPRUNTE FROM categorie c inner join livre L  
ON c.ID_CATEGORIE = L.ID_CATEGORIE  INNER JOIN rediger R 
ON L.ID_LIVRE = R.ID_LIVRE INNER JOIN auteur A 
ON R.ID_AUTEUR = A.ID_AUTEUR INNER JOIN reserverlivre re ON L.ID_LIVRE = re.ID_LIVRE
INNER JOIN empruntlivre E on E.ID_RESERVATION=re.ID_RESERVATION
INNER JOIN personne p on re.ID_PERSONNE=p.ID_PERSONNE
WHERE p.ID_PERSONNE=$ID_PERSONNE
GROUP BY L.ID_LIVRE";
$result = $con->query($query);
$data = $result->fetchAll();
?>
<html lang="en">

<head>
	<title>Emprunts</title>
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
							<div 
								class="icon-header-item cl2 hov-cl1 trans-04 p-l-10 p-r-11 icon-header-noti "
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

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
					data-notify="2">
					<i class="zmdi zmdi-favorite-outline"></i>
				</div>
				<div class="p-l-15">
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
					<a href="shoping-cart.php">Emprunts</a>
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

	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>

			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="images/item-cart-01.jpg" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								White Shirt Pleat
							</a>

							<span class="header-cart-item-info">
								1 x $19.00
							</span>
						</div>
					</li>

					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="images/item-cart-02.jpg" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								Converse All Star
							</a>

							<span class="header-cart-item-info">
								1 x $39.00
							</span>
						</div>
					</li>

					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="images/item-cart-03.jpg" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								Nixon Porter Leather
							</a>

							<span class="header-cart-item-info">
								1 x $17.00
							</span>
						</div>
					</li>
				</ul>

				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						Total: $75.00
					</div>

					<div class="header-cart-buttons flex-w w-full">
						<a href="shoping-cart.php"
							class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							View Cart
						</a>

						<a href="shoping-cart.php"
							class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							Check Out
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				Acceuil
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Emprunt
			</span>
		</div>
	</div>


	<!-- Shoping Cart -->
	<form class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-12 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Livre</th>
									<th class="column-1">TITRE</th>
									<th class="column-1">CATEGORIE</th>
									<th class="column-1">AUTEUR</th>
                                    <th class="column-1">Date d'emprunt</th>
                                    <th class="column-1">Date fin d'emprunt</th>
									<th class="column-1">Plus d'informations</th>
									<th class="column-1">Statue</th>
								</tr>
								<?php for ($i = 0; $i < count($data); $i++) { ?>
									<tr class="table_row">
										<td class="column-1">
											<div class="how-itemcart1">
												<img src="<?= $data[$i]["COUVERTURE_MIN"] ?>" alt="IMG">
											</div>
										</td>
										<td class="column-1">
											<?= $data[$i]["TITRE"] ?>
										</td>
										<td class="column-1">
											<?= $data[$i]["LIBELLE_CATEGORIE"] ?>
										</td>
										<td class="column-1">
											<?= $data[$i]["NOM_AUTEUR"] ?>
										</td>
                                        <td class="column-1">
											<?= $data[$i]["DATEEMPRUNTE"] ?>
										</td>
                                        <td class="column-1">
											<?= $data[$i]["DATE_RETURN_EMPRUNTE"] ?>
										</td>
										<td class="column-1">
											<div class="p-l-15">
												<div class="image-container">
													<a href="product-detail.php?id=<?= $data[$i]["ID_LIVRE"] ?>">
														<img src="images/more.png" alt="more informations"
															class="annotated-image">
													</a>
												</div>
										</td>
										<td class="column-1">
                                            <?php 

                                                if(!$data[$i]["DATE_RETURN_EMPRUNTE"]){
                                                    ?><p>Non rendu</p><?php
                                                }else{
                                                    ?><p>Rendu</p><?php 
                                                }
                                            ?>
										</td>
									</tr>
								<?php } ?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>




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
			<p class="stext-107 cl6 txt-center">
				© Copyrights 2023 EHEI. All Rights Reserved.
			</p>
		</div>
	</footer>


	<!-- Back to top -->
	<div class="btn-back-to-top m-b-10" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
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
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
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
	<script src="js/main.js"></script>

</body>

</html>