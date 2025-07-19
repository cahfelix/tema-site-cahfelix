<p>COMPARTILHE:</p>
<ul class="social-share">
    <li class="facebook">
       <a href="https://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" title="Compartilhe este post no Facebook!"><i class="icon-facebook"></i></a>
    </li>
    <li class="twitter">
       <a href="https://twitter.com/home?status=<?php echo urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); ?>: <?php the_permalink(); ?>" title="Compartilhe este post no Twitter"><i class="icon-twitter"></i></a>
    </li>
    <li class="google-plus">
       <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" title="Compartilhe este post no Google Plus!"><i class="icon-google-plus"></i></a>
    </li>
    <li class="linkedin">
       <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); ?>&source=LinkedIn" title="Compartilhe este post no Linkedin"><i class="icon-linkedin"></i></a>
    </li>
    <li class="pinterest">
       <a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&media=<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>&description=<?php the_title();?> on <?php bloginfo('name'); ?> <?php echo site_url()?>" class="pin-it-button" count-layout="horizontal" title="Compartilhe este post no Pinterest"><i class="icon-pinterest"></i></a>
    </li>
    <li class="email">
       <a title="Por Email" href="mailto:?subject=Check this post - <?php the_title();?> &amp;body= <?php the_permalink()?>&amp;title="<?php the_title()?>" email"=""><i class="icon-envelope"></i></span></a>
    </li>
    <li class="whatsapp">    
        <a href="whatsapp://send?text=<?php esc_attr(the_permalink()); ?>?utm_source=whatsapp&amp;"><i class="icon-whatsapp">&#xf232;</i></a>
    </li>
</ul>		