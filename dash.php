<?php
/* 
* template name: Dashboard
*/
if(!is_user_logged_in()){
	global $wp_query;
	$wp_query->set_404();
	status_header( 404 );
	get_template_part( 404 ); exit();
}

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php if (is_home()): ?>
	<title>Dossett.dev | Home</title>
	<?php else: ?>
	<title>Dossett.dev | <?php echo get_the_title(); ?></title>
	<?php endif; ?>
	<style>
		@font-face{
			font-family: 'roboto';
			src: url('<?php echo get_stylesheet_directory_uri(); ?>/RobotoMono-VariableFont_wght.ttf') format('truetype'),
			url('<?php echo get_stylesheet_directory_uri(); ?>/RobotoMono-Regular.woff') format('woff'),
			url('<?php echo get_stylesheet_directory_uri(); ?>/RobotoMono-VariableFont_wght.woff2') format('woff2'), url('<?php echo get_stylesheet_directory_uri(); ?>/RobotoMono-VariableFont_wght.eot') format('embedded-opentype');
		}
		html{
			background-color: #222;
			padding-bottom: 24px;
		}
		pre{
			white-space: pre-wrap;
			white-space: -moz-pre-wrap;
			white-space: -pre-wrap;
			white-space: -o-pre-wrap;
			word-wrap: break-word;   
		}
		code {
			font-size: 14px;
		}
		#content{
			width: 1024px;
			max-width: calc(100% - 16px);
			margin: auto;
			padding: 0 32px;
			box-sizing: border-box;
		}
		#content * {
			max-width: 100%;
		}
		*{
			color: #fefefe;
			font-family: 'roboto';
		}
		#home-loop{
			list-style: none;
			padding: 0;
		}
		#home-loop li{
			margin-bottom: 8px;
		}
		#home-loop li.NOTICE{
			background-color: #fefefe;
			color: #222;
		}
		#home-loop li.NOTICE a{
			color: #222;
		}
		nav{
			border-bottom: dashed #fefefe 1px;
		}
		nav > div{
			width: 1024px;
			box-sizing: border-box;
			max-width: 100%;
			padding: 16px 32px;
			display: flex;
			justify-content: space-between;
			margin: auto;
		}
		.menu__categories{
			margin-top: 8px;
		}
		.error__404{
			height: calc(100vh - 120px);
			display: flex;
			align-items: center;
			flex-direction: column;
			justify-content: center;

		}
		.error__404 h1{
			margin: 0;
			font-size: 160px;
			text-align: center;
			line-height: 160px;
		}
		img{
			max-width: 100%;
		}
		footer{
			text-align: center;
		}
		footer span{
			display: inline-block;
			text-align: center;
			letter-spacing: -3px;
		}
		footer i{
			font-size: 12px;
		}
	</style>
	<style>
		.search__wrapper{
			margin-top: 64px;
			padding: 16px;
			margin-bottom: 64px
		}
		#q{
			background-color: transparent;
			width: 100%;
			border: dashed #fefefe 1px;
			padding: 16px;
			font-size: 24px;
			box-sizing: border-box;
		}
		@media screen and (max-width: 560px) {
			.search__wrapper{
				margin-top: 64px;
				padding: 0px;
				margin-bottom: 64px
			}
			#q{
				padding: 8px;
				font-size: 18px;
			}
		}
	</style>
</head>
<body>
<nav><div><span>DOSSETT.DEV</span> <span><span><a title ="Home" href="<?php echo get_home_url(); ?>">HOME</a></span> / <span><a href="https://github.com/devdossett" title="GitHub">GITHUB</a></span></span></div></nav>
<main id="content" role="main">
<div class="search__wrapper">
	<input type="text" id="q" placeholder="search">
</div>
<footer>
<span>
<span>g</span>
<span>e</span>
<span>n</span>
<span>e</span>
<span>r</span>
<span>a</span>
<span>l</span>
<span>@</span>
<span>d</span>
<span>o</span>
<span>s</span>
<span>s</span>
<span>e</span>
<span>t</span>
<span>t</span>
<span>.</span>
<span>d</span>
<span>e</span>
<span>v</span>
</span>
<div><i>*I Collect No Information About You*</i></div>
</footer>
</main><!-- #site-content -->
</body>
<script>
    let elem = document.getElementById('q');
    elem.addEventListener('keypress', (event)=>{
        if(event.which !== 13) return;
        event.preventDefault();
        let val = elem.value;
        let siteToQuery = 'https://duckduckgo.com/?hps=1&ia=web&q=' + val;
        if(val.length > 10 && val.substring(0, 9) === 'subsearch'){
            let search = val.split(" ");
            let sub = search[1];
            let query = search.slice(2).join(" ");
            siteToQuery = 'https://www.google.com/search?q=site:reddit.com/r/' + sub + ' "' + query + '"';
        } 
        window.location.href = siteToQuery;
    });
</script>
</html>
