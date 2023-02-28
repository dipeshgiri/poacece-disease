<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Poacece</title>
    <link rel="stylesheet" href="/css/style.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
  </head>
  <body>
    <form action="/uploadfile" method="post" enctype="multipart/form-data">
      @csrf
    <div class="container">
      <div class="wrapper">
        <div class="image">
          <img src="" />
        </div>
        <div class="content">
          <div class="icon">
            <i class="fas fa-cloud-upload-alt"></i>
          </div>
          <div class="text">No file chosen, yet!</div>
        </div>
        <div id="cancel-btn">
          <i class="fas fa-times"></i>
        </div>
        <div class="file-name">File name here</div>
      </div>
      <input type="button" value="Upload a File" onclick="defaultBtnActive()" id="custom-btn">
      <input id="default-btn" type="file" name="filename" hidden />
      <button type="submit" onclick="submit()" id="custom-btn" name="upload">Submit</button>
    </div>
    <script src="js/script.js"></script>
</form>
  </body>
</html>
