<?php
class DropboxV2Client
{
   private $token;
   public function __construct($OAUTH2_ACCESS_TOKEN)
   {
     $this->$token = "Bearer " . $OAUTH2_ACCESS_TOKEN;
   }
   public function createFolder($path)
   {
    /*
    try {

      URL url = new URL("https://api.dropboxapi.com/2/files/create_folder");
      HttpURLConnection conn = (HttpURLConnection) url.openConnection();
      String parameters = "{\"path\": \"" + path + "\"}";

      conn.setRequestProperty("Content-Type", "application/json");
      conn.addRequestProperty ("Authorization", token);
      conn.setRequestMethod("POST");


      conn.setDoOutput(true);

      DataOutputStream writer = new DataOutputStream(conn.getOutputStream());
      writer.writeBytes(parameters);
      writer.flush();

      if (writer != null)
          writer.close();

      if (conn.getResponseCode() != 200) {
          System.out.println(conn.getResponseMessage());
          throw new RuntimeException("Failed : HTTP error code : "
                  + conn.getResponseCode());
      }

      BufferedReader br = new BufferedReader(new InputStreamReader(
          (conn.getInputStream())));

      String output;
      System.out.println("Output from Server .... \n");
      while ((output = br.readLine()) != null) {
          System.out.println(output);
      }

      conn.disconnect();

    } catch (MalformedURLException e) {

      e.printStackTrace();

    } catch (IOException e) {

      e.printStackTrace();

    }

     */
   }
   public function delete($path)
   {
     /*
     try {

       URL url = new URL("https://api.dropboxapi.com/2/files/delete_v2");
       HttpURLConnection conn = (HttpURLConnection) url.openConnection();
       String parameters = "{\"path\": \"" + path + "\"}";

       conn.setRequestProperty("Accept", "application/json");
       conn.addRequestProperty ("Authorization", token);
       conn.setRequestMethod("POST");
       conn.setRequestProperty("Content-Type", "application/json");

       conn.setDoOutput(true);

       DataOutputStream writer = new DataOutputStream(conn.getOutputStream());
       writer.writeBytes(parameters);
       writer.flush();

       if (writer != null)
           writer.close();

       if (conn.getResponseCode() != 200) {
           System.out.println(conn.getResponseMessage());
           throw new RuntimeException("Failed : HTTP error code : "
                   + conn.getResponseCode());
       }

       BufferedReader br = new BufferedReader(new InputStreamReader(
           (conn.getInputStream())));

       String output;
       System.out.println("Output from Server .... \n");
       while ((output = br.readLine()) != null) {
           System.out.println(output);
       }

       conn.disconnect();

     } catch (MalformedURLException e) {

       e.printStackTrace();

     } catch (IOException e) {

       e.printStackTrace();

     }
      */
   }
   public function getFile($foldername)
   {
     /*
     try {

       URL url = new URL("https://content.dropboxapi.com/2/files/download");
       HttpURLConnection conn = (HttpURLConnection) url.openConnection();
       String parameters = "{\"path\": \"" + foldername + "\"}";

       conn.addRequestProperty ("Authorization", token);
       conn.addRequestProperty ("Dropbox-API-Arg", parameters);
       conn.setDoOutput(true);

       if (conn.getResponseCode() != 200) {
           System.out.println(conn.getResponseMessage());
           throw new RuntimeException("Failed : HTTP error code : "
                   + conn.getResponseCode());
       }

       BufferedReader br = new BufferedReader(new InputStreamReader(
           (conn.getInputStream())));

       String output;
       System.out.println("Output from Server .... \n");
       while ((output = br.readLine()) != null) {
           System.out.println(output);
       }

       conn.disconnect();

     } catch (MalformedURLException e) {

       e.printStackTrace();

     } catch (IOException e) {

       e.printStackTrace();

     }
      */
   }
   public function listFolder($foldername)
   {
     /*

           try {

             URL url = new URL("https://api.dropboxapi.com/2/files/list_folder");
             HttpURLConnection conn = (HttpURLConnection) url.openConnection();
             String parameters = "{\"path\": \"" + foldername + "\",\"recursive\": false,\"include_media_info\": false,\"include_deleted\": false,\"include_has_explicit_shared_members\": false}";

             conn.setRequestProperty("Accept", "application/json");
             conn.addRequestProperty ("Authorization", token);
             conn.setRequestMethod("POST");
             conn.setRequestProperty("Content-Type", "application/json");

             conn.setDoOutput(true);

             DataOutputStream writer = new DataOutputStream(conn.getOutputStream());
             writer.writeBytes(parameters);
             writer.flush();

             if (writer != null)
                 writer.close();

             if (conn.getResponseCode() != 200) {
                 System.out.println(conn.getResponseMessage());
                 throw new RuntimeException("Failed : HTTP error code : "
                         + conn.getResponseCode());
             }

             BufferedReader br = new BufferedReader(new InputStreamReader(
                 (conn.getInputStream())));

             String output;
             System.out.println("Output from Server .... \n");
             while ((output = br.readLine()) != null) {
                 System.out.println(output);
             }

             conn.disconnect();

           } catch (MalformedURLException e) {

             e.printStackTrace();

           } catch (IOException e) {

             e.printStackTrace();

           }

      */
   }
   // Return TRUE if the file was uploaded properly.
   public function putFile($dropboxpath,$local_path)
   {
      $url = "https://content.dropboxapi.com/2/files/upload";
      $header = array(
         "Authorization: ".$this->$token,
         "Content-Length: ".filesize($local_path),
         "Content-Type: application/octet-stream",
         "Dropbox-API-Arg: {\"path\": \"$dropboxpath\",\"mute\": false}"
         );

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

      $fh_res = fopen($local_path, 'rb');
      $file_data = fread($fh_res, filesize($local_path));
      rewind($fh_res);

      curl_setopt($ch, CURLOPT_INFILE, $fh_res);
      curl_setopt($ch, CURLOPT_INFILESIZE, filesize($local_path));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

      $curl_response_res = curl_exec ($ch);

      //echo $curl_response_res; // Server response
      //print_r(curl_getinfo($ch)); // Http Response
      $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);

