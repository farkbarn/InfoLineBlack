<?php
/*include(TEMPLATEPATH.'/includes/images.php');*/

// AGREGANDO PARAMETROS DE IMAGEN
//the_post_thumbnail($size,$attr);
add_theme_support('post-thumbnails');
add_image_size('ssli', 680, 340, true);
add_image_size('psli', 360, 180, true);
add_image_size('col1', 510, 254, true);
add_image_size('col2', 250, 133, true);
add_image_size('mlei', 110, 60, true);


// AGREGANDO WIDGET
register_sidebar(array(
    'name'=>'Home',
    'id'=>'widhome',
    'description'=>'Widget para Home',
    'class'=>'widget',
    'before_widget'=>'<section class="widget">',
    'after_widget'=>'</section>',
    'before_title'=>'<section class="tagsec">
		    <section class="recnar"></section>
		    <section class="recneg"></section>
		    <p class="txteti">',
    'after_title'=>'</p>
		    </section>'
));

register_sidebar(array(
    'name'=>'Youtube',
    'id'=>'widyou',
    'description'=>'Canal Youtube El InformadorVE',
    'class'=>'widget',
    'before_widget'=>'<section class="widget">',
    'after_widget'=>'</section>',
    'before_title'=>'<section class="tagsec">
		    <section class="recnar"></section>
		    <section class="recneg"></section>
		    <p class="txteti">',
    'after_title'=>'</p>
		    </section>'
));

register_sidebar(array(
    'name'=>'Categoria',
    'id'=>'widcat',
    'description'=>'Widget para Categorias',
    'class'=>'widget',
    'before_widget'=>'<section class="widget">',
    'after_widget'=>'</section>',
    'before_title'=>'<section class="tagsec">
		    <section class="recnar"></section>
		    <section class="recneg"></section>
		    <p class="txteti">',
    'after_title'=>'</p>
		    </section>'
));

register_sidebar(array(
    'name'=>'Nota',
    'id'=>'widnot',
    'description'=>'Widget para Notas',
    'class'=>'widget',
    'before_widget'=>'<section class="widget">',
    'after_widget'=>'</section>',
    'before_title'=>'<section class="tagsec">
		    <section class="recnar"></section>
		    <section class="recneg"></section>
		    <p class="txteti">',
    'after_title'=>'</p>
		    </section>'
));

register_sidebar(array(
    'name'=>'Busqueda',
    'id'=>'widbus',
    'description'=>'Widget para Busqueda',
    'class'=>'widget',
    'before_widget'=>'<section class="widget">',
    'after_widget'=>'</section>',
    'before_title'=>'<section class="tagsec">
		    <section class="recnar"></section>
		    <section class="recneg"></section>
		    <p class="txteti">',
    'after_title'=>'</p>
		    </section>'
));

register_sidebar(array(
    'name'=>'Leidos',
    'id'=>'widLei',
    'description'=>'Widget para Mas Leidos',
    'class'=>'widget',
    'before_widget'=>'<section class="widget">',
    'after_widget'=>'</section>',
    'before_title'=>'<section class="tagsec">
		    <section class="recnar"></section>
		    <section class="recneg"></section>
		    <p class="txteti">',
    'after_title'=>'</p>
		    </section>'
));

register_sidebar(array(
    'name'=>'General',
    'id'=>'widGen',
    'description'=>'Widget para Generales que saldra en todo',
    'class'=>'widget',
    'before_widget'=>'<section class="widget">',
    'after_widget'=>'</section>',
));

function the_excerpt_max($charlength) {
    $excerpt=get_the_excerpt();
    $charlength++;
    if ( mb_strlen( $excerpt ) > $charlength ) {
	$subex = mb_substr( $excerpt, 0, $charlength - 5 );
	$exwords = explode( ' ', $subex );
	$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
	if ( $excut < 0 ) {
	    echo mb_substr( $subex, 0, $excut );
	} else {
	    echo $subex;
	}
	echo "<a class='lnkexcerpt' href='".get_permalink()."'>...</a>";
    } else {
	echo $excerpt;
    }
}

// LISTAR CATEGORIAS 
function list_cat(){
$categorias = get_the_category();
$separador = ' | ';
$output = '';
if ( ! empty( $categorias ) ) {
    foreach( $categorias as $category ) {
	if ($category->cat_name=='NOAPLICA' ||
	    $category->cat_name=='DESTACADA' ||
	    $category->cat_name=='COLUMNA1A' ||
	    $category->cat_name=='SILUETA' ||
	    $category->cat_name=='Sin categoría' ){
	}
	else
	{
        $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="categoria '.esc_html( $category->name ).'" title="' . esc_attr( sprintf( __( 'click para %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separador;
	}
    }
    return trim( $output, $separador );
}
}

