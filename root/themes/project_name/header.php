<!DOCTYPE html>
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js msie ie8 lte9 lte8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="no-js msie ie9 lte9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>

  <script type="text/javascript">
    document.documentElement.className = document.documentElement.className.replace('no-js', '');
  </script>

  <!--[if lte IE 8 ]> <script type="text/javascript">var htmlForIe = ["abbr" ,"article" ,"aside" ,"audio" ,"canvas" ,"details" ,"figcaption" ,"figure" ,"footer" ,"header" ,"hgroup" ,"mark" ,"meter" ,"nav" ,"output" ,"progress" ,"section" ,"summary" ,"time" ,"video"], htmlForIeLen = htmlForIe.length; for(i=0;i<htmlForIeLen;i++){ document.createElement(htmlForIe[i]); }</script> <![endif]-->

  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
