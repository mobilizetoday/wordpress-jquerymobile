jQuery(document).bind("mobileinit", function(){
  jQuery.mobile.ajaxEnabled = false;
  jQuery.mobile.hashListeningEnabled = false;
});
jQuery(document).ready(function(){
	jQuery('#sidebar .widget_links ul, #sidebar .widget_nav_menu ul, #sidebar .widget_recent_comments ul, #sidebar .widget_categories ul, #sidebar .widget_recent_entries ul, #sidebar .widget_meta ul, #sidebar .widget_rss ul, #sidebar .widget_archive ul, #sidebar .widget_pages ul').attr('data-role', 'listview').attr('data-inset', 'false');
	jQuery('.widget .textwidget, .widget #calendar_wrap, .widget .tagcloud').addClass('ui-body ui-body-c');
	jQuery('.widget select').attr('data-native-menu', 'false');
	jQuery('option:first', jQuery('.widget select')).removeAttr('value');
	jQuery('#wp-calendar #prev a, #wp-calendar #next a, a.post-edit-link, p.tags a, p.pages span').attr('data-role', 'button').attr('data-inline', 'true');
});