<?php

if ( ! function_exists( 'river_qode_is_css_folder_writable' ) ) {
	function river_qode_is_css_folder_writable() {
		return is_writable( QODE_CSS_ROOT_DIR );
	}
}

if ( ! function_exists( 'river_qode_is_js_folder_writable' ) ) {
	function river_qode_is_js_folder_writable() {
		return is_writable( QODE_JS_ROOT_DIR );
	}
}

if ( ! function_exists( 'river_qode_get_multisite_blog_id' ) ) {
	function river_qode_get_multisite_blog_id() {
		if ( is_multisite() ) {
			return get_blog_details()->blog_id;
		}
	}
}

if ( ! function_exists( 'river_qode_generate_dynamic_css_and_js' ) ) {
	/**
	 * Function that gets content of dynamic assets files and puts that in static ones
	 */
	function river_qode_generate_dynamic_css_and_js() {
		global $wp_filesystem;
		WP_Filesystem();
		
		if ( river_qode_is_css_folder_writable() ) {
			
			ob_start();
			include_once QODE_CSS_ROOT_DIR . '/style_dynamic.php';
			$css = ob_get_clean();
			if ( is_multisite() ) {
				$wp_filesystem->put_contents( QODE_CSS_ROOT_DIR . '/style_dynamic_ms_id_' . river_qode_get_multisite_blog_id() . '.css', $css );
			} else {
				$wp_filesystem->put_contents( QODE_CSS_ROOT_DIR . '/style_dynamic.css', $css );
			}
			
			ob_start();
			include_once QODE_CSS_ROOT_DIR . '/style_dynamic_responsive.php';
			$css = ob_get_clean();
			if ( is_multisite() ) {
				$wp_filesystem->put_contents( QODE_CSS_ROOT_DIR . '/style_dynamic_responsive_ms_id_' . river_qode_get_multisite_blog_id() . '.css', $css );
			} else {
				$wp_filesystem->put_contents( QODE_CSS_ROOT_DIR . '/style_dynamic_responsive.css', $css );
			}
		}
		
		if ( river_qode_is_js_folder_writable() ) {
			
			ob_start();
			include_once QODE_JS_ROOT_DIR . '/default_dynamic.php';
			$js = ob_get_clean();
			if ( is_multisite() ) {
				$wp_filesystem->put_contents( QODE_JS_ROOT_DIR . '/default_dynamic_ms_id_' . river_qode_get_multisite_blog_id() . '.js', $js );
			} else {
				$wp_filesystem->put_contents( QODE_JS_ROOT_DIR . '/default_dynamic.js', $js );
			}
		}
	}
	
	add_action( 'river_qode_action_after_theme_option_save', 'river_qode_generate_dynamic_css_and_js' );
}

