<?php
function removerCaracter($string) {
    @$string = preg_replace("[áàâãª]", "a", $string);
    @$string = preg_replace("[ÁÀÂÃ]", "A", $string);
    @$string = preg_replace("[éèê]", "e", $string);
    @$string = preg_replace("[ÉÈÊ]", "E", $string);
    @$string = preg_replace("[íì]", "i", $string);
    @$string = preg_replace("[ÍÌ]", "I", $string);
    @$string = preg_replace("[óòôõº]", "o", $string);
    @$string = preg_replace("[ÓÒÔÕ]", "O", $string);
    @$string = preg_replace("[úùû]", "u", $string);
    @$string = preg_replace("[ÚÙÛ]", "U", $string);
    @$string = preg_replace("ç", "c", $string);
    @$string = preg_replace("Ç", "C", $string);
    @$string = preg_replace("[][><}{)(:;,!?*%~^`&#@]", "", $string);
    @$string = preg_replace(" ", "_", $string);
    
    return $string;
}
