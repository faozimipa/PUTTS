<?php

class Wav extends DataProvider{

    /**
     * Creates a playable .wav file
     *
     * @param Voice $voice
     * @return string
     */
    public function getOutput(Voice $voice){
        $files = [];
        foreach($this->getSpeech() as $word){
            $files[] = $voice->getDataFolder().$word.".wav"; //Create a full path
        }
        return $this->joinwavs($files);
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
        foreach($wavs as $key => $wav){
            echo "Adding wav ".($key + 1)." of ".count($wavs)." (".round(($key + 1) / (count($wavs) / 100), 2)."%) \n";
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