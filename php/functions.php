<?php
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'popper-scripts', get_template_directory_uri() . '/js/popper.min.js', array(), false);
    //wp_enqueue_script( 'bootstrap_js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js');
    wp_enqueue_script( 'child-custom-scripts', get_stylesheet_directory_uri() . '/js/custom.js', array(), $the_theme->get( 'Version' ), false);
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), false );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }    
}

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 */
function maya_javascript_detection() {
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'maya_javascript_detection', 0 );


if ( ! function_exists( 'maya_setup' ) ) :
function maya_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'featured-image', 985, 438, true );
    add_image_size( 'miniatura-image', 435, 435, true ); 
}
endif;
add_action( 'after_setup_theme', 'maya_setup' );





/**
 * Colaboracion helper
 *
 * Preprocess data to show it into colaboracion's template
 *
 */
function preprocess_colaboracion() {
  $id = get_the_id(); 
  $post = get_post($id);
  $title = get_the_title($id);
  $custom = get_post_custom($id);
  $docentes = isset( $custom["colaboracion_docentes"][0] ) ? $custom["colaboracion_docentes"][0] : "";
  $asignatura = isset( $custom["colaboracion_asignatura"][0] ) ? $custom["colaboracion_asignatura"][0] : "";
  $image = esc_url(get_the_post_thumbnail_url($id, 'featured-image'));

  $programa = get_post_meta( $asignatura, 'asignatura_programa', true );
  set_query_var( 'programa', $programa );

  if (!empty($docentes)) {
    $teacher_array = explode(',',$docentes);
    array_walk($teacher_array, function(&$v) { $v = '<span>'.trim($v).'</span>'; });
    $docentes = implode(', ', $teacher_array);
  }

  $disenio_ind = get_page_by_title('Diseño industrial', OBJECT, 'programa');
  $link_asig = add_query_arg( array('prog' => $disenio_ind->ID), site_url('/repositorio') );
  $categories = get_the_category();
  $categoria = '';
  if ( ! empty( $categories ) ) {
      foreach ($categories as $key => $category) {
        $categoria .= '<a href="">'.$category->name.'</a>';
      }  
  }

  $prev_post = get_previous_post();
  if ( ! empty( $prev_post ) ) {
    $antes = '<a class="btn button-brand-i" href="'.get_permalink( $prev_post->ID ).'">Anterior</a>';
  } else {
    $antes = '<a class="btn btn-outline-secondary disabled" href="#">Anterior</a>';
  }
  $next_post = get_next_post();
  if ( ! empty( $next_post ) ) {
    $sig = '<a class="btn button-brand-i" href="'.get_permalink( $next_post->ID ).'">Siguiente</a>';
  } else {
    $sig = '<a class="btn btn-outline-secondary disabled" href="#">Siguiente</a>';
  }

  return array(
    'asignatura' => $asignatura,
    'title' => $title,
    'docentes' => $docentes,
    'categoria' => $categoria,
    'post' => $post, 
    'image' => $image,
    'link_asig' => $link_asig,
    'antes' => $antes,
    'sig' => $sig
  );

}


/**
 * Asignatura helper
 *
 * Preprocess data to show it into asignatura's template
 *
 */
