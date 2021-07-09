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
        // give it no permission
        chmod($file_path, 0777);

        $fp = fopen('./documents/' . $filename . '.csv', 'w');
        // check its permission .
        chmod('./documents/' . $filename . '.csv', 0777);

        echo "this is my coming from a library " . $file_path;

        echo "<br/><br/><br> this is from anotherp parser";

        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile($file_path);

        $text = $pdf->getText();
        // echo $text;
        $remove = "\n";
        $split = explode($remove, $text);

        $array[] = null;
        $tab = "\t";

        foreach ($split as $string) {
            $row = explode($tab, $string);
            array_push($array, $row);
        }
        echo "<pre>";
        print_r($array);
        echo "</pre>";

        echo "<br/><br/><br> this is from anotherp parser";

        // Retrieve all pages from the pdf file.
        // $pages = $pdf->getPages();

        // Loop over each page to extract text.
        // foreach ($pages as $page) {
        //     echo $page->getText();
        //     fputcsv($fp, $page->getText());

        // }

        // echo "<br/><br/><br> this is from anotherp parser";

        // Retrieve all details from the pdf file.
        // $details = $pdf->getDetails();

        // // Loop over each property to extract values (string or array).
        // foreach ($details as $property => $value) {
        //     if (is_array($value)) {
        //         $value = implode(', ', $value);
        //     }
        //     echo $property . ' => ' . $value . "\n";
        // }

        foreach ($array as $line) {
            if (empty($line)) {
                continue;
            }

            fputcsv($fp, $line);
        }
        fclose($fp);

    }

}
