<?php
$logo = \helper\options::options_by_key_type('logo');
$title = \helper\options::options_by_key_type('site_name');
$menu_header = \helper\menu::find_menu_by_menugroup('menu_header');
$menu_header = \helper\menu::to_menu_directory_style($menu_header);
?>

<body class=" ">
	<div class="page">
		<div class="page__wrapper">
			<?php if ($enable_ads) : ?>
				<div class="ads-slot myads ads_left">
					<?php echo \helper\themes::get_layout('ads_layout/doc', array('enable_ads' => $enable_ads)); ?>
				</div>
			<?php endif; ?>
			<?php if ($enable_ads) : ?>
				<div class="ads-slot myads ads_right">
					<?php echo \helper\themes::get_layout('ads_layout/doc', array('enable_ads' => $enable_ads)); ?>
				</div>
			<?php endif; ?>

			<section class="nav-wrap">
				<div class="container">
					<div class="navbar">
						<div class='bx bx-menu'>☰</div>
						<div class="logo">
							<a href="/" class="logo" title="<?php echo $title ?>">
								<img itemprop="logo" class="lazy" src="<?php echo '/' . DIR_THEME ?>rs/imgs/pixel.png" data-src="<?php echo \helper\image::get_thumbnail($logo, '', 50, 'h') ?>" width="100%" height="50" title="<?php echo $title ?>" alt="<?php echo $title ?> logo" />
							</a>
						</div>
						<div class="nav-links">
							<div class="sidebar-logo">
								<div class='bx bx-x bx-menu'>✖</div>
							</div>

							<ul class="list_links">
								<?php foreach ($menu_header as $k => $menu) : ?>
									<?php if ($k < 5) : ?>
										<li><a href="<?php echo $menu->url ?>" title="<?php echo $menu->title ?>"><?php echo $menu->title ?></a></li>
									<?php endif ?>
								<?php endforeach ?>

								<?Php if (count($menu_header) > 5 || $external) : ?>
									<li>
										<a href="javascript:void(0)" role="button" class="menu_more" title="More">More</a>
										<svg xmlns="http://www.w3.org/2000/svg" class='bx bxs-chevron-down htmlcss-arrow arrow_more' width="20px" height="20px" viewBox="0 0 24 24" fill="none">
											<path stroke="#fff" fill="#fff" fill-rule="evenodd" clip-rule="evenodd" d="M7.71967 9.96967C8.01256 9.67678 8.48744 9.67678 8.78033 9.96967L12 13.1893L15.2197 9.96967C15.5126 9.67678 15.9874 9.67678 16.2803 9.96967C16.5732 10.2626 16.5732 10.7374 16.2803 11.0303L12.5303 14.7803C12.2374 15.0732 11.7626 15.0732 11.4697 14.7803L7.71967 11.0303C7.42678 10.7374 7.42678 10.2626 7.71967 9.96967Z" />
										</svg>

										<ul class="htmlCss-sub-menu sub-menu">
											<?php foreach ($menu_header as $k => $menu) :
												if ($k >= 5) : ?>
													<?php  ?>
													<li><a href="<?php echo $menu->url ?>" title="<?php echo $menu->title ?>"><?php echo $menu->title ?></a>
														<?php  ?>
												<?php endif;
											endforeach ?>

												<?php foreach ($external as $k => $menu) : ?>
													<li <?php echo $k == 0 ? 'style="padding-top: 6px; border-top: 1px solid #f1f1f1"' : '' ?>>
														<a href="<?php echo $menu->url ?>" target="<?php echo $menu->target ?>" rel="<?php echo $menu->nofollow ? 'nofollow' : 'dofollow' ?>" title="<?php echo $menu->title ?>"><?php echo $menu->title ?></a>
													</li>
												<?php endforeach ?>
										</ul>
									</li>
								<?php endif; ?>
							</ul>
						</div>

						<div class="search-box">
							<button class="bx bx-search btn_search" type="button" aria-label="Search">
								<!-- <span class="icon-search"></span> -->
								<svg xmlns="http://www.w3.org/2000/svg" class="icon-search btn_open" width="28px" height="28px" viewBox="0 0 24 24">
									<path d="M21.71,20.29,18,16.61A9,9,0,1,0,16.61,18l3.68,3.68a1,1,0,0,0,1.42,0A1,1,0,0,0,21.71,20.29ZM11,18a7,7,0,1,1,7-7A7,7,0,0,1,11,18Z"></path>
								</svg>
								<div class='bx bx-x btn_close hidden_btn_close'>✖</div>
							</button>
							<div class="input-box">
								<input class="input_search" type="text" value="<?php echo $keywords ?>" placeholder="Search..." aria-label="Search" autocomplete="off">
								<button class="btn_get_search" type="submit" aria-label="Search">
									<svg xmlns="http://www.w3.org/2000/svg" class="icon-search" width="28px" height="28px" viewBox="0 0 24 24">
										<path d="M21.71,20.29,18,16.61A9,9,0,1,0,16.61,18l3.68,3.68a1,1,0,0,0,1.42,0A1,1,0,0,0,21.71,20.29ZM11,18a7,7,0,1,1,7-7A7,7,0,0,1,11,18Z"></path>
									</svg>
								</button>
							</div>
						</div>
					</div>
				</div>
			</section>