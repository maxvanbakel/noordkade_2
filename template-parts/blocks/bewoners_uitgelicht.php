<?php
/**
 * Block Name: Bewoners uitgelicht
 *
 */

$id = 'bewoners-' . $block['id'];
$align_class = $block['align'] ? 'align' . $block['align'] : '';


$query_size = get_field('query_size');

function enqueue_scripts_for_bewoners_uitgelicht () {
    
}

add_action('wp_enqueue_scripts', 'enqueue_scripts_for_bewoners_uitgelicht');

// Begin !is_admin()
if( ! is_admin() ) :


$id_selected =  get_field('pijler') ?? get_the_id();

$kleur = get_wim_pijler_kleur( $id_selected );


$query_args = array(

	'post_type' => 'bewoners',
	'posts_per_page' => $query_size,
	'orderby'        => 'rand', // Voor het geval er geen posts in de categroie zitten toch een random
	
);



$meta_key = 'orientaties'; // De meta key waarin dit wordt opgeslagen bij bewoners. / Bij agenda punten heet het pijlers. 
$get_bewoners_pages = get_pages( array('post_type' => 'bewoners'  ) );
$get_bewoners_ids = [];


foreach($get_bewoners_pages as $page){

    $loop_id = $page->ID;
    
    $meta_values = get_field($meta_key, $loop_id) ?? [];
    
        // Welke pijler object is als eerste geselecteerd. 
    $pijler_object_name 	= $meta_values[0]->post_title ?? ''; // Wat is dan de titel
    $pijler_object_id 		= $meta_values[0]->ID ?? ''; // ID hebben we nodig om te checken. 
    //echo "<pre>" . print_r($meta_value[0]->ID, true) . "</pre>";
    
    // Check of de meta_values array gevuld is 
    if( $meta_values ){
        
        // Door alle values gaan 
        foreach($meta_values as $meta_value){
            
            $pijler_object_name 	= $meta_value->post_title ?? ''; // naam
            $pijler_object_id 		= $meta_value->ID ?? '';  // ID
            
            // Als de pijler hetzelfde ID heeft als de gekozen pijler. 
            if( $pijler_object_id == $id_selected ) {
                
                $get_bewoners_ids[] = $loop_id;
                
            }
            
        }
        
    }
    
}




if( count($get_bewoners_ids) > 0 ){ // Door problemen in admin heb ik dit gedeelte gewrapped in een if is not admin statement. 
    
	// maximaal aantal random cijfers
	$max_random = count($get_bewoners_ids);
	
    // Functie om unieke cijfers genereren. rand() kan dezelfde cijfers terug geven dus dit is beter. 
    if( ! function_exists( 'uniqueRandom' ) ){
        function uniqueRandom($min, $max, $quantity) {
            $numbers = range($min, $max);
            shuffle($numbers);
            return array_slice($numbers, 0, $quantity);
        }
    }
	
    // Check of er een maximum aan posts gelegd moet worden. query_size: -1 is maximaal
    $max_random = ( $query_size >= 0) ? $query_size : $max_random;
    // Nieuwe loop aanmaken om de random cijfers te kunnen koppelen aan de get_bewoners_ids array. 
	$random_posts = uniqueRandom(0, ($max_random - 1), $max_random );
	$random_posts_array = []; // Nieuwe array gemaakt om de random posts in op te slaan. 
	
	// Loop door de randoms en zet ze in een array deze kan dan uitgeladen worden in de query
	foreach($random_posts as $r_post){
		
		$random_posts_array[] = $get_bewoners_ids[$r_post];
		
    }

    // Gebruik volgende prints gebruiken om IDs te kunnen checken.
    /*
    echo "Dit zijn de random IDs: <br> <pre>" . print_r($random_posts_array, true) . "</pre>";
    echo "Dit zijn alle IDs: <br> <pre>" . print_r($get_bewoners_ids, true) . "</pre>";
    */
    
    $query_args['post__in'] = $random_posts_array;
}



$uitgelicht = new wp_Query( $query_args );



if( is_user_logged_in(  ) ){
    //echo '<pre>' . print_r($uitgelicht, true) . '</pre>';
}



?>

<form id="jsSend" action="" method="post"><input type="hidden" name="hook" id="actor"></form>


<div class="wim-bewoners bewoners-<?php echo $id; ?> <?php echo $align_class; ?> uitgelicht">
	
	<div class="row bewoner_wrapper">
		
	<?php if( $uitgelicht->have_posts() ) : while( $uitgelicht->have_posts() ) : $uitgelicht->the_post(); ?>
	
		<div class="four columns bewoner">
			
			<div class="container">
				
				<a href="<?php the_permalink(); ?>" alt="Klik en lees <?php the_title(); ?> verder" class="hook_change" data-hook="<?php echo $id_selected; ?>" class="smooth">
					
					<?php parsePageBlocks( [ 'header' => true ] ); ?>
					
					<h6 class="bewoner-title" style="color:<?php echo $kleur; ?>;"><?php the_title(); ?></h6>
					
					<div class="bewoner_content merri color_gray">	
						
						<?php parsePageBlocks( [ 'intro' => true, 'rest_content' => false, 'limit_characters' => 160, 'strip_tags' => true, ] ); ?>
						
					</div>
					
				</a>
				
			</div>
			
		</div>
	
	<?php endwhile; endif; ?>
	
	</div>
	
</div>





<style>
	
	
	.bewoners-<?php echo $id; ?> {
		background: #fff;
	}
	.bewoners-<?php echo $id; ?>.alignwide .bewoner_wrapper{
		max-width: 1520px;
		margin:50px auto;
	}
	

</style>
<?php endif; /* Einde !is_admin() */ if( is_admin()){
    // admin panel
    echo "Bewoners uitgelicht <button type='button' aria-disabled='false' class='components-button editor-post-publish-button editor-post-publish-button__button is-primary'>bewerken</button> ";

}