      curl_close($ch);
      fclose($fh_res);

      return (200 === intval($http_code));
   }
  /*
    public static void main(String[] args) throws Exception {
        DBClientService dbcs = new DBClientService();
        String folderName = "/test_createFolder" + System.currentTimeMillis();
        String newFolderName = folderName + "/NewFolder";
        dbcs.createFolder(folderName);
        dbcs.listFolder("");
        dbcs.delete(folderName);
        dbcs.putFile("/test_createFolder/skills.txt", "C:/Users/IBM_ADMIN/Desktop/skills.txt");
        dbcs.getFile("/test_createFolder/skills.txt");
    }
  */

  // ^Dropbox ReST API v2 to create folder, list folder, get, put and delete file using Java^

  function traverse_files($root)
  {
    foreach(new DirectoryIterator($root) as $fileInfo)
    {
        if($fileInfo->isDir() && (!$fileInfo->isDot()))
        {
          // Compare with dropbox eqvuvelent
        }
    }
  }
}
?>
<?php
if (/*API KEY length + API KEY must be valid & must be a api that is connected with "peter's" Dropbox so no one else can steal and download the files to their  */) {
    // Allowing to press the buttons to sync to dropbox
  } else {
    // Button's continue to be locked
  }
 ?>
<?php
  // Percentage that determinds how much is left of sync.
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>DropboxV2Client</title>
  </head>
  <body>

        <!--
        Loader with percentage for sync progress.
      -->

          <script type="text/javascript">

              function play(id)
              {
                // alert("id="+id);
                var audio1 = document.getElementById("sync");
                var audio2 = document.getElementById("syncHome");
                var audio3 = document.getElementById("bothSync");

                if (id == "sync")
                {
                  audio2.pause();
                  audio3.pause();
                  audio1.play();
                  audio2.currentTime = 0;
                  audio3.currentTime = 0;

                }
                else if (id == "syncHome")
                {
                  audio1.pause();
                  audio3.pause();
                  audio2.play();
                  audio3.currentTime = 0;
                  audio1.currentTime = 0;

                }
                else if (id == "bothSync")
                {
                  audio1.pause();
                  audio2.pause();
                  audio3.play();
                  audio2.currentTime = 0;
                  audio1.currentTime = 0;

                }
                else
                {
                  audio1.pause();
                  audio2.pause();
                  audio3.pause();
                  audio2.currentTime = 0;
                  audio1.currentTime = 0;
                  audio3.currentTime = 0;
                }
              }
          </script>

        <audio id="sync" src="EM.mp3" loop >

        </audio>
        <audio id="syncHome" src="EM.mp3" loop >

        </audio>
        <audio id="bothSync" src="EM.mp3" loop >

        </audio>

        <center>
        <input type="password" name="password input">
        <br>
          <button class="button" type="button" id="sync" name="sync" onclick="play('sync')">Sync with dopbox</button>
          <button class="button" type="button" id="syncHome" name="syncHome" onclick="play('syncHome')">Sync Home</button>
          <button class="button" type="button" id="bothSync" name="bothSync" onclick="play('bothSync')">Both</button>
          <div id="container"></div>
       </center>
  </body>
</html>
