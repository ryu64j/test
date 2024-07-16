<?php
  date_default_timezone_set('Asia/Taipei');
  $link = '';

  if ($_FILES) {
    $total = count($_FILES['pictures']['name']);

    for( $i=0 ; $i < $total ; $i++ ) {
      //Get the temp file path
      $tmpFilePath = $_FILES['pictures']['tmp_name'][$i];

      //Make sure we have a file path
      if ($tmpFilePath != ""){
        //Setup our new file path
        $fileType = explode('/', $_FILES['pictures']['type'][$i]);
        $newFilePath = "img/" . date('YmdHis') . '_' . $i . '.' . end($fileType);

        //Upload the file into the temp dir
        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
          $link .= '<a href="/' . $newFilePath . '">' . $newFilePath . '</a><br/>';
        }
      }
    }
  }
?>
<title>Screenshot Uploader</title>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
  </head>
<body>
  <div class="container-fluid">
  <h1 class="text-center">Screenshot Uploader</h1>
  <div class="col col-sm-12 col-lg-4 mr-auto ml-auto border p-4">
    <form method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label><strong>Upload Files</strong></label>
        <div class="custom-file">
          <input type="file" name="pictures[]" accept="image/*" multiple class="custom-file-input" id="customFile">
          <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
      </div>
      <div class="form-group">
        <input type="submit" name="upload" value="Upload" id="upload" class="btn btn-block btn-dark"><i class="fa fa-fw fa-upload"></i>
      </div>
    </form>
    <span class="text-center"><a href="/img" target="_blank">Find your images here.</a></span>
    </br>
    <span class="text-center"><?php if (isset($link)) { echo $link; } ?></span>
  </div>
</body>
<script>
  $(document).ready(function() {
    $('input[type="file"]').on("change", function() {
      let filenames = [];
      let files = document.getElementById("customFile").files;
      if (files.length > 1) {
        filenames.push("Total Files (" + files.length + ")");
      } else {
        for (let i in files) {
          if (files.hasOwnProperty(i)) {
            filenames.push(files[i].name);
          }
        }
      }
      $(this)
        .next(".custom-file-label")
        .html(filenames.join(","));
    });
  });
</script>
