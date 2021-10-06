<?php
/*	--------------------------------------------------------------
	-------------- ACF BLOCKS
	--------------------------------------------------------------
*/


function custom_noordkade_block_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'noordkade-blocks',
				'title' => __( 'Noordkade Blocks', 'noordkade-blocks' ),
			),
		)
	);
}
add_filter( 'block_categories', 'custom_noordkade_block_category', 10, 2);

if( is_admin() ){
   // echo "In admin";
}

add_action('acf/init', 'my_acf_nennene_init_block_types');
function my_acf_nennene_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type_thisisnew') ) {

        // register a testimonial block.
        acf_register_block_type_thisisnew(array(
            'name'              => 'testimonial',
            'title'             => __('Testimonial'),
            'description'       => __('A custom testimonial block.'),
            'render_template'   => 'template-parts/blocks/testimonial/testimonial.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'testimonial', 'quote' ),
        ));
    }
}

function register_noordkade_block_types() {

    // Om noordkade blokken te registreren kopieer acf_register_block_type functie en pas hem aan. 
    
    $url_logo = '<svg id="site_logo" data-name="site_logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 579.33 392.79"><defs><style>path, rect{fill:#555d66;}</style></defs><title>noordkade_embleem-zwart</title><path class="cls-1" d="M289.66,392.79a6.2,6.2,0,0,1-3.4-1L2.78,204.79a6.18,6.18,0,0,1-.09-10.26L286.18,1.07l.17-.1a6.1,6.1,0,0,1,3.16-1h.18a6.1,6.1,0,0,1,3.68,1.23l283.27,193.3a6.19,6.19,0,0,1-.08,10.26L293.4,391.55a6.23,6.23,0,0,1-3.72,1.24h0M20,199.51,289.66,377.4,559.37,199.51l-269.71-184Z"/><rect class="cls-1" x="255.04" y="213.24" width="17.94" height="28.28"/><rect class="cls-1" x="230.95" y="122.71" width="14.1" height="45.98"/><rect class="cls-1" x="284.26" y="122.71" width="14.1" height="45.98"/><rect class="cls-1" x="323.04" y="213.24" width="17.24" height="60.26"/><path class="cls-1" d="M499.35,208.87l-59.16-2.05c-5.33-.19-5.3-3.72,0-3.83l59.24-1.24c5.36-.11,5.4-5.16,0-5.35l-59.22-2c-5.33-.19-5.31-3.72,0-3.84l59.18-1.24c5.58-.11,5.67-5.09.11-5.28L440.39,182c-5.33-.18-5.31-3.72,0-3.83l59.26-1.24-81-55.29v50.89l-10.75,10.25H373.34V108.62h26.31l-.45-.31L289.65,33.55,177.94,109.78l-.74.51,15,40.87V108.62h15.15v74.11h-15.9l-15.68-42.54v42.54H160.69V121.56L79.63,176.88l59.25,1.24c5.34.11,5.36,3.65,0,3.83L79.69,184c-5.55.19-5.47,5.17.11,5.28L139,190.52c5.34.12,5.36,3.65,0,3.84l-59.22,2c-5.35.19-5.31,5.24,0,5.35L139.08,203c5.33.11,5.37,3.64,0,3.83L80,208.87c-5.58.19-5.59,5.16,0,5.28l59.25,1.24c5.33.11,5.36,3.65,0,3.83l-58.74,2,80.22,52.91v-79.4h21.07V238.1h1.39l19.74-43.33h21L204.63,238.1H224v53.81H203V256.44h-21.2v31.62l.1.07,107.79,71.1,102.07-67.32H369.83V194.77h48.81v18.47H390.69V232h26.56v18.14H391V273.5H418.6v.7l80.23-52.94-58.73-2c-5.34-.18-5.31-3.72,0-3.83l59.24-1.24C504.93,214,504.93,209.06,499.35,208.87ZM268.15,108.62h46.26v74.11H268.15Zm-53.3,74.11V108.62h46.26v74.11Zm79.2,109.18H273V260H255v31.91H233.9V210.15l16.2-15.38h44Zm67.37-13.44-14.11,13.44H302V194.77h43.25l16.2,15.38Zm-10.13-95.74-9.53-26.8h-4.24v26.8H321.46V119.07l11.66-10.45h32.8v47.1h-8.69l10.17,27Z"/><rect class="cls-1" x="389.39" y="122.71" width="13.14" height="45.98"/><rect class="cls-1" x="337.52" y="122.71" width="12.35" height="19.32"/></svg>';
        acf_register_block_type(array(
            'name'              => 'bewoners_uitgelicht',
            'title'             => __('Bewoners uitgelicht'),
            'description'       => __('Bewoners worden automatisch uitgelicht via de gekoppelde pijler.'),
            'render_template'   => 'template-parts/blocks/bewoners_uitgelicht.php',
            'category'          => 'noordkade-blocks',
            'mode'				=> 'auto',
            'icon' => array(
                'background' => '#fff',
                'foreground' => '#555d66',
                'src' => 'admin-home',
                ),
            'keywords'			=> array( 'content', 'wim', 'grid', 'post', 'block', 'uitgelicht', 'bewoners', 'noordkade' ),
            'example' => [],
        ));

        acf_register_block_type(array(
            'name'              => 'agenda_uitgelicht',
            'title'             => __('Agenda uitgelicht'),
            'description'       => __('Agenda worden automatisch uitgelicht via de gekoppelde pijler.'),
            'render_template'   => 'template-parts/blocks/agenda_uitgelicht.php',
            'category'          => 'noordkade-blocks',
            'mode'				=> 'auto',
            'icon' => array(
                'background' => '#fff',
                'foreground' => '#555d66',
                'src' => 'calendar-alt',
                ),
            'keywords'			=> array( 'content', 'wim', 'grid', 'post', 'block', 'uitgelicht', 'agenda', 'noordkade' ),
            'example' => [],
        ));     
        
        
        acf_register_block_type(array(
            'name'              => 'gevestigden',
            'title'             => __('Gevestigden'),
            'description'       => __('Gevesitgden worden automatisch uitgeladen per pijler.'),
            'render_template'   => 'template-parts/blocks/gevestigden.php',
            'category'          => 'noordkade-blocks',
            'mode'				=> 'auto',
            'icon' => array(
                'background' => '#fff',
                'foreground' => '#555d66',
                'src' => 'editor-ul',
                ),
            'keywords'			=> array( 'content', 'wim', 'grid', 'post', 'block', 'uitgelicht', 'gevestigden', 'noordkade' ),
            'example' => [],
        ));   
        
        
        acf_register_block_type(array(
            'name'              => 'favorieten',
            'title'             => __('Favorieten'),
            'description'       => __('Geselecteerde afvorieten worden hier automatisch in geladen.'),
            'render_template'   => 'template-parts/blocks/favorieten.php',
            'category'          => 'noordkade-blocks',
            'mode'				=> 'edit',
            'icon' => array(
                'background' => '#fff',
                'foreground' => '#555d66',
                'src' => 'heart',
                ),
            'keywords'			=> array( 'content', 'wim', 'favorieten', 'post', 'block', 'noordkade' ),
            'example' => [],
        )); 
        
        
        acf_register_block_type(array(
            'name'              => 'zalen_uitgelicht',
            'title'             => __('Zalen uitgelicht'),
            'description'       => __('Zalen worden automatisch uitgelicht op basis van relatie soort.'),
            'render_template'   => 'template-parts/blocks/zalen_uitgelicht.php',
            'category'          => 'noordkade-blocks',
            'mode'				=> 'auto',
            'icon' => array(
                'background' => '#fff',
                'foreground' => '#555d66',
                'src' => 'forms',
                ),
            'keywords'			=> array( 'content', 'wim', 'zalen', 'post', 'block', 'noordkade' ),
            'example' => [],
        ));  
    
    
        
            
        acf_register_block_type(array(
            'name'              => 'home_header',
            'title'             => __('Home header'),
            'description'       => __('Een ruige video intro om de website meteen een knallende look en feel te kunnen bieden.'),
            'render_template'   => 'template-parts/blocks/home_header.php',
            'category'          => 'noordkade-blocks',
            'align' 			=> 'full',
            'multiple'			=> false,
            'mode'				=> 'auto',
            'post_types' => array('page'),
            'icon' => 'megaphone',
            'keywords'			=> array( 'content', 'wim', 'zalen', 'post', 'block', 'noordkade' ),
            'example' => [],
            'enqueue_style' => get_stylesheet_directory_uri() . '/template-parts/blocks/css/home_header.css',
        )); 
        
        
        acf_register_block_type(array(
            'name'              => 'home_pijlers',
            'title'             => __('Home pijlers'),
            'description'       => __('De pijlers random ingeladen.'),
            'render_template'   => 'template-parts/blocks/home_pijler_block.php',
            'category'          => 'noordkade-blocks',
            'align' 			=> 'full',
            'multiple'			=> false,
            'mode'				=> 'auto',
            'post_types' => array('page'),
            'icon' => 'megaphone',
            'keywords'			=> array( 'content', 'wim', 'zalen', 'post', 'block', 'noordkade', 'pijlers' ),
            'example' => [],
            'enqueue_style' => get_stylesheet_directory_uri() . '/template-parts/blocks/css/home_pijler_block.css',
        )); 
        
        
        acf_register_block_type(array(
            'name'              => 'instagram_feed',
            'title'             => __('Instagram feed'),
            'description'       => __('Laad feed in van Instagram.'),
            'render_template'   => 'template-parts/blocks/instagram_feed.php',
            'category'          => 'noordkade-blocks',
            'align' 			=> 'full',
            'multiple'			=> false,
            'mode'				=> 'edit',
            'post_types' => array('page'),
            'icon' => 'visibility',
            'keywords'			=> array( 'content', 'wim', 'zalen', 'post', 'block', 'noordkade', 'pijlers' ),
            'example' => [],
            'enqueue_style' => get_stylesheet_directory_uri() . '/template-parts/blocks/css/instagram_feed.css',
            'enqueue_script' => get_stylesheet_directory_uri() . '/template-parts/blocks/js/insta.js',
        )); 

        acf_register_block_type(array(
            'name'              => 'blog_posts',
            'title'             => __('Blog berichten'),
            'description'       => __('Toon de laatste 3 blog berichten.'),
            'render_template'   => 'template-parts/blocks/latest_blog.php',
            'category'          => 'noordkade-blocks',
            'align' 			=> 'full',
            'multiple'			=> false,
            'mode'				=> 'edit',
            'post_types' => array('page'),
            'icon' => 'visibility',
            'keywords'			=> array( 'content', 'wim', 'zalen', 'post', 'block', 'noordkade', 'pijlers' ),
            'example' => [],
            'enqueue_style' => get_stylesheet_directory_uri() . '/template-parts/blocks/css/latest_blog.css',
            
        )); 
        
        acf_register_block_type(array(
            'name'              => 'gebouw_block',
            'title'             => __('Gebouwen block'),
            'description'       => __('Toon de gebouwen in blocks'),
            'render_template'   => 'template-parts/blocks/gebouw_block.php',
            'category'          => 'noordkade-blocks',
            'align' 			=> 'full',
            'multiple'			=> false,
            'mode'				=> 'edit',
            'post_types' => array('page'),
            'icon' => 'visibility',
            'keywords'			=> array( 'content', 'wim', 'zalen', 'post', 'block', 'noordkade', 'pijlers' ),
            'example' => [],
            'enqueue_style' => get_stylesheet_directory_uri() . '/template-parts/blocks/css/home_pijler_block.css',
            
        )); 
    
}
register_noordkade_block_types();
	
?>