<?php

class BrowserWav {

    private $speech;

    public function __construct(array $speech){
        $this->speech = $speech;
    }

    /**
     * @return array
     */
    public function getSpeechArray(){
        return $this->speech;
    }

    /**
     * @return string
     */
    public function getSpeechString(){
        return implode(" ", $this->speech);
    }

    /**
     * Creates direct Browser output
     *
     * @param Voice $voice
     */
    public function speak(Voice $voice){
        header("Content-Type: audio/x-wav");
        $files = [];
        foreach($this->getSpeechArray() as $word){
            $files[] = $voice->getDataFolder().$word.".wav"; //Create a full path
        }
        $data = $this->joinwavs($files);
        echo $data;
    }

    /**
     * This function is not mine. I'm just using it here.
     * If the original developer wants this removed, E-Mail
     * me, and I will remove it.
     *
     * @param $wavs
     * @return string
     */
    private function joinwavs($wavs){
        $fields = join('/',array( 'H8ChunkID', 'VChunkSize', 'H8Format',
            'H8Subchunk1ID', 'VSubchunk1Size',
            'vAudioFormat', 'vNumChannels', 'VSampleRate',
            'VByteRate', 'vBlockAlign', 'vBitsPerSample' ));
        $data = '';
        foreach($wavs as $wav){
            $fp     = fopen($wav,'rb');
            $header = fread($fp,36);
            $info   = unpack($fields,$header);
            // read optional extra stuff
            if($info['Subchunk1Size'] > 16){
                $header .= fread($fp,($info['Subchunk1Size']-16));
            }
            // read SubChunk2ID
            $header .= fread($fp,4);
            // read Subchunk2Size
            $size  = unpack('Vsize',fread($fp, 4));
            $size  = $size['size'];
            // read data
            $data .= fread($fp,$size);
        }
    return $header.pack('V',strlen($data)).$data;
}

} 