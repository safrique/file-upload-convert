# file-upload-convert
Technical Test - Telappliant application - PHP Full Stack Developer

# Test Instructions
The marketing department have a number of in-house applications that require customer data in
a range of different formats, specifically JSON, YAML and CSV. They have requested that
development produce a command line application that will take an untrusted input file and
convert it to another format.

They require the application to have the following features:

1. The application should be able to accept the input file from:
a. a local file path
b. an HTTP network location such as http://localhost/customers.json
2. The application should be able to read and write the following formats:
a. CSV
b. JSON
c. YAML
3. The application should be able to output to a file or to standard out

The application should be written in PHP, demonstrate object oriented design and be supported
by automated tests. You're welcome to install packages from composer but please don't use a
framework to complete the task.

An example CSV file has been attached with 100 correctly validated customer records. To test
the application we will also pass it some files where the data is not so clean.

There is no right or wrong answer for this task, we just want to see how you approach the
problem. Please supply your work as a zip or tarball archive along with a paragraph or two of
text to explain the decisions you made to complete the task.

# App Running Instructions
1. Extract the .zip archive contents to a location of your choice.
2. cd into the new root directory `file-upload-convert`.
3. Run `composer install` to download the required Composer packages.