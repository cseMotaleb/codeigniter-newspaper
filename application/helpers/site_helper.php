<?php
function detectmobilebrowsers()
{
    $return = 0;

    $useragent = $_SERVER['HTTP_USER_AGENT'];
    if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
        $return = 1;
    }

    return $return;
}


function flags($table = "degree", $id = 0, $translation = FALSE, $link = '')
{
    $flags = '';

    if ($id) {
        $sql_properties['select'] = "{$table}.*, language.language, language.icon";
        $sql_properties['table'] = "{$table}";
        $sql_properties['limit'] = 100;
        $sql_properties['glue'] = "language";
        $sql_properties['pieces'] = "language.id = {$table}.lang_id";

        if ($translation) $check_converts = get_rows($sql_properties, array("{$table}.translation_id" => $id));
        else $check_converts = get_rows($sql_properties, array("{$table}.id" => $id));

        foreach ($check_converts as $key => $convert) {
            $image = base_url() . "assets/img/icons/{$convert['icon']}";
            if ($link) $flags .= "<a href=\"{$link}{$convert['id']}\">";
            $flags .= "<img class=\"small-flag\" src =\"{$image}\" alt=\"{$convert['language']}\" title=\"{$convert['language']}\" />";
            if ($link) $flags .= "</a>";
        }
    }

    return $flags;
}

function site_current_lang()
{
    $ci = &get_instance();
    $site_actual_lang = $ci->uri->segment(1);
    if (!$site_actual_lang) { /*redirect(current_url() . 'en/', 'location', 301); return;*/
    }
    $valid_langs = array('ar', 'en');
    $site_actual_lang = in_array($site_actual_lang, $valid_langs) ? $site_actual_lang : "en";
    return $site_actual_lang;
}

function default_language_details()
{
    $ci = &get_instance();
    $ci->load->model("core/language_model");
    return $ci->language_model->default_language_details("lang");
}

function site_lang($lang = '')
{
    $ci = &get_instance();
    return $ci->lang->line($lang);
}

function replace_url($url = '')
{
    $search = array(",", "!", ":", "?", '/', '(', ')', ' ', '.', "'", '"', "’", "‘", "%", "+", '=', "”", "“", "।", "&", "®", "’", "–", "|");
    //$search = array(",", "!", ":", "?", '/', '(', ')', ' ', '.');
    $url = str_replace($search, '-', $url);
    $url = trim(preg_replace('/-+/', '-', $url), '-');
    return $url;
}

function parents($filters = array(), $default = '')
{
    $ci = &get_instance();
    return $ci->site_library->parents($filters, $default);
}

function site_cdn_url()
{
    $ci = &get_instance();
    return $ci->config->item("site_cdn_url");
}

function all_config()
{
    $ci = &get_instance();
    return $ci->site_library->all_config();
}

function get_image_list($filters = array('type' => 'Home Page', 'status' => 'Enabled'), $default = '')
{
    $ci = &get_instance();
    return $ci->site_library->get_image_list($filters, $default);
}

function page_banner($filters = array(), $default = '')
{
    $ci = &get_instance();
    return $ci->site_library->page_banner($filters, $default);
}

function countries($filters = array(), $default = '')
{
    $ci = &get_instance();
    return $ci->site_library->countries($filters, $default);
}

function alphaID($in, $to_num = false, $pass_key = 'TATAMAX', $pad_up = 8)
{
    $ci = &get_instance();
    return $ci->batch_model->alphaID($in, $to_num, $pass_key, $pad_up);
}

function tour_packages($filters = array(), $default = '')
{
    $ci = &get_instance();
    return $ci->site_library->tour_packages($filters, $default);
}

function menus($filters = array())
{
    $ci = &get_instance();
    return $ci->site_library->menus($filters);
}

function members($filters = array(), $default = '')
{
    $ci = &get_instance();
    return $ci->site_library->members($filters, $default);
}

function get_files($path = '')
{
    $ci = &get_instance();
    $ci->load->helper('file');
    $return = get_filenames("{$path}");

    /*if( !is_dir($dir.$file)) {
        if( preg_match("/\.(png|gif|jpe?g|bmp)/",$file,$m)) {
            // $m[1] is now the extension of the filename
            // You can perform additional verification
            // Example: if $m[1] == 'png' check if imagecreatefrompng accepts it
            $images[] = $file;
        }
    }*/
    $return_file = array();
    if (is_array($return)) {
        foreach ($return as $key => $value) {
            if ($value !== 'Thumbs.db') {
                $return_file[] = $value;
            }
        }
    }
    return $return_file;
}