if ( ! function_exists( 'river_qode_add_style_dynamic' ) ) {
	function river_qode_add_style_dynamic() {
		$river_options = river_qode_return_global_options();
		?>
		
		<?php if (!empty($river_options['selection_color'])) { ?>
			/* Webkit */
			::selection {
			background: <?php echo esc_attr($river_options['selection_color']);  ?>;
			}
		<?php } ?>
		<?php if (!empty($river_options['selection_color'])) { ?>
			/* Gecko/Mozilla */
			::-moz-selection {
			background: <?php echo esc_attr($river_options['selection_color']);  ?>;
			}
		<?php } ?>
		<?php if (!empty($river_options['first_color'])) { ?>
			table th,
			table tr:nth-child(odd) td,
			nav.main_menu > ul > li:hover > a span,
			.icon_list i,
			.progress_bar .progress_content,
			.progress_bars_vertical .progress_content_outer .progress_content,
			.box_holder_icon_inner.square .icon-stack,
			.qbutton,
			.load_more a,
			#submit_comment,
			.drop_down .wide .second ul li .qbutton,
			.drop_down .wide .second ul li ul li .qbutton,
			.call_to_action.elegant .cta_button,
			.portfolio_gallery a .gallery_text_holder,
			.projects_holder article span.text_holder,
			.filter_holder ul li.active span,
			.tabs .tabs-nav li.active a,
			.highlight,
			.testimonials .testimonial_nav li.active a,
			.gallery_holder ul li .gallery_hover,
			.active_best_price,
			.progress_bars_icons_inner.square .bar.active .bar_noactive,
			.progress_bars_icons_inner.square .bar.active .bar_active,
			.list.number.circle_number ul>li:before,
			.social_share_dropdown ul li.share_title,
			.blog_holder article.format-link .post_text .post_text_holder,
			.blog_holder article.format-quote .post_text .post_text_holder,
			.single_links_pages > span,
			.single_links_pages a:hover,
			.single_tags a,
			.pagination ul li span,
			.widget.widget_search form input[type="submit"],
			.widget .tagcloud a,
			.steps_holder .circle_small,
			.mejs-controls .mejs-time-rail .mejs-time-current,
			.mejs-controls .mejs-time-rail .mejs-time-handle,
			.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
			.pie_graf_legend ul li .color_holder,
			.line_graf_legend ul li .color_holder,
			.circle_item .circle,
			nav.main_menu > ul > li.active > a > span,
			.projects_holder.circle .mix .image .circle_hover
			{
			background-color: <?php echo esc_attr($river_options['first_color']);?>;
			}
			
			.icon_with_title.boxed .icon_holder .icon-stack:hover,
			footer .social_icon_holder .icon-stack:hover,
			.side_menu .social_icon_holder .icon-stack:hover{
			background-color: <?php echo esc_attr($river_options['first_color']);?> !important;
			}
			
			<?php $article_hover = river_qode_hex2rgb($river_options['first_color']); ?>
			
			.portfolio_gallery a .gallery_text_holder,
			.projects_holder article span.text_holder,
			.gallery_holder ul li .gallery_hover{
			background-color: rgba(<?php echo esc_attr($article_hover[0]); ?>,<?php echo esc_attr($article_hover[1]); ?>,<?php echo esc_attr($article_hover[2]); ?>,0.9);
			}
			
			a:hover,
			p a:hover,
			.drop_down .wide .second ul li a,
			.title .breadcrumb .current,
			.title .breadcrumb a:hover,
			.box_image_holder .box_icon .icon-stack i.icon-stack-base,
			.counter_holder span.counter,
			.box_holder_icon i,
			.box_holder_icon .icon-stack i.icon-circle,
			.qbutton.no_fill,
			.qbutton.no_fill:hover,
			.portfolio_like a.liked i,
			.portfolio_like a:hover i,
			.portfolio_single .portfolio_like a.liked i,
			.portfolio_single .portfolio_like a:hover i,
			.accordion_holder.accordion.with_icon .ui-accordion-header i,
			.testimonial_text_inner .testimonial_name .author_desc,
			blockquote i.pull-left,
			.dropcap,
			.message.with_icon > i,
			.price_in_table .value,
			.icon_with_title .icon_holder i,
			.font_awsome_icon_square i,
			.font_awsome_icon_stack i,
			.font_awsome_icon i,
			.progress_bars_icons_inner.normal .bar.active i,
			.progress_bars_icons_inner .bar.active i.icon-circle,
			.list.number ul>li:before,
			.social_icon_holder .icon-stack i,
			.blog_holder article .post_text  h2 .date,
			.blog_holder article .post_infos a:hover,
			.blog_holder article .post_infos .post_author:hover,
			.blog_holder article .post_infos .post_comments:hover,
			.blog_holder article  .post_icons_holder  a.post_comments:hover i ,
			.blog_holder article  .post_icons_holder  a.post_comments:hover,
			.blog_like a:hover i,
			.blog_like a.liked i,
			.blog_like a:hover span,
			.social_share_dropdown ul li:hover .share_text,
			.social_share_dropdown ul li :hover i,
			.blog_holder article.format-quote .post_text i.qoute_mark,
			.blog_holder article.format-link .post_text i.link_mark,
			aside .widget li a:hover,
			.footer_top .widget_recent_entries > ul > li > a:hover,
			#back_to_top:hover,
			.vc_text_separator.full div,
			aside .widget #lang_sel ul ul a:hover,
			aside .widget #lang_sel_click ul ul a:hover,
			section.side_menu #lang_sel ul ul a:hover,
			section.side_menu #lang_sel_click ul ul a:hover,
			footer #lang_sel ul ul a:hover,
			footer #lang_sel_click ul ul a:hover,
			aside .widget #lang_sel_list li a:hover,
			section.side_menu #lang_sel_list li a:hover,
			footer #lang_sel_list li a:hover,
			aside .widget #lang_sel_list.lang_sel_list_vertical a.lang_sel_sel,
			aside .widget #lang_sel_list.lang_sel_list_horizontal a.lang_sel_sel
			{
			color: <?php echo esc_attr($river_options['first_color']);?>;
			}
			
			.icon_with_title.circle .icon_holder .icon-stack:hover i.icon-circle,
			.font_awsome_icon_stack:hover .icon-circle{
			color: <?php echo esc_attr($river_options['first_color']);?> !important;
			}
			
			.ajax_loader_html,
			.box_image_with_border:hover,
			.qbutton.no_fill,
			.tabs .tabs-nav li.active a,
			#respond textarea:focus,
			#respond input[type='text']:focus,
			.contact_form input[type='text']:focus,
			.contact_form  textarea:focus,
			.widget.widget_search form input[type="text"]:focus,
			.vc_text_separator.full div
			{
			border-color: <?php echo esc_attr($river_options['first_color']);?>;
			}
		<?php } ?>
		<?php if (!empty($river_options['second_color'])) { ?>
			.separator,
			.call_to_action,
			.portfolio_navigation .portfolio_prev a,
			.portfolio_navigation .portfolio_next a,
			.tabs .tabs-nav li a,
			.accordion_holder.accordion .ui-accordion-header,
			.testimonials .testimonial_text_inner,
			blockquote,
			.message,
			.price_table_inner ul ul li:nth-child(odd),
			.price_table_inner ul li.table_title,
			.icon_with_title.boxed .icon_holder .icon-stack,
			.font_awsome_icon_square,
			.progress_bars_icons_inner.square .bar .bar_noactive,
			.progress_bars_icons_inner.square .bar .bar_active,
			.social_icon_holder .icon-stack,
			.social_share_dropdown ul li,
			.pagination ul li a,
			.mejs-controls .mejs-time-rail .mejs-time-total,
			.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total,
			.circle_item .circle:hover
			{
			background-color: <?php echo esc_attr($river_options['second_color']);?>;
			}
			
			.portfolio_navigation .portfolio_button a i,
			.icon_with_title.circle .icon_holder .icon-stack i.icon-circle,
			.font_awsome_icon_stack .icon-circle,
			.icon_with_title.boxed .icon_holder .icon-stack,
			.font_awsome_icon_square,
			.progress_bars_icons_inner.normal .bar i,
			.progress_bars_icons_inner .bar i.icon-circle,
			.social_icon_holder .icon-stack i.icon-circle,
			.blog_holder.small_images article.format-audio .post_image a i,
			.blog_holder.small_images article.format-link .post_image a i,
			.blog_holder.small_images article.format-quote .post_image a i
			{
			color: <?php echo esc_attr($river_options['second_color']);?>;
			}
			
			.box_image_with_border,
			.box_holder,
			.portfolio_navigation,
			.icon_with_title.with_border_line .icon_text_inner,
			.blog_holder article,
			.author_description,
			.comment_holder  ul.comment-list,
			.comment_holder .comment,
			#respond textarea,
			#respond input[type='text'],
			.contact_form input[type='text'],
			.contact_form  textarea,
			aside .widget,
			.side_menu .widget,
			.widget.widget_archive select,
			.widget.widget_categories select,
			.widget.widget_text select,
			.widget.widget_search form input[type="text"],
			.vc_text_separator.full,
			aside .widget #lang_sel > ul > li,
			aside .widget #lang_sel_click > ul > li,
			aside .widget #lang_sel ul ul,
			aside .widget #lang_sel_click ul ul,
			section.side_menu #lang_sel ul ul,
			section.side_menu #lang_sel_click ul ul,
			footer #lang_sel ul ul,
			footer #lang_sel_click ul ul
			{
			border-color: <?php echo esc_attr($river_options['second_color']);?>;
			}
		<?php } ?>
		<?php if (!empty($river_options['third_color'])) { ?>
			
			.header_bottom,
			.progress_bar .progress_content_outer,
			.projects_holder.hover_text article .image .image_hover,
			.social_share_dropdown ul,
			aside .widget #lang_sel ul ul a:hover,
			aside .widget #lang_sel_click ul ul a:hover,
			section.side_menu #lang_sel ul ul a:hover,
			section.side_menu #lang_sel_click ul ul a:hover,
			footer #lang_sel ul ul a:hover,
			footer #lang_sel_click ul ul a:hover,
			.image_with_text_over .over_line
			{
			background-color: <?php echo esc_attr($river_options['third_color']);?>;
			}
			
			<?php $article_bg = river_qode_hex2rgb($river_options['third_color']); ?>
			
			.projects_holder.hover_text article .image .image_hover{
			background-color: rgba(<?php echo esc_attr($article_bg[0]); ?>,<?php echo esc_attr($article_bg[1]); ?>,<?php echo esc_attr($article_bg[2]); ?>,0.85);
			}
			
			table tr:nth-child(odd) td,
			nav.main_menu > ul > li:hover > a,
			nav.main_menu > ul > li.active > a,
			.drop_down .second .inner ul li:hover a,
			.drop_down .second .inner ul li.sub ul li:hover a,
			.drop_down .wide .second ul li a:hover,
			.drop_down .wide .second .inner ul li.sub ul li a:hover,
			.drop_down .wide .second .inner > ul > li > a,
			.drop_down .wide .second .inner > ul > li > h3,
			.drop_down .wide.icons  .second a:hover i,
			nav.mobile_menu ul li a:hover,
			nav.mobile_menu ul li.active > a,
			.icon_list i,
			.progress_bar .progress_number_wrapper,
			.progress_bar .progress_number,
			.box_holder_icon .icon-stack i,
			.qbutton,
			.load_more a,
			#submit_comment,
			.drop_down .wide .second ul li .qbutton,
			.drop_down .wide .second ul li ul li .qbutton,
			.qbutton:hover,
			.load_more a:hover,
			#submit_comment:hover,
			.drop_down .wide .second ul li .qbutton:hover,
			.drop_down .wide .second ul li ul li .qbutton:hover,
			.call_to_action.elegant .cta_button,
			.call_to_action.elegant .cta_button i,
			.portfolio_navigation .portfolio_prev a:hover,
			.portfolio_navigation .portfolio_next a:hover,
			.portfolio_gallery a .gallery_text_inner h3,
			.projects_holder.hover_text article h4 a,
			.projects_holder.circle article h4 a,
			.projects_holder.hover_text article .portfolio_like a i,
			.projects_holder.hover_text article .portfolio_like a.liked i,
			.projects_holder.hover_text article .portfolio_like a:hover i,
			.projects_holder.hover_text article .portfolio_like span,
			.projects_holder.circle article .portfolio_like a i,
			.projects_holder.circle article .portfolio_like a.liked i,
			.projects_holder.circle article .portfolio_like a:hover i,
			.projects_holder.circle article .portfolio_like span,
			.projects_holder article span.text_holder span span.text_inner,
			.projects_holder article span.text_holder span span.text_inner h5 a,
			.projects_holder article a.lightbox,
			.projects_holder article a.preview,
			.projects_holder.hover_text article .portfolio_like,
			.projects_holder.circle article .portfolio_like,
			.filter_holder ul li.active span,
			.filter_holder ul li:hover span,
			.tabs .tabs-nav li a:hover,
			.tabs .tabs-nav li.active a,
			.highlight,
			.gallery_holder ul li .gallery_hover i,
			.active_best_price,
			.flexslider.widget_flexslider h3,
			.drop_down .wide .second ul li ul li .flexslider.widget_flexslider h3,
			.drop_down .wide .second ul li ul li .flexslider.widget_flexslider h3 a,
			.drop_down .wide.icons .second .flexslider.widget_flexslider ul.flex-direction-nav i,
			.drop_down .wide .second .inner ul li.sub .flexslider.widget_flexslider .menu_recent_post_text a:hover,
			.progress_bars_icons_inner .bar i,
			.list.number.circle_number ul>li:before,
			.social_share_dropdown ul li.share_title,
			.blog_holder article.format-link .post_text .post_infos,
			.blog_holder article.format-link .post_text .post_infos a,
			.blog_holder article.format-link .post_text .post_infos .post_author,
			.blog_holder article.format-link .post_text .post_social .blog_like a i,
			.blog_holder article.format-link .post_text .post_social .blog_like a span,
			.blog_holder article.format-link .post_text p,
			.blog_holder article.format-link .post_text p a,
			.blog_holder article.format-quote .post_text .post_infos,
			.blog_holder article.format-quote .post_text .post_infos a,
			.blog_holder article.format-quote .post_text .post_infos .post_author,
			.blog_holder article.format-quote .post_text .post_social .blog_like a i,
			.blog_holder article.format-quote .post_text .post_social .blog_like a span,
			.blog_holder article.format-quote .post_text p,
			.blog_holder article.format-quote .post_text p a,
			.blog_holder article.format-quote .post_text i.qoute_mark,
			.blog_holder article.format-link .post_text i.link_mark,
			.blog_holder article.format-quote .post_text .quote_author,
			.blog_holder article.format-link .post_text .post_icons_holder a.post_comments i,
			.blog_holder article.format-quote .post_text .post_icons_holder a.post_comments i,
			.blog_holder article.format-link .post_text .post_icons_holder a.post_comments,
			.blog_holder article.format-quote .post_text .post_icons_holder a.post_comments,
			.single_tags a,
			.pagination ul li span,
			.pagination ul li a:hover,
			.pagination ul li.next a:hover i,
			.pagination ul li.prev a:hover i,
			.pagination ul li.last a:hover i,
			.pagination ul li.first a:hover i,
			.footer_top .widget.widget_search form input[type="text"],
			.widget .tagcloud a,
			footer,
			.footer_top h4,
			.footer_top a:hover,
			.footer_top .widget_recent_entries > ul > li > a,
			#back_to_top span,
			.steps_holder .circle_small,
			.steps_holder a.circle_small_inner,
			.steps_holder .circle_small .step_title,
			.flex-direction-nav a,
			.me-cannotplay a,
			.header_top #lang_sel ul > li:hover > a,
			.header_top #lang_sel_click ul > li:hover > a,
			.header_top #lang_sel ul li ul li a:hover,
			.header_top #lang_sel_click ul li ul li a:hover,
			.header_top #lang_sel_list ul li a,
			.header_top #lang_sel_list ul li a:visited,
			footer #lang_sel li:hover a.lang_sel_sel,
			footer #lang_sel_click li:hover a.lang_sel_sel,
			section.side_menu #lang_sel li:hover a.lang_sel_sel,
			section.side_menu #lang_sel_click li:hover a.lang_sel_sel,
			section.side_menu #lang_sel_list.lang_sel_list_horizontal a.lang_sel_sel,
			section.side_menu #lang_sel_list.lang_sel_list_vertical a.lang_sel_sel,
			footer #lang_sel ul ul a:hover,
			footer #lang_sel_click ul ul a:hover,
			.side_menu #lang_sel ul ul a:hover,
			.side_menu #lang_sel_click ul ul a:hover,
			footer #lang_sel_list.lang_sel_list_horizontal a:hover,
			footer #lang_sel_list.lang_sel_list_vertical a:hover,
			.side_menu #lang_sel_list.lang_sel_list_horizontal a:hover,
			.side_menu #lang_sel_list.lang_sel_list_vertical a:hover,
			#lang_sel_footer a:hover,
			.ls-preview .ls-nav-prev,
			.ls-preview .ls-nav-next,
			.image_with_text_over .text p,
			.image_with_text_over .caption,
			.image_with_text_over .subtitle,
			.circle_item .circle,
			.circle_item .circle a,
			.header_top .searchform input[type="text"]
			{
			color: <?php echo esc_attr($river_options['third_color']);?>;
			}
			
			.icon_with_title.circle .icon_holder .icon-stack:hover i:last-child,
			.font_awsome_icon_stack:hover i:last-child,
			.icon_with_title.boxed .icon_holder .icon-stack:hover i,
			.social_icon_holder .icon-stack:hover i,
			.side_menu a:hover,
			.steps_holder .circle_small:hover span,
			.steps_holder .circle_small:hover .step_title
			{
			color: <?php echo esc_attr($river_options['third_color']);?> !important;
			}
		<?php } ?>
		<?php if (!empty($river_options['fourth_color'])) { ?>
			h1,h2,h3,h4,h5,h6,a,p a,
			.title h1,
			.title .breadcrumb,
			.title .breadcrumb h1,
			.percentage,
			.call_to_action,
			.projects_holder.hover_text article .image .image_hover h4 a,
			.testimonial_text_inner .testimonial_name,
			.message p,
			.message .message_text,
			.price_table_inner ul li.table_title,
			.price_in_table .value,
			.price_in_table .price,
			.price_in_table .mark,
			.flexslider.widget_flexslider ul li h3 a,
			.drop_down .wide .second .inner ul li.flexslider.widget_flexslider ul li h3 a,
			.blog_holder article .post_infos a,
			.blog_holder article .post_infos .post_author,
			.blog_holder article .post_infos .post_comments,
			.comment_number_holder .comment_number,
			.widget.widget_rss li a.rsswidget,
			#wp-calendar caption,
			.mejs-container .mejs-controls .mejs-time,
			.mejs-container .mejs-controls .mejs-time span,
			.mejs-controls .mejs-time-rail .mejs-time-float,
			.circle_item .circle:hover,
			.circle_item .circle:hover a,
			.call_to_action_text_wrapper p
			{
			color: <?php echo esc_attr($river_options['fourth_color']);?>;
			}
			
			.separator.small,
			.flexslider.widget_flexslider ul.flex-direction-nav a.flex-next:hover,
			.drop_down .wide .second .inner ul li.sub .flexslider.widget_flexslider ul.flex-direction-nav a.flex-next:hover,
			.flexslider.widget_flexslider ul.flex-direction-nav a.flex-prev:hover,
			.drop_down .wide .second .inner ul li.sub .flexslider.widget_flexslider ul.flex-direction-nav a.flex-prev:hover,
			#back_to_top:hover span,
			.flexslider .flex-next:hover,
			.flexslider .flex-prev:hover,
			.ls-preview .ls-nav-prev,
			.ls-preview .ls-nav-next
			{
			background-color: <?php echo esc_attr($river_options['fourth_color']);?>;
			}
		<?php } ?>
		<?php if (!empty($river_options['fifth_color'])) { ?>
			.title,
			.progress_bar .progress_content_outer,
			.progress_bars_vertical .progress_content_outer,
			.tabs.boxed .tab-content,
			.accordion_holder.accordion .ui-accordion-header.ui-state-active,
			.accordion_holder.accordion div.accordion_content,
			.price_table_inner ul ul li:nth-child(even),
			.price_table_inner ul li.prices,
			.price_table_inner .price_button,
			aside .widget #lang_sel > ul > li > a,
			aside .widget #lang_sel_click > ul > li > a,
			section.side_menu #lang_sel > ul > li > a,
			section.side_menu #lang_sel_click > ul > li > a,
			footer #lang_sel > ul > li > a,
			footer #lang_sel_click > ul > li > a,
			.qode_call_to_action.container
			{
			background-color: <?php echo esc_attr($river_options['fifth_color']);?>;
			}
			
			aside .widget #lang_sel ul ul a,
			aside .widget #lang_sel_click ul ul a,
			aside .widget #lang_sel ul ul a:visited,
			aside .widget #lang_sel_click ul ul a:visited,
			footer #lang_sel ul ul a,
			footer #lang_sel_click ul ul a,
			footer #lang_sel ul ul a:visited,
			footer #lang_sel_click ul ul a:visited
			{
			background-color: <?php echo esc_attr($river_options['fifth_color']);?> !important;
			}
		<?php } ?>
		<?php if (!empty($river_options['sixth_color'])) { ?>
			.drop_down .second .inner ul li a,
			.drop_down .second .inner ul li h5,
			.drop_down .second .inner ul li.sub ul li a,
			.drop_down .second .inner ul.right li.sub ul li a,
			.drop_down .wide .second .inner ul li.sub ul li a,
			.drop_down .wide .second ul li ul li a,
			.drop_down .wide.icons .second i,
			nav.mobile_menu ul li a span.mobile_arrow i,
			nav.mobile_menu ul li h3 span.mobile_arrow i,
			nav.mobile_menu ul li a,
			nav.mobile_menu ul li h3,
			.portfolio_navigation .portfolio_prev a,
			.portfolio_navigation .portfolio_next a,
			.filter_holder ul li span,
			.tabs .tabs-nav li a,
			.blog_holder article  .post_icons_holder  a.post_comments,
			.blog_like span,
			.social_share_dropdown ul li a,
			.social_share_dropdown ul li i,
			.blog_holder article .post_text p a,
			#respond textarea,
			#respond input[type='text'],
			.contact_form input[type='text'],
			.contact_form  textarea,
			.pagination ul li a,
			aside .widget li a,
			.widget.widget_search form input[type="text"],
			.header_top #lang_sel ul > li a.lang_sel_sel,
			.header_top #lang_sel_click ul > li a.lang_sel_sel,
			.header_top #lang_sel ul li ul li a,
			.header_top #lang_sel ul li ul li a:visited,
			.header_top #lang_sel_click ul li ul li a,
			.header_top #lang_sel_click ul li ul li a:visited,
			.header_top #lang_sel_list ul li a.lang_sel_other,
			footer #lang_sel > ul > li > a,
			footer #lang_sel_click > ul > li > a,
			section.side_menu #lang_sel > ul > li > a,
			section.side_menu #lang_sel_click > ul > li > a,
			aside .widget #lang_sel > ul li > a,
			aside .widget #lang_sel_click > ul li > a,
			section.side_menu #lang_sel > ul li > a,
			section.side_menu #lang_sel_click > ul li > a,
			footer #lang_sel > ul li > a,
			footer #lang_sel_click > ul li > a,
			footer #lang_sel a.lang_sel_sel,
			footer #lang_sel_click a.lang_sel_sel,
			section.side_menu #lang_sel > ul > li,
			section.side_menu #lang_sel_click > ul > li,
			footer #lang_sel ul ul a,
			footer #lang_sel_click ul ul a,
			footer #lang_sel ul ul a:visited,
			footer #lang_sel_click ul ul a:visited,
			section.side_menu #lang_sel ul ul a,
			section.side_menu #lang_sel_click ul ul a,
			section.side_menu #lang_sel ul ul a:visited,
			section.side_menu #lang_sel_click ul ul a:visited,
			footer #lang_sel_list.lang_sel_list_horizontal a,
			footer #lang_sel_list.lang_sel_list_vertical a,
			.side_menu #lang_sel_list.lang_sel_list_horizontal a,
			.side_menu #lang_sel_list.lang_sel_list_vertical a,
			#lang_sel_footer a
			{
			color: <?php echo esc_attr($river_options['sixth_color']);?>;
			}
			
			.testimonials .testimonial_nav li a{
			background-color: <?php echo esc_attr($river_options['sixth_color']);?>;
			}
			
			.call_to_action{
			border-color: <?php echo esc_attr($river_options['sixth_color']);?>;
			}
		<?php } ?>
		<?php if (!empty($river_options['seventh_color'])) { ?>
			#ascrail2000,
			.header_top,
			nav.main_menu > ul > li:hover > a > span,
			.drop_down .second .inner ul,
			.drop_down .second .inner ul li ul,
			nav.mobile_menu,
			.side_menu,
			.qbutton:hover,
			.load_more a:hover,
			#submit_comment:hover,
			.drop_down .wide .second ul li .qbutton:hover,
			.drop_down .wide .second ul li ul li .qbutton:hover,
			.portfolio_navigation .portfolio_prev a:hover,
			.portfolio_navigation .portfolio_next a:hover,
			.filter_holder ul li:hover span,
			.tabs .tabs-nav li a:hover,
			.blog_holder article.format-link .post_text:hover .post_text_holder,
			.blog_holder article.format-quote .post_text:hover .post_text_holder,
			.single_tags  a:hover,
			.pagination ul li a:hover,
			.widget.widget_search form input[type="submit"]:hover,
			.footer_top_holder
			{
			background-color: <?php echo esc_attr($river_options['seventh_color']);?>;
			}
			
			.social_icon_holder .icon-stack:hover,
			.steps_holder .circle_small:hover{
			background-color: <?php echo esc_attr($river_options['seventh_color']);?> !important;
			}
			
			.portfolio_navigation .portfolio_button a:hover i
			{
			color: <?php echo esc_attr($river_options['seventh_color']);?>;
			}
		<?php } ?>
		<?php if (!empty($river_options['background_color']) || !empty($river_options['text_color']) || !empty($river_options['text_fontsize']) || $river_options['google_fonts'] != "-1") { ?>
			body,
			.title .breadcrumb {
			<?php if (!empty($river_options['background_color'])) { ?> background-color:<?php echo esc_attr($river_options['background_color']);  ?>; <?php } ?>
			<?php if($river_options['google_fonts'] != "-1"){ ?>
				<?php $font = str_replace('+', ' ', $river_options['google_fonts']); ?>
				font-family: <?php echo esc_attr($font); ?>, sans-serif;
			<?php } ?>
			<?php if (!empty($river_options['text_color'])) { ?> color: <?php echo esc_attr($river_options['text_color']);  ?>; <?php } ?>
			<?php if (!empty($river_options['text_fontsize'])) { ?> font-size: <?php echo intval($river_options['text_fontsize']); ?>px; <?php } ?>
			}
			<?php if (!empty($river_options['background_color'])) { ?>
				.content{
				background-color:<?php echo esc_attr($river_options['background_color']);  ?>;
				}
			<?php } ?>
		<?php } ?>
		<?php if (!empty($river_options['background_color_box'])) { ?>
			.wrapper{
			<?php if (!empty($river_options['background_color_box'])) { ?> background-color:<?php echo esc_attr($river_options['background_color_box']);  ?>; <?php } ?>
			}
		<?php } ?>
		<?php
		$boxed = "no";
		if (isset($river_options['boxed']))
			$boxed = $river_options['boxed'];
		?>
		<?php if($boxed == "yes"){ ?>
			body.boxed .wrapper{
			<?php if (!empty($river_options['background_color_box'])) { ?> background-color:<?php echo esc_attr($river_options['background_color_box']);  ?>; <?php } ?>
			
			<?php if($river_options['pattern_background_image'] != ""){  ?>
				background-image: url('<?php echo esc_url($river_options['pattern_background_image']) ?>');
				background-position: 0px 0px;
				background-repeat: repeat;
			<?php } ?>
			
			<?php if($river_options['background_image'] != ""){  ?>
				background-image: url('<?php echo esc_url($river_options['background_image']) ?>');
				background-attachment: fixed;
				background-position: center 0px;
				background-repeat: no-repeat;
			<?php } ?>
			}
			body.boxed .content{
			<?php if (!empty($river_options['background_color'])) { ?> background-color:<?php echo esc_attr($river_options['background_color']);  ?>; <?php } ?>
			}
		<?php } ?>
		<?php if (!empty($river_options['highlight_color'])) { ?>
			span.highlight {
			background-color: <?php echo esc_attr($river_options['highlight_color']);  ?>;
			}
		<?php } ?>
		
		<?php if (!empty($river_options['header_background_color']) || $river_options['header_background_transparency_initial'] != "") {
			if(!empty($river_options['header_background_color'])){
				$bg_color = river_qode_hex2rgb($river_options['header_background_color']);
			}else{
				$bg_color = river_qode_hex2rgb('#ffffff');
			}
			if ($river_options['header_background_transparency_initial'] != "") {
				$bg_color_transparency = $river_options['header_background_transparency_initial'];
			}else{
				$bg_color_transparency = 1;
			}
			?>
			.header_bottom{
			background-color: rgba(<?php echo esc_attr($bg_color[0]); ?>,<?php echo esc_attr($bg_color[1]); ?>,<?php echo esc_attr($bg_color[2]); ?>,<?php echo esc_attr($bg_color_transparency); ?>);
			}
		<?php } ?>
		<?php
		if (!empty($river_options['header_background_color_scroll']) || $river_options['header_background_transparency_scroll'] != "") {
			
			if(!empty($river_options['header_background_color_scroll'])){
				$bg_color_scroll = river_qode_hex2rgb($river_options['header_background_color_scroll']);
			}else{
				$bg_color_scroll = river_qode_hex2rgb('#f0f2f2');
			}
			
			if ($river_options['header_background_transparency_scroll'] != "") {
				$bg_color_scroll_transparency = $river_options['header_background_transparency_scroll'];
			}else{
				$bg_color_scroll_transparency = 0.85;
			}
			?>
			header.scrolled .header_bottom{
			background-color: rgba(<?php echo esc_attr($bg_color_scroll[0]); ?>,<?php echo esc_attr($bg_color_scroll[1]); ?>,<?php echo esc_attr($bg_color_scroll[2]); ?>,<?php echo esc_attr($bg_color_scroll_transparency); ?>);
			}
		<?php } ?>
		<?php if (!empty($river_options['header_top_background_color']) || $river_options['header_background_transparency_initial'] != "") {
			if(!empty($river_options['header_top_background_color'])){
				$bg_color_top = river_qode_hex2rgb($river_options['header_top_background_color']);
			}else{
				$bg_color_top = river_qode_hex2rgb('#1C1C1C');
			}
			if ($river_options['header_background_transparency_initial'] != "") {
				$bg_color_transparency = $river_options['header_background_transparency_initial'];
			}else{
				$bg_color_transparency = 1;
			}
			
			?>
			.header_top{
			background-color: rgba(<?php echo esc_attr($bg_color_top[0]); ?>,<?php echo esc_attr($bg_color_top[1]); ?>,<?php echo esc_attr($bg_color_top[2]); ?>,<?php echo esc_attr($bg_color_transparency); ?>);
			}
		<?php } ?>
		<?php
		if (!empty($river_options['header_top_background_color']) || $river_options['header_background_transparency_scroll'] != "") {
			
			if(!empty($river_options['header_top_background_color'])){
				$bg_color_scroll_top = river_qode_hex2rgb($river_options['header_top_background_color']);
			}else{
				$bg_color_scroll_top = river_qode_hex2rgb('#1C1C1C');
			}
			
			if ($river_options['header_background_transparency_scroll'] != "") {
				$bg_color_scroll_transparency = $river_options['header_background_transparency_scroll'];
			}else{
				$bg_color_scroll_transparency = 0.85;
			}
			?>
			header.scrolled .header_top{
			background-color: rgba(<?php echo esc_attr($bg_color_scroll_top[0]); ?>,<?php echo esc_attr($bg_color_scroll_top[1]); ?>,<?php echo esc_attr($bg_color_scroll_top[2]); ?>,<?php echo esc_attr($bg_color_scroll_transparency); ?>);
			}
		<?php } ?>
		
		<?php
		$display_header_top = "no";
		if(isset($river_options['header_top_area'])){
			$display_header_top = $river_options['header_top_area'];
		}
		if (!empty($_SESSION['qode_header_top'])){
			$display_header_top = $_SESSION['qode_header_top'];
		}
		
		if($display_header_top == "no"){
			$margin_top_add = 0;
			?>
			.content{
			margin-top: 80px;
			}
			<?php
		}else{
			$margin_top_add = 30;
			?>
			.content{
			margin-top: 110px;
			}
			<?php
		}
		?>
		
		
		<?php if (!empty($river_options['header_height'])) { ?>
			.logo_wrapper,
			.side_menu_button
			{
			height: <?php echo intval($river_options['header_height']);  ?>px;
			}
			
			.content{
			margin-top: <?php echo intval($river_options['header_height'] + $margin_top_add);  ?>px;
			}
			.drop_down .second{
			top: <?php echo intval($river_options['header_height']);  ?>px;
			}
		<?php } ?>
		<?php if ($river_options['header_background_transparency_initial'] != "") {?>
			header{
			border: 0px;
			}
			
			.content{
			margin-top: 0px !important;
			}
			.title .title_holder .container{
			vertical-align: bottom;
			padding: 0px 0px 20px 0px;
			}
		<?php } ?>
		<?php
		$parallax_onoff = "on";
		if (isset($river_options['parallax_onoff']))
			$parallax_onoff = $river_options['parallax_onoff'];
		if ($parallax_onoff == "off"){
			?>
			.touch .parallax section{
			height: auto !important;
			min-height: 300px;
			background-position: center top !important;
			background-attachment: scroll;
			}
			
			.touch	.parallax section.no_background{
			padding: 0px;
			}
		<?php } ?>
		<?php if (!empty($river_options['header_height'])) { ?>
			nav.main_menu > ul > li > a{
			line-height: <?php echo intval($river_options['header_height']);  ?>px;
			}
		<?php } ?>
		<?php if (!empty($river_options['dropdown_background_color'])) { ?>
			nav.main_menu > ul > li:hover > a > span,
			.drop_down .second .inner ul,
			.drop_down .second .inner ul li ul
			{
			background-color:<?php echo esc_attr($river_options['dropdown_background_color']);  ?>;
			}
		<?php } ?>
		<?php if (!empty($river_options['dropdown_separator_color'])) { ?>
			.drop_down .wide .second ul li,
			.drop_down .second .inner ul li{
			border-color:<?php echo esc_attr($river_options['dropdown_separator_color']);  ?>;
			}
		<?php } ?>
		<?php if (!empty($river_options['menu_color']) || !empty($river_options['menu_fontsize']) || !empty($river_options['menu_fontstyle']) || !empty($river_options['menu_fontweight']) || !empty($river_options['menu_letter_spacing']) || $river_options['menu_google_fonts'] != "-1") { ?>
			nav.main_menu > ul > li > a{
			<?php if (!empty($river_options['menu_color'])) { ?> color: <?php echo esc_attr($river_options['menu_color']);  ?>; <?php } ?>
			<?php if($river_options['menu_google_fonts'] != "-1"){ ?>
				font-family: <?php echo str_replace('+', ' ', $river_options['menu_google_fonts']); ?>, sans-serif;
			<?php } ?>
			<?php if (!empty($river_options['menu_fontsize'])) { ?> font-size: <?php echo intval($river_options['menu_fontsize']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['menu_fontstyle'])) { ?> font-style: <?php echo esc_attr($river_options['menu_fontstyle']);  ?>; <?php } ?>
			<?php if (!empty($river_options['menu_fontweight'])) { ?> font-weight: <?php echo esc_attr($river_options['menu_fontweight']);  ?>; <?php } ?>
			}
			
			<?php if (!empty($river_options['menu_color'])) { ?>
				.side_menu_button a,
				.mobile_menu_button span{
				color: <?php echo esc_attr($river_options['menu_color']);  ?>;
				}
			<?php } ?>
		
		<?php } ?>
		<?php if (!empty($river_options['menu_hovercolor'])) { ?>
			nav.main_menu ul li:hover a,
			nav.main_menu ul li.active a{
			color: <?php echo esc_attr($river_options['menu_hovercolor']);  ?>;
			}
		<?php } ?>
		<?php if(!empty($river_options['dropdown_color']) || !empty($river_options['dropdown_fontsize']) || !empty($river_options['dropdown_lineheight']) || !empty($river_options['dropdown_fontstyle']) || !empty($river_options['dropdown_fontweight']) || $river_options['dropdown_google_fonts'] != "-1"){ ?>
			.drop_down .second .inner > ul > li > a,
			.drop_down .second .inner > ul > li > h3,
			.drop_down .wide .second .inner > ul > li > h3,
			.drop_down .wide .second .inner > ul > li > a,
			.drop_down .wide .second .inner > ul li.sub .flexslider ul li  h5 a,
			.drop_down .wide .second .inner > ul li .flexslider ul li  h5 a,
			.drop_down .wide .second .inner > ul li.sub .flexslider ul li  h5,
			.drop_down .wide .second .inner > ul li .flexslider ul li  h5{
			<?php if (!empty($river_options['dropdown_color'])) { ?> color: <?php echo esc_attr($river_options['dropdown_color']); ?>; <?php } ?>
			<?php if($river_options['dropdown_google_fonts'] != "-1"){ ?>
				font-family: <?php echo str_replace('+', ' ', $river_options['dropdown_google_fonts']) ?>, sans-serif !important;
			<?php } ?>
			<?php if (!empty($river_options['dropdown_fontsize'])) { ?> font-size: <?php echo intval($river_options['dropdown_fontsize']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['dropdown_lineheight'])) { ?> line-height: <?php echo intval($river_options['dropdown_lineheight']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['dropdown_fontstyle'])) { ?> font-style: <?php echo esc_attr($river_options['dropdown_fontstyle']);  ?>;  <?php } ?>
			<?php if (!empty($river_options['dropdown_fontweight'])) { ?>font-weight: <?php echo esc_attr($river_options['dropdown_fontweight']);  ?>; <?php } ?>
			}
		<?php } ?>
		<?php if (!empty($river_options['dropdown_hovercolor'])) { ?>
			.drop_down .second .inner ul li:hover a{
			color: <?php echo esc_attr($river_options['dropdown_hovercolor']);  ?> !important;
			}
		<?php } ?>
		<?php if (!empty($river_options['dropdown_backgroundhovercolor'])) { ?>
			.drop_down .wide .second .inner ul li.sub ul li a:hover,
			.drop_down .second .inner ul li:hover{
			background-color: <?php echo esc_attr($river_options['dropdown_backgroundhovercolor']);  ?> !important;
			}
		<?php } ?>
		<?php if(!empty($river_options['dropdown_color_thirdlvl']) || !empty($river_options['dropdown_fontsize_thirdlvl']) || !empty($river_options['dropdown_lineheight_thirdlvl']) || !empty($river_options['dropdown_fontstyle_thirdlvl']) || !empty($river_options['dropdown_fontweight_thirdlvl']) || $river_options['dropdown_google_fonts_thirdlvl'] != "-1"){ ?>
			.drop_down .wide .second .inner ul li.sub ul li a,
			.drop_down .wide .second ul li ul li a,
			.drop_down .second .inner ul li.sub ul li a,
			.drop_down .wide .second ul li ul li a,
			.drop_down .wide .second .inner ul li.sub .flexslider ul li .menu_recent_post,
			.drop_down .wide .second .inner ul li .flexslider ul li .menu_recent_post a,
			.drop_down .wide .second .inner ul li .flexslider ul li .menu_recent_post,
			.drop_down .wide .second .inner ul li .flexslider ul li .menu_recent_post a,
			.drop_down .wide.icons .second i
			{
			<?php if (!empty($river_options['dropdown_color_thirdlvl'])) { ?> color: <?php echo esc_attr($river_options['dropdown_color_thirdlvl']);  ?> !important;  <?php } ?>
			<?php if($river_options['dropdown_google_fonts_thirdlvl'] != "-1"){ ?>
				font-family: <?php echo str_replace('+', ' ', $river_options['dropdown_google_fonts_thirdlvl']) ?>, sans-serif !important;
			<?php } ?>
			<?php if (!empty($river_options['dropdown_fontsize_thirdlvl'])) { ?> font-size: <?php echo intval($river_options['dropdown_fontsize_thirdlvl']);  ?>px !important;  <?php } ?>
			<?php if (!empty($river_options['dropdown_lineheight_thirdlvl'])) { ?> line-height: <?php echo intval($river_options['dropdown_lineheight_thirdlvl']);  ?>px !important;  <?php } ?>
			<?php if (!empty($river_options['dropdown_fontstyle_thirdlvl'])) { ?> font-style: <?php echo esc_attr($river_options['dropdown_fontstyle_thirdlvl']);  ?> !important;   <?php } ?>
			<?php if (!empty($river_options['dropdown_fontweight_thirdlvl'])) { ?> font-weight: <?php echo esc_attr($river_options['dropdown_fontweight_thirdlvl']);  ?> !important;  <?php } ?>
			}
		<?php } ?>
		<?php if (!empty($river_options['dropdown_hovercolor_thirdlvl'])) { ?>
			.drop_down .second .inner ul li.sub ul li:hover a,
			.drop_down .second .inner ul li ul li:hover a,
			.drop_down .wide.icons .second a:hover i
			{
			color: <?php echo esc_attr($river_options['dropdown_hovercolor_thirdlvl']);  ?> !important;
			}
		<?php } ?>
		<?php if (!empty($river_options['mobile_color']) || !empty($river_options['mobile_fontsize']) || !empty($river_options['mobile_lineheight']) || !empty($river_options['mobile_fontstyle']) || !empty($river_options['mobile_fontweight']) || !empty($river_options['mobile_letter_spacing']) || $river_options['mobile_google_fonts'] != "-1") { ?>
			nav.mobile_menu ul li a,
			nav.mobile_menu ul li h3{
			<?php if (!empty($river_options['mobile_color'])) { ?> color: <?php echo esc_attr($river_options['mobile_color']);  ?>; <?php } ?>
			<?php if($river_options['mobile_google_fonts'] != "-1"){ ?>
				font-family: <?php echo str_replace('+', ' ', $river_options['mobile_google_fonts']); ?>, sans-serif;
			<?php } ?>
			<?php if (!empty($river_options['mobile_fontsize'])) { ?> font-size: <?php echo intval($river_options['mobile_fontsize']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['mobile_lineheight'])) { ?> line-height: <?php echo intval($river_options['mobile_lineheight']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['mobile_fontstyle'])) { ?> font-style: <?php echo esc_attr($river_options['mobile_fontstyle']);  ?>; <?php } ?>
			<?php if (!empty($river_options['mobile_fontweight'])) { ?> font-weight: <?php echo esc_attr($river_options['mobile_fontweight']);  ?>; <?php } ?>
			<?php if(!empty($river_options['mobile_letter_spacing'])){ ?>
				letter-spacing: <?php echo intval($river_options['mobile_letter_spacing']);  ?>px;
			<?php } ?>
			}
		<?php } ?>
		<?php if (!empty($river_options['mobile_hovercolor'])) { ?>
			nav.mobile_menu ul li a:hover,
			nav.mobile_menu ul li.active > a,
			nav.mobile_menu ul li.current-menu-item > a{
			color: <?php echo esc_attr($river_options['mobile_hovercolor']);  ?>;
			}
		<?php } ?>
		<?php if (!empty($river_options['mobile_separator_color'])) { ?>
			nav.mobile_menu ul li a,
			nav.mobile_menu ul li h3,
			nav.mobile_menu ul li ul li a,
			nav.mobile_menu ul li.open_sub > a:first-child{
			border-color: <?php echo esc_attr($river_options['mobile_separator_color']);  ?>;
			}
		<?php } ?>
		
		<?php if (!empty($river_options['mobile_background_color'])) { ?>
			nav.mobile_menu{
			background-color: <?php echo esc_attr($river_options['mobile_background_color']);  ?>;
			}
			
			@media only screen and (max-width: 1000px){
			header .side_menu_button a,
			header .mobile_menu_button span{
			color: <?php echo esc_attr($river_options['mobile_background_color']);  ?>;
			}
			}
		<?php } ?>
		
		<?php if (!empty($river_options['smooth_background_color'])) { ?>
			#ascrail2000{
			background-color: <?php echo esc_attr($river_options['smooth_background_color']);  ?>;
			}
		<?php } ?>
		<?php if (!empty($river_options['smooth_bar_color'])) {
			?>
			#ascrail2000 div{
			background-color: <?php echo esc_attr($river_options['smooth_bar_color']);  ?> !important;
			}
		<?php } ?>
		<?php if (!empty($river_options['h1_color']) || !empty($river_options['h1_fontsize']) || !empty($river_options['h1_lineheight']) || !empty($river_options['h1_fontstyle']) || !empty($river_options['h1_fontweight']) || $river_options['h1_google_fonts'] != "-1") { ?>
			h1{
			<?php if (!empty($river_options['h1_color'])) { ?>	color: <?php echo esc_attr($river_options['h1_color']);  ?>; <?php } ?>
			<?php if($river_options['h1_google_fonts'] != "-1"){ ?>
				font-family: <?php echo str_replace('+', ' ', $river_options['h1_google_fonts']); ?>, sans-serif;
			<?php } ?>
			<?php if (!empty($river_options['h1_fontsize'])) { ?>font-size: <?php echo intval($river_options['h1_fontsize']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['h1_lineheight'])) { ?>line-height: <?php echo intval($river_options['h1_lineheight']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['h1_fontstyle'])) { ?>font-style: <?php echo esc_attr($river_options['h1_fontstyle']);  ?>; <?php } ?>
			<?php if (!empty($river_options['h1_fontweight'])) { ?>font-weight: <?php echo esc_attr($river_options['h1_fontweight']);  ?>; <?php } ?>
			}
		<?php } ?>
		<?php if (!empty($river_options['page_title_color']) || !empty($river_options['page_title_fontsize']) || !empty($river_options['page_title_lineheight']) || !empty($river_options['page_title_fontstyle']) || !empty($river_options['page_title_fontweight']) || $river_options['page_title_position'] != "0" || $river_options['page_title_google_fonts'] != "-1") { ?>
			.title h1{
			<?php if (!empty($river_options['page_title_color'])) { ?>color: <?php echo esc_attr($river_options['page_title_color']);  ?>; <?php } ?>
			<?php if($river_options['page_title_google_fonts'] != "-1"){ ?>
				font-family: <?php echo str_replace('+', ' ', $river_options['page_title_google_fonts']); ?>, sans-serif;
			<?php } ?>
			<?php if (!empty($river_options['page_title_fontsize'])) { ?>font-size: <?php echo intval($river_options['page_title_fontsize']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['page_title_lineheight'])) { ?>line-height: <?php echo intval($river_options['page_title_lineheight']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['page_title_fontstyle'])) { ?>font-style: <?php echo esc_attr($river_options['page_title_fontstyle']);  ?>; <?php } ?>
			<?php if (!empty($river_options['page_title_fontweight'])) { ?>font-weight: <?php echo esc_attr($river_options['page_title_fontweight']);  ?>; <?php } ?>
			<?php if($river_options['page_title_position'] != "0"){ ?>
				text-align: <?php if($river_options['page_title_position'] == "1"){echo "left";} if($river_options['page_title_position'] == "2"){echo "center";} if($river_options['page_title_position'] == "3"){echo "right";}  ?>;
			<?php } ?>
			}
			<?php if($river_options['page_title_position'] != "0"){ ?>
				.title .separator{
				text-align: <?php if($river_options['page_title_position'] == "1"){echo "left";} if($river_options['page_title_position'] == "2"){echo "center";} if($river_options['page_title_position'] == "3"){echo "right";}  ?>;
				<?php if($river_options['page_title_position'] == "1" || $river_options['page_title_position'] == "3"){?>
					margin-left:0;
					margin-right:0;
					display: inline-block;
				<?php } ?>
				}
			<?php } ?>
			<?php if($river_options['page_title_position'] != "0"){ ?>
				.title h6,
				.title
				{
				text-align: <?php if($river_options['page_title_position'] == "1"){echo "left";} if($river_options['page_title_position'] == "2"){echo "center";} if($river_options['page_title_position'] == "3"){echo "right";}  ?>;
				}
			<?php } ?>
		<?php } ?>
		<?php if (!empty($river_options['h2_color']) || !empty($river_options['h2_fontsize']) || !empty($river_options['h2_lineheight']) || !empty($river_options['h2_fontstyle']) || !empty($river_options['h2_fontweight']) || $river_options['h2_google_fonts'] != "-1") { ?>
			h2,
			h2 a{
			<?php if (!empty($river_options['h2_color'])) { ?>color: <?php echo esc_attr($river_options['h2_color']);  ?>; <?php } ?>
			<?php if($river_options['h2_google_fonts'] != "-1"){ ?>
				font-family: <?php echo str_replace('+', ' ', $river_options['h2_google_fonts']); ?>, sans-serif;
			<?php } ?>
			<?php if (!empty($river_options['h2_fontsize'])) { ?>font-size: <?php echo intval($river_options['h2_fontsize']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['h2_lineheight'])) { ?>line-height: <?php echo intval($river_options['h2_lineheight']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['h2_fontstyle'])) { ?>font-style: <?php echo esc_attr($river_options['h2_fontstyle']);  ?>; <?php } ?>
			<?php if (!empty($river_options['h2_fontweight'])) { ?>font-weight: <?php echo esc_attr($river_options['h2_fontweight']);  ?>; <?php } ?>
			}
		<?php } ?>
		<?php if (!empty($river_options['h3_color']) || !empty($river_options['h3_fontsize']) || !empty($river_options['h3_lineheight']) || !empty($river_options['h3_fontstyle']) || !empty($river_options['h3_fontweight']) || $river_options['h3_google_fonts'] != "-1") { ?>
			h3,h3 a{
			<?php if (!empty($river_options['h3_color'])) { ?>color: <?php echo esc_attr($river_options['h3_color']);  ?>; <?php } ?>
			<?php if($river_options['h3_google_fonts'] != "-1"){ ?>
				font-family: <?php echo str_replace('+', ' ', $river_options['h3_google_fonts']); ?>, sans-serif;
			<?php } ?>
			<?php if (!empty($river_options['h3_fontsize'])) { ?>font-size: <?php echo intval($river_options['h3_fontsize']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['h3_lineheight'])) { ?>line-height: <?php echo intval($river_options['h3_lineheight']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['h3_fontstyle'])) { ?>font-style: <?php echo esc_attr($river_options['h3_fontstyle']);?>; <?php } ?>
			<?php if (!empty($river_options['h3_fontweight'])) { ?>font-weight: <?php echo esc_attr($river_options['h3_fontweight']);  ?>; <?php } ?>
			}
		<?php } ?>
		<?php if (!empty($river_options['h4_color']) || !empty($river_options['h4_fontsize']) || !empty($river_options['h4_lineheight']) || !empty($river_options['h4_fontstyle']) || !empty($river_options['h4_fontweight']) || $river_options['h4_google_fonts'] != "-1") { ?>
			h4,
			h4 a{
			<?php if (!empty($river_options['h4_color'])) { ?>color: <?php echo esc_attr($river_options['h4_color']);  ?>; <?php } ?>
			<?php if($river_options['h4_google_fonts'] != "-1"){ ?>
				font-family: <?php echo str_replace('+', ' ', $river_options['h4_google_fonts']); ?>, sans-serif;
			<?php } ?>
			<?php if (!empty($river_options['h4_fontsize'])) { ?>font-size: <?php echo intval($river_options['h4_fontsize']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['h4_lineheight'])) { ?>line-height: <?php echo intval($river_options['h4_lineheight']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['h4_fontstyle'])) { ?>font-style: <?php echo esc_attr($river_options['h4_fontstyle']);  ?>; <?php } ?>
			<?php if (!empty($river_options['h4_fontweight'])) { ?>font-weight: <?php echo esc_attr($river_options['h4_fontweight']);  ?>; <?php } ?>
			}
		<?php } ?>
		<?php if (!empty($river_options['h5_color']) || !empty($river_options['h5_fontsize']) || !empty($river_options['h5_lineheight']) || !empty($river_options['h5_fontstyle']) || !empty($river_options['h5_fontweight']) || $river_options['h5_google_fonts'] != "-1") { ?>
			h5,
			h5 a{
			<?php if (!empty($river_options['h5_color'])) { ?>color: <?php echo esc_attr($river_options['h5_color']);  ?>; <?php } ?>
			<?php if($river_options['h5_google_fonts'] != "-1"){ ?>
				font-family: <?php echo str_replace('+', ' ', $river_options['h5_google_fonts']); ?>, sans-serif;
			<?php } ?>
			<?php if (!empty($river_options['h5_fontsize'])) { ?>font-size: <?php echo intval($river_options['h5_fontsize']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['h5_lineheight'])) { ?>line-height: <?php echo intval($river_options['h5_lineheight']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['h5_fontstyle'])) { ?>font-style: <?php echo esc_attr($river_options['h5_fontstyle']);  ?>; <?php } ?>
			<?php if (!empty($river_options['h5_fontweight'])) { ?>font-weight: <?php echo esc_attr($river_options['h5_fontweight']);  ?>; <?php } ?>
			}
		<?php } ?>
		<?php if (!empty($river_options['h6_color']) || !empty($river_options['h6_fontsize']) || !empty($river_options['h6_lineheight']) || !empty($river_options['h6_fontstyle']) || !empty($river_options['h6_fontweight']) || !empty($river_options['h6_letterspacing']) || $river_options['h6_google_fonts'] != "-1") { ?>
			h6,
			.title .breadcrumb h1,
			.title .breadcrumb
			{
			<?php if (!empty($river_options['h6_color'])) { ?>color: <?php echo esc_attr($river_options['h6_color']);  ?>; <?php } ?>
			<?php if($river_options['h6_google_fonts'] != "-1"){ ?>
				font-family: <?php echo str_replace('+', ' ', $river_options['h6_google_fonts']); ?>, sans-serif;
			<?php } ?>
			<?php if (!empty($river_options['h6_fontsize'])) { ?>font-size: <?php echo intval($river_options['h6_fontsize']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['h6_lineheight'])) { ?>line-height: <?php echo intval($river_options['h6_lineheight']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['h6_fontstyle'])) { ?>font-style: <?php echo esc_attr($river_options['h6_fontstyle']);  ?>;  <?php } ?>
			<?php if (!empty($river_options['h6_fontweight'])) { ?>font-weight: <?php echo esc_attr($river_options['h6_fontweight']);  ?>; <?php } ?>
			<?php if (!empty($river_options['h6_letterspacing'])) { ?>letter-spacing: <?php echo intval($river_options['h6_letterspacing']);  ?>px; <?php } ?>
			}
		<?php } ?>
		<?php if (!empty($river_options['text_color']) || !empty($river_options['text_fontsize']) || !empty($river_options['text_lineheight']) || !empty($river_options['text_fontstyle']) || !empty($river_options['text_fontweight']) || $river_options['text_google_fonts'] != "-1" || !empty($river_options['text_margin'])) { ?>
			p{
			<?php if (!empty($river_options['text_color'])) { ?>color: <?php echo esc_attr($river_options['text_color']);  ?>;<?php } ?>
			<?php if($river_options['text_google_fonts'] != "-1"){ ?>
				font-family: <?php echo str_replace('+', ' ', $river_options['text_google_fonts']); ?>, sans-serif;
			<?php } ?>
			<?php if (!empty($river_options['text_fontsize'])) { ?>font-size: <?php echo intval($river_options['text_fontsize']);  ?>px;<?php } ?>
			<?php if (!empty($river_options['text_lineheight'])) { ?>line-height: <?php echo intval($river_options['text_lineheight']);  ?>px;<?php } ?>
			<?php if (!empty($river_options['text_fontstyle'])) { ?>font-style: <?php echo esc_attr($river_options['text_fontstyle']);  ?>;<?php } ?>
			<?php if (!empty($river_options['text_fontweight'])) { ?>font-weight: <?php echo esc_attr($river_options['text_fontweight']);  ?>;<?php } ?>
			<?php if (!empty($river_options['text_margin'])) { ?>margin-top: <?php echo intval($river_options['text_margin']);  ?>px;<?php } ?>
			<?php if (!empty($river_options['text_margin'])) { ?>margin-bottom: <?php echo intval($river_options['text_margin']);  ?>px;<?php } ?>
			}
			.portfolio_navigation .portfolio_button a,
			.portfolio_navigation .portfolio_prev a,
			.portfolio_navigation .portfolio_next a,
			.ordered ol li,
			.pagination ul li a,
			.pagination ul li.next a i,
			.pagination ul li.prev a i,
			.pagination ul li.last a i,
			.pagination ul li.first a i,
			#wp-calendar th,
			#wp-calendar td,
			.widget.widget_archive select,
			.widget.widget_categories select,
			.widget.widget_text select,
			.widget.widget_search form input[type="text"],
			.shopping_cart_dropdown ul li a
			{
			<?php if (!empty($river_options['text_color'])) { ?>color: <?php echo esc_attr($river_options['text_color']);  ?>;<?php } ?>
			}
		<?php } ?>
		<?php if (!empty($river_options['link_color']) || !empty($river_options['link_fontstyle']) || !empty($river_options['link_fontweight']) || !empty($river_options['link_fontdecoration'])) { ?>
			a, p a{
			<?php if (!empty($river_options['link_color'])) { ?>color: <?php echo esc_attr($river_options['link_color']);  ?>;<?php } ?>
			<?php if (!empty($river_options['link_fontstyle'])) { ?>font-style: <?php echo esc_attr($river_options['link_fontstyle']);  ?>;<?php } ?>
			<?php if (!empty($river_options['link_fontweight'])) { ?>font-weight: <?php echo esc_attr($river_options['link_fontweight']);  ?>;<?php } ?>
			<?php if (!empty($river_options['link_fontdecoration'])) { ?>text-decoration: <?php echo esc_attr($river_options['link_fontdecoration']);  ?>;<?php } ?>
			}
		<?php } ?>
		<?php if (!empty($river_options['link_hovercolor']) || !empty($river_options['link_fontdecoration'])) { ?>
			a:hover,
			p a:hover{
			<?php if (!empty($river_options['link_hovercolor'])) { ?>color: <?php echo esc_attr($river_options['link_hovercolor']);  ?>;<?php } ?>
			<?php if (!empty($river_options['link_fontdecoration'])) { ?>text-decoration: <?php echo esc_attr($river_options['link_fontdecoration']);  ?>;<?php } ?>
			}
		<?php } ?>
		<?php if (!empty($river_options['blockquote_font_color'])) { ?>
			blockquote h5{
			color: <?php echo esc_attr($river_options['blockquote_font_color']);  ?>;
			}
		<?php } ?>
		<?php if (!empty($river_options['blockquote_background_color']) && !empty($river_options['blockquote_border_color'])) { ?>
			blockquote{
			border-color: <?php echo esc_attr($river_options['blockquote_border_color']);  ?>;
			background-color: <?php echo esc_attr($river_options['blockquote_background_color']);  ?>;
			}
		<?php } ?>
		<?php if (!empty($river_options['separator_thickness']) || !empty($river_options['separator_topmargin']) || !empty($river_options['separator_bottommargin']) || !empty($river_options['separator_color'])) { ?>
			.separator{
			<?php if (!empty($river_options['separator_thickness'])) { ?>	height: <?php echo intval($river_options['separator_thickness']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['separator_topmargin'])) { ?>	margin-top: <?php echo intval($river_options['separator_topmargin']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['separator_bottommargin'])) { ?>	margin-bottom: <?php echo intval($river_options['separator_bottommargin']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['separator_color'])) { ?>	background-color: <?php echo esc_attr($river_options['separator_color']);  ?>; <?php } ?>
			}
		<?php } ?>
		<?php if (!empty($river_options['separator_color'])) { ?>
			.separator.small{
			<?php if (!empty($river_options['separator_color'])) { ?>	background-color: <?php echo esc_attr($river_options['separator_color']);  ?>; <?php } ?>
			}
		<?php } ?>
		<?php if (!empty($river_options['separator_color'])) { ?>
			.blog_holder article,
			.author_description,
			aside .widget,
			section.section	{
			border-color:<?php echo esc_attr($river_options['separator_color']);  ?>;
			}
		<?php } ?>
		<?php if (!empty($river_options['message_backgroundcolor']) || (isset($river_options['message_bordercolor']) && !empty($river_options['message_bordercolor']))) { ?>
			.message{
			<?php if (!empty($river_options['message_backgroundcolor'])) { ?>background-color: <?php echo esc_attr($river_options['message_backgroundcolor']);  ?><?php } ?>;
			<?php if (isset($river_options['message_bordercolor']) && !empty($river_options['message_bordercolor'])) { ?>border-color: <?php echo esc_attr($river_options['message_bordercolor']);  ?> <?php } ?>;
			}
		<?php } ?>
		<?php if (!empty($river_options['message_title_color']) || !empty($river_options['message_title_fontsize']) || !empty($river_options['message_title_lineheight']) || !empty($river_options['message_title_fontstyle']) || !empty($river_options['message_title_fontweight']) || $river_options['message_title_google_fonts'] != "-1") { ?>
			.message .message_text{
			<?php if (!empty($river_options['message_title_color'])) { ?>	color: <?php echo esc_attr($river_options['message_title_color']);  ?>; <?php } ?>
			<?php if($river_options['message_title_google_fonts'] != "-1"){ ?>
				font-family: <?php echo str_replace('+', ' ', $river_options['message_title_google_fonts']); ?>, sans-serif;
			<?php } ?>
			<?php if (!empty($river_options['message_title_fontsize'])) { ?>	font-size: <?php echo intval($river_options['message_title_fontsize']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['message_title_lineheight'])) { ?>	line-height: <?php echo intval($river_options['message_title_lineheight']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['message_title_fontstyle'])) { ?>	font-style: <?php echo esc_attr($river_options['message_title_fontstyle']);  ?>; <?php } ?>
			<?php if (!empty($river_options['message_title_fontweight'])) { ?>	font-weight: <?php echo esc_attr($river_options['message_title_fontweight']);  ?>; <?php } ?>
			}
		<?php } ?>
		<?php if (!empty($river_options['message_icon_fontsize']) && !empty($river_options['message_icon_color'])) { ?>
			.message.with_icon > i {
			<?php if (!empty($river_options['message_icon_color'])) { ?> color:  <?php echo esc_attr($river_options['message_icon_color']);  ?>; <?php } ?>
			<?php if (!empty($river_options['message_icon_fontsize'])) { ?> font-size: <?php echo intval($river_options['message_icon_fontsize']);  ?>px; <?php } ?>
			}
		<?php } ?>
		<?php if (!empty($river_options['social_icon_backgroundcolor'])) { ?>
			.social_icon_holder .icon-stack i.icon-circle{
			color: <?php echo esc_attr($river_options['social_icon_backgroundcolor']);  ?>;
			}
		<?php } ?>
		<?php if (!empty($river_options['button_title_color']) || !empty($river_options['button_title_fontsize']) || !empty($river_options['button_title_lineheight']) || !empty($river_options['button_title_fontstyle']) || !empty($river_options['button_title_fontweight']) || !empty($river_options['button_backgroundcolor']) || $river_options['button_title_google_fonts'] != "-1") { ?>
			.qbutton, #submit_comment, .load_more a{
			<?php if (!empty($river_options['button_title_color'])) { ?>	color: <?php echo esc_attr($river_options['button_title_color']);  ?>; <?php } ?>
			<?php if($river_options['button_title_google_fonts'] != "-1"){ ?>
				font-family: <?php echo str_replace('+', ' ', $river_options['button_title_google_fonts']); ?>, sans-serif;
			<?php } ?>
			<?php if (!empty($river_options['button_title_fontsize'])) { ?>	font-size: <?php echo intval($river_options['button_title_fontsize']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['button_title_lineheight'])) { ?>	line-height: <?php echo intval($river_options['button_title_lineheight']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['button_title_lineheight'])) { ?>	height: <?php echo intval($river_options['button_title_lineheight']);  ?>px; <?php } ?>
			<?php if (!empty($river_options['button_title_fontstyle'])) { ?>	font-style: <?php echo esc_attr($river_options['button_title_fontstyle']);  ?>; <?php } ?>
			<?php if (!empty($river_options['button_title_fontweight'])) { ?>	font-weight: <?php echo esc_attr($river_options['button_title_fontweight']);  ?>; <?php } ?>
			<?php if (!empty($river_options['button_backgroundcolor'])) { ?>	background-color: <?php echo esc_attr($river_options['button_backgroundcolor']);  ?>; <?php } ?>
			}
		<?php } ?>
		<?php if (!empty($river_options['button_title_hovercolor']) || (isset($river_options['button_backgroundhovercolor']) && !empty($river_options['button_backgroundhovercolor']))) { ?>
			.qbutton:hover,
			#submit_comment:hover,
			.load_more a:hover{
			<?php if (!empty($river_options['button_title_hovercolor'])) { ?> color: <?php echo esc_attr($river_options['button_title_hovercolor']);?> !important; <?php } ?>
			}
		<?php } ?>
		<?php if (!empty($river_options['button_title_hovercolor'])) { ?>
			.qbutton:hover,
			#submit_comment:hover,
			.load_more a:hover{
			<?php if (!empty($river_options['button_title_hovercolor'])) { ?> background-color: <?php echo esc_attr($river_options['button_backgroundcolor_hover']);?> !important; <?php } ?>
			}
		<?php } ?>
		<?php
		if(isset($river_options['google_maps_height'])){
			if (intval($river_options['google_maps_height']) > 0) {
				?>
				.google_map{
				height: <?php echo intval($river_options['google_maps_height']); ?>px;
				}
				<?php
			}
		}
		?>
		<?php if (!empty($river_options['footer_top_background_color'])) { ?>
			.footer_top_holder,	footer #lang_sel > ul > li > a,	footer #lang_sel_click > ul > li > a{
			background-color: <?php echo esc_attr($river_options['footer_top_background_color']); ?>;
			}
			footer #lang_sel ul ul a,footer #lang_sel_click ul ul a,footer #lang_sel ul ul a:visited,footer #lang_sel_click ul ul a:visited{
			background-color: <?php echo esc_attr($river_options['footer_top_background_color']); ?> !important;
			}
		<?php } ?>
		<?php if (!empty($river_options['footer_top_title_color'])) { ?>
			.footer_top .column_inner > div h4 {
			color:<?php echo esc_attr($river_options['footer_top_title_color']);  ?>;
			}
		<?php } ?>
		<?php if (!empty($river_options['footer_top_text_color'])) { ?>
			footer,
			.footer_top,
			.footer_top p,
			.footer_top ul li a
			{
			color: <?php echo esc_attr($river_options['footer_top_text_color']);  ?>;
			}
		<?php } ?>
		<?php if (!empty($river_options['footer_bottom_background_color'])) { ?>
			.footer_bottom_holder, #lang_sel_footer{
			background-color:<?php echo esc_attr($river_options['footer_bottom_background_color']);  ?>;
			}
		<?php } ?>
		<?php if (!empty($river_options['footer_bottom_text_color'])) { ?>
			.footer_bottom, .footer_bottom p, .footer_bottom p a, #lang_sel_footer ul li a,
			footer #lang_sel > ul > li > a,
			footer #lang_sel_click > ul > li > a,
			footer #lang_sel a.lang_sel_sel,
			footer #lang_sel_click a.lang_sel_sel,
			footer #lang_sel ul ul a,
			footer #lang_sel_click ul ul a,
			footer #lang_sel ul ul a:visited,
			footer #lang_sel_click ul ul a:visited,
			footer #lang_sel_list.lang_sel_list_horizontal a,
			footer #lang_sel_list.lang_sel_list_vertical a,
			#lang_sel_footer a{
			color:<?php echo esc_attr($river_options['footer_bottom_text_color']);  ?>;
			}
		<?php } ?>
		<?php if (isset($river_options['content_bottom_background_color'])) { ?>
			.content_bottom
			{
			background-color:<?php echo esc_attr($river_options['content_bottom_background_color']);  ?>;
			}
		<?php } ?>
		<?php if (isset($river_options['side_area_background_color']) && !empty($river_options['side_area_background_color'])) { ?>
			.side_menu,
			.side_menu #lang_sel,
			.side_menu #lang_sel_click,
			.side_menu #lang_sel ul ul,
			.side_menu #lang_sel_click ul ul{
			background-color:<?php echo esc_attr($river_options['side_area_background_color']);  ?>;
			}
		<?php } ?>
		<?php if (isset($river_options['side_area_text_color']) && !empty($river_options['side_area_text_color'])) { ?>
			.side_menu .widget,
			.side_menu .widget.widget_search form,
			.side_menu .widget.widget_search form input[type="text"],
			.side_menu .widget.widget_search form input[type="submit"],
			.side_menu .widget h6,
			.side_menu .widget h6 a,
			.side_menu .widget p,
			.side_menu .widget li a,
			.side_menu .widget.widget_rss li a.rsswidget,
			.side_menu #wp-calendar caption,
			.side_menu .widget li,
			.side_menu_title h3,
			.side_menu #lang_sel_list ul li a,
			.side_menu #lang_sel_list ul li a:visited,
			.side_menu #lang_sel_list ul li a:hover,
			.side_menu #lang_sel_list a.lang_sel_sel:hover,
			.side_menu #lang_sel_list ul li a.lang_sel_sel,
			.side_menu #lang_sel a.lang_sel_sel,
			.side_menu #lang_sel_click a.lang_sel_sel,
			.side_menu #lang_sel ul li ul li a,
			.side_menu #lang_sel_click ul li ul li a,
			.side_menu #lang_sel ul li ul li a:visited,
			.side_menu #lang_sel_click ul li ul li a:visited{
			color:<?php echo esc_attr($river_options['side_area_text_color']);  ?>;
			}
			
			.side_menu .widget.widget_archive select,
			.side_menu .widget.widget_categories select,
			.side_menu .widget.widget_text select,
			.side_menu .widget.widget_search form input[type="submit"],
			.side_menu #wp-calendar th,
			.side_menu #wp-calendar td,
			.side_menu .widget .tagcloud a{
			background-color: <?php echo esc_attr($river_options['side_area_text_color']);  ?>;
			}
			
			.side_menu .widget.widget_search form,
			.side_menu #lang_sel,
			.side_menu #lang_sel_click,
			.side_menu #lang_sel ul ul,
			.side_menu #lang_sel_click ul ul{
			border-color: <?php echo esc_attr($river_options['side_area_text_color']);  ?>;
			}
		<?php } ?>
		<?php
	}
	
	add_action( 'river_qode_action_style_dynamic', 'river_qode_add_style_dynamic' );
}

