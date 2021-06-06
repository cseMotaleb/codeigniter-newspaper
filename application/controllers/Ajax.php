<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	var $data = array();

	function __construct()
	{
		parent::__construct();
        $this->config->load_db_items();
        $this->data['company_config'] = all_config();
	}

	public function mega_menu_summary()
	{
		$data = array();
		$category_id = (int)$this->input->post("cat_id");
		$parent_id = (int)$this->input->post("par_id");
		$this->load->model("blog/blog_model");
		$news_rows = $this->blog_model->get_news_by_category(array("blog.enabled"=>1, "blog_categories.category_id"=>$category_id, "blog_categories.parent_id"=>$parent_id), array("limit"=>3));
		$data['rows'] = $news_rows['blogs'];
		//$data['rows'] = $this->batch_model->get_rows(array("table"=>"blog", "limit"=>9), array("blog.category_id"=>$category_id, "blog.parent_id"=>$parent_id));
		$json = $this->load->view("ajax/mega-menu-summary", $data, TRUE);
		$this->_json_encode($json); return;
	}

	public function poll()
	{
		$json = "";

        $cartkey = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);

		$poll_id = $this->input->post("poll_id");
		$option = $this->input->post("option");
		if($option && $poll_id) {
			$check_vote = $this->batch_model->get_rows(array("table"=>"poll_details", "limit"=>1), array("poll_id"=>$poll_id, "key"=>$cartkey));
			if(isset($check_vote['id'])) {
				$json['error'] = '<br /><div class="err_msg" style="display: block;"><i class="fa fa-info"></i> আপনি এর আগেও একবার ভোট দিয়েছেন, তাই এই ভোটটি গৃহীত হলো না।</div>';
			}
			else {
				$poll_data = $this->batch_model->get_rows(array("table"=>"polls", "limit"=>1), array("id"=>$poll_id));
				$url = (isset($poll_data['id'])) ? non_english_url_title(strip_tags($poll_data['poll'])) : "";
				$parsed_data['poll_id'] = $poll_id;
				$parsed_data['option_id'] = $option;
				$parsed_data['key'] = $cartkey;
				$this->batch_model->save("poll_details", $parsed_data);
				$json['error'] = 1;
				$json['redirect'] = site_url("poll/{$poll_id}/{$url}");
			}
		}
		else {
			$json['error'] = '<br /><div class="err_msg" style="display: block;"><i class="fa fa-info"></i> অনুগ্রহ করে আপনার পছন্দ নির্বাচন করুন।</div>';
		}
		
		$this->_json_encode($json); return;
	}

	public function like_dislike_comment()
	{
		$comment_id = $this->input->get("id");
		$blog_id = $this->input->get("blog_id");
		$like = $this->input->get("like");
		$user_id = $this->session->userdata("user_id");

		$json['like'] = $this->bangla_number->convert("0");
		$json['dislike'] = $this->bangla_number->convert("0");

		if($user_id && $comment_id && $blog_id) {
			$check_like = $this->batch_model->get_rows(array("table"=>"blog_like_dislike", "limit"=>1), array("comment_id"=>$comment_id, "member_id"=>$user_id));
			$comparison_fields = NULL;
			if(isset($check_like['id'])) {
				$comparison_fields["name"] = "id";
				$comparison_fields['value'] = $check_like['id'];
			}

			$parsed_data['comment_id'] = $comment_id;
			$parsed_data['member_id'] = $user_id;
			$parsed_data['like'] = ($like == "like") ? 1 : 0;
			$parsed_data['dislike'] = ($like == "dislike") ? 1 : 0;
			$status = $this->batch_model->save("blog_like_dislike", $parsed_data, $comparison_fields);

			$total_like = $this->batch_model->row_counter(array("like"=>1, "comment_id"=>$comment_id, "member_id"=>$user_id), "blog_like_dislike");
			$json['like'] = $this->bangla_number->convert($total_like);

			$total_dislike = $this->batch_model->row_counter(array("dislike"=>1, "comment_id"=>$comment_id, "member_id"=>$user_id), "blog_like_dislike");
			$json['dislike'] = $this->bangla_number->convert($total_dislike);
		}

		$this->_json_encode($json); return;
	}

	public function archive_calendar()
	{
		$month = (int)$this->input->get("month");
		$year = (int)$this->input->get("year");

	  	/* draw table */
	  	$calendar = '<table border="0" cellspacing="0" cellpadding="6" class="table-cal">';

	  	/* table headings */
	  	$today_date_number = date("w");
	  	$headings = array('রবি','সোম','মঙ্গল','বুধ','বৃহঃ','শুক্র','শনি');
	  	$calendar.= '<tr style="background-color: #FFFFFF;" font-weight: bold;">';
	  	$calendar.= ($today_date_number == 0) ? '<td class="calendar-day-head active-day">রবি</td>' : '<td class="calendar-day-head">রবি</td>';
	  	$calendar.= ($today_date_number == 1) ? '<td class="calendar-day-head active-day">সোম</td>' : '<td class="calendar-day-head">সোম</td>';
	  	$calendar.= ($today_date_number == 2) ? '<td class="calendar-day-head active-day">মঙ্গল</td>' : '<td class="calendar-day-head">মঙ্গল</td>';
	  	$calendar.= ($today_date_number == 3) ? '<td class="calendar-day-head active-day">বুধ</td>' : '<td class="calendar-day-head">বুধ</td>';
	  	$calendar.= ($today_date_number == 4) ? '<td class="calendar-day-head active-day">বৃহঃ</td>' : '<td class="calendar-day-head">বৃহঃ</td>';
	  	$calendar.= ($today_date_number == 5) ? '<td class="calendar-day-head active-day">শুক্র</td>' : '<td class="calendar-day-head">শুক্র</td>';
	  	$calendar.= ($today_date_number == 6) ? '<td class="calendar-day-head active-day">শনি</td>' : '<td class="calendar-day-head">শনি</td>';
	  	$calendar.= '</tr>';

	 	/* days and weeks vars now ... */
	  	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	  	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
		$running_date = date("Y-m-d");
	  	$days_in_this_week = 1;
	  	$day_counter = 0;

	  	/* row for week one */
	  	$calendar.= '<tr class="calendar-row">';

	  	/* print "blank" days until the first of the current week */
	  	for($x = 0; $x < $running_day; $x++):
	    	$calendar.= '<td style="color:#FCFCFC" class="calendar-day-np">&nbsp;</td>';
	    	$days_in_this_week++;
	  	endfor;

	  	/* keep going with days.... */
	  	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
	        $date=date('Y-m-d',mktime(0,0,0,$month,$list_day,$year));
			$urldate = date('Y/m/d',mktime(0,0,0,$month,$list_day,$year));
			$week_number = date('w',mktime(0,0,0,$month,$list_day,$year));
			$row_counter = $this->batch_model->row_counter(array("enabled"=>1, "date"=>$date), "blog");

			$bgcolor = ($row_counter > 0) ? 'bgcolor="#fbfffc"' : 'bgcolor="#ffffff"';
			$bgclass = ($row_counter > 0) ? "bg-28374e" : "bg-7e7e7e";
			if($date == $running_date) $bgclass = "bg-0f64b5";
	    	$calendar.= "<td class=\"calendar-day {$bgclass}\">";
	      	/* add in the day number */
	      	if($row_counter > 0) {
	      		$url = site_url("archive/{$urldate}");
	      		$calendar.= '<div class="day-number"><strong style="text-align: center;"><a target="_blank" href="'.$url.'">'.$this->bangla_number->convert($list_day).'</a></strong></div>';
	      	}
			else {
				$calendar.= '<div class="day-number"><strong>'.$this->bangla_number->convert($list_day).'</strong></div>';
			}

	        $tdHTML='';
	        //if(isset($resultA[$date])) $tdHTML=$resultA[$date];

	      	$calendar.=$tdHTML;

	    	$calendar.= '</td>';

	    	if($running_day == 6):
	      		$calendar.= '</tr>';
	     		 if(($day_counter+1) != $days_in_month):
	        		$calendar.= '<tr bgcolor="#00bfff" class="calendar-row">';
	      		endif;
	      		$running_day = -1;
	      		$days_in_this_week = 0;
	    	endif;
	    	$days_in_this_week++; $running_day++; $day_counter++;
	 	endfor;

	  	/* finish the rest of the days in the week */
	  	if($days_in_this_week < 8):
	    	for($x = 1; $x <= (8 - $days_in_this_week); $x++):
	      		$calendar.= '<td bgcolor="#ffffff" class="calendar-day-np">&nbsp;</td>';
	    	endfor;
	  	endif;

	  	/* final row */
	  	$calendar.= '</tr>';

	  	/* end the table */
	  	$calendar.= '</table>';

	  	/* all done, return result */
	  	$this->_json_encode($calendar); return;
	  	//return $calendar;
	}

	private function _json_encode($json)
	{
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($json); return;
	}
}