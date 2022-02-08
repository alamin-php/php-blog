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
    }