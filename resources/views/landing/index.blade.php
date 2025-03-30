<head>
	<meta charset="UTF-8">
	<title>Samba Bikes</title>
	<!-- =================== META =================== -->
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}">
	<!-- =================== STYLE =================== -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/landing/slick.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('assets/css/landing/bootstrap-grid.css') }}">
	<link href="https://use.fontawesome.com/releases/v5.10.1/css/all.css" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('assets/css/landing/nice-select.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/landing/style.css') }}">
</head>
<body id="home">
	<!-- =============== PRELOADER =============== -->
	<div class="page-preloader-cover">
		<div class="cssload-loader">
			<div class="cssload-inner cssload-one"></div>
			<div class="cssload-inner cssload-two"></div>
			<div class="cssload-inner cssload-three"></div>
		</div>
	</div>
	<!-- ============== PRELOADER END ============== -->
	<span class="bg-effect" style="background-image: url({{ asset('assets/images/landing/main-bg.svg') }});"></span>
	<!-- ================= HEADER ================= -->
	<header class="marathon-header-fixed header-fixed">
		<a href="#" class="nav-btn">
			<span></span>
			<span></span>
			<span></span>
		</a>
		<div class="top-panel">
			<div class="container">
				<a href="index.html" class="logo"><img src="{{ asset('assets/images/logo-brand-side.png') }}" alt="logo" style="width: 11rem; height: auto;"></a>
				<ul class="social-list">
					<li><a target="_blank" href="https://www.facebook.com/rovadex"><i class="fab fa-facebook-f"></i></a></li>
					<li><a target="_blank" href="https://twitter.com/RovadexStudio"><i class="fab fa-twitter"></i></a></li>
					<li><a target="_blank" href="https://www.instagram.com/rovadex"><i class="fab fa-instagram"></i></a></li>
					<li><a target="_blank" href="https://www.youtube.com"><i class="fab fa-youtube"></i></a></li>
				</ul>
			</div>
		</div>
		<div class="header-nav">
			<div class="container">
				<div class="header-nav-cover">
					<nav class="nav-menu menu">
						<ul class="nav-list">
							<li><a href="index.html">home</a></li>
							<li><a href="#about">about</a></li>
							<li><a href="#schedule">schedule</a></li>
							<li><a href="#location">location</a></li>
							<li><a href="#register">register</a></li>
						</ul>
					</nav>
					<a href="#register" class="btn btn-white"><span>registration</span></a>
				</div>
			</div>
		</div>
	</header>
	<!-- =============== HEADER END =============== -->

	<!-- ============= MARATHON-SLIDER ============= -->
	<section class="s-marathon-slider">
		<div class="marathon-slider">
			<div class="marathon-slide marathon-slide-1">
				<div data-hover-only="true" data-pointer-events="true" data-scalar-y="0" class="scene">
					<div class="scene-item" data-depth="0.2">
						<span class="marathon-effect" style="background-image: url({{ asset('assets/images/landing/effect-slider-marathon.svg') }});"></span>
					</div>
					<div class="scene-item" data-depth="0.2">
						<img class="marathon-img" src="{{ asset('assets/images/landing/Trial/bicycle.png') }}" alt="img">
					</div>
					<div class="scene-item" data-depth="0.5">
						<div class="slider-location">Surabaya <br>marathon <span class="date">23 feb 2025</span></div>
					</div>
					<div class="scene-item" data-depth="0.35">
						<div class="marathon-text-left">find<br>your</div>
					</div>
					<div class="scene-item" data-depth="0.35">
						<div class="marathon-text-right">Fast</div>
					</div>
				</div>
			</div>
			<div class="marathon-slide marathon-slide-2">
				<div data-hover-only="true" data-pointer-events="true" data-scalar-y="0" class="scene">
					<div class="scene-item" data-depth="0.2">
						<span class="marathon-effect" style="background-image: url({{ asset('assets/images/landing/effect-slider-marathon.svg') }});"></span>
					</div>
					<div class="scene-item" data-depth="0.2">
						<img class="marathon-img" src="{{ asset('assets/images/landing/Trial/bicycle.png') }}" alt="img">
					</div>
					<div class="scene-item" data-depth="0.5">
						<div class="slider-location">Jakarta <br>marathon <span class="date">25 feb 2025</span></div>
					</div>
					<div class="scene-item" data-depth="0.35">
						<div class="marathon-text-left">live<br>your</div>
					</div>
					<div class="scene-item" data-depth="0.35">
						<div class="marathon-text-right">Life</div>
					</div>
				</div>
			</div>
			<div class="marathon-slide marathon-slide-3">
				<div data-hover-only="true" data-pointer-events="true" data-scalar-y="0" class="scene">
					<div class="scene-item" data-depth="0.2">
						<span class="marathon-effect" style="background-image: url({{ asset('assets/images/landing/effect-slider-marathon.svg') }});"></span>
					</div>
					<div class="scene-item" data-depth="0.2">
						<img class="marathon-img" src="{{ asset('assets/images/landing/Trial/bicycle.png') }}" alt="img">
					</div>
					<div class="scene-item" data-depth="0.5">
						<div class="slider-location">Semarang <br>marathon <span class="date">28 feb 2025</span></div>
					</div>
					<div class="scene-item" data-depth="0.35">
						<div class="marathon-text-left">Feel<br>your</div>
					</div>
					<div class="scene-item" data-depth="0.35">
						<div class="marathon-text-right">burn!</div>
					</div>
				</div>
			</div>
		</div>
		<img class="marathon-slider-shape" src="{{ asset('assets/images/landing/slider-home1-shape.svg') }}" alt="shape">
		<div id="clockdiv" class="clock-timer clock-timer-marathon">
			<div class="days-item">
				<img src="{{ asset('assets/images/landing/counter-1.svg') }}" alt="img">
				<span class="days"></span>
				<div class="smalltext">Days</div>
			</div>
			<div class="hours-item">
				<img src="{{ asset('assets/images/landing/counter-2.svg') }}" alt="img">
				<span class="hours"></span>
				<div class="smalltext">Hours</div>
			</div>
			<div class="minutes-item">
				<img src="{{ asset('assets/images/landing/counter-3.svg') }}" alt="img">
				<span class="minutes"></span>
				<div class="smalltext">Minutes</div>
			</div>
			<div class="seconds-item">
				<img src="{{ asset('assets/images/landing/counter-4.svg') }}" alt="img">
				<span class="seconds"></span>
				<div class="smalltext">Seconds</div>
			</div>
		</div>
	</section>
	<!-- =========== MARATHON-SLIDER END =========== -->

	<!-- ============== S-OUR-MISSION ============== -->
	<section id="about" class="s-our-mission">
		<div class="container">
			<img class="mission-effect" src="{{ asset('assets/images/landing/our-mission-5.svg') }}" alt="img">
			<h2 class="title">Our mission</h2>
			<div class="row">
				<div class="col-lg-6 our-mission-img">
					<span>
						<img class="mission-img-effect-1" src="{{ asset('assets/images/landing/our-mission-2.svg') }}" alt="img">
						<img class="mission-img rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/our-mission.jpg') }}" alt="img">
						<img class="mission-img-effect-4" src="{{ asset('assets/images/landing/tringle-gray-little.svg') }}" alt="img">
					</span>
				</div>
				<div class="col-lg-6 our-mission-info">
					<ul class="mission-meta">
						<li><i aria-hidden="true" class="fas fa-map-marker-alt"></i>Jakarta</li>
						<li><i aria-hidden="true" class="fas fa-calendar-alt"></i>28.02.2025</li>
					</ul>
					<h4>Pedal Together, Ride Stronger!</h4>
					<p>At Samba, we bring cyclists together—whether casual riders or competitive athletes—to experience scenic and exciting rides. Cycling is more than a sport; it’s a lifestyle that promotes health, sustainability, and community. Join us and ride towards new adventures!</p>
					<div class="mission-number-cover">
						<div class="mission-number-item">
							<div class="number">2000+</div>
							<span>Participants</span>
						</div>
						<div class="mission-number-item">
							<div class="number">50km</div>
							<span>ride distance</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- ============ S-OUR-MISSION END ============ -->

	<!-- ================ S-CHOOSE-US ================ -->
	<section class="s-choose-us" style="background-image: url({{ asset('assets/images/landing/bg-1.svg') }});">
		<div class="container">
			<h2 class="title"><span>Why Ride with Us!</span></h2>
			<div class="row">
				<div class="col-sm-6 col-md-6 col-lg-3 choose-us-item">
					<img class="rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/icon-1.svg') }}" alt="img">
					<h4>Easy Registration</h4>
					<p>Sign up in just a few clicks and get ready to ride!</p>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-3 choose-us-item">
					<img class="rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/icon-2.svg') }}" alt="img">
					<h4>Well-Marked Routes</h4>
					<p>Enjoy safe, scenic, and clearly marked cycling routes.</p>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-3 choose-us-item">
					<img class="rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/icon-3.svg') }}" alt="img">
					<h4>Hydration Stations</h4>
					<p>Stay refreshed with free water stations along the route.</p>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-3 choose-us-item">
					<img class="rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/icon-4.svg') }}" alt="img">
					<h4>Medical Support</h4>
					<p>Our professional medical team is ready to assist if needed.</p>
				</div>
			</div>
		</div>
	</section>
	<!-- ============== S-CHOOSE-US END ============== -->

	<!-- ============== S-EVENT-SCHEDULE ============== -->
	<section id="schedule" class="s-event-schedule">
		<div class="container">
			<h2 class="title"><span>Event schedule</span></h2>
			<img class="schedule-effect-white"src="{{ asset('assets/images/landing/tringle-white.svg') }}" alt="img">
			<img class="schedule-effect-yellow"src="{{ asset('assets/images/landing/tringle-yellow-little.svg') }}" alt="img">
			<div class="row">
				<div class="col-xl-6">
					<div class="event-schedule-tabs">
						<div class="event-schedule-item">
							{{-- <div class="schedule-item-img">
								<img class="rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/event-icon-1.svg') }}" alt="img">
							</div> --}}
							<div class="schedule-item-info">
								<div class="date">9:00 - 11:00</div>
								<h4>Opening Ceremony & Warm-up</h4>
								<div class="schedule-info-content" style="display: block;">
									<p>Kick off the event with an energizing warm-up session, race briefing, and an inspiring welcome speech.</p>
								</div>
							</div>
						</div>
						<div class="event-schedule-item">
							{{-- <div class="schedule-item-img"><img class="rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/event-icon-2.svg') }}" alt="img"></div> --}}
							<div class="schedule-item-info">
								<div class="date">11:00 - 13:00</div>
								<h4>Main Cycling Event</h4>
								<div class="schedule-info-content">
									<p>Ride through scenic routes, challenge yourself, and enjoy the thrill of the race with fellow cyclists.</p>
								</div>
							</div>
						</div>
						<div class="event-schedule-item">
							{{-- <div class="schedule-item-img"><img class="rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/event-icon-3.svg') }}" alt="img"></div> --}}
							<div class="schedule-item-info">
								<div class="date">13:00 - 14:00</div>
								<h4>Break & Refreshments</h4>
								<div class="schedule-info-content">
									<p>Recharge with snacks and drinks while mingling with other participants and sharing experiences.</p>
								</div>
							</div>
						</div>
						<div class="event-schedule-item">
							{{-- <div class="schedule-item-img"><img class="rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/event-icon-4.svg') }}" alt="img"></div> --}}
							<div class="schedule-item-info">
								<div class="date">14:00 - 15:00</div>
								<h4>Awards & Closing Ceremony</h4>
								<div class="schedule-info-content">
									<p>Celebrate achievements with an award presentation and closing remarks, marking the end of an unforgettable event.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 event-schedule-img">
					<div class="schedule-img-wrap">
						<img class="schedule-effect-tringle" src="{{ asset('assets/images/landing/tringle-gray-little.svg') }}" alt="img">
						<img class="schedule-img-effect" src="{{ asset('assets/images/landing/our-mission-2.svg') }}" alt="img">
						<img class="schedule-img rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/event-schedule.jpg') }}" alt="img">
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- ============ S-EVENT-SCHEDULE END ============ -->

	<!-- =============== MAP-WITH-ROUTE =============== -->
	<section id="location" class="map-with-route">
		<div class="container">
			<h2 class="title"><span>Map with route</span></h2>
			<div class="row">
				<div class="col-lg-6 map-route-img">
					<span>
						<img src="{{ asset('assets/images/landing/our-mission-2.svg') }}" alt="img" class="map-img-effect-1">
						<img src="{{ asset('assets/images/landing/tringle-gray-little.svg') }}" alt="img" class="map-img-effect-2">
						<img class="rx-lazy map-img" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/map.png') }}" alt="img">
					</span>
				</div>
				<div class="col-lg-6 map-route-info">
					<div class="map-route-cover">
						<h4>Explore the exciting cycling route designed for all skill levels</h4>
						<div class="route-info-content">
							<p>Ride through scenic landscapes and well-marked paths, ensuring a safe yet challenging experience for every participant. Get ready to push your limits and enjoy the journey!</p>
						</div>
						<div class="mission-number-cover">
							<div class="mission-number-item">
								<img src="{{ asset('assets/images/landing/map-effect.svg') }}" alt="img" class="map-img-effect">
								<div class="number">50km</div>
								<span>Ride distance</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- ============= MAP-WITH-ROUTE END ============= -->

	<!-- ============= MAP-WITH-ROUTE END ============= -->
	<section id="register" class="s-marathon-register">
		<img src="{{ asset('assets/images/landing/tringle-gray-little.svg') }}" alt="img" class="register-img-effect-2">
		<div class="container">
			<div class="marathon-register-row">
				<img src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/Trial/celebration.png') }}" alt="img" class="register-img rx-lazy">
					<div class="marathon-register">
						<img src="{{ asset('assets/images/landing/our-mission-2.svg') }}" alt="img" class="register-img-effect-1">
						<h2 class="title"><span>Register as Personal</span></h2>
						<form id='registerPersonal'>
							@csrf
							<ul class="form-cover">
								<li class="inp-cover inp-name" style="width: 100%"><input id="nama" type="text" name="nama" placeholder="Name" autocomplete="no" required></li>
								<li class="inp-cover"><input id="phone" type="text" name="phone" placeholder="No Telepon" autocomplete="no" pattern="\d*" required></li>
								<li class="inp-cover inp-email"><input id="email" type="email" name="email" placeholder="E-mail" autocomplete="no" required></li>
								<li class="inp-cover"><input id="tanggal_lahir" class="tanggal" type="text" name="tanggal_lahir" placeholder="Tanggal Lahir" autocomplete="no" required></li>
								<li class="inp-cover">
									<select class="nice-select" id="gender" name="gender" autocomplete="no" required>
										<option value="L" style="font-size: 14px;">Laki-laki</option>
										<option value="P" style="font-size: 14px;">Perempuan</option>
									</select>
								</li>
								<li class="inp-cover">
									<select class="nice-select" id="blood" name="blood" placeholder="Gol Darah" autocomplete="no" required>
										<option value="A" style="font-size: 14px;">A</option>
										<option value="B" style="font-size: 14px;">B</option>
										<option value="AB" style="font-size: 14px;">AB</option>
										<option value="O" style="font-size: 14px;">O</option>
									</select>
								</li>
								<li class="inp-cover" style="z-index: 0"><input id="nik" type="text" name="nik" placeholder="No Tanda Pengenal" autocomplete="no" required></li>
								<li class="inp-cover" style="z-index: 0"><input id="telp_emergency" type="text" name=" telp_emergency" placeholder="No Kontak Darurat" autocomplete="no" required></li>
								<li class="inp-cover" style="z-index: 0"><input id="hubungan_emergency" type="text" name="hubungan_emergency" placeholder="Hub Kontak Darurat" autocomplete="no" required></li>
								<li class="inp-cover" style="z-index: 0"><input id="kota" type="text" name="kota" placeholder="Kota" autocomplete="no" required></li>
								<li class="inp-cover"><input id="nama_komunitas" type="text" name="nama_komunitas" placeholder="Nama Komunitas" autocomplete="no"></li>
								<li class="inp-cover" style="width: 100%"><input id="alamat" type="text" name="alamat" placeholder="Alamat" autocomplete="no" required></li>
								<li class="inp-cover" style="width: 100%">
									<select class="nice-select" id="jersey" name="jersey" autocomplete="no" required>
										<option>S</option>
										<option>M</option>
										<option>L</option>
										<option>XL</option>
									</select>
								</li>
							</ul>
							<div class="btn-form-cover" style="margin-top: 1.5rem">
								<button type="submit" class="btn" id="btn-submit-personal"><span>Register</span></button>
							</div>
						</form>
					</div>
			</div>
		</div>
	</section>
	<!-- ============= MAP-WITH-ROUTE END ============= -->

		<!--================== S-BUY-TICKET ==================-->
		<section id="register" class="s-buy-ticket dance-buy-ticket" style="background-image: url(assets/img/effect-form-dance.svg);">
			<div class="container">
				<div class="title-cover">
					<span class="dance-slogan">Daftarkan Komunitas Anda</span>
					<h2 class="dance-title">Register as Komunitas</h2>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="buy-ticket-form">
							<form id='registerKomunitas'>
								@csrf
								<h5>Informasi Komunitas</h5>
								<ul class="form-cover">
									<li class="inp-cover inp-name" style="width: 100%"><input id="nama_komunitas" type="text" name="nama_komunitas" placeholder="Nama Komunitas"></li>
									<li class="inp-cover inp-name"><input id="koordinator" type="text" name="koordinator" placeholder="Nama Koordinator"></li>
									<li class="inp-cover inp-name"><input id="email" type="email" name="email" placeholder="Email Koordinator"></li>
									<li class="inp-cover inp-name"><input id="kota" type="text" name="kota" placeholder="Kota Komunitas"></li>
									<li class="inp-cover inp-name"><input id="phone" type="text" name="phone" placeholder="Kontak Koordinator"></li>
									
									<li class="pay-method">
										<div class="col-md-12 mb-2 p-0" style="display: flex; justify-content: space-between; align-items: center;">
											<h5>List Peserta</h5>
											<button type="button" class="btn" id="addPeserta"><span>Add Peserta</span></button>
										</div>
										<div class="table-container">
											<table class="custom-table">
												<thead>
													<tr>
														<th>Nama Peserta</th>
														<th>Jenis Kelamin</th>
														<th>Tanggal Lahir</th>
														<th>No KTP</th>
														<th>No Telepon</th>
														<th>Hubungan</th>
														<th>Gol Darah</th>
														<th>Ukuran Jersey</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody id="listPeserta">
													<tr>
														<td><input type="text" name="nama[]" placeholder="Nama Peserta" autocomplete="no"></td>
														<td>
															<select class="nice-select" id="gender" name="gender[]" autocomplete="no">
																<option value="L" style="font-size: 14px;">Laki-laki</option>
																<option value="P" style="font-size: 14px;">Perempuan</option>
															</select>
														</td>
														<td><input type="date" name="tanggal_lahir[]" class="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" autocomplete="no"></td>
														<td><input type="text" name="nik[]" placeholder="No KTP" autocomplete="no"></td>
														<td><input type="text" name="telp_emergency[]" placeholder="No Telepon" autocomplete="no"></td>
														<td><input type="text" name="hubungan_emergency[]" placeholder="Hubungan" autocomplete="no"></td>
														<td>
															<select class="nice-select" id="blood" name="blood[]" placeholder="Gol Darah" autocomplete="no">
																<option value="A" style="font-size: 14px;">A</option>
																<option value="B" style="font-size: 14px;">B</option>
																<option value="AB" style="font-size: 14px;">AB</option>
																<option value="O" style="font-size: 14px;">O</option>
															</select>
														</td>
														<td>
															<select class="nice-select" id="jersey" name="jersey[]" placeholder="Ukuran Jersey" autocomplete="no" style="width: 220px !important;">
																<option value="S" style="font-size: 14px;">S</option>
																<option value="M" style="font-size: 14px;">M</option>
																<option value="L" style="font-size: 14px;">L</option>
																<option value="XL" style="font-size: 14px;">XL</option>
															</select>
														</td>
														<td><button type="button" class="btn" id="removePeserta"><span>X</span></button></td>
													</tr>
												</tbody>
											</table>
										</div>
										
										
									</li>
								</ul>
								<div class="col-md-12 m-0 p-0" style="display: flex; justify-content: space-between; align-items: center;">
									<div class="price-final">
										<span>Total <span id="totalPeserta">1</span>Peserta :</span>
										<div class="price-final-text">Rp. <span id="totalHarga">0</span></div>
									</div>
									<div class="btn-form-cover" style="margin-top: 1.5rem; margin-bottom: 1.5rem">
										<button type="submit" class="btn" id="btn-submit-komunitas"><span>Register</span></button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--================ S-BUY-TICKET END ================-->

	<!--=================== S-CLIENTS ===================-->
	<section class="s-clients">
		<div class="container">
			<h2 class="title"><span>Sponsors</span></h2>
			<div class="clients-cover">
				<div class="client-slide">
					<div class="client-slide-cover">
						<img src="{{ asset('assets/images/landing/client-1.svg') }}" alt="img">
					</div>
				</div>
				<div class="client-slide">
					<div class="client-slide-cover">
						<img src="{{ asset('assets/images/landing/client-2.svg') }}" alt="img">
					</div>
				</div>
				<div class="client-slide">
					<div class="client-slide-cover">
						<img src="{{ asset('assets/images/landing/client-4.svg') }}" alt="img">
					</div>
				</div>
				<div class="client-slide">
					<div class="client-slide-cover">
						<img src="{{ asset('assets/images/landing/client-5.svg') }}" alt="img">
					</div>
				</div>
				<div class="client-slide">
					<div class="client-slide-cover">
						<img src="{{ asset('assets/images/landing/client-6.svg') }}" alt="img">
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================= S-CLIENTS END =================-->

	<!--================ S-MARATHON-NEWS ================-->
	{{-- <section id="news" class="s-marathon-news">
		<div class="container">
			<h2 class="title"><span>Our news</span></h2>
			<div class="marathon-news-slider">
				<div class="marathon-news-slide">
					<div class="marathon-news-date"><span>March</span>10, 2020</div>
					<div class="marathon-news-item">
						<h5><a href="single-blog.html">Sed ut perspiciatis unde omnis iste natus error sit</a></h5>
						<div class="marathon-post-thumbnail">
							<a href="single-blog.html"><img src="{{ asset('assets/images/landing/post-1-home-1.jpg') }}" alt="img"></a>
						</div>
						<div class="marathon-post-content">
							<p>Сonsectetur adipiscing elit, sed do eiusmod tempor</p>
							<div class="marathon-post-meta">
								<i class="fas fa-comment rxta-dynamic-meta-icon" aria-hidden="true"></i>
								<a href="blog.html">0 Comment(s)</a>
							</div>
							<a href="single-blog.html" class="btn"><span>Read More</span></a>
						</div>
					</div>
				</div>
				<div class="marathon-news-slide">
					<div class="marathon-news-date"><span>April</span>15, 2020</div>
					<div class="marathon-news-item">
						<h5><a href="single-blog.html">It has survived not only five centuries</a></h5>
						<div class="marathon-post-thumbnail">
							<a href="single-blog.html"><img src="{{ asset('assets/images/landing/post-2-home-1.jpg') }}" alt="img"></a>
						</div>
						<div class="marathon-post-content">
							<p>Many desktop publishing packages and web page</p>
							<div class="marathon-post-meta">
								<i class="fas fa-comment rxta-dynamic-meta-icon" aria-hidden="true"></i>
								<a href="blog.html">0 Comment(s)</a>
							</div>
							<a href="single-blog.html" class="btn"><span>Read More</span></a>
						</div>
					</div>
				</div>
				<div class="marathon-news-slide">
					<div class="marathon-news-date"><span>June</span>25, 2020</div>
					<div class="marathon-news-item">
						<h5><a href="single-blog.html">But I must explain to you how all this mistaken idea</a></h5>
						<div class="marathon-post-thumbnail">
							<a href="single-blog.html"><img src="{{ asset('assets/images/landing/post-3-home-1.jpg') }}" alt="img"></a>
						</div>
						<div class="marathon-post-content">
							<p>Various versions have evolved over the years</p>
							<div class="marathon-post-meta">
								<i class="fas fa-comment rxta-dynamic-meta-icon" aria-hidden="true"></i>
								<a href="blog.html">0 Comment(s)</a>
							</div>
							<a href="single-blog.html" class="btn"><span>Read More</span></a>
						</div>
					</div>
				</div>
				<div class="marathon-news-slide">
					<div class="marathon-news-date"><span>September</span>20, 2020</div>
					<div class="marathon-news-item">
						<h5><a href="single-blog.html">Nor again is there anyone who loves or pursues</a></h5>
						<div class="marathon-post-thumbnail">
							<a href="single-blog.html"><img src="{{ asset('assets/images/landing/post-4-home-1.jpg') }}" alt="img"></a>
						</div>
						<div class="marathon-post-content">
							<p>The point of using Lorem Ipsum is that</p>
							<div class="marathon-post-meta">
								<i class="fas fa-comment rxta-dynamic-meta-icon" aria-hidden="true"></i>
								<a href="blog.html">0 Comment(s)</a>
							</div>
							<a href="single-blog.html" class="btn"><span>Read More</span></a>
						</div>
					</div>
				</div>
				<div class="marathon-news-slide">
					<div class="marathon-news-date"><span>October</span>10, 2020</div>
					<div class="marathon-news-item">
						<h5><a href="single-blog.html">At vero eos et accusamus et iusto odio dignissimos</a></h5>
						<div class="marathon-post-thumbnail">
							<a href="single-blog.html"><img src="{{ asset('assets/images/landing/post-5-home-1.jpg') }}" alt="img"></a>
						</div>
						<div class="marathon-post-content">
							<p>All the Lorem Ipsum generators on the Internet</p>
							<div class="marathon-post-meta">
								<i class="fas fa-comment rxta-dynamic-meta-icon" aria-hidden="true"></i>
								<a href="blog.html">0 Comment(s)</a>
							</div>
							<a href="single-blog.html" class="btn"><span>Read More</span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> --}}
	<!--============== S-MARATHON-NEWS END ==============-->

	<!--================== S-INSTAGRAM ==================-->
	<section class="s-instagram">
		<div class="instagram-cover">
			<a href="#" class="instagram-item">
				<ul>
					<li class="comments">234 <i class="far fa-comment"></i></li>
					<li class="like">134 <i class="far fa-heart"></i></li>
				</ul>
				<img class="rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/instagram-1.jpg') }}" alt="img">
			</a>
			<a href="#" class="instagram-item">
				<ul>
					<li class="comments">222 <i class="far fa-comment"></i></li>
					<li class="like">118 <i class="far fa-heart"></i></li>
				</ul>
				<img class="rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/instagram-2.jpg') }}" alt="img">
			</a>
			<a href="#" class="instagram-item">
				<ul>
					<li class="comments">224 <i class="far fa-comment"></i></li>
					<li class="like">124 <i class="far fa-heart"></i></li>
				</ul>
				<img class="rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/instagram-3.jpg') }}" alt="img">
			</a>
			<a href="#" class="instagram-item">
				<ul>
					<li class="comments">155 <i class="far fa-comment"></i></li>
					<li class="like">107 <i class="far fa-heart"></i></li>
				</ul>
				<img class="rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/instagram-4.jpg') }}" alt="img">
			</a>
			<a href="#" class="instagram-item">
				<ul>
					<li class="comments">350 <i class="far fa-comment"></i></li>
					<li class="like">140 <i class="far fa-heart"></i></li>
				</ul>
				<img class="rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/instagram-5.jpg') }}" alt="img">
			</a>
			<a href="#" class="instagram-item">
				<ul>
					<li class="comments">350 <i class="far fa-comment"></i></li>
					<li class="like">140 <i class="far fa-heart"></i></li>
				</ul>
				<img class="rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/instagram-6.jpg') }}" alt="img">
			</a>
			<a href="#" class="instagram-item">
				<ul>
					<li class="comments">350 <i class="far fa-comment"></i></li>
					<li class="like">140 <i class="far fa-heart"></i></li>
				</ul>
				<img class="rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/instagram-7.jpg') }}" alt="img">
			</a>
			<a href="#" class="instagram-item">
				<ul>
					<li class="comments">350 <i class="far fa-comment"></i></li>
					<li class="like">140 <i class="far fa-heart"></i></li>
				</ul>
				<img class="rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/instagram-8.jpg') }}" alt="img">
			</a>
			<a href="#" class="instagram-item">
				<ul>
					<li class="comments">350 <i class="far fa-comment"></i></li>
					<li class="like">140 <i class="far fa-heart"></i></li>
				</ul>
				<img class="rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/instagram-9.jpg') }}" alt="img">
			</a>
			<a href="#" class="instagram-item">
				<ul>
					<li class="comments">350 <i class="far fa-comment"></i></li>
					<li class="like">140 <i class="far fa-heart"></i></li>
				</ul>
				<img class="rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/instagram-10.jpg') }}" alt="img">
			</a>
		</div>
	</section>
	<!--================ S-INSTAGRAM END ================-->

	<!--==================== FOOTER ====================-->
	<footer>
		<div class="container">
			<div class="row">
				<div class="footer-cont col-12 col-sm-6 col-lg-4">
					<a href="index.html" class="logo"><img src="{{ asset('assets/images/logo-brand-side-yellow.png') }}" alt="logo" style="width: 11rem; height: auto;"></a>
					<p>Semarang, Indonesia</p>
					<ul class="footer-contacts">
						<li class="footer-phone">
							<i aria-hidden="true" class="fas fa-phone"></i>
							<a href="tel:+085875502569">085875502569</a>
						</li>
						<li class="footer-email">
							<a href="mailto:samba@gmail.com">samba@gmail.com</a>
						</li>
					</ul>
					<div class="footer-copyright"><a target="_blank" href="https://samba.com">Samba</a> © 2025. All Rights Reserved.</div>
				</div>
				<div class="footer-item-link col-12 col-sm-6 col-lg-4">
					<div class="footer-link">
						<h5>Event</h5>
						<ul class="footer-list">
							<li><a href="#about">About</a></li>
							<li><a href="#schedule">Schedule</a></li>
							<li><a href="#location">Location</a></li>
						</ul>
					</div>
					<div class="footer-link">
						<h5>Social</h5>
						<ul class="footer-list">
							<li><a target="_blank" href="https://www.facebook.com/rovadex">Facebook</a></li>
							<li><a target="_blank" href="https://twitter.com/RovadexStudio">Twitter</a></li>
							<li><a target="_blank" href="https://www.instagram.com/rovadex">Instagram</a></li>
							<li><a target="_blank" href="https://www.youtube.com">Youtube</a></li>
						</ul>
					</div>
				</div>
				<div class="footer-subscribe col-12 col-sm-6 col-lg-4">
					<h5>Subscribe to our newsletter. Stay up to date with our latest news and updates.</h5>
					<form class="subscribe-form">
						<input class="inp-form" type="email" name="subscribe" placeholder="E-mail">
						<button class="btn-form" type="submit"><i class="fas fa-paper-plane"></i></button>
					</form>
					<p>By clicking the button you agree to the <a href="#" target="_blank">Privacy Policy</a> and <a href="#" target="_blank">Terms and Conditions</a></p>
				</div>
			</div>
		</div>
	</footer>
	<!--================== FOOTER END ==================-->

	<!-- Modal Konfirmasi Pembayaran -->
	<div id="modalKonfirmasi" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Konfirmasi Pembayaran</h5>
					<button type="button" class="close" onclick="closeModal()">&times;</button>
				</div>
				<div class="modal-body">
					<!-- Informasi Pembayaran -->
					<div class="info-pembayaran mb-3">
						Silakan lakukan transfer ke <strong>Bank BCA</strong>, No. Rekening <strong>33321231123</strong> atas nama <strong>[Nama Pemilik Rekening]</strong>. 
						Setelah transfer, mohon kirim bukti pembayaran melalui WhatsApp ke <a href="https://wa.me/6285875502569" target="_blank"><strong>0858-7550-2569</strong></a>.
					</div>
					<!-- Pesan Konfirmasi -->
					<div class="info-pembayaran mb-3 text-success">
						Kami akan segera memproses pembayaran Anda setelah bukti transfer diterima.
					</div>
				</div>
				<div class="modal-footer">
					<div class="btn-form-cover">
						<button type="button" class="btn btn-secondary" onclick="closeModal()"><span>Tutup</span></button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Override -->
	<div id="modalOverride" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Konfirmasi Peserta</h5>
					<button type="button" class="close" onclick="closeModal()">&times;</button>
				</div>
				<div class="modal-body">
					<!-- Informasi Pembayaran -->
					<div class="info-peserta-terdaftar mb-3" id="info-peserta-terdaftar"></div>
				</div>
				<div class="modal-footer">
					<div class="btn-form-cover">
						<button type="button" class="btn btn-secondary" onclick="closeModalOverride()"><span>Tidak</span></button>
						<button type="button" class="btn btn-primary" onclick="" id="submit-override"><span>Ya</span></button>
					</div>
				</div>
			</div>
		</div>

	<!--=================== TO TOP ===================-->
	<a class="to-top" href="#home">
		<i class="fa fa-angle-double-up" aria-hidden="true"></i>
	</a>
	<!--================= TO TOP END =================-->

	<!--=================== SCRIPT	===================-->
	
	{{-- <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css"> --}}

	<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
	

	<script src="{{ asset('assets/js/apps/landing/slick.min.js') }}"></script>
	<script src="{{ asset('assets/js/apps/landing/rx-lazy.js') }}"></script>
	<script src="{{ asset('assets/js/apps/landing/jquery.nice-select.js') }}"></script>
	<script src="{{ asset('assets/js/apps/landing/parallax.min.js') }}"></script>
	<script src="{{ asset('assets/js/apps/landing/scripts.js') }}"></script>

	<script src="{{ asset('assets/js/apps/landing/landing.js') }}"></script>

</body>
</html>
