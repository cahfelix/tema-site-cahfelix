<!-- 
  pegar imagem menor
-->

<?php
  $thumb = get_the_post_thumbnail_url(get_the_ID(), 'featured-image' );
  $thumb_amp = get_the_post_thumbnail_url(get_the_ID(), 'amp_img');
  $image_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "featured-image" );

  global $ti_option;
  global $post;
  setup_postdata( $post );
?>
<!doctype html>
<html amp lang="en">
  <head>
    <meta charset="utf-8">
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
    <script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
    
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="canonical" href="<?php echo get_the_permalink(); ?>" />
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php echo esc_attr( get_the_title() ); ?>" />
    <meta property="og:url" content="<?php echo esc_url( get_the_permalink() ); ?>" />
    <meta property="og:description" content="<?php echo esc_attr( get_the_excerpt() ); ?>" />
    <meta property="article:published_time" content="<?php echo get_the_time('Y-m-j\TH:i:s\+00:00'); ?>" />
    <meta property="article:modified_time" content="<?php echo get_the_modified_time('Y-m-j\TH:i:s\+00:00'); ?>" />
    <meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo('name') ); ?>" />
    <meta property="og:image" content="<?php echo esc_url($thumb); ?>" />
    <meta property="og:locale" content="pt_BR" />
    <meta name="twitter:site" content="@carpe_mundi" />
    <meta name="twitter:image:src" content="<?php echo esc_url($thumb); ?>" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta property="article:publisher" content="https://www.facebook.com/carpemundi/" />
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
    
    <script type="application/ld+json">
      {
        "@context": "http://schema.org",
        "@type": "NewsArticle",
        "headline": "<?php wp_title( '|', true, 'right' ); ?>",
        "datePublished": "<?php echo get_the_time('Y-m-j\TH:i:s\Z') ?>",
        "dateModified": "<?php echo get_the_modified_date('Y-m-j\TH:i:s\Z'); ?>",
        "mainEntityOfPage": "<?php echo esc_url( get_the_permalink() ); ?>",
        "author": {
          "@type": "Person",
          "name": "Cah Felix"
        },
        "image": {
          "@type": "ImageObject",
          "url": "<?php echo $image_data[0]; ?>",
          "width": "<?php echo $image_data[1]; ?>",
          "height": "<?php echo $image_data[2]; ?>"
        },
        "publisher":{
			    "@type": "Organization",
			    "name": "Cah Felix",
          "logo": {
            "@type": "ImageObject",
            "url": "https://cahfelix.com/wp-content/uploads/2015/07/logo_port.png",
            "width": "300",
            "height": "68"
          }
        }
      }
    </script>
    
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <style amp-custom>
      @font-face {
        font-family: "icon";
        src: url('/wp-content/themes/cah-felix/font/icon.eot?63090132');
        src: url('/wp-content/themes/cah-felix/font/icon.eot?63090132#iefix') format('embedded-opentype'),
             url('/wp-content/themes/cah-felix/font/icon.woff?63090132') format('woff'),
             url('/wp-content/themes/cah-felix/font/icon.ttf?63090132') format('truetype'),
             url('/wp-content/themes/cah-felix/font/icon.svg?63090132#icon') format('svg');     
        font-weight: normal;
        font-style: normal;
      }
      a:link, a:visited {
        color: #000;
        text-decoration: none;
      }
      ul, ol {
        padding: 0px 30px 20px;
      }
      h1, h2, h3, h4, h5, h6 {
        font-family: 'Oswald',sans-serif;
        font-weight: normal
      }
      h1 {
        margin: 20px 0 10px;
      }
      h2 {
        font-family: 'Oswald',sans-serif;
        display: block;
        margin: 0 0 21px;
        text-transform: uppercase;
      }
      h3 {
        font-size: 22px;
        margin: 40px 0 10px;
        line-height: 30px;
      }
      /*
      h4 {
        font-size: 20px;
      } */

      .amp-logo {
        display: block;
        margin: auto;
      }
      .amp-content {
        max-width: 600px;
        margin: auto;
        font-family: "Lato", sans-serif;
        color: #333333;
      }
      .amp-content p, 
      .amp-content ul,
      .amp-content ol {
        /* font-size: 18px;
        line-height: 1.5;
        font-weight: 300;
        margin: 0 0 30px; */
        font-size: 1.1rem;
        font-family: 'Open Sans', sans-serif;
        font-weight: 300;
        font-style: normal;
        line-height: 2;
        letter-spacing: .01rem;
        margin: 0 auto 0.875rem;
      }
      .amp-wp-meta {
        margin: 0;
        padding: 0;
      }
      .amp-wp-meta li {
        list-style: none;
        padding: 10px 0;
      }
      .amp-excerpt {
        font-size: 18px;
      }
      .share {
        display: block;
        border-top: 1px solid rgba(0, 0, 0, 0.12);       
      }
      .icons {
        font-family: "icon";
        font-weight: normal;
        font-style: normal;
        font-size: 20px;
        display: inline-block;
        color: #fff;
        width: 70px;
        text-align: center;
        width: 32.2%;
        padding: 8px 0;
      }
      .icon-facebook {
        background-color: #3B5999;
      }
      .icon-twitter {
        background-color: #54ABEE;
      }
      .icon-whatsapp {
        background: #20b038;
      }
      .article {
        padding: 10px 20px;
      }
      p.article-author,
      p.article-date {
        margin: 0;
        line-height: 24px;
        line-height: 16px;
        color: #626262;
        font-size: 13px;
        font-weight: 400;
      }
      .nome_cat, .amp-wp-category {
        display: inline-block;
        padding: 5px 8px;
        text-transform: uppercase;
        font-family: "Lato", sans-serif;
        font-size: 14px;
        font-weight: bold;
        color: white;
        background-color: #414141;
        margin-bottom: 0;
      }

      footer {
        background: #414141;
        color: #fff;  
        font-family: "Lato", sans-serif;
        margin-top: 30px;
      }
      p.footer {
        font-size: 11px;
        border-top: 1px solid rgba(0, 0, 0, 0.12);  
        text-align: center;
        padding: 10px;
        margin: 10px;
      }
      .footer-ad {
        text-align: center;
      }

      pre {
        background: #333333;
        color: #fff;
        padding: 15px;
        margin: 30px 0;
        /* border-radius: 5px; */
        white-space: pre-wrap;
      }
    </style>
  </head>

  <body>
    <amp-analytics type="googleanalytics">
      <script type="application/json">
      {
        "vars": {
          "account": "UA-13303287-5"
        },
        "triggers": {
          "trackPageview": {
            "on": "visible",
            "request": "pageview"
          }
        }
      }
      </script>
    </amp-analytics>
    
    <div class="amp-content">
      <div class="amp-wp-title-bar">
        <a href="<?php echo get_home_url(); ?>">
          <amp-img
          class='amp-logo'
          src="https://cahfelix.com/wp-content/uploads/2015/07/logo_port.png"
          width="170"
          height="95"
          alt="logo carpe mundi">
          </amp-img>
        </a>
      </div>
    
      <?php if( has_post_thumbnail() ){ ?>
        <amp-img
        src="<?php echo esc_url($thumb_amp); ?>"
        srcset="<?php echo esc_url($thumb_amp).' 640w, '.esc_url($thumb_amp).' 320w'; ?>"
        width="1920"
        height="1280"
        layout="responsive"
        alt="">
        </amp-img>
      <?php } ?>
      <div class="article">
        <div class="amp-wp-category">
          <?php 
            $cats = get_the_category();
            print( $cats[0]->name);
          ?>
        </div>
        <h1 class="amp-wp-title"><?php echo esc_html( get_the_title() ); ?></h1>

        <ul class="amp-wp-meta">
          <li class='article-author-time'>
              <p class='article-author'>Por <a href="<?php print $autor_url ?>" title="Ver mais posts desta autora" class="autor_nome"><?php the_author() ?></a></p>
              <p class='article-date'>Publicado em <time class="entry-date published updated" datetime="<?php the_date( 'c' ) ?>"><?php print get_the_date() ?></time></p>
          </li>
      
          <li class="share">
            <!-- 
            <i class="demo-icon icon-twitter">&#xf099;</i>
            <i class="demo-icon icon-facebook">&#xf09a;</i>
            <i class="demo-icon icon-gplus">&#xf0d5;</i>
            <i class="demo-icon icon-linkedin">&#xf0e1;</i>
            <i class="demo-icon icon-whatsapp">&#xf232;</i> 
            -->
            <a
              href="https://facebook.com/sharer/sharer.php?u=<?php esc_attr(the_permalink()); ?>?utm_source=facebook&amp;" 
              target="_blank">
              <i class="icons icon-facebook">&#xf09a;</i>
            </a>
            <a
              href="https://twitter.com/home?status=<?php esc_attr(the_permalink()); ?>?utm_source=twitter&amp;" 
              target="_blank">
              <i class="icons icon-twitter">&#xf099;</i>  
              </a>
            <a
              href="whatsapp://send?text=<?php esc_attr(the_permalink()); ?>?utm_source=whatsapp&amp;">
              <i class="icons icon-whatsapp">&#xf232;</i>
            </a>
          </li>
        </ul> 

        <div class="article-content">
          <?php
            $content = wpautop( get_the_content() );
            $content = str_replace('<iframe', '<amp-iframe frameborder="0" layout="responsive"', $content);
            $content = str_replace('<img', '<amp-img layout="responsive"', $content);
            
            $allowed_html = array(
              'amp-img' => array(
                'src' => true,
                'srcset' => true,
                'width' => true,
                'height' => true,
                'layout' => true,
                'alt' => true,
                'sizes' => true
              ),
              'p' => array('align' => true),
              'a' => array(
                'href' => array(),
                'title' => array(),
              ),
              'span' => array(),
              // 'div' => array(),
              'div' => array('class' => true),
              'b' => array(),
              'u' => array(),
              'strong' => array(),
              'iframe' => array(),
              'h1' => array('align' => true),
              'h2' => array('align' => true),
              'h3' => array('align' => true),
              'h4' => array('align' => true),
              'h5' => array('align' => true),
              'h6' => array('align' => true),
              'br' => array('align' => true),
              'i' => array(),
              'ul' => array(),
              'ol' => array(),
              'li' => array(),
              'pre' => array(),
              );

              echo wp_kses($content, $allowed_html);
            ?>
        </div> 

        <!-- <div class="footer-ad">
          <amp-ad
            width=300
            height=250
            type="adsense"
            data-ad-client="ca-pub-5604719799704952"
            data-ad-slot="5936160424">
          </amp-ad>
        </div> -->

      </div> 
    </div>   
    <footer>
      <p class="footer" >© 2008-2017 - Portfolio da web designer e freelancer - Cah Felix. Todos os direitos reservados. All rights reserved.</p>
    </footer>  
  </body>
</html>