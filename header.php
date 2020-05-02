<?php if( !defined( 'ABSPATH')){ exit(); }
global $or_template_directory, $or_site_url, $exchangebox;

$ui = wp_get_current_user();
$user_id = intval($ui->ID);

$themechange = get_option('themechange');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php wp_title(); ?></title>

	<?php wp_head(); ?>

	<?php
	$vers = '2.4';
	if($exchangebox->is_debug_mode()){
		$vers = current_time('timestamp');
	}

	$checktheme = pn_strip_input(is_isset($themechange,'checktheme'));
	if($checktheme and $checktheme != 'blue'){
	?>
		<link rel="stylesheet" href="<?php echo $or_template_directory; ?>/<?php echo $checktheme; ?>.css?ver=<?php echo $vers; ?>" type="text/css" />
	<?php
	}
	?>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="liMarquee/liMarquee.css"/>
    <script type="text/javascript" src="liMarquee/jquery-1.8.3.min.js"></script>
    <script type="text/javascript"src="liMarquee/jquery.liMarquee.js"></script>
    <script type="text/javascript">
        $(window).load(function(){
            $('.str').liMarquee();
        });
    </script>

    <script src="//code.jivosite.com/widget/y6bVR3NXXs" async></script>


</head>

<body <?php body_class(); ?>>
<div class="str">&nbsp;
    тест &nbsp; тест &nbsp; тест
</div>

<?php do_action('pn_header_theme'); ?>
<!-- top rates -->
<div class="header__rates">
    <div class="full">
        <?php
        // MOEX RATE

        $dataMoex = file_get_contents('https://iss.moex.com/iss/engines/currency/markets/selt/securities.jsonp?iss.meta=off&iss.only=marketdata&securities=CETS%3AUSD000UTSTOM%2CCETS%3AEUR_RUB__TOM');
        $dataJsonMoex = json_decode($dataMoex);
        $usd_rub_rate_moex = $dataJsonMoex->marketdata->data[1][41];
        if (is_null($usd_rub_rate_moex)) {
            $usd_rub_rate_moex = $dataJsonMoex->marketdata->data[1][8];
        }

        //Binance Rate


        $dataBinance = file_get_contents('https://api.binance.com/api/v3/ticker/price');
        $dataBinanceJson = json_decode($dataBinance);
        //            echo "<pre>";
        //
        //            var_dump($dataBinanceJson);   fdfdfdfd
        $BTC_USDT_RATE_binance = ($dataBinanceJson[11]->price);
        $BTC_RUB_RATE = $BTC_USDT_RATE_binance * $usd_rub_rate_moex;

        $ETH_USDT_RATE = ($dataBinanceJson[12]->price);
        $ETH_RUB_RATE_binance = $ETH_USDT_RATE * $usd_rub_rate_moex;

        ?>

<!--        <div class="header-rates__wrap">-->

            <div class="str">12332
<!--                    1222 USD =  --><?php //echo round($usd_rub_rate_moex,2). " RUB "; ?><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
<!--                    1 BTC =  --><?php //echo round($BTC_RUB_RATE, 2). " RUB"; ?><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
<!--                    1 BTC =  --><?php //echo round($BTC_USDT_RATE_binance, 2). " USD"; ?><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
<!--                    1 ETH =  --><?php //echo round($ETH_RUB_RATE_binance, 2). " RUB"; ?><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
<!--                    1 ETH =  --><?php //echo round($ETH_USDT_RATE, 2). " USD"; ?><!--</></div>-->
            </div>

    </div>
</div>
<div id="container">

 <!--Техобслуживание-->
	<!--<div class="headline">-->
	<!--    Внимание! Сайт на техобслуживании. Некоторые пары обмена могут быть недоступны. Приносим извинения за неудобства.-->
	<!--</div>-->
