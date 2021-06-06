<?php

Class Bangla_number {

    private $bn_array = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
    private $en_array = array('1','2','3','4','5','6','7','8','9','0');
    
    public function convert($string){
        return str_replace($this->en_array, $this->bn_array, $string);
    }

    public function get_monthname($day="January"){
        switch ($day){
            case 'January': return "জানুয়ারী";break;
            case 'February': return "ফেব্রুয়ারী";break;
            case 'March': return "মার্চ";break;
            case 'April': return "এপ্রিল";break;
            case 'May': return "মে";break;
            case 'June': return "জুন";break;
            case 'July': return "জুলাই";break;
            case 'August': return "অগাস্ট";break;
            case 'September': return "সেপ্টেম্বর";break;
            case 'October': return "অক্টোবর";break;
            case 'November': return "নভেম্বর";break;
            case 'December': return "ডিসেম্বর";break;
        }
    }
    
}

