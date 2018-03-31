<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>DoxBin</title>
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
<meta name="viewport" content="width=device-width, initial-scale=1">    
    <link rel="stylesheet" href="css/normalize.css">

    
        <link rel="stylesheet" href="css/style.css">

    
    
    
  </head>

  <body>

    <div class="form">
      
      <ul class="tab-group">
        <li class="tab active"><a href="#upload">Upload</a></li>
        <li class="tab"><a href="#files">File Types</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="upload">   
          <h1>Doxbin</h1>
          

          <?php
                    // ENTER YOUR ONION NAME AS FULL PATH WITH TRAILING /
		     $full_path = "http://YOUR-ONION-HERE.onion/";
                     $number_of_uploads = 1;
                     $allowed_file_types = array("rar", "mp3", "psd", "zip", "html", "csv", "sql", "txt", "pdf", "jpg", "png", "jpeg", "gif", "css", "js", "mp4", "ico");
                     $upload_folder = "./file/";
                     $max_size_in_kb = 90024;
                     $rename_files = 1;
                     function printForm()
                     {
                     global $allowed_file_types,$number_of_uploads,$max_size_in_kb;
                     
                     print "<form action=\"". htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES) ."\" method=\"post\" enctype=\"multipart/form-data\">\n";
                     
                         for($i=0;$i<$number_of_uploads;$i++)
                         {
                         print "<p><input class=\"responsetext\" type=\"file\" name=\"file[]\" /></p>\n";
                         }
                     
                     print "<p><input type=\"hidden\" name=\"upload\" value=\"1\" /><input type=\"submit\" value=\"Upload\" /></p>\n</form>\n";
                     
                     }
                     
                     $fileNAMES = array();
                     
                     if(isset($_POST['upload']))
                     {
                         for($i=0;$i<$number_of_uploads;$i++)
                         {
                             if(strlen($_FILES['file']['name'][$i]) > 0)
                             {
                             $filearray = explode(".", $_FILES['file']['name'][$i]);
                             $ext = end($filearray);
                     
                                 if($rename_files == 1)
                                 {
                                 list($usec, $sec) = explode(" ", microtime());
                                 $fileNAMES[$i] = $sec."_".$usec;
                                 }
                                 else
                                 {
                                 $xperiods = str_replace("." . $ext, "", $_FILES['file']['name'][$i]);
                                 $fileNAMES[$i] = str_replace(".", "", $xperiods);
                                 }
                     
                                 if(!in_array(strtolower($ext), $allowed_file_types))
                                 {
                                 print "<p class=\"error\"><strong>Disallowed Extension</strong><br /> ". htmlspecialchars($_FILES['file']['name'][$i]) ."<br />ERROR: File type not allowed.</p>\n";
                                 }
                                 elseif($_FILES['file']['size'][$i] > ($max_size_in_kb*1024))
                                 {
                                 print "<p class=\"error\"><strong>File Too Big</strong><br /> ". htmlspecialchars($_FILES['file']['name'][$i]) ."<br />ERROR: File size to large.</p>\n";
                                 }
                                 elseif(file_exists($upload_folder.$fileNAMES[$i] .".". $ext))
                                 {
                                 print "<p class=\"error\"><strong>File Exists</strong><br /> ". htmlspecialchars($fileNAMES[$i]) .".". $ext ."<br />ERROR: File already exists.</p>\n";
                                 }
                                 else
                                 {
                                     if(move_uploaded_file($_FILES['file']['tmp_name'][$i], $upload_folder.$fileNAMES[$i] .".". $ext))
                                     {
                                     print '<input class="responsetext" style="width: 100%;float: center;" value="' . $full_path . 'file/' . htmlspecialchars($fileNAMES[$i]) .'.'. $ext .'"></p>';
                                     }
                                     else
                                     {
                                     print "<p class=\"error\"><strong>Error</strong><br /> ". htmlspecialchars($_FILES['file']['name'][$i]) ."<br />ERROR: Undetermined.</p>\n";
                                     }
                                 }
                             }
                         }
                     printForm();
                     }
                     else
                     {
                     printForm();
                     }
                     
                     ?>
          </div>
        <div id="files">   
          <h1><font color="#8D3A37"><strong>.</strong></font><font color="#ccc">zip</font></h1>
		  <h1><font color="#8D3A37"><strong>.</strong></font><font color="#ccc">rar</font></h1>
		  <h1><font color="#8D3A37"><strong>.</strong></font><font color="#ccc">mp3</font></h1>
		  <h1><font color="#8D3A37"><strong>.</strong></font><font color="#ccc">psd</font></h1>
		  <h1><font color="#8D3A37"><strong>.</strong></font><font color="#ccc">html</font></h1>
		  <h1><font color="#8D3A37"><strong>.</strong></font><font color="#ccc">txt</font></h1>
		  <h1><font color="#8D3A37"><strong>.</strong></font><font color="#ccc">pdf</font></h1>
		  <h1><font color="#8D3A37"><strong>.</strong></font><font color="#ccc">jpg</font></h1>
		  <h1><font color="#8D3A37"><strong>.</strong></font><font color="#ccc">png</font></h1>
		  <h1><font color="#8D3A37"><strong>.</strong></font><font color="#ccc">jpeg</font></h1>
		  <h1><font color="#8D3A37"><strong>.</strong></font><font color="#ccc">gif</font></h1>
		  <h1><font color="#8D3A37"><strong>.</strong></font><font color="#ccc">css</font></h1>
		  <h1><font color="#8D3A37"><strong>.</strong></font><font color="#ccc">js</font></h1>
                  <h1><font color="#8D3A37"><strong>.</strong></font><font color="#ccc">ico</font></h1>
                  <h1><font color="#8D3A37"><strong>.</strong></font><font color="#ccc">sql</font></h1>
                  <h1><font color="#8D3A37"><strong>.</strong></font><font color="#ccc">csv</font></h1>
        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
// ADD YOUR ONION HERE IF YOU WISH NOT NEEDED FOR TOR
        <script src="https://your.domain.com/js/index.js"></script>

    
    
    
  </body>
</html>