if ( ! function_exists( 'river_qode_add_style_dynamic_responsive' ) ) {
	function river_qode_add_style_dynamic_responsive() {
		$river_options = river_qode_return_global_options();
		?>
		
		@media only screen and (max-width: 1000px){
		<?php if (!empty($river_options['header_background_color'])) { ?>
			.header_bottom {
			background-color: <?php echo esc_attr($river_options['header_background_color']);  ?>;
			}
		<?php } ?>
		}
		@media only screen and (min-width: 480px) and (max-width: 768px){
		
		<?php if (isset($river_options['parallax_minheight']) && !empty($river_options['parallax_minheight'])) { ?>
			.parallax section{
			height: auto !important;
			min-height: <?php echo intval($river_options['parallax_minheight']); ?>px;
			}
		<?php } ?>
		
		<?php if (isset($river_options['header_background_color_mobile']) &&  !empty($river_options['header_background_color_mobile'])) { ?>
			header
			{
			background-color: <?php echo esc_attr($river_options['header_background_color_mobile']);  ?> !important;
			background-image:none;
			}
		<?php } ?>
		}
		
		@media only screen and (max-width: 480px){
		
		<?php if (isset($river_options['parallax_minheight']) && !empty($river_options['parallax_minheight'])) { ?>
			.parallax section{
			height: auto !important;
			min-height: <?php echo intval($river_options['parallax_minheight']); ?>px;
			}
		<?php } ?>
		
		
		<?php if (isset($river_options['header_background_color_mobile']) &&  !empty($river_options['header_background_color_mobile'])) { ?>
			header
			{
			background-color: <?php echo esc_attr($river_options['header_background_color_mobile']);  ?> !important;
			background-image:none;
			}
		<?php } ?>
		}
		<?php
	}
	
	add_action( 'river_qode_action_style_dynamic_responsive', 'river_qode_add_style_dynamic_responsive' );
}

