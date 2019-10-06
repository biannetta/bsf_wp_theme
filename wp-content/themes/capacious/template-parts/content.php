<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package capacious
 */
?>
<article class="news-block  wow fadeInUp"  id="post-<?php the_ID(); ?>" >
	<div class="news-inner">
		<div class="row">
		   <?php if(has_post_thumbnail()) { ?>
			<div class="post-thumbnail col-sm-6">
			  
		    	
		    	 <a href="<?php the_permalink(); ?>">
		       <?php   the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
		          </a>  
	         
			</div>
		  <?php   } ?>
			<div class="news-info <?php if(has_post_thumbnail()) { echo "col-sm-6 text-left"; } else{ echo "col-sm-12"; } ?> ">
				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h4>
				<div class="date"><?php capacious_post_date(); ?></div>
				<div class="content"><p>
				 <?php 
				     the_excerpt();				     
				   ?> 
				</p></div>
			
				<div class="name"><span><?php capacious_blog_list() ?></span></div>
                   <div class="comments"><i class="fa fa fa-comments" aria-hidden="true"></i><a href="<?php comments_link(); ?>"><?php comments_number( '0 comments', '1 comments', '% comments' ); ?></a></div>
			 	</div>
		</div>
	</div>
</article>
