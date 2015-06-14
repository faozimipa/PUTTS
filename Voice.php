<?php

class Voice {

    private $dataFolder;
    private $name;

    public function __construct($name, $dataFolder){
        $this->name = $name;
        $this->dataFolder = $dataFolder;
    }

    /**
     * @param string
     * @return DataProvider
     */
    public function speakString($string){
        $words = explode(" ", $string);
        $spoken = [];
        foreach($words as $word){
            if(is_numeric($word) and strlen($word) < 5){
                $spoken = array_merge($spoken, PUTTS::getInstance()->getLanguage()->sayNumber($word));
            } elseif ($this->existsVoiceFile(strtolower($word))){
                $spoken[] = $word;
            } else {
                $chopped = str_split($word);
                foreach($chopped as $part){
                    if($this->existsVoiceFile(strtolower($part))){
                        $spoken[] = $part;
                    }
                }
            }
        }
        PUTTS::getInstance()->getDataProvider()->setSpeech($spoken);
        return PUTTS::getInstance()->getDataProvider();
    }

    /**
     * Checks if a voice is compatible with the language
     *
     * @return bool
     */
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

    /**
     * Checks if a specific voice file exists
     *
     * @param $file
     * @return bool
     */
    public function existsVoiceFile($file){
        return file_exists($this->getDataFolder().$file.".wav");
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
    public function getDataFolder(){
        return $this->dataFolder."/";
    }

    /**
     * @return array
     */
    public function getDataFolderContents(){
        return scandir($this->dataFolder);
    }

} 