function preprocess_asignatura() {
  $salida = array();

  $id = get_the_id(); 
  $salida['post'] = get_post($id);
  $salida['title'] = get_the_title($id);
  $custom = get_post_custom($id);

  $salida['ciclo'] = isset( $custom["asignatura_ciclo"][0] ) ? $custom["asignatura_ciclo"][0] : "";
  $salida['semestre'] = isset( $custom["asignatura_semestre"][0] ) ? $custom["asignatura_semestre"][0] : "";
  $salida['creditos'] = isset( $custom["asignatura_creditos"][0] ) ? $custom["asignatura_creditos"][0] : "";
  $salida['programa'] = isset( $custom["asignatura_programa"][0] ) ? $custom["asignatura_programa"][0] : "";
  $salida['area'] = isset( $custom["asignatura_area"][0] ) ? $custom["asignatura_area"][0] : "";
  $linea = isset( $custom["asignatura_linea"][0] ) ? $custom["asignatura_linea"][0] : "";
  $salida['image'] = esc_url(get_the_post_thumbnail_url($id, 'featured-image'));
  $docentes = isset( $custom["asignatura_docentes"][0] ) ? $custom["asignatura_docentes"][0] : "";
  $docentes_link = isset( $custom["asignatura_docentes_link"][0] ) ? $custom["asignatura_docentes_link"][0] : "";
  $salida['temas'] = isset( $custom["asignatura_temas"][0] ) ? $custom["asignatura_temas"][0] : "";
  $salida['enlace'] = isset( $custom["asignatura_aula"][0] ) ? $custom["asignatura_aula"][0] : "";  
  $salida['resultados'] = isset( $custom["asignatura_resultados"][0] ) ? $custom["asignatura_resultados"][0] : "";
  $salida['colaboraciones'] = isset( $custom["asignatura_colaboraciones"][0] ) ? $custom["asignatura_colaboraciones"][0] : "";

  $array = explode(',', $docentes);
  $docentes_array = array_map('trim', $array);
  $array = explode(',', $docentes_link);
  $docentes_link_array = array_map('trim', $array);

  $profesores = array();
  foreach ($docentes_array as $key => $profe) {
    if (!empty($docentes_link_array[$key])) {
      $profesores[] = '<a href="'.$docentes_link_array[$key].'">'.$profe.'</a>';
    } else {
      $profesores[] = $profe;
    }    
  }
  $salida['profesores'] = implode(', ', $profesores);

  // Projects related
  $args = array (
    'post_type'     => 'proyecto',
    'numberposts'   => -1,  
    'post_status'   => 'publish',
    'meta_key'   => 'proyecto_asignatura',
    'meta_value' => $id
  );
  $args = array_merge( $args, array('posts_per_page' => 6, 'paged' => $paged1) );
  $salida['posts_proy']  = query_posts($args);

  // Colaborations related
  $args = array (  
    'post_type'     => 'colaboracion',
    'numberposts'   => -1,  
    'post_status'   => 'publish',
    'meta_key'   => 'colaboracion_asignatura',
    'meta_value' => $id    
  );
  $args = array_merge( $args, array('posts_per_page' => 2, 'paged' => $paged2) );
  $salida['posts_colab']  = query_posts($args);

  $disenio_ind = get_page_by_title('Diseño industrial', OBJECT, 'programa');
  $salida['link_asig'] = add_query_arg( array('prog' => $disenio_ind->ID), site_url('/repositorio') );

  return $salida;
}

/**
 * Docente helper
 *
 * Preprocess data to show it into docente's template
 *
 */
function preprocess_docente() {
  $salida = array();
  $id = get_the_id(); 
  $salida['post'] = get_post($id);
  $salida['title'] = get_the_title($id);
  $custom = get_post_custom($id);
  $asignaturas = isset( $custom["docente_asignaturas"][0] ) ? $custom["docente_asignaturas"][0] : "";
  $asignaturas_link = isset( $custom["docente_asignaturas_link"][0] ) ? $custom["docente_asignaturas_link"][0] : "";
  $programa = isset( $custom["docente_programa"][0] ) ? $custom["docente_programa"][0] : "";
  $salida['descripcion'] = isset( $custom["docente_descripcion"][0] ) ? $custom["docente_descripcion"][0] : "";
  $salida['docentemail'] = isset( $custom["docente_email"][0] ) ? $custom["docente_email"][0] : "";
  $salida['portfolio'] = isset( $custom["docente_portfolio"][0] ) ? $custom["docente_portfolio"][0] : "";
  $salida['cvlac'] = isset( $custom["docente_cvlac"][0] ) ? $custom["docente_cvlac"][0] : "";
  $salida['image'] = esc_url(get_the_post_thumbnail_url($id, 'miniatura-image'));


  $disenio_ind = get_page_by_title('Diseño industrial', OBJECT, 'programa');
  $salida['link_doc'] = add_query_arg( array('doc' => $disenio_ind->ID), site_url('/repositorio') );

  $array = explode(',', $asignaturas);
  $asig_array = array_map('trim', $array);

  $array = explode(',', $asignaturas_link);
  $asig_link_array = array_map('trim', $array);

  $materias = array();
  foreach ($asig_array as $key => $materia) {
    $materias[] = '<a href="'.$asig_link_array[$key].'">'.$materia.'</a>';
  }
  $salida['materias'] = $materias;

  return $salida;


  $profesores[] = '<a href="'.$docentes_link_array[$key].'">'.$profe.'</a>';
}