function create_folder($path = '')
{
    if ($path) {
        if (!file_exists($path)) {
            @mkdir($path);
        }
    }
    return;
}

function get_rows($sql_properties = array(), $filters = array())
{
    $ci = &get_instance();
    return $ci->batch_model->get_rows($sql_properties, $filters);
}

function ajax_json_encode($response = array(), $success = 0)
{
    $ci = &get_instance();
    return $ci->batch_model->ajax_json_encode($response, $success);
}

function widget_menu($filters = array(), $full_data = FALSE)
{
    $ci = &get_instance();
    $data = $ci->site_library->widget_menu($filters);
    if (!$full_data) return isset($data['values'][0]['content']) ? $data['values'][0]['content'] : '';
    else return $data;
}

function row_counter($filters = array(), $table = '', $sql_properties = NULL)
{
    $ci = &get_instance();
    return $ci->batch_model->row_counter($filters, $table, $sql_properties);
}

function widget_snippet($filters = array('enabled' => 1))
{
    $data = array();

    $ci = &get_instance();
    $widgets = $ci->batch_model->get_rows(array('table' => 'widgets', 'limit' => 100), $filters);
    foreach ($widgets as $key => $section) {
        $data["{$section['section_id']}"] = $section;
    }

    return $data;
}

function controllerlist($subdir = FALSE, $filters = array(), $default = '')
{
    $ci = &get_instance();
    return $ci->site_library->controllerlist($subdir, $filters, $default);
}

function groups($filters = array(), $batch = array())
{
    $ci = &get_instance();
    return $ci->site_library->groups($filters, $batch);
}

function addons($filters = array(), $batch = array())
{
    $ci = &get_instance();
    return $ci->site_library->addons($filters, $batch);
}

function users_rules($filters = array(), $check_addon = FALSE, $preg_match = FALSE)
{
    $ci = &get_instance();
    return $ci->site_library->users_rules($filters, $check_addon, $preg_match);
}

function top_lang($filters = array(), $default = '')
{
    $ci = &get_instance();
    return $ci->site_library->top_lang($filters, $default);
}

function enum_list($table = 'users', $list = 'group', $default = '', $properties = array())
{
    $groups = list_enum($table, $list);
    $enum_list = '';
    foreach ($groups as $key => $value) {
        if (!empty($value)) {
            if ($default === $value) $selected = 'selected="selected"';
            else $selected = '';
            $enum_list .= "<option value=\"{$value}\" {$selected}>{$value}</option>";
        }
    }

    if (isset($properties['custom_options'])) {
        foreach ($properties['custom_options'] as $key => $value) {
            if (!empty($value)) {
                if ($default === $value) $selected = 'selected="selected"';
                else $selected = '';
                $enum_list .= "<option value=\"{$value}\" {$selected}>{$value}</option>";
            }
        }
    }
    return $enum_list;
}

function options($sql_properties = array(), $filters = array())
{
    $ci = &get_instance();
    return $ci->site_library->options($sql_properties, $filters);
}

function check_job_status($filters = array())
{
    $return = array();

    $return['class'] = '';
    $return['status'] = '';
    $check_job_status = get_rows($filters, array('table' => 'message_code', 'limit' => 1));
    if (isset($check_job_status['id'])) {
        if ($check_job_status['status'] == 'On Progress') $return['class'] = ' label-primary';
        elseif ($check_job_status['status'] == 'Complete Request') $return['class'] = ' label-danger';
        elseif ($check_job_status['status'] == 'Complete Accepted') $return['class'] = ' label-danger';
        elseif ($check_job_status['status'] == 'Dispute') $return['class'] = ' label-warning';

        if ($check_job_status['status'] == 'Dispute') $return['status'] = 'File Disputed';
        elseif ($check_job_status['status'] == 'Complete Accepted') $return['status'] = 'Payment Pending';
        else $return['status'] = $check_job_status['status'];
    }

    return $return;
}

