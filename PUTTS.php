<?php

class PUTTS {

    const VOICE_PATH = "Voices/";
    const DEBUG_MODE = false;

    static $voices = [];
    static $instance = false;

    /**
     * @return PUTTS|bool
     */
    public static function getInstance(){
        return self::$instance;
    }

    /**
     * @param $voice
     * @return Voice|false
     */
    public static function getVoice($voice){
        return (isset(self::$voices[$voice]) ? self::$voices[$voice] : false);
    }

    private $language;

    public function __construct(Language $language){
        self::$instance = $this;
        $this->language = $language;

        $this->getVoices(); //Initialise
    }

    /**
     * @return Language
     */
    public function getLanguage(){
        return $this->language;
    }

    protected function getVoices(){
        $dir = scandir(self::VOICE_PATH);
        if(!$dir){
            throw new Exception("Data-Path ".self::VOICE_PATH." does not exist!");
        }

        foreach($dir as $voiceFolder){
            if(is_dir(self::VOICE_PATH.$voiceFolder)){
                self::$voices[$voiceFolder] = new Voice($voiceFolder, self::VOICE_PATH.$voiceFolder); //Create new voice
            }
        }
    }

} 