/**
 * Proyecto helper
 *
 * Preprocess data to show it into proyecto's template
 *
 */
function preprocess_proyecto() {
  $salida = array();

  $id = get_the_id(); 
  $salida['post'] = get_post($id);
  $salida['title'] = get_the_title($id);
  $custom = get_post_custom($id);
  $estudiantes = isset( $custom["proyecto_estudiantes"][0] ) ? $custom["proyecto_estudiantes"][0] : "";
  $docentes = isset( $custom["proyecto_docentes"][0] ) ? $custom["proyecto_docentes"][0] : "";
  $salida['asignatura'] = isset( $custom["proyecto_asignatura"][0] ) ? $custom["proyecto_asignatura"][0] : "";
  $salida['image'] = esc_url(get_the_post_thumbnail_url($id, 'featured-image'));

  $disenio_ind = get_page_by_title('Diseño industrial', OBJECT, 'programa');
  $salida['link_asig'] = add_query_arg( array('prog' => $disenio_ind->ID), site_url('/repositorio') );

  $salida['programa'] = get_post_meta( $asignatura, 'asignatura_programa', true );
  
  if (!empty($estudiantes)) {
    $student_array = explode(',',$estudiantes);
    array_walk($student_array, function(&$v) { $v = '<span>'.trim($v).'</span>'; });
    $estudiantes = implode(', ', $student_array);
  }

  $salida['estudiantes'] = $estudiantes;

  if (!empty($docentes)) {
    $teacher_array = explode(',',$docentes);
    array_walk($teacher_array, function(&$v) { $v = '<span>'.trim($v).'</span>'; });
    $docentes = implode(', ', $teacher_array);
  }

  $salida['docentes'] = $docentes;

  return $salida;
}


add_filter( 'mce_buttons', 'jivedig_remove_tiny_mce_buttons_from_editor');
function jivedig_remove_tiny_mce_buttons_from_editor( $buttons ) {
    $remove_buttons = array(
        //'bold',
        'italic',
        'strikethrough',
        //'bullist',
        //'numlist',
        //'blockquote',
        'hr', // horizontal line
        'alignleft',
        'aligncenter',
        'alignright',
        //'link',
        //'unlink',
        'wp_more', // read more link
        //'spellchecker',
        //'dfw', // distraction free writing mode
        //'wp_adv', // kitchen sink toggle (if removed, kitchen sink will always display)
    );
    foreach ( $buttons as $button_key => $button_value ) {
        if ( in_array( $button_value, $remove_buttons ) ) {
            unset( $buttons[ $button_key ] );
        }
    }
    return $buttons;
}

add_filter( 'mce_buttons_2', 'jivedig_remove_tiny_mce_buttons_from_kitchen_sink');
function jivedig_remove_tiny_mce_buttons_from_kitchen_sink( $buttons ) {
    $remove_buttons = array(
        //'formatselect', // format dropdown menu for <p>, headings, etc
        'underline',
        'alignjustify',
        'forecolor', // text color
        'pastetext', // paste as text
        //'removeformat', // clear formatting
        //'charmap', // special characters
        'outdent',
        'indent',
        'undo',
        'redo',
        'wp_help', // keyboard shortcuts
    );
    foreach ( $buttons as $button_key => $button_value ) {
        if ( in_array( $button_value, $remove_buttons ) ) {
            unset( $buttons[ $button_key ] );
        }
    }
    return $buttons;
}

// Do NOT include the opening php tag above
add_filter('tiny_mce_before_init', 'tiny_mce_remove_unused_formats' );
/*
 * Modify TinyMCE editor to remove H1.
 */
function tiny_mce_remove_unused_formats($init) {
  // Add block format elements you want to show in dropdown
  $init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6';
  return $init;
}


add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
    .no-customize-support .menu-icon-docente ul.wp-submenu.wp-submenu-wrap li:last-child, .no-customize-support .menu-icon-asignatura ul.wp-submenu.wp-submenu-wrap li:last-child, .no-customize-support a.page-title-action, .no-customize-support .li#wp-admin-bar-new-content, .post-type-archive-colaboracion.no-customize-support .li#wp-admin-bar-new-content{display:none;}
  </style>';
}


