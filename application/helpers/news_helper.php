<?php
function top_letest_news($filters=array(), $limit=10)
{
	$ci = & get_instance();
	return $ci->news_library->top_letest_news($filters, $limit);
}
function top_menu($filters=array("parent_id"=>0))
{
	$ci = & get_instance();
	return $ci->news_library->top_menu($filters);
}
function footer_blog($filters=array(), $properties=array())
{
	$ci = & get_instance();
	return $ci->news_library->footer_blog($filters, $properties);
}
function get_news_list($filters=array(), $limit=10, $properties=array())
{
	$ci = & get_instance();
	return $ci->news_library->get_news_list($filters, $limit, $properties);
}
function get_news_list_category($filters=array(), $properties=array())
{
	$ci = & get_instance();
	return $ci->news_library->get_news_list_category($filters, $properties);
}
function mostreaded_news($filters=array(), $limit=10, $properties=array())
{
	$ci = & get_instance();
	return $ci->news_library->mostreaded_news($filters, $limit, $properties);
}
function cur_poll()
{
	$ci = & get_instance();
	return $ci->news_library->cur_poll();
}
function cur_advertisement($filters=array(), $sql_properties=array())
{
	$ci = & get_instance();
	return $ci->news_library->cur_advertisement($filters, $sql_properties);
}
function list_style($filters=array(), $properties=array())
{
	$ci = & get_instance();
	return $ci->news_library->list_style($filters, $properties);
}
function grid_style($categories=array(), $properties=array())
{
	$ci = & get_instance();
	return $ci->news_library->grid_style($categories, $properties);
}
function grid_style_custom($categories=array(), $properties=array())
{
	$ci = & get_instance();
	return $ci->news_library->grid_style_custom($categories, $properties);
}
function grid_style_bottom($categories=array(), $properties=array())
{
	$ci = & get_instance();
	return $ci->news_library->grid_style_bottom($categories, $properties);
}

function today_prayer()
{
	$ci = & get_instance();
	return $ci->news_library->today_prayer();
}
function news_comments($news_id=0)
{
	$ci = & get_instance();
	return $ci->news_library->news_comments($news_id);
}

function small_content_slider($filters=array(), $limit=10, $id="slide-1")
{
	$ci = & get_instance();
	return $ci->news_library->small_content_slider($filters, $limit, $id);
}
function news_instant($properties=array())
{
	$ci = & get_instance();
	return $ci->news_library->news_instant($properties);
}
function tabpanel($filters=array(), $properties=array())
{
	$ci = & get_instance();
	return $ci->news_library->tabpanel($filters, $properties);
}
function top_date() {
	$ci = & get_instance();
	return $ci->news_library->top_date();
}

function double_list_style($properties=array())
{
	$ci = & get_instance();
	return $ci->news_library->double_list_style($properties);
}
function picture_category()
{
	$ci = & get_instance();
	return $ci->news_library->picture_category();
}
function gellary_style($properties=array())
{
	$ci = & get_instance();
	return $ci->news_library->gellary_style($properties);
}
function allcountry_list_style($properties=array())
{
	$ci = & get_instance();
	return $ci->news_library->allcountry_list_style($properties);
}
function teach_list_style($properties=array())
{
	$ci = & get_instance();
	return $ci->news_library->teach_list_style($properties);
}
function play_list_style($properties=array())
{
	$ci = & get_instance();
	return $ci->news_library->play_list_style($properties);
}
function binodone_list_style($properties=array())
{
	$ci = & get_instance();
	return $ci->news_library->binodone_list_style($properties);
}
function picture_list_style($properties=array())
{
	$ci = & get_instance();
	return $ci->news_library->picture_list_style($properties);
}

function newsDefaultImage($row=array(), $properties=array())
{
    $ci = & get_instance();
    return $ci->news_library->newsDefaultImage($row, $properties);
}

function newsImageResize($source_image='', $new_image='', $width=50, $height=50)
{
    $ci = & get_instance();
    return $ci->news_library->newsImageResize($source_image, $new_image, $width, $height);
}

function newsImageFixedResize($id=0, $ext='', $image='', $width=50, $height=50)
{
    $ci = & get_instance();
    return $ci->news_library->newsImageFixedResize($id, $ext, $image, $width, $height);
}
