# file-upload-convert
Technical Test - Telappliant application - PHP Full Stack Developer

## Test Instructions
The marketing department have a number of in-house applications that require customer data in
a range of different formats, specifically JSON, YAML and CSV. They have requested that
development produce a command line application that will take an untrusted input file and
convert it to another format.

They require the application to have the following features:

1. The application should be able to accept the input file from:
    1. a local file path
    2. an HTTP network location such as http://localhost/customers.json
2. The application should be able to read and write the following formats:
    1. CSV
    2. JSON
    3. YAML
3. The application should be able to output to a file or to standard out

The application should be written in PHP, demonstrate object oriented design and be supported
by automated tests. You're welcome to install packages from composer but please don't use a
framework to complete the task.

An example CSV file has been attached with 100 correctly validated customer records. To test
the application we will also pass it some files where the data is not so clean.

There is no right or wrong answer for this task, we just want to see how you approach the
problem. Please supply your work as a zip or tarball archive along with a paragraph or two of
text to explain the decisions you made to complete the task.

## App Running Instructions
1. Extract the .zip archive contents to a location of your choice.
2. cd into the new root directory `file-upload-convert`.
3. Run `composer install` to download the required Composer packages.
4. Run the command `./upload-file ConvertFile` with the following parameters:
    1. `FileLocation` - REQUIRED (string) - indicates where the upload file is to be found;
    2. `NewFileType` - REQUIRED (string) - the file type to convert the file to;
    3. `SaveOrDisplay` - OPTIONAL (boolean - true for save - default false) - whether the file should be saved or
     displayed;
    4. `SaveLocation` - REQUIRED if SaveOrDisplay is true (string) - the location where the new file is to be saved.
5. To run tests run the command `vendor/bin/phpunit` inside the root directory.
6. Exceptions have intentionally been designed and kept as is in order to show the relevant error with details when
 the command is not called correctly or if the input file does not exist.
 
 ## Considerations
 I chose to build the application in the way I did to enable me to add further functionality if required. To achieve
  this I added separate namespaces for the CLI commands as well as services required. I also included interfaces in
   order to bind the contracts to methods required for successful operation of the application.
   
To handle the CLI commands, I used the Symfony Console Command package from Composer as this gave me the
    functionality required
    in an easy to use package which has good support. For consistency I also used the Symfony Yaml package.
    
For automated testing I used PHPUnit, which is the industry accepted standard for automated PHP unit testing. 