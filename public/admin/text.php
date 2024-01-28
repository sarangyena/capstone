<html>
<body>

<form method="post" action="upload.php" enctype="multipart/form-data">

<input type="text" name="title" placeholder="Enter a title for the image">

<input type="file" name="fileToUpload" id="fileToUpload">

<input type="button" value="Take Webcam Picture" onclick="takeSnapshot()">

</form>

<script>
function takeSnapshot() {
  // Access webcam
  navigator.mediaDevices.getUserMedia({video: true}) 
  .then(function(mediaStream) {
    // Create video element 
    var video = document.createElement('video');
    video.srcObject = mediaStream;
    
    // When loaded, take snapshot
    video.onloadedmetadata = function() {
      var canvas = document.createElement('canvas');
      canvas.width = video.videoWidth;
      canvas.height = video.videoHeight;
      canvas.getContext('2d').drawImage(video, 0, 0);
      var img = canvas.toDataURL('image/jpeg');
      
      // Upload to server
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'upload.php');
      xhr.setRequestHeader('Content-Type', 'application/upload');
      xhr.send(img);
      
      // Stop webcam stream
      mediaStream.getTracks()[0].stop();
    } 
  })
}
</script>

</body>
</html>