<?php header("Content-type: text/css; charset=utf-8"); 

$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];

require_once( $path_to_wp . '/wp-load.php' );

$options = get_option('klaus');
?>

<?php
if(!empty($options['enable-custom-fonts']) && $options['enable-custom-fonts'] == 1 ) {

$body = $options['body-font'];
$logo = $options['logo-font'];
$menu = $options['menu-font'];
$dropdown = $options['dropdown-menu-font'];
$mobilemenu = $options['mobile-menu-font'];

$page_header = $options['pageheader-font'];
$page_caption = $options['pagecaption-font'];
$h1 = $options['heading1-font'];
$h2 = $options['heading2-font'];
$h3 = $options['heading3-font'];
$h4 = $options['heading4-font'];
$h5 = $options['heading5-font'];
$h6 = $options['heading6-font'];

if(!empty($options['enable-body-fonts']) && $options['enable-body-fonts'] == '1') {
echo '
/* Body Custom Fonts */

body,
input,
button,
select,
textarea {
	font-family: '.$body['font-family'].';
	font-size: '.$body['font-size'].';';
	if(!empty($body['font-style'])){
	echo '
	font-style: '.$body['font-style'].';';
	}
	echo '
	font-weight: '.$body['font-weight'].';
	line-height: '.$body['line-height'].';
}';
}

if(!empty($options['enable-header-fonts']) && $options['enable-header-fonts'] == '1') {
echo '
/* Header and Mobile Custom Fonts */

header #logo a {
	font-family: '.$logo['font-family'].';
	font-size: '.$logo['font-size'].';';
	if(!empty($logo['font-style'])){
	echo '
	font-style: '.$logo['font-style'].';';
	}
	echo '
	font-weight: '.$logo['font-weight'].';
	letter-spacing: '.$logo['letter-spacing'].';
}';

echo '
#menu ul a {
	font-family: '.$menu['font-family'].';
	font-size: '.$menu['font-size'].';';
	if(!empty($menu['font-style'])){
	echo '
	font-style: '.$menu['font-style'].';';
	}
	echo '
	font-weight: '.$menu['font-weight'].';
}';

echo '
#menu ul .sub-menu li a {
	font-family: '.$dropdown['font-family'].';
	font-size: '.$dropdown['font-size'].';';
	if(!empty($dropdown['font-style'])){
	echo '
	font-style: '.$dropdown['font-style'].';';
	}
	echo '
	font-weight: '.$dropdown['font-weight'].';
}';

echo '
#navigation-mobile li a {
	font-family: '.$mobilemenu['font-family'].';
	font-size: '.$mobilemenu['font-size'].';';
	if(!empty($mobilemenu['font-style'])){
	echo '
	font-style: '.$mobilemenu['font-style'].';';
	}
	echo '
	font-weight: '.$mobilemenu['font-weight'].';
}';
}

if(!empty($options['enable-headings-fonts']) && $options['enable-headings-fonts'] == '1') {
echo '
/* Headings Custom Fonts */

h1 {
	font-family: '.$h1['font-family'].';
	font-size: '.$h1['font-size'].';';
	if(!empty($h1['font-style'])){
	echo '
	font-style: '.$h1['font-style'].';';
	}
	echo '
	font-weight: '.$h1['font-weight'].';
	line-height: '.$h1['line-height'].';
	letter-spacing: '.$h1['letter-spacing'].';
}';

echo '
h2 {
	font-family: '.$h2['font-family'].';
	font-size: '.$h2['font-size'].';';
	if(!empty($h2['font-style'])){
	echo '
	font-style: '.$h2['font-style'].';';
	}
	echo '
	font-weight: '.$h2['font-weight'].';
	line-height: '.$h2['line-height'].';
	letter-spacing: '.$h2['letter-spacing'].';
}';

echo '
h3 {
	font-family: '.$h3['font-family'].';
	font-size: '.$h3['font-size'].';';
	if(!empty($h3['font-style'])){
	echo '
	font-style: '.$h3['font-style'].';';
	}
	echo '
	font-weight: '.$h3['font-weight'].';
	line-height: '.$h3['line-height'].';
	letter-spacing: '.$h3['letter-spacing'].';
}';

echo '
h4 {
	font-family: '.$h4['font-family'].';
	font-size: '.$h4['font-size'].';';
	if(!empty($h4['font-style'])){
	echo '
	font-style: '.$h4['font-style'].';';
	}
	echo '
	font-weight: '.$h4['font-weight'].';
	line-height: '.$h4['line-height'].';
	letter-spacing: '.$h4['letter-spacing'].';
}';

echo '
h5 {
	font-family: '.$h5['font-family'].';
	font-size: '.$h5['font-size'].';';
	if(!empty($h5['font-style'])){
	echo '
	font-style: '.$h5['font-style'].';';
	}
	echo '
	font-weight: '.$h5['font-weight'].';
	line-height: '.$h5['line-height'].';
	letter-spacing: '.$h5['letter-spacing'].';
}';

echo '
h6 {
	font-family: '.$h6['font-family'].';
	font-size: '.$h6['font-size'].';';
	if(!empty($h6['font-style'])){
	echo '
	font-style: '.$h6['font-style'].';';
	}
	echo '
	font-weight: '.$h6['font-weight'].';
	line-height: '.$h6['line-height'].';
	letter-spacing: '.$h6['letter-spacing'].';
}';

echo '
/* Page Header Font */

#image-static h2,
#title-page h2 {
	font-family: '.$page_header['font-family'].';
	font-size: '.$page_header['font-size'].';';
	if(!empty($page_header['font-style'])){
	echo '
	font-style: '.$page_header['font-style'].';';
	}
	echo '
	font-weight: '.$page_header['font-weight'].';
	line-height: '.$page_header['line-height'].';
	letter-spacing: '.$page_header['letter-spacing'].';
}';

echo '
/* Page Header Caption Font */

#image-static .page-caption,
#image-static .entry-meta.entry-header,
#title-page .page-caption,
#title-page .entry-meta.entry-header {
	font-family: '.$page_caption['font-family'].';
	font-size: '.$page_caption['font-size'].';';
	if(!empty($page_caption['font-style'])){
	echo '
	font-style: '.$page_caption['font-style'].';';
	}
	echo '
	font-weight: '.$page_caption['font-weight'].';
	line-height: '.$page_caption['line-height'].';
	letter-spacing: '.$page_caption['letter-spacing'].';
}';
}

}
?>