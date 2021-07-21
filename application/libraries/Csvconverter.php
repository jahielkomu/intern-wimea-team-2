<?php

//Creating csv Converter
/*
1. library name should start with capital letter
2. Class name should start with capital letter
3. Class name and file name should match

 */

class CsvConverter
{

    public function convert($file_path, $filename)
    {

        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile($file_path);



        // // give it no permission
        chmod($file_path, 0777);

        $fp = fopen('./documents/' . $filename . '.csv', 'w');
        // check its permission .
        chmod('./documents/' . $filename . '.csv', 0777);
        echo "This text shall be convert to a csv <br/><br/>";

        // Retrieve all pages from the pdf file.
        $pages = $pdf->getPages();

        if ($pdf != "") {

            foreach ($pages as $page) {
                $original_text = $page->getText();

                $remove = "\n";

                $split = explode($remove, $original_text);
                $array[] = null;
                $tab = "\t";

                foreach ($split as $string) {

                    // $string = $this->format_data($string);

                    $row = explode($tab, $string);
                    array_push($array, $row);
                }

                //Loop over each array to extract text.

                foreach ($array as $line) {
                    if (empty($line)) {
                        continue;
                    }
                    $line =explode('\n',implode(',',explode(' ',implode('\n',$line))));
                    fputcsv($fp, $line, $delimiter = ',', $enclosure = ' ', $escape_char = "\\");

                }

            }
            echo " <br/><br/> Check under documents to see the csv file";
            fclose($fp);

        } else {
            echo "No text extracted from PDF.";
        }

// Common functions

    }
    public function format_data($original_text)
    {
        $text = nl2br($original_text); // Paragraphs and line break formatting
        $text = $this->clean_ascii_characters($text); // Check special characters
        // $text = str_replace(array("<br /> <br /> <br />", "<br> <br> <br>"), "<br /> <br />", $text); // Optional
        $text = addslashes($text); // Backslashes for single quotes
        $text = stripslashes($text);
        $text = strip_tags($text);

        /**********************************************/
        /* Additional step to check formatting issues */
        // There may be some PDF formatting issues. I'm trying to check if the words are:
        // (a) Join. E.g., HelloWorld!Thereisnospacingbetweenwords
        // (b) splitted. E.g., H e l l o W o r l d ! E x c e s s i v e s p a c i n g
        $check_text = preg_split('/\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);

        $no_spacing_error = 0;
        $excessive_spacing_error = 0;
        foreach ($check_text as $word_key => $word) {
            if (strlen($word) >= 60) { // 60 is a limit that I set for a word length, assuming that no word would be 60 length long
                $no_spacing_error++;
            } else if (strlen($word) == 1) { // To check if the word is 1 word length
                if (preg_match('/^[A-Za-z]+$/', $word)) { // Only consider alphabetical words and ignore numbers.
                    $excessive_spacing_error++;
                }
            }
        }

        // Set the boundaries of errors you can accept
        // E.g., we reject the change if there are 60 or more $no_spacing_error or 150 or more $excessive_spacing_error issues
        if ($no_spacing_error >= 60 || $excessive_spacing_error >= 150) {
            // echo "Too many formatting issues<br />";
            return null;
        } else {
            // echo "Success!<br />";
            return $text;
        }
    }
    public function clean_ascii_characters($string)
    {
        $string = str_replace(array('-', '–'), '-', $string);
        $string = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $string);
        // $string = preg_replace('/(?<!\ )[A-Z]/', ' $0', $string);

        return $string;
    }

}
