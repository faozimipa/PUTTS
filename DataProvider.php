<?php

abstract class DataProvider {

    private $speech;

    /**
     * Sets the speech
     * @param array $speech
     */
    public function setSpeech(array $speech){
        $this->speech = $speech;
    }

    /**
     * Gets the speech
     * @return array
     */
    public function getSpeech(){
        return $this->speech;
    }

    /**
     * Gets the speech as a string
     * @return string
     */
    public function getSpeechString(){
        return implode(" ", $this->speech);
    }

    /**
     * Gets the generated output
     * @param Voice $voice
     * @return mixed
     */
    public abstract function getOutput(Voice $voice);

} 