if ( ! function_exists( 'river_qode_add_default_dynamic' ) ) {
	function river_qode_add_default_dynamic() {
		$river_options = river_qode_return_global_options();
		?>
		
		function ajaxSubmitCommentForm(){
		"use strict";
		
		var options = {
		success: function(){
		$j("#commentform textarea").val("");
		$j("#commentform .success p").text("<?php esc_html_e('Comment has been sent!','river'); ?>");
		}
		};
		
		$j('#commentform').submit(function() {
		$j(this).find('input[type="submit"]').next('.success').remove();
		$j(this).find('input[type="submit"]').after('<div class="success"><p></p></div>');
		$j(this).ajaxSubmit(options);
		return false;
		});
		}
		var header_height = 82;
		var min_header_height = 56;
		<?php if(isset($river_options['header_height'])){
			if (!empty($river_options['header_height'])) { ?>
				
				header_height = <?php echo intval($river_options['header_height']); ?>;
			
			
			<?php } } ?>
		<?php if(isset($river_options['header_height_scroll'])){
			if (!empty($river_options['header_height_scroll'])) { ?>
				
				min_header_height = <?php echo intval($river_options['header_height_scroll']); ?>;
			
			<?php } } ?>
		
		
		var logo_height = header_height;
		<?php if ( isset( $river_options['logo_image'] ) && ! empty( $river_options['logo_image'] ) ) {
			$image_dimension = river_qode_get_image_dimensions( $river_options['logo_image'] );
			
			if ( ! empty( $image_dimension ) ) { ?>
				logo_height  = <?php echo intval( $image_dimension['height'] ); ?>;
			<?php }
		} ?>
		
		
		<?php
		if($river_options['enable_google_map'] != ""){
			?>
			
			var geocoder;
			var map;
			
			function initialize() {
			"use strict";
			// Create an array of styles.
			<?php
			$google_maps_color = "#324156";
			if(isset($river_options['google_maps_color'])){
				if (!empty($river_options['google_maps_color']))
					$google_maps_color = $river_options['google_maps_color'];
			}
			?>
			var mapStyles = [
			{
			stylers: [
			{hue: "<?php echo esc_attr($google_maps_color); ?>" },
			{saturation: -60},
			{lightness: -20},
			{gamma: 1.51}
			]
			}
			];
			var qodeMapType = new google.maps.StyledMapType(mapStyles,
			{name: "Qode Map"});
			
			geocoder = new google.maps.Geocoder();
			var latlng = new google.maps.LatLng(-34.397, 150.644);
			var myOptions = {
			<?php
			$google_maps_scroll_wheel = false;
			if(isset($river_options['google_maps_scroll_wheel'])){
				if ($river_options['google_maps_scroll_wheel'] == "yes")
					$google_maps_scroll_wheel = true;
			}
			$google_maps_zoom = 12;
			if(isset($river_options['google_maps_zoom'])){
				if (intval($river_options['google_maps_zoom']) > 0)
					$google_maps_zoom = intval($river_options['google_maps_zoom']);
			}
			?>
			zoom: <?php echo esc_attr($google_maps_zoom); ?>,
			<?php if (!$google_maps_scroll_wheel) { ?>
				scrollwheel: false,
			<?php } ?>
			center: latlng,
			zoomControl: true,
			zoomControlOptions: {
			style: google.maps.ZoomControlStyle.SMALL,
			position: google.maps.ControlPosition.RIGHT_CENTER
			},
			scaleControl: false,
			scaleControlOptions: {
			position: google.maps.ControlPosition.LEFT_CENTER
			},
			streetViewControl: false,
			streetViewControlOptions: {
			position: google.maps.ControlPosition.LEFT_CENTER
			},
			panControl: false,
			panControlOptions: {
			position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeControl: false,
			mapTypeControlOptions: {
			mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'qode_style'],
			style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
			position: google.maps.ControlPosition.LEFT_CENTER
			},
			<?php
			$google_maps_style = true;
			if(isset($river_options['google_maps_style'])){
				if ($river_options['google_maps_style'] == "no")
					$google_maps_style = false;
			}
			?>
			<?php if ($google_maps_style) { ?>
				mapTypeId: 'qode_style'
			<?php } else { ?>
				mapTypeId: google.maps.MapTypeId.ROADMAP
			<?php } ?>
			};
			map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
			<?php if ($google_maps_style) { ?>
				map.mapTypes.set('qode_style', qodeMapType);
			<?php } ?>
			}
			
			function codeAddress(data) {
			"use strict";
			
			if (data === '')
			return;
			
			var contentString = '<div id="content"><div id="siteNotice"></div><div id="bodyContent"><p>'+data+'</p></div></div>';
			var infowindow = new google.maps.InfoWindow({
			content: contentString
			});
			geocoder.geocode( { 'address': data}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
			map.setCenter(results[0].geometry.location);
			var marker = new google.maps.Marker({
			map: map,
			position: results[0].geometry.location,
			<?php if(isset($river_options['google_maps_pin_image'])){ ?>
				icon:  '<?php echo esc_attr($river_options['google_maps_pin_image']); ?>',
			<?php } ?>
			title: data['store_title']
			});
			google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(map,marker);
			});
			//infowindow.open(map,marker);
			}
			});
			}
			
			var $j = jQuery.noConflict();
			
			$j(document).ready(function() {
			"use strict";
			
			showContactMap();
			});
			<?php
		}
		?>
		
		function showContactMap() {
		"use strict";
		
		if($j("#map_canvas").length > 0 && typeof google === 'object'){
		initialize();
		codeAddress('<?php if(isset($river_options['google_maps_address5'])) { echo esc_attr($river_options['google_maps_address5']); } ?>');
		codeAddress('<?php if(isset($river_options['google_maps_address4'])) { echo esc_attr($river_options['google_maps_address4']); } ?>');
		codeAddress('<?php if(isset($river_options['google_maps_address3'])) { echo esc_attr($river_options['google_maps_address3']); } ?>');
		codeAddress('<?php if(isset($river_options['google_maps_address2'])) { echo esc_attr($river_options['google_maps_address2']); } ?>');
		codeAddress('<?php if(isset($river_options['google_maps_address'])) { echo esc_attr($river_options['google_maps_address']); } ?>');
		}
		}
		
		var no_ajax_pages = [];
		var root = '<?php echo esc_url( home_url( '/' ) ); ?>';
		var theme_root = '<?php echo QODE_ROOT; ?>/';
		<?php if($river_options['parallax_speed'] != ''){ ?>
			var parallax_speed = <?php echo esc_attr($river_options['parallax_speed']); ?>;
		<?php }else{ ?>
			var parallax_speed = 1;
		<?php } ?>
		
		<?php
		if(class_exists('Woocommerce')){
			$shop_id = get_option('woocommerce_shop_page_id');
			$cart_id = get_option('woocommerce_cart_page_id');
			$checkout_id = get_option('woocommerce_checkout_page_id');
			$pay_id = get_option(' woocommerce_pay_page_id ');
			$thanks_id = get_option(' woocommerce_thanks_page_id ');
			$myacount_id = get_option(' woocommerce_myaccount_page_id ');
			$edit_address_id = get_option(' woocommerce_edit_address_page_id ');
			$view_order_id = get_option(' woocommerce_view_order_page_id ');
			$terms_id = get_option(' woocommerce_terms_page_id ');
			
			$woo_pages = get_posts(array('post_type' => 'product','post_status' => 'publish', 'posts_per_page' => '-1') );
			
			foreach($woo_pages as $page){
				$woo_page_id = $page->ID;
				?>
				no_ajax_pages.push('<?php echo get_permalink($woo_page_id) ?>');
				<?php
			}
			?>
			no_ajax_pages.push('<?php echo get_permalink($shop_id) ?>');
			no_ajax_pages.push('<?php echo get_permalink($cart_id) ?>');
			no_ajax_pages.push('<?php echo get_permalink($checkout_id) ?>');
			no_ajax_pages.push('<?php echo get_permalink($pay_id) ?>');
			no_ajax_pages.push('<?php echo get_permalink($thanks_id) ?>');
			no_ajax_pages.push('<?php echo get_permalink($myacount_id) ?>');
			no_ajax_pages.push('<?php echo get_permalink($edit_address_id) ?>');
			no_ajax_pages.push('<?php echo get_permalink($view_order_id) ?>');
			no_ajax_pages.push('<?php echo get_permalink($terms_id) ?>');
			<?php
		}
		?>
		
		<?php
		$pages = get_pages();
		foreach ($pages as $page) {
			if(get_post_meta($page->ID, "qode_show-animation", true) == "no_animation") :
				?>
				no_ajax_pages.push('<?php echo get_permalink($page->ID) ?>');
			<?php
			endif;
		}
		
		if(function_exists('icl_get_languages')) {
			$language_pages = icl_get_languages('skip_missing=0');
			foreach($language_pages as $language_page) {
				?>
				no_ajax_pages.push('<?php echo esc_attr($language_page["url"]); ?>');
			
			<?php } }
		
		if (isset($river_options['internal_no_ajax_links'])) {
			foreach (explode(',', $river_options['internal_no_ajax_links']) as $no_ajax_link) {
				?>
				no_ajax_pages.push('<?php echo trim($no_ajax_link); ?>');
				<?php
			}
		}
		?>
		<?php
	}
	
	add_action( 'river_qode_action_default_dynamic', 'river_qode_add_default_dynamic' );
}