//ADD crear url con bit.ly
function bitly() {  
    $url = get_permalink();  //permalink  
    $login = 'o_42dsrlbhl4';   //user
    $apikey = 'R_e45c039d0fb54a94bad5fe8b6f78acc1'; //api
    $format = 'xml';   //elegir entre json o xml  
    $version = '2.0.1';  
    //generar la URL  
    $bitly = 'http://api.bit.ly/shorten?version='.$version.'&longUrl='.urlencode($url).'&login='.$login.'&apiKey='.$apikey.'&format='.$format;
     //recuperar url  
     $response = file_get_contents($bitly);  
     //para el formato json
     if(strtolower($format) == 'json') {  
         $json = @json_decode($response,true);  
         echo $json['results'][$url]['shortUrl'];  
     }  
     else //para formato xml
     {  
         $xml = simplexml_load_string($response);  
         echo "http://bit.ly/".$xml->results->nodeKeyVal->hash;  
     }
}

//Contador de caracteres en extracto
function excerpt_count_js(){
      echo '<script>jQuery(document).ready(function(){
jQuery("#postexcerpt .handlediv").after("<div style=\"position:absolute;top:0px;right:30px;color:#666;\"><small></small><input type=\"text\" value=\"0\" maxlength=\"3\" size=\"3\" id=\"excerpt_counter\" readonly=\"\" style=\"background:#fff;\"> <small>caracter(es).</small></div>");
     jQuery("#excerpt_counter").val(jQuery("#excerpt").val().length);
     jQuery("#excerpt").keyup( function() {
     jQuery("#excerpt_counter").val(jQuery("#excerpt").val().length);
   });
});</script>';
}
add_action( 'admin_head-post.php', 'excerpt_count_js');
add_action( 'admin_head-post-new.php', 'excerpt_count_js');

//Contador de caracteres en titulo
function titulo_contador_js(){
      echo '<script>jQuery(document).ready(function(){
jQuery("#titlewrap").after("<div style=\"position:absolute;top:-32px;right:0px;color:#666;\"><small></small><input type=\"text\" value=\"0\" maxlength=\"3\" size=\"3\" id=\"tit_counter\" readonly=\"\" style=\"background:#fff;\"> <small>Máximo 90 caracter(es).</small></div>");
	jQuery("#tit_counter").val(jQuery("#title").val().length);
	jQuery("#title").keyup( function() {
	jQuery("#tit_counter").val(jQuery("#title").val().length);
    });
});</script>';}
add_action('admin_head-post.php','titulo_contador_js');
add_action('admin_head-post-new.php','titulo_contador_js');

/*ELIMINAR NOTIFICACION DE ACTUALIZACION PARA NO ADM*/
global $user_login;
get_currentuserinfo();
if ($user_login !== "admin") {
add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );}

// UPDATE TEMA DESDE WP
function github_check_update( $transient ) {
$usergithub=farkbarn;
$ramastable=master;
    if ( empty( $transient->checked ) ) {
        return $transient;
    }
    $theme_data = wp_get_theme(wp_get_theme()->template);
    $theme_slug = $theme_data->get_template();
    $theme_uri_slug = preg_replace('/-'.$ramastable.'$/', '', $theme_slug);
   $remote_version = '0.0.0';
   $style_css = wp_remote_get("https://raw.githubusercontent.com/".$usergithub."/".$theme_uri_slug."/".$ramastable."/style.css")['body'];
   if ( preg_match( '/^[ \t\/*#@]*' . preg_quote( 'Version', '/' ) . ':(.*)$/mi', $style_css, $match ) && $match[1] )
       $remote_version = _cleanup_header_comment( $match[1] );
   if (version_compare($theme_data->version, $remote_version, '<')) {
       $transient->response[$theme_slug] = array(
           'theme'       => $theme_slug,
           'new_version' => $remote_version,
           'url'         => 'https://github.com/'.$usergithub.'/'.$theme_uri_slug,
           'package'     => 'https://github.com/'.$usergithub.'/'.$theme_uri_slug.'/archive/'.$ramastable.'.zip',
       );
   }
   return $transient;
}
add_filter( 'pre_set_site_transient_update_themes', 'github_check_update' );
//Cambiar el pie de pagina del panel de Administración
function change_footer_admin() {echo '&copy;2016 Copyright EL INFORMADOR. Todos los derechos reservados - Web creada por <a href="http://www.elinformador.com.ve">El Informador</a>';}
add_filter('admin_footer_text', 'change_footer_admin');
//ELIMINAR EJECUCION DE CODIGO HTML EN COMMENTS
add_filter('pre_comment_content', 'wp_specialchars');
//omitir info error login
add_filter('login_errors',create_function('$a', "return null;"));
// REMOVER GENERADOR DE META
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);



?>
