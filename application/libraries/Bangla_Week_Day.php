<?php

class Bangla_week_day{
    
    public function get_dayname(){
        $week_day = date('w');
        
        switch ($week_day){
            case '0': return "রবিবার";break;
            case '1': return "সোমবার";break;
            case '2': return "মঙ্গলবার";break;
            case '3': return "বুধবার";break;
            case '4': return "বৃহস্পতিবার";break;
            case '5': return "শুক্রবার";break;
            case '6': return "শনিবার";break;
            
        }
        
    }

    public function get_monthname($name="January"){
   
        switch ($name){
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

?>