//DB Forge - Enum Field
function list_enum($table = '', $list = FALSE)
{
    $CI =& get_instance();

    // Another Custom Function to Check Exists Files
    if (!function_exists('check_file')) {
        $CI->load->helper('file');
    }

    // path + filename ( filename = tablename )
    $file = $CI->config->item('system_file_path') . 'system/list/' . $table;

    // Check if File exists
    if (file_exists($file)) {
        // File exists = No need to do MySQL Request
        // Get the Data
        $data = read_file($file);
        // Unserialize the Return Data
        $return = unserialize($data);
        // In the Case several Lists are request
        // return as array
        if ($list) {
            return (array_key_exists($list, $return)) ? $return[$list] : $return;
        } else {
            return $return;
        }

    } else {
        // File doesn't exists
        // Prepare MySql Query
        // The Query asked only for type 'enum'
        $sql = 'SHOW COLUMNS FROM ' . $CI->db->dbprefix($table) . ' WHERE type LIKE "enum%"';
        $query = $CI->db->query($sql);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $item) {
                // Clean Up the Typ List
                // preg_match is a mighty function
                // to mighty for the little function
                // so, just str_replace is enough
                $tmp_array_list = explode(',', str_replace(array('enum(', ')', "'"), '', $item->Type));

                // prepare every single enum field as list
                foreach ($tmp_array_list as $entry) {
                    $lists[$item->Field][$entry] = ucwords($entry);
                }
                // the first entry isn't 0 ( is 1 )
                // 0 is empty
                // add NULL (0) as first array entry
                array_unshift($lists[$item->Field], NULL);
            }

            // write the serialize lists on the table file
            write_file($file, serialize($lists));

            // Asked several list = return as array
            if ($list) {
                return (array_key_exists($list, $lists)) ? $lists[$list] : $lists;
            } else {
                return $lists;
            }
        }
    }
}

function language($filters = array(), $default = '')
{
    $ci = &get_instance();
    return $ci->site_library->language($filters, $default);
}

function encoded_url_title($string = '', $funcs = array('str_replace', 'strtolower', ''))
{
    if (in_array('str_replace', $funcs)) $string = str_replace(' ', '-', $string);
    if (in_array('strtolower', $funcs)) $string = strtolower($string);
    if (in_array('urlencode', $funcs)) $string = urlencode($string);

    return $string;
}

//font end
function social_network()
{
    $ci = &get_instance();
    return $ci->site_library->social_network();
}

function non_english_url_title($str, $separator = '-', $lowercase = TRUE)
{
    if ($separator == 'dash') {
        $separator = '-';
    } else if ($separator == 'underscore') {
        $separator = '_';
    }
    $q_separator = preg_quote($separator);
    $trans = array(
        '&.+?;' => '',
        '[^[U+0621]-[U+064a]a-z0-9 _-]' => '',
        '\s+' => $separator,
        '(' . $q_separator . ')+' => $separator
    );
    $str = strip_tags($str);
    foreach ($trans as $key => $val) {
        $str = preg_replace("#" . $key . "#i", $val, $str);
    }
    if ($lowercase === TRUE) {
        $str = strtolower($str);
    }

    $url = trim($str, $separator);
    $url = replace_url($url);

    return $url;
}

function basic_modal($properties = array())
{
    $id = (isset($properties['id'])) ? $properties['id'] : "myModal";
    $title = (isset($properties['title'])) ? $properties['title'] : "Delete";
    $content = (isset($properties['content'])) ? $properties['content'] : "Are you sure to delete this data?";
    $btn1 = (isset($properties['btn1'])) ? $properties['btn1'] : "Cancel";
    $btn2 = (isset($properties['btn2'])) ? $properties['btn2'] : "Confirm";
    $btn2_class = (isset($properties['btn2_class'])) ? $properties['btn2_class'] : "ConfirmDel";

    $data = '<div class="modal fade" id="' . $id . '">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        		<h4 class="modal-title">' . $title . '</h4>
	      		</div>
	      		<div class="modal-body">
	        		<p>' . $content . '</p>
	      		</div>
	      		<div class="modal-footer">
					<button type="submit" data-dismiss="modal" class="btn btn-danger">' . $btn1 . '</button>
					<button type="submit" data-dismiss="modal" class="btn btn-primary ' . $btn2_class . '">' . $btn2 . '</button>
	      		</div>
	    	</div>
	  	</div>
	</div>';

    return $data;
}

function menu_rows($filters = array())
{
    $ci = &get_instance();
    $ci->load->model(array("cms/content_model"));
    $sql_properties = $ci->content_model->sql_properties($limit = 15);
    $rows = $ci->batch_model->get_rows($sql_properties, $filters);
    return $rows;
}

function top_phones($limit = 6)
{
    $ci = &get_instance();
    $ci->load->model(array("products/products_model"));
    $filters = array("product_images.position" => 0, "products.category_id" => 20);
    $sql_properties = $ci->products_model->sql_properties($limit);
    $sql_properties['order_by'] = "product_description.product_name";
    $sql_properties['order_type'] = "random";
    return $ci->batch_model->get_rows($sql_properties, $filters);
}