<!--Техобслуживание-->




    <div id="header">
	    <div class="header">

		    <div class="logo">
		        <a href="<?php echo $or_site_url;?>">
		            <img src="/wp-content/themes/exchangeboxtheme2/images/logo_selectcash.svg" alt="Logo Select.cash">
		        </a>

				<!-- <?php
				$logo = get_logotype();
				$textlogo = get_textlogo();
				if($logo){
				?>
					<div class="imglogo">
						<a href="<?php echo $or_site_url;?>" title="<?php bloginfo('name');?>"><img src="<?php echo $logo; ?>" alt="<?php bloginfo('name');?>" /></a>
					</div>
				<?php
				} else {
					if(!$textlogo){
						$textlogo = str_replace(array('http://','https://','www.'),'',$or_site_url);
					}
				?>
					<div class="textlogo"><a href="<?php echo $or_site_url;?>" title="<?php bloginfo('name');?>"><?php echo get_caps_name($textlogo); ?></a></div>
					<div class="logodescr"><?php bloginfo('description');?></div>
				<?php
				}
				?> -->
			</div>

		<div id="menutopped">
			<div id="topmenu">
				<div class="topmenu">
					<?php
					if($user_id){
						$theme_location = 'the_top_menu_user';
					} else {
						$theme_location = 'the_top_menu';
					}
					wp_nav_menu(
						array(
							'sort_column' => 'menu_order',
							'container' => 'div',
							'container_class' => 'menu',
							'menu_class' => 'tmenu js_menu',
							'menu_id' => '',
							'depth' => '3',
							'fallback_cb' => 'no_menu',
							'theme_location' => $theme_location
						)
					);
					?>
						<div class="clear"></div>
				</div>
			</div>
		</div>

			<?php
			$skype = pn_strip_input(is_isset($themechange,'skype'));
			$icq = pn_strip_input(is_isset($themechange,'icq'));
			$mail = pn_strip_input(is_isset($themechange,'mail'));
			$tel = pn_strip_input(is_isset($themechange,'tel'));
			$telegram = pn_strip_input(is_isset($themechange,'telegram'));
			$viber = pn_strip_input(is_isset($themechange,'viber'));
			$whatsup = pn_strip_input(is_isset($themechange,'whatsup'));
			$jabber = pn_strip_input(is_isset($themechange,'jabber'));
			$regrab = is_isset($themechange,'regrab');
			?>
		<!--	<span class="rcl-tab-button" data-tab="exit2" id="tab-button-exit2">
			<a href="<?php echo wp_logout_url( get_permalink() ); ?>" class="recall-button" style="margin-top:0px;">
			<i class="fa fa-sign-out"></i>
					<span><b>Выход</b></span></a></span>  кнопка выхода из ЛК		--> 
			<div class="head_right">
				<div class="head_righttop">
					<?php if($icq){ ?><div class="hicon icq"><?php echo $icq; ?></div><?php } ?>
					<?php if($skype){ ?><div class="hicon skype"><a href="skype:<?php echo $skype; ?>?add" title="<?php _e('Add to skype','pntheme'); ?>"><?php echo $skype; ?></a></div><?php } ?>
					<?php if($telegram){ ?><div class="hicon telegram"><a href="https://tlgg.ru/<?php echo $telegram; ?>"><?php echo $telegram; ?></a></div><?php } ?>
					<?php if($viber){ ?><div class="hicon viber"><a href="viber://chat?number=<?php echo $viber; ?>"><?php echo $viber; ?></a></div><?php } ?>
					<?php if($whatsup){ ?><div class="hicon whatsup"><a href="https://api.whatsapp.com/send?phone=<?php echo $whatsup; ?>"><?php echo $whatsup; ?></a></div><?php } ?>
					<?php if($jabber){ ?><div class="hicon jabber"><a href="xmpp:<?php echo $jabber; ?>"><?php echo $jabber; ?></a></div><?php } ?>
					<?php if($mail){ ?><div class="hicon email"><a href="mailto:<?php echo antispambot($mail); ?>"><?php echo antispambot($mail); ?></a></div><?php } ?>
						<div class="clear"></div>
				</div>

				<div class="head_rightbot">
					<div class="head_worktime"><?php echo apply_filters('comment_text',$regrab); ?></div>
					<div class="head_phone"><?php echo $tel; ?></div>
						<div class="clear"></div>
				</div>
			</div>

			    <div class="clear"></div>
		</div>
	</div>

	<div id="cwrap">
		<!-- <div id="menutopped">
			<div id="topmenu">
				<div class="topmenu">
					<?php
					if($user_id){
						$theme_location = 'the_top_menu_user';
					} else {
						$theme_location = 'the_top_menu';
					}
					wp_nav_menu(
						array(
							'sort_column' => 'menu_order',
							'container' => 'div',
							'container_class' => 'menu',
							'menu_class' => 'tmenu js_menu',
							'menu_id' => '',
							'depth' => '3',
							'fallback_cb' => 'no_menu',
							'theme_location' => $theme_location
						)
					);
					?>
						<div class="clear"></div>
				</div>
			</div>
		</div> -->

		<div class="content">
			<div class="contentzone">