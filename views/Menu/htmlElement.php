<?php
class html{
    private $attribute;
    private $tag;
    public function __construct($tag){
        $this->tag = $tag;
    }
    public function __set($name, $value){
        $this->attribute[$name] = $value;
    }
    public function __get($name){
        if(array_key_exists($name, $this->attribute)){
            return $this->attribute[$name];
        }
    }
    public function createHTML(string $innerHTML = '', $htmlSingle = false):string {
        $html = '<'. $this->tag .' ';
        if ($htmlSingle){
            foreach($this->attribute as $key => $value){
                $html .= $key . '="' .$value . '" ';
            }
            return $html .= '>';
        }
        else{
            foreach($this->attribute as $key=>$value){
                $html .= $key .'="' . $value.'" ';
            }
            return $html .= '>'.$innerHTML .'</'. $this->tag .'>';
        }
        
    }
}
 ?>