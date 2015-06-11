<?php

class Voice {

    private $dataFolder;
    private $name;

    public function __construct($name, $dataFolder){
        $this->name = $name;
        $this->dataFolder = $dataFolder;

        if(!$this->useable()){
            if(!PUTTS::DEBUG_MODE){
                throw new Exception("This voice is not compatible to language ".PUTTS::getInstance()->getLanguage()->getCode()."!");
            }
        }
    }


    public function speakString($string){

    }

    public function useable(){
        $required = PUTTS::getInstance()->getLanguage()->getRequired();
        foreach($required as $audio){
            if(!$this->existsVoiceFile($audio)){
                return false;
                break;
            }
        }

        return true;
    }

    public function existsVoiceFile($file){
        return file_exists($this->getDataFolder().$file.".wav");
    }

    public function getName(){
        return $this->name;
    }

    public function getDataFolder(){
        return $this->dataFolder;
    }

    public function getDataFolderContents(){
        return scandir($this->dataFolder);
    }

} 