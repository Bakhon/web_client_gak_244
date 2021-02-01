<?php
function rtf_isPlainText($s) {
    $arrfailAt = array("*", "fonttbl", "colortbl", "datastore", "themedata");
    for ($i = 0; $i < count($arrfailAt); $i++)
        if (!empty($s[$arrfailAt[$i]])) return false;
    return true;
} 

function rtf2text($text) {
    // Read the data from the input file.
    //$text = file_get_contents($filename);
    if (!strlen($text))
        return "";

    // Create empty stack array.
    $document = "";
    $stack = array();
    $j = -1;
    // Read the data character-by- character…
    for ($i = 0, $len = strlen($text); $i < $len; $i++) {
        $c = $text[$i];

        // Depending on current character select the further actions.
        switch ($c) {
            // the most important key word backslash
            case "\\":
                // read next character
                $nc = $text[$i + 1];

                // If it is another backslash or nonbreaking space or hyphen,
                // then the character is plain text and add it to the output stream.
                if ($nc == '\\' && rtf_isPlainText($stack[$j])) $document .= '\\';
                elseif ($nc == '~' && rtf_isPlainText($stack[$j])) $document .= ' ';
                elseif ($nc == '_' && rtf_isPlainText($stack[$j])) $document .= '-';
                // If it is an asterisk mark, add it to the stack.
                elseif ($nc == '*') $stack[$j]["*"] = true;
                // If it is a single quote, read next two characters that are the hexadecimal notation
                // of a character we should add to the output stream.
                elseif ($nc == "'") {
                    $hex = substr($text, $i + 2, 2);
                    if (rtf_isPlainText($stack[$j]))
                        $document .= html_entity_decode("&#".hexdec($hex).";");
                    //Shift the pointer.
                    $i += 2;
                // Since, we’ve found the alphabetic character, the next characters are control word
                // and, possibly, some digit parameter.
                } elseif ($nc >= 'a' && $nc <= 'z' || $nc >= 'A' && $nc <= 'Z') {
                    $word = "";
                    $param = null;

                    // Start reading characters after the backslash.
                    for ($k = $i + 1, $m = 0; $k < strlen($text); $k++, $m++) {
                        $nc = $text[$k];
                        // If the current character is a letter and there were no digits before it,
                        // then we’re still reading the control word. If there were digits, we should stop
                        // since we reach the end of the control word.
                        if ($nc >= 'a' && $nc <= 'z' || $nc >= 'A' && $nc <= 'Z') {
                            if (empty($param))
                                $word .= $nc;
                            else
                                break;
                        // If it is a digit, store the parameter.
                        } elseif ($nc >= '0' && $nc <= '9')
                            $param .= $nc;
                        // Since minus sign may occur only before a digit parameter, check whether
                        // $param is empty. Otherwise, we reach the end of the control word.
                        elseif ($nc == '-') {
                            if (empty($param))
                                $param .= $nc;
                            else
                                break;
                        } else
                            break;
                    }
                    // Shift the pointer on the number of read characters.
                    $i += $m - 1;

                    // Start analyzing what we’ve read. We are interested mostly in control words.
                    $toText = "";
                    switch (strtolower($word)) {
                        // If the control word is "u", then its parameter is the decimal notation of the
                        // Unicode character that should be added to the output stream.
                        // We need to check whether the stack contains \ucN control word. If it does,
                        // we should remove the N characters from the output stream.
                        case "u":
                            $toText .= html_entity_decode("&#x".dechex($param).";");
                            $ucDelta = @$stack[$j]["uc"];
                            if ($ucDelta > 0)
                                $i += $ucDelta;
                        break;
                        // Select line feeds, spaces and tabs.
                        case "par": case "page": case "column": case "line": case "lbr":
                            $toText .= "\n"; 
                        break;
                        case "emspace": case "enspace": case "qmspace":
                            $toText .= " "; 
                        break;
                        case "tab": $toText .= "\t"; break;
                        // Add current date and time instead of corresponding labels.
                        case "chdate": $toText .= date("m.d.Y"); break;
                        case "chdpl": $toText .= date("l, j F Y"); break;
                        case "chdpa": $toText .= date("D, j M Y"); break;
                        case "chtime": $toText .= date("H:i:s"); break;
                        // Replace some reserved characters to their html analogs.
                        case "emdash": $toText .= html_entity_decode("&mdash;"); break;
                        case "endash": $toText .= html_entity_decode("&ndash;"); break;
                        case "bullet": $toText .= html_entity_decode("&#149;"); break;
                        case "lquote": $toText .= html_entity_decode("&lsquo;"); break;
                        case "rquote": $toText .= html_entity_decode("&rsquo;"); break;
                        case "ldblquote": $toText .= html_entity_decode("&laquo;"); break;
                        case "rdblquote": $toText .= html_entity_decode("&raquo;"); break;
                        // Add all other to the control words stack. If a control word
                        // does not include parameters, set &param to true.
                        default:
                            $stack[$j][strtolower($word)] = empty($param) ? true : $param;
                        break;
                    }
                    // Add data to the output stream if required.
                    if (rtf_isPlainText($stack[$j]))
                        $document .= $toText;
                }

                $i++;
            break;
            // If we read the opening brace {, then new subgroup starts and we add
            // new array stack element and write the data from previous stack element to it.
            case "{":
                array_push($stack, $stack[$j++]);
            break;
            // If we read the closing brace }, then we reach the end of subgroup and should remove 
            // the last stack element.
            case "}":
                array_pop($stack);
                $j--;
            break;
            // Skip “trash”.
            case '\0': case '\r': case '\f': case '\n': break;
            // Add other data to the output stream if required.
            default:
                if (rtf_isPlainText($stack[$j]))
                    $document .= $c;
            break;
        }
    }
    // Return result.
    return $document;
}

    //require_once  __DIR__."/../application/config.php";
    //require_once  __DIR__."/../application/units/other.php";
    //require_once  __DIR__."/../application/units/database3.php";
    $db = new DB3();
    $q = $db->Select("select * from frx_reports where id = 20");
    
    $xml_text = $q[0]['XML_TEXT'];
    
    $xml = simplexml_load_string($xml_text);
    
    /*
    echo '<textarea>';
    print_r($xml);
    echo '</textarea>';
    */
    //<textarea cols="30" rows="30" wrap="virtual" maxlength="100"></textarea>
    
    $page = $xml->TfrxReportPage[0];
    $data = $page->TfrxRichView['PropData'][0];
    
    //$px = round(strlen($data) / 2);
    $str = '';
        
    for ($i=0; $i < strlen($data)-1; $i+=2){
      $d1 = substr($data, $i, 1);
      $d2 = substr($data, $i+1, 1);              
      $str .= chr(hexdec($d1.$d2));
    }
    
    //$keywords = iconv('ASCII', 'UTF-8//IGNORE', $str);
    $keywords = $str;
    echo $keywords;
    echo '<br />---------------------------------------------------------------<br />';
    
    
    //$keywords = str_replace('{', "{\r\t\n", $keywords);
    //$keywords = str_replace('}', "}\r\t\n", $keywords);
    //$keywords = str_replace("RichEdit", '', $keywords);
    //$keywords = str_replace("S'", '', $keywords);
    
    //echo '<textarea style="width: 100%; height: 450px;">';    
    $text = rtf2text($keywords);
    $text = $text = mb_convert_encoding($text, 'ISO-8859-1', 'UTF-8');
    //$text = iconv('ASCII', 'cp1251', $text);
    //$text = mb_convert_encoding($text, "cp1251");
    //echo '<br>---------------------------------------------<br>';
    //$text = iconv('ISO-8859-1', 'Windows-1251', $text);
    //$text = mb_convert_encoding($text, 'ASCII');
    //$text = mb_convert_encoding($text, 'WINDOWS-1251', 'ASCII');
    //$text = iconv('ASCII', 'cp1251', $text);
    /*
    echo '<br>-----------------------CP1251----------------------<br>';
    $text = mb_convert_encoding($text, "CP1251");
    echo mb_convert_encoding($text, "CP1251");    
    echo '<br>-------------------------------------------------<br>';
    
    //echo mb_convert_encoding($text, "CP1251");
    
    echo '<br>-----------------------ISO-8859-9----------------------<br>';
    echo mb_convert_encoding($text, "ISO-8859-9");
    echo '<br>-------------------------------------------------<br>';
    
    echo '<br>-----------------------UTF-8----------------------<br>';
    echo mb_convert_encoding($text, "UTF-8");
    echo '<br>-------------------------------------------------<br>';
    */
    echo $text;
    //echo mb_detect_encoding($text);
    
    //echo '</textarea>';
    
     
    
    //echo chr(ord("\e5")+10);
    
    
    
    /*
    
    echo '<pre>';
    print_r($page->TfrxRichView['PropData'][0]);            
    echo '</pre>';
    */        
    exit;    
?>