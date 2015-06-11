<?php

abstract class Language {

    private $name;
    private $code;

    public function __construct($name, $countryCode){
        $this->name = $name;
        $this->code = $countryCode; //e.g de_DE, en_US ...
    }

    /**
     * @return string
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCode(){
        return $this->code;
    }

    public abstract function sayNumber($number);

    public abstract function getRequired();

} 