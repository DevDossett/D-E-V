<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

//get_header();

function formatted_content()
{
  global $post;

  return apply_filters(
    'the_content',
    get_post_field('post_content', $post->id)
  );
} ?>
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
</head>
<body>
<nav><div><span>DOSSETT.DEV</span> <span><span><a title ="Home" href="<?php echo get_home_url(); ?>">HOME</a></span> / <span><a href="https://github.com/devdossett" title="GitHub">GITHUB</a></span></span></div></nav>
<main id="content" role="main">
<?php if (is_home() || is_archive()) { ?>
<section class="menu__categories">
	<?php $cats = get_categories([
   'orderby' => 'name',
   'order' => 'ASC',
 ]); ?>
  <a title="All Posts" href="<?php echo get_home_url(); ?>">All</a>
  <?php foreach ($cats as $cat) { ?>
	<a title="<?php echo $cat->name; ?> Category" href="<?php echo get_category_link(
   $cat->term_id
 ); ?>"><?php echo $cat->name; ?></a>
  <?php } ?>
</section>
<?php } ?>
<?php if (is_single()) { ?>
<section class="menu__categories">
  <a title="home" style="text-decoration: none;" href="<?php echo get_home_url(); ?>"><- Home</a>
</section>
<?php } ?>
<?php
if (is_home()) {
  ob_start();
  $query = new WP_Query([
    'post_type' => 'post',
    'order' => 'DESC',
    'posts_per_page' => '-1',
  ]);
  if ($query->have_posts()) { ?>
		<ul id="home-loop">
				<?php while ($query->have_posts()):
      $query->the_post(); ?>
				<li class="<?php echo get_the_category()[0]
      ->name; ?>"><a href="<?php echo get_the_permalink(); ?>">{ <?php echo get_the_category()[0]
  ->name; ?> } | <?php echo get_the_title(); ?></a></li>
				<?php
    endwhile; ?>
		</ul>
		<?php } else { ?>
			<p>Its empty here...</p>
		<?php }
}
if(is_archive()) {
	$cat = get_queried_object();
	ob_start();
	$query = new WP_Query([
	  'post_type' => 'post',
	  'order' => 'DESC',
	  'posts_per_page' => '-1',
	  'cat' => $cat->term_id,
	]);
	if ($query->have_posts()) { ?>
		  <ul id="home-loop">
				  <?php while ($query->have_posts()):
		$query->the_post(); ?>
				  <li class="<?php echo get_the_category()[0]
		->name; ?>"><a href="<?php echo get_the_permalink(); ?>">{ <?php echo get_the_category()[0]
	->name; ?> } | <?php echo get_the_title(); ?></a></li>
				  <?php
	  endwhile; ?>
		  </ul>
		  <?php } else { ?>
			  <p>Its empty here...</p>
		  <?php }
}
if (is_single()) {
  echo formatted_content($post->ID);
  $date = get_the_date('F j, Y');
  $mDate = get_the_modified_date('F j, Y');
  if ($mDate != $date) {
    echo "<div style='font-size: 12px; text-align: center;'><span>Published " .
      get_the_date('F j, Y') .
      "</span> || <span>Edited " .
      get_the_modified_date('F j, Y') .
      "</span></div>";
  } else {
    echo "<div style='font-size: 12px; text-align: center;'><span>" .
      get_the_date('F j, Y') .
      "</span></div>";
  }
}
if (is_404()) { ?>
	<section class="error__404">
		<h1>404</h1>
		<p style="text-align: center;">Something is wrong...</p>
	</section>
<?php
}
?>
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
</html>
