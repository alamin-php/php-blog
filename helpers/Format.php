<?php
    class Format{
        
        public function formatDate($date){
            return date('F j, Y, g:i A', strtotime($date));
        }

        public function shortenText($text, $limit=400){
            $text = $text."";
            $text = substr($text, 0, $limit);
            $text = substr($text, 0, strrpos($text, ' '));
            // $text = $text.". . .";
            return $text;
        }

        public function validation($data){
            $data = trim($data);
            $data = htmlspecialchars($data);
            $data = stripslashes($data);
            return $data;
        }

        public function title(){
            $path = $_SERVER['SCRIPT_FILENAME'];
           $title = basename($path, '.php');
           $title = str_replace('_', ' ', $title);
           if($title == 'index'){
               $title = 'home';
           }elseif($title == 'contact'){
               $title = 'contact';
           }elseif($title == 'catlist'){
               $title = 'category list';
           }elseif($title == 'titleslogan'){
               $title = 'Slogan';
           }elseif($title == 'addcat'){
               $title = 'add category';
           }elseif($title == 'addpost'){
               $title = 'add post';
           }
           return $title = ucfirst($title);
        }
    }