function featured_products($limit = 10, $filters = array("product_images.position" => 0, "products.category_id" => 20))
{
    $ci = &get_instance();
    $ci->load->model(array("products/products_model"));
    $sql_properties = $ci->products_model->sql_properties($limit);
    $sql_properties['order_by'] = "products.id";
    $sql_properties['order_type'] = "random";
    return $ci->batch_model->get_rows($sql_properties, $filters);
}

/**
 *
 * @param Array $list
 * @param int $p
 * @return multitype:multitype:
 * @link http://www.php.net/manual/en/function.array-chunk.php#75022
 */
function partition($list = array(), $p = 2)
{
    $listlen = is_countable($list) ? count($list): 0;
    $partlen = floor($listlen / $p);
    $partrem = $listlen % $p;
    $partition = array();
    $mark = 0;
    for ($px = 0; $px < $p; $px++) {
        $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
        $partition[$px] = array_slice($list, $mark, $incr);
        $mark += $incr;
    }
    return $partition;
}

if (!function_exists('word_limiter')) {
    //string word limiter
    function word_limiter($str, $n = 100, $end_char = '…')
    {
        if (strlen($str) < $n) {
            return close_tags($str);
        }

        $words = explode(' ', preg_replace("/\s+/", ' ', preg_replace("/(\r\n|\r|\n)/", " ", $str)));

        if (count($words) <= $n) {
            return close_tags($str);
        }

        $str = '';
        for ($i = 0; $i < $n; $i++) {
            $str .= $words[$i] . ' ';
        }

        $str = close_tags($str);
        return trim($str) . $end_char;
    }
}


if (!function_exists('close_tags')) {
    //dynamically close all tags
    function close_tags($string = '')
    {
        // coded by Constantin Gross <connum at googlemail dot com> / 3rd of June, 2006
        // (Tiny little change by Sarre a.k.a. Thijsvdv)
        $donotclose = array('br', 'img', 'input', 'hr', 'link', 'meta'); //Tags that are not to be closed

        //prepare vars and arrays
        $tagstoclose = '';
        $tags = array();

        //put all opened tags into an array  /<(([A-Z]|[a-z]).*)(( )|(>))/isU
        @preg_match_all("/<(([A-Z]|[a-z]).*)(( )|(>))/isU", $string, $result);
        $openedtags = $result[1];
        // Next line escaped by Sarre, otherwise the order will be wrong
        // $openedtags=array_reverse($openedtags);

        //put all closed tags into an array
        @preg_match_all("/<\/(([A-Z]|[a-z]).*)(( )|(>))/isU", $string, $result2);
        $closedtags = $result2[1];

        //look up which tags still have to be closed and put them in an array
        for ($i = 0; $i < count($openedtags); $i++) {
            if (in_array($openedtags[$i], $closedtags)) {
                unset($closedtags[array_search($openedtags[$i], $closedtags)]);
            } else array_push($tags, $openedtags[$i]);
        }

        $tags = array_reverse($tags); //now this reversion is done again for a better order of close-tags

        //prepare the close-tags for output
        for ($x = 0; $x < count($tags); $x++) {
            $add = strtolower(trim($tags[$x]));
            if (!in_array($add, $donotclose)) $tagstoclose .= '</' . $add . '>';
        }

        //and finally
        $html = $string . $tagstoclose;

        $ci = &get_instance();
        //$html = $ci->site_library->fix_unsafe_attributes($html);
        return $html;
    }

    function imageResize($source_image = '', $new_image = '', $width = 50, $height = 50)
    {
        $ci = &get_instance();
        return $ci->site_library->imageResize($source_image, $new_image, $width, $height);
    }
}
/**
 * @return string
 */
function metaAuthor($return = null)
{
    $tag = '<meta name="author" content="Rajib Hossain<rajibhossain.php@gmail.com>"/>'."\n";
    if ($return)
        return $tag;
    echo $tag;
}

function scriptTag($src, $return = false)
{
    $op = '<script src="';
    $cl = '"></script>'."\n";
    $tags = '';
    if (is_array($src)) {
        foreach ($src as $s) {
            $tags .= $op . site_url($s) . $cl;
        }
    } else {
        $tags = $op . site_url($src) . $cl;
    }
    if ($return)
        return $tags;
    echo $tags;
}


if (version_compare(PHP_VERSION, "7.3") < 0 && !function_exists("is_countable")) {
    function is_countable($var): bool
    {
        return (is_array($var) || is_object($var) || is_iterable($var) || $var instanceof Countable);
    }
}