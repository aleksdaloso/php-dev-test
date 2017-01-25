<?php
require_once('./config/config.php');
/**
 * Created by PhpStorm.
 * User: aleksd
 * Date: 1/25/17
 * Time: 12:28 PM
 */

class App
{
    var $data_folder;
    var $text_file;

    public function __construct()
    {
        //check data folder existence
        $root_folder = $_SERVER['DOCUMENT_ROOT'];

        $this->data_folder = $root_folder.'/'.DATA_FOLDER;
        $this->text_file = $this->data_folder.'/'. TEXT_FILE_NAME;

        if(!file_exists($this->data_folder)) {
            mkdir($this->data_folder, 0777);
        }
    }

    /**
     * Save submitted data to a text file
     *
     * @param $data
     * @return bool
     */
    public function saveToFile($data) {
        try {
            $text_file = fopen($this->text_file,'a+') or die('Error: unable to open file!');
            $content = trim($data['inputName'])."|".trim($data['inputBirthday'])."\r\n";
            fwrite($text_file, $content);
            fclose();
            return true;
        } catch (Exception $e) {
            return false;
        }

    }

    /**
     * Generates XML file and allows user to download the file
     */
    public function exportData() {
        $xml = new DOMDocument();
        $xml->preserveWhiteSpace = false;
        $xml->formatOutput = true;
        $xml_community = $xml->createElement("community");

        $handle = fopen($this->text_file, "r") or die('No data found. Insert data first! Go <a href="/">back.</a>');
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $row = explode('|', $line);
                $xml_member = $xml->createElement("member");
                $xml_community->appendChild($xml_member);

                if(!empty($row[0])) {
                    $xml_name = $xml->createElement("name");
                    $xml_name->nodeValue = trim($row[0]);
                    $xml_member->appendChild($xml_name);
                }

                if(!empty($row[1])) {
                    $xml_birthday = $xml->createElement("birthday");
                    $xml_birthday->nodeValue = trim($row[1]);
                    $xml_member->appendChild($xml_birthday);
                }


            }

            fclose($handle);
        } else {
            // error opening the file.
        }

        $xml->appendChild( $xml_community );

        $xml->save($this->data_folder.'/'. XML_FILE_NAME);

        header('Content-type: text/xml');
        header('Content-Disposition: attachment; filename="data_export.xml"');

        echo file_get_contents($this->data_folder.'/'. XML_FILE_NAME);

    }

    /**
     * Validates the submitted data
     *
     * @param $data
     * @return bool|string
     */
    public function validate($data) {
        $valid = true;
        $error = array();
        if(empty($data['inputName'])) {
            $error[] = "Name field cannot be empty.";
        } else {
            if(!preg_match('/^[A-Za-z0-9_]+$/', $data['inputName'])) {
                $error[] = "Name field accepts alphanumeric characters only.";
            }
        }

        if(empty($data['inputBirthday'])){
            $error[] = "Birthday field cannot be empty.";
        } else {
            $date = DateTime::createFromFormat('m-d-Y', $data['inputBirthday']);
            if (!$date) {
               $error[] = "Invalid birthday format. Should be mm-dd-yyyy(eg: 04-28-1993)";
            }
        }

        if(!empty($error)) {
            return implode('<br>',$error);
        }

        return $valid;
    }
}