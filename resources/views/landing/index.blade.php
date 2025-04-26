<head>
	<meta charset="UTF-8">
	<title>Samba Bikes</title>
	<!-- =================== META =================== -->
	<meta name="keywords" content="Samba Cycling Event, bike event Indonesia, cycling race 2025, road bike challenge, fun ride, community cycling, bike festival 2025, bike event, cycling race, bike ride, bicycle competition, outdoor cycling, community bike ride, cycling festival, road bike event, mountain biking, group cycling event">
	<meta name="description" content="A fun and thrilling bike event for all ages! Enjoy group rides, challenges, and outdoor excitement with fellow cycling enthusiasts.">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}">
	<!-- =================== STYLE =================== -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/landing/slick.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('assets/css/landing/bootstrap-grid.css') }}">
	<link href="https://use.fontawesome.com/releases/v5.10.1/css/all.css" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('assets/css/landing/nice-select.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/landing/style.css') . '?v=' . time() }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.css" integrity="sha512-fjO3Vy3QodX9c6G9AUmr6WuIaEPdGRxBjD7gjatG5gGylzYyrEq3U0q+smkG6CwIY0L8XALRFHh4KPHig0Q1ug==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
				<a href="#home" class="logo"><img src="{{ asset('assets/images/logo-brand-side.png') }}" alt="logo" style="width: 11rem; height: auto;"></a>
				<ul class="social-list">
					@if ($data->instagram)
						<li><a target="_blank" href="{{ $data->instagram }}"><i class="fab fa-instagram"></i></a></li>
					@endif
					@if ($data->facebook)
						<li><a target="_blank" href="{{ $data->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
					@endif
					@if ($data->twitter)
						<li><a target="_blank" href="{{ $data->twitter }}"><i class="fab fa-twitter"></i></a></li>
					@endif
					@if ($data->youtube)
						<li><a target="_blank" href="{{ $data->youtube }}"><i class="fab fa-youtube"></i></a></li>
					@endif
				</ul>
			</div>
		</div>
		<div class="header-nav">
			<div class="container">
				<div class="header-nav-cover">
					<nav class="nav-menu menu">
						<ul class="nav-list">
							<li><a href="#home">home</a></li>
							<li><a href="#about">about</a></li>
							<li><a href="#schedule">schedule</a></li>
							<li><a href="#location">location</a></li>
						</ul>
					</nav>
					<a href="#register" id="registration-navbar" class="btn btn-white"><span>registration</span></a>
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
							<img class="marathon-img" src="{{ asset('/storage/uploads/' . $data->banner1) }}" alt="Event Image">
						</div>
						<div class="scene-item" data-depth="0.5">
							<div class="slider-location">{{ $data->kota }} <span class="date">{{ date('d M Y', strtotime($data->tanggal)) }}</span> <br> {{ $data->nama }}</div>
						</div>
						@php
							$tagline1 	= explode(' ', $data->tagline_banner1);
							$tagline1_1 = $tagline1[0];
							$tagline1_2 = $tagline1[1];
							$tagline1_3 = $tagline1[2];
						@endphp
						<div class="scene-item" data-depth="0.35">
							<div class="marathon-text-left">{{ $tagline1_1 }}<br>{{ $tagline1_2 }}</div>
						</div>
						<div class="scene-item" data-depth="0.35">
							<div class="marathon-text-right">{{ $tagline1_3 }}</div>
						</div>
					</div>
				</div>

			@if ($data->banner2 && $data->tagline_banner2) 
				<div class="marathon-slide marathon-slide-1">
					<div data-hover-only="true" data-pointer-events="true" data-scalar-y="0" class="scene">
						<div class="scene-item" data-depth="0.2">
							<span class="marathon-effect" style="background-image: url({{ asset('assets/images/landing/effect-slider-marathon.svg') }});"></span>
						</div>
						<div class="scene-item" data-depth="0.2">
							<img class="marathon-img" src="{{ asset('/storage/uploads/' . $data->banner2) }}" alt="Event Image">
						</div>
						<div class="scene-item" data-depth="0.5">
							<div class="slider-location">{{ $data->kota }} <span class="date">{{ date('d M Y', strtotime($data->tanggal)) }}</span> <br> {{ $data->nama }}</div>
						</div>
						@php
							$tagline2 	= explode(' ', $data->tagline_banner2);
							$tagline2_1 = $tagline2[0];
							$tagline2_2 = $tagline2[1];
							$tagline2_3 = $tagline2[2];
						@endphp
						<div class="scene-item" data-depth="0.35">
							<div class="marathon-text-left">{{ $tagline2_1 }}<br>{{ $tagline2_2 }}</div>
						</div>
						<div class="scene-item" data-depth="0.35">
							<div class="marathon-text-right">{{ $tagline2_3 }}</div>
						</div>
					</div>
				</div>
			@endif

			@if ($data->banner3 && $data->tagline_banner3) 
				<div class="marathon-slide marathon-slide-1">
					<div data-hover-only="true" data-pointer-events="true" data-scalar-y="0" class="scene">
						<div class="scene-item" data-depth="0.2">
							<span class="marathon-effect" style="background-image: url({{ asset('assets/images/landing/effect-slider-marathon.svg') }});"></span>
						</div>
						<div class="scene-item" data-depth="0.2">
							<img class="marathon-img" src="{{ asset('/storage/uploads/' . $data->banner3) }}" alt="Event Image">
						</div>
						<div class="scene-item" data-depth="0.5">
							<div class="slider-location">{{ $data->kota }} <span class="date">{{ date('d M Y', strtotime($data->tanggal)) }}</span> <br> {{ $data->nama }}</div>
						</div>
						@php
							$tagline3 	= explode(' ', $data->tagline_banner3);
							$tagline3_1 = $tagline3[0];
							$tagline3_2 = $tagline3[1];
							$tagline3_3 = $tagline3[2];
						@endphp
						<div class="scene-item" data-depth="0.35">
							<div class="marathon-text-left">{{ $tagline3_1 }}<br>{{ $tagline3_2 }}</div>
						</div>
						<div class="scene-item" data-depth="0.35">
							<div class="marathon-text-right">{{ $tagline3_3 }}</div>
						</div>
					</div>
				</div>
			@endif

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
			<h2 class="title">What We Do</h2>
			<div class="row">
				<div class="col-lg-6 our-mission-img">
					<span>
						<img class="mission-img-effect-1" src="{{ asset('assets/images/landing/our-mission-2.svg') }}" alt="img">
						<img class="mission-img rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/DEFAULT-OUR-MISSION.jpg') }}" alt="img">
						<img class="mission-img-effect-4" src="{{ asset('assets/images/landing/tringle-gray-little.svg') }}" alt="img">
					</span>
				</div>
				<div class="col-lg-6 our-mission-info">
					<ul class="mission-meta">
						<li><i aria-hidden="true" class="fas fa-map-marker-alt"></i>{{ $data->kota }}</li>
						<li><i aria-hidden="true" class="fas fa-calendar-alt"></i>{{ date('d M Y', strtotime($data->tanggal)) }}</li>
					</ul>
					<h4>Speed, Strength, Samba!</h4>
					@if (!empty($data->deskripsi))
						<p>{{ $data->deskripsi }}</p>
					@else
						<p>At Samba, we bring cyclists together—whether casual riders or competitive athletes—to experience scenic and exciting rides. Cycling is more than a sport; it’s a lifestyle that promotes health, sustainability, and community. Join us and ride towards new adventures!</p>
					@endif
					<div class="mission-number-cover">
						<div class="mission-number-item">
							<div class="number">{{ $data->stok }}+</div>
							<span>Participants</span>
						</div>
						<div class="mission-number-item">
							<div class="number">{{ $data->jarak }}km</div>
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
			<div class="row" style="box-shadow: 10px 8px 20px -6px rgba(0, 0, 0, 0.15);">
				<div class="col-xl-6">
					<div class="event-schedule-tabs">
						
						@foreach ($schedules as $schedule)
							<div class="event-schedule-item">
								<div class="schedule-item-info">
									<div class="date">{{ date('H:i', strtotime($schedule->jam)) }}</div>
									<h4>{{ $schedule->nama }}</h4>
									<div class="schedule-info-content" style="{{ $loop->first ? 'display: block;' : '' }}">
										<p>{{ $schedule->deskripsi }}</p>
									</div>
								</div>
							</div>
						@endforeach

					</div>
				</div>
				<div class="col-md-6 event-schedule-img">
					<div class="schedule-img-wrap">
						<img class="schedule-effect-tringle" src="{{ asset('assets/images/landing/tringle-gray-little.svg') }}" alt="img">
						<img class="schedule-img-effect" src="{{ asset('assets/images/landing/our-mission-2.svg') }}" alt="img">
						<img class="schedule-img rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/landing/Trial/celebration-small.png') }}" alt="img">
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
						<img class="rx-lazy map-img" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('/storage/uploads/' . $data->rute) }}" alt="img">
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
								<div class="number">{{ $data->jarak }}km</div>
								<span>Ride distance</span>
							</div>
						</div>
						@if($data->lat_start && $data->long_start && $data->lat_end && $data->long_end)
							<a class="btn mt-3" href="https://www.google.com/maps/dir/?api=1&origin={{ $data->lat_start }},{{ $data->long_start }}&destination={{ $data->lat_end }},{{ $data->long_end }}" target="_blank"><span>Open in Google Maps</span></a>
						@endif
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- ============= MAP-WITH-ROUTE END ============= -->

	<section class="type-register" style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
		<div class="container" style="display: flex; justify-content: center; gap: 1rem; backdrop-filter: blur(10px); background-color: rgba(255, 255, 255, 0.5); padding: 2rem; margin: 2rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
			<button type="button" class="btn btn-register-personal"><span>Register as Personal</span></button>
			<button type="button" class="btn btn-register-komunitas"><span>Register as Komunitas</span></button>
		</div>
	</section>

	<!-- ============= PERSONAL ============= -->
	<section id="register" class="s-marathon-register">
		<img src="{{ asset('assets/images/landing/tringle-gray-little.svg') }}" alt="img" class="register-img-effect-2">
		<div class="container">
			<div class="marathon-register-row row">
				<div class="col-md-6 col-12">
					<img src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('/storage/uploads/' . $data->size_chart) }}" alt="img" class="register-img rx-lazy">
				</div>
				<div class="marathon-register col-md-6 col-12">
					<img src="{{ asset('assets/images/landing/our-mission-2.svg') }}" alt="img" class="register-img-effect-1">
					<h2 class="title"><span>Register as Personal</span></h2>
					<form id='registerPersonal'>
						@csrf
						<ul class="form-cover">
							<li class="inp-cover inp-name" style="width: 100%"><input id="nama" type="text" name="nama" placeholder="Name" autocomplete="off" required></li>
							<li class="inp-cover"><input id="phone" class="input-number" type="text" name="phone" placeholder="No Telepon" autocomplete="off" pattern="\d*" required></li>
							<li class="inp-cover inp-email"><input id="email" type="email" name="email" placeholder="E-mail" autocomplete="off" required></li>
							<li class="inp-cover"><input id="tanggal_lahir" class="tanggal" type="text" name="tanggal_lahir" placeholder="Tanggal Lahir" autocomplete="off" required></li>
							<li class="inp-cover">
								<select class="nice-select" id="gender" name="gender" autocomplete="off">
									<option value="" style="font-size: 14px;">Jenis Kelamin</option>
									<option value="L" style="font-size: 14px;">Laki-Laki</option>
									<option value="P" style="font-size: 14px;">Perempuan</option>
								</select>
							</li>
							<li class="inp-cover" style="z-index: 1">
								<select class="nice-select" id="blood" name="blood" placeholder="Gol Darah" autocomplete="off">
									<option value="" style="font-size: 14px;">Gol Darah</option>
									<option value="A" style="font-size: 14px;">A</option>
									<option value="B" style="font-size: 14px;">B</option>
									<option value="AB" style="font-size: 14px;">AB</option>
									<option value="O" style="font-size: 14px;">O</option>
								</select>
							</li>
							<li class="inp-cover" style="z-index: 0"><input id="nik" class="input-number" type="text" name="nik" placeholder="No KTP" autocomplete="off" required></li>
							<li class="inp-cover" style="z-index: 0"><input id="telp_emergency" class="input-number" type="text" name=" telp_emergency" placeholder="No Kontak Darurat" autocomplete="off" required></li>
							<li class="inp-cover">
								<select class="nice-select" id="hubungan_emergency" name="hubungan_emergency" placeholder="Hub Kontak Darurat" autocomplete="off">
									<option value="" style="font-size: 14px;">Hubungan</option>
									<option value="SAUDARA" style="font-size: 14px;">Saudara</option>
									<option value="ORANG TUA" style="font-size: 14px;">Orang Tua</option>
									<option value="SUAMI/ISTRI" style="font-size: 14px;">Suami/Istri</option>
									<option value="ANAK" style="font-size: 14px;">Anak</option>
								</select>
							</li>
							<li class="inp-cover" style="z-index: 0"><input id="kota" type="text" name="kota" placeholder="Kota" autocomplete="off" required></li>
							<li class="inp-cover" style="z-index: 0"><input id="nama_komunitas" type="text" name="nama_komunitas" placeholder="Nama Komunitas" autocomplete="off"></li>
							<li class="inp-cover" style="width: 100%; z-index: 0;"><input id="alamat" type="text" name="alamat" placeholder="Alamat" autocomplete="off"></li>
							<li class="inp-cover" style="width: 100%">
								<select class="nice-select" id="jersey" name="jersey" autocomplete="off">
									<option value="">Jersey</option>
									<option value="S">S</option>
									<option value="M">M</option>
									<option value="L">L</option>
									<option value="XL">XL</option>
									<option value="XXL">XXL</option>
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
	<!-- ============= PERSONAL ============= -->

	<!--================== KOMUNITAS ==================-->
	<section id="register-komunitas" class="s-buy-ticket dance-buy-ticket d-none" style="background-image: url(assets/img/effect-form-dance.svg);">
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
								<li class="inp-cover inp-name" style="width: 100%"><input id="nama_komunitas" type="text" name="nama_komunitas" placeholder="Nama Komunitas" autocomplete="off" required></li>
								<li class="inp-cover inp-name"><input id="koordinator" type="text" name="koordinator" placeholder="Nama Koordinator" autocomplete="off" required></li>
								<li class="inp-cover inp-name"><input id="email" type="email" name="email" placeholder="Email Koordinator" autocomplete="off" required></li>
								<li class="inp-cover inp-name"><input id="kota" type="text" name="kota" placeholder="Kota Komunitas" autocomplete="off" required></li>
								<li class="inp-cover inp-name"><input id="phone" class="input-number" type="text" name="phone" placeholder="Kontak Koordinator" autocomplete="off" required></li>
								
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
													<td><input type="text" name="nama[]" placeholder="Nama Peserta" autocomplete="off" required></td>
													<td>
														<select class="nice-select" id="gender" name="gender[]" autocomplete="off">
															<option value="">Jenis Kelamin</option>
															<option value="L" style="font-size: 14px;">Laki-laki</option>
															<option value="P" style="font-size: 14px;">Perempuan</option>
														</select>
													</td>
													<td><input type="date" name="tanggal_lahir[]" class="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" autocomplete="off" required></td>
													<td><input type="text" class="input-number" name="nik[]" placeholder="No KTP" autocomplete="off" required></td>
													<td><input type="text" class="input-number" name="telp_emergency[]" placeholder="No Telepon" autocomplete="off" required></td>
													<td>
														<select class="nice-select" id="hubungan_emergency[]" name="hubungan_emergency[]" placeholder="Hub Kontak Darurat" autocomplete="off">
															<option value="" style="font-size: 14px;">Hub Kontak Darurat</option>
															<option value="SAUDARA" style="font-size: 14px;">Saudara</option>
															<option value="ORANG TUA" style="font-size: 14px;">Orang Tua</option>
															<option value="SUAMI/ISTRI" style="font-size: 14px;">Suami/Istri</option>
															<option value="ANAK" style="font-size: 14px;">Anak</option>
														</select>
													</td>
													<td>
														<select class="nice-select" id="blood" name="blood[]" placeholder="Gol Darah" autocomplete="off">
															<option value="">Gol Darah</option>
															<option value="A" style="font-size: 14px;">A</option>
															<option value="B" style="font-size: 14px;">B</option>
															<option value="AB" style="font-size: 14px;">AB</option>
															<option value="O" style="font-size: 14px;">O</option>
														</select>
													</td>
													<td>
														<select class="nice-select" id="jersey" name="jersey[]" placeholder="Ukuran Jersey" autocomplete="off" style="width: 220px !important;">
															<option value="">Jersey</option>
															<option value="S" style="font-size: 14px;">S</option>
															<option value="M" style="font-size: 14px;">M</option>
															<option value="L" style="font-size: 14px;">L</option>
															<option value="XL" style="font-size: 14px;">XL</option>
															<option value="XXL" style="font-size: 14px;">XXL</option>
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
									<div class="price-final-text"><span id="totalHarga">0</span></div>
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
	<!--================ KOMUNITAS ================-->

	<!--=================== S-CLIENTS ===================-->
	<section class="s-clients" @if ($sponsors->count() == 0) style="padding-bottom: 0 !important;" @endif>
		@if ($sponsors->count() > 0)
			<div class="container">
				<h2 class="title"><span>Our Sponsors</span></h2>
				<div class="clients-cover">

					@foreach ($sponsors as $sponsor)
						<div class="client-slide">
							<div class="client-slide-cover">
								<img src="{{ asset('/storage/uploads/' . $sponsor->filename) }}" alt="img">
							</div>
						</div>
					@endforeach
					
				</div>
			</div>
		@endif
	</section>
	<!--================= S-CLIENTS END =================-->

	<!--================== S-INSTAGRAM ==================-->
	<section class="s-instagram">
		<h2 class="title"><span>Gallery</span></h2>
		<div class="instagram-cover">

			@php
				$total_images 	= count($images);
				$sisa 			= 10 - $total_images;

				$default_images = ['DEFAULT-EVENT-1.jpg', 'DEFAULT-EVENT-2.jpg', 'DEFAULT-EVENT-3.jpg', 'DEFAULT-EVENT-4.jpg', 'DEFAULT-EVENT-5.jpg', 'DEFAULT-EVENT-6.jpg', 'DEFAULT-EVENT-7.jpg', 'DEFAULT-EVENT-8.jpg', 'DEFAULT-EVENT-9.jpg', 'DEFAULT-EVENT-10.jpg'];
				shuffle($default_images); // Randomize the default images
			@endphp

			@foreach ($images as $image)
				<a href="#" onclick="return false;" class="instagram-item">
					<img class="rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('/storage/uploads/' . $image->filename) }}" alt="img">
				</a>
			@endforeach

			@for ($index = 0; $index < $sisa; $index++)
				<a href="#" onclick="return false;" class="instagram-item">
					<img class="rx-lazy" src="{{ asset('assets/images/landing/placeholder-all.png') }}" data-src="{{ asset('assets/images/' . $default_images[$index]) }}" alt="img">
				</a>
			@endfor

		</div>
	</section>
	<!--================ S-INSTAGRAM END ================-->

	<!--==================== FOOTER ====================-->
	<footer>
		<div class="container">
			<div class="footer-box row justify-content-between">
				<div class="footer-cont col-12 col-sm-6 col-lg-4">
					<a href="#" class="logo"><img src="{{ asset('assets/images/logo-brand-side-yellow.png') }}" alt="logo" style="width: 11rem; height: auto;"></a>
					<p>{{ $data->lokasi }}</p>
					<ul class="footer-contacts">
						<li class="footer-phone">
							<i aria-hidden="true" class="fas fa-phone"></i>
							<a href="tel:{{ $data->phone }}">{{ $data->phone }}</a>
						</li>
						<li class="footer-email">
							<a href="mailto:{{ $data->email }}">{{ $data->email }}</a>
						</li>
					</ul>
					<div class="footer-copyright"><a target="_blank" href="https://sambabikes.com">Samba Bikes</a> © 2025. All Rights Reserved.</div>
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
					@if($data->instagram || $data->facebook || $data->twitter || $data->youtube)
						<div class="footer-link">
							<h5>Social</h5>
							<ul class="footer-list">
								@if($data->instagram)
									<li><a href="{{ $data->instagram }}" target="_blank">Instagram</a></li>
								@endif
								@if($data->facebook)
									<li><a href="{{ $data->facebook }}" target="_blank">Facebook</a></li>
								@endif
								@if($data->twitter)
									<li><a href="{{ $data->twitter }}" target="_blank">Twitter</a></li>
								@endif
								@if ($data->youtube)
									<li><a href="{{ $data->youtube }}" target="_blank">Youtube</a></li>
								@endif
							</ul>
						</div>
					@endif
				</div>
				<div class="footer-subscribe col-12 col-sm-6 col-lg-4">
					<h5>Statistik Pengunjung</h5>
					<div class="row clearfix text-center text-md-start justify-content-center justify-content-md-start">
						<div class="col-md-6 col-3" style="text-align: left;">
							<ul>
								<li><span href="#">Harian</span></li>
								<li><span href="#">Bulanan</span></li>
								<li><span href="#">Tahunan</span></li>
							</ul>
						</div>
						<div class="col-md-6 col-3" style="text-align: right;">
							<ul>
								<li><span href="#">{{ $statistik->counterHari }}</span></li>
								<li><span href="#">{{ $statistik->counterBulan }}</span></li>
								<li><span href="#">{{ $statistik->counterTahun }}</span></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>

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
						Silakan lakukan transfer pembayaran ke rekening <strong>{{ $data->bank }}</strong> dengan nomor <strong>{{ $data->nomor_rekening }}</strong> atas nama <strong>{{ $data->nama_rekening }}</strong>. 
						Setelah melakukan transfer, mohon kirim bukti pembayaran melalui WhatsApp ke <a href="https://wa.me/{{ $data->phone }}" target="_blank"><strong>{{ $data->phone }}</strong></a>.
					</div>
					<!-- Pesan Konfirmasi -->
					<div class="info-pembayaran mb-3 text-success">
						Kami akan segera memproses pembayaran Anda setelah bukti transfer diterima.
					</div>
					<div class="info-pembayaran mb-3 text-success">
						<strong>Catatan</strong>: Rincian lengkap pembayaran telah kami kirimkan ke email Anda. Silakan periksa inbox (atau folder spam) untuk memastikan Anda menerima informasinya.
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
	</div>
	
	<!-- Modal Error -->
	<div id="modalError" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Perhatian</h5>
					<button type="button" class="close" onclick="closeModalError()">&times;</button>
				</div>
				<div class="modal-body">
					<!-- Informasi Pembayaran -->
					<div class="info-error" id="info-error">Terjadi Kesalahan, Mohon Hubungi Admin 🙏</div>
				</div>
				<div class="modal-footer">
					<div class="btn-form-cover">
						<button type="button" class="btn btn-secondary" onclick="closeModalError()"><span>Tutup</span></button>
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
	<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.min.js" integrity="sha512-LGHBR+kJ5jZSIzhhdfytPoEHzgaYuTRifq9g5l6ja6/k9NAOsAi5dQh4zQF6JIRB8cAYxTRedERUF+97/KuivQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="{{ asset('assets/js/apps/landing/slick.min.js') }}"></script>
	<script src="{{ asset('assets/js/apps/landing/rx-lazy.js') }}"></script>
	<script src="{{ asset('assets/js/apps/landing/jquery.nice-select.js') }}"></script>
	<script src="{{ asset('assets/js/apps/landing/parallax.min.js') }}"></script>
	<script src="{{ asset('assets/js/apps/landing/scripts.js') }}"></script>

	<script src="{{ asset('assets/js/apps/landing/landing.js') . '?v=' . time() }}"></script>

	<script>

		var phone = "{{ $data->phone }}";

		// Check if the user is offline
        if (!navigator.onLine) {
            // User is offline, show SweetAlert notification
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'You are currently offline. Please check your internet connection and try again.',
            });
        }

        window.addEventListener('online', () => {
            Swal.fire({
                icon: 'success',
                title: 'Great!',
                text: 'You are back online. Welcome back!',
            });
        });

		$(window).on("scroll", function () {
			if ($(".scroll-to-top").length) {
			var strickyScrollPos = 100;
			if ($(window).scrollTop() > strickyScrollPos) {
				$(".scroll-to-top").fadeIn(500);
			} else if ($(this).scrollTop() <= strickyScrollPos) {
				$(".scroll-to-top").fadeOut(500);
			}
			}
		});

		if ($(".scroll-to-target").length) {
			$(".scroll-to-target").on("click", function () {
			var target = $(this).attr("data-target");
			// animate
			$("html, body").animate(
				{
				scrollTop: $(target).offset().top
				},
				1000
			);

			return false;
			});
		}

		// click button regiter personal then show section register and hide section register komunitas
		$(document).on('click', '.btn-register-personal', function() {
			$('#registration-navbar').attr('href', '#register');
			$('#register').removeClass('d-none').fadeIn(500);
			$('#register-komunitas').fadeOut(500).addClass('d-none');
			$('html, body').animate({
				scrollTop: $("#register").offset().top
			}, 500);
		});

		// click button register komunitas then show section register komunitas and hide section register
		$(document).on('click', '.btn-register-komunitas', function() {
			$('#registration-navbar').attr('href', '#register-komunitas');
			$('#register-komunitas').removeClass('d-none').fadeIn(500);
			$('#register').fadeOut(500).addClass('d-none');
			$('html, body').animate({
				scrollTop: $("#register-komunitas").offset().top
			}, 500);
		});

		// nav link click 
		$(document).on('click', '.nav-list li a', function() {
			$('.nav-menu').toggleClass('active');
			$('.nav-btn').toggleClass('active');
			$('body').toggleClass('no-scroll');
			return false;
		});

		if( $( '#clockdiv' )[0] ){
			function getTimeRemaining(endtime) {
				var t = Date.parse(endtime) - Date.parse(new Date());
				var seconds = Math.floor((t / 1000) % 60);
				var minutes = Math.floor((t / 1000 / 60) % 60);
				var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
				var days = Math.floor(t / (1000 * 60 * 60 * 24));
				return {
					'total': t,
					'days': days,
					'hours': hours,
					'minutes': minutes,
					'seconds': seconds
				};
			}

			function initializeClock(id, endtime) {
				var clock = document.getElementById(id);
				var daysSpan = clock.querySelector('.days');
				var hoursSpan = clock.querySelector('.hours');
				var minutesSpan = clock.querySelector('.minutes');
				var secondsSpan = clock.querySelector('.seconds');

				function updateClock() {
					var t = getTimeRemaining(endtime);

					if (t.total <= 0) {
						daysSpan.innerHTML = '0';
						hoursSpan.innerHTML = '00';
						minutesSpan.innerHTML = '00';
						secondsSpan.innerHTML = '00';
						clearInterval(timeinterval);
					} else {
						daysSpan.innerHTML = t.days;
						hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
						minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
						secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
					}
				}

				updateClock();
				var timeinterval = setInterval(updateClock, 1000);
			}

			initializeClock('clockdiv', "{{ $data->tanggal }}");
		}
	</script>

</body>
</html>
