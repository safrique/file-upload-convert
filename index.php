<?php

echo "<h1>Start of project</h1>";

$files = [
    "./resources/sample-files/webdictionary.txt",
    "./resources/sample-files/customers.csv",
];

$accepted_ext = ["csv", "json", "yaml"];

foreach ($files as $filename) {
    echo "<h2>Reading file $filename</h2>";

    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    echo "<h3>File extension: $ext</h3>";

    if (!in_array($ext, $accepted_ext)) {
        echo "<strong>File type not accepted</strong><br>";
        continue;
    }

    $file = fopen($filename, "r") or die("Unable to open file!");

    if (strtolower($ext) == "csv") {
        $csv = array_map('str_getcsv', file($filename));
        array_walk($csv, function (&$a) use ($csv) {
            $a = array_combine($csv[0], $a);
        });
        array_shift($csv);
        print_r($csv);
    }

    fclose($file);
}
