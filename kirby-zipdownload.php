<?php
// -------------------------------------------
// kirby plugin
// Title:  ZipDownload
// function: This plugin provides basic capacity to select & download multiple image files as a zip.

// copyright: 2016 Joachim Robert <joachim.robert@gmail.com>
// license: https://creativecommons.org/licenses/by-sa/3.0/ CC BY-SA 3.0

// usage:
// see README.md

// version: 0.1 (14.08.2016)
// changelog:
//  O.1 : initial release. Nothing much to see yet.
// -------------------------------------------


# This, you can change :

# No File Selected error message
function zipdl_errormessage_noFileSelected() {
  # TODO : add support for multilang
  echo "Error : no file was selected :(";
}


# Until the end of the file, you might not want to change :

function zipdl_dl_url() {
  echo kirby()->urls()->index() . DS . 'download-zip'; // . basename(__DIR__) . '/download.php';
}

# Set the Download Button snippet
$kirby->set('snippet', 'zipdl_form_btn', __DIR__ . '/snippets/zipdl_form_btn.php');
# Set the Checkbox snippet
$kirby->set('snippet', 'zipdl_checkbox', __DIR__ . '/snippets/zipdl_checkbox.php');
# Set the Asset Gallery snippet
$kirby->set('snippet', 'asset_gallery', __DIR__ . '/snippets/asset_gallery.php');

# Set the /download route
# and define the main Zipping action
$kirby->set('route', array(
  'pattern' => 'download-zip',
  'method'  => 'POST',
  'action'  => function() {
    # get the POST values
    # $current_page = strval($_POST["current_page"]);
    # $selected_files = explode(',', $_POST["selection"]);
    $selected_files = array();
    foreach($_POST as $key => $value) {
      if ($key == "current_page") {
        $current_page = strval($value);
      } else if($value=="on") {
        # array_push($selected_files, strval(substr($key, 0, -4) . "." . substr($key, -3)));
        array_push($selected_files, strval(substr($key, 0, strrpos($key, '_')) . "." . substr($key, strrpos($key, '_')+1)));
      }
    }

    # set up an empty array
    $files = array();

    # loop through each file name
    foreach($selected_files as $selected_file){
      # check if the selected file exists as a file in the current page
      # so it doesn't get abused
      if($file = site()->page($current_page)->file($selected_file)) {
        # perhaps it would be best if a thumbnail of the image was called
        # but I don't know if I can get the root address of the thumbnail

        # fill up the main array with the root address of each image
        array_push($files, $file->root());
      }
    }

    # only do the zip if we HAVE files
    if (!empty($files)){

      # this part of the code was adapted from StackOverflow
      # http://stackoverflow.com/a/20216192
      # Thank you all! I owe you all a beer.

      # create new zip opbject
      $zip = new ZipArchive();

      # create a temp file & open it
      $tmp_file = tempnam( kirby()->roots()->index() . '/site/plugins/kirby-zipdownload/temp' ,'');
      $zip->open($tmp_file, ZipArchive::CREATE);

      # loop through each file
      foreach($files as $file){

          # download file
          $download_file = file_get_contents($file);

          #add it to the zip
          $zip->addFromString(basename($file),$download_file);

      }

      # close zip
      $zip->close();

      # send the file to the browser as a download
      header('Content-disposition: attachment; filename=download.zip');
      header('Content-type: application/zip');
      readfile($tmp_file);
    } else {
      # That's a call to the function displaying the error message.
      zipdl_errormessage_noFileSelected();
    }
    return false;
  }

));
