$(document).ready(function()
    {
       
        let file;
        $("#drop-area").on('dragenter', function (e){
            e.preventDefault();
            $(this).css('background', '#BBD5B8');
        });

        $("#drop-area").on('dragover', function (e){
            e.preventDefault();
        });

        $("#drop-area").on('drop', function (e){
            $(this).css('background', '#D8F9D3');
                e.preventDefault();
                var image = e.originalEvent.dataTransfer.files;
                createFormData(image);
            });
        });

function createFormData(image)
{
 var formImage = new FormData();
 formImage.append('userImage', image[0]);
 file = image[0];

 uploadFormData(formImage);
}
function handlePDFFile(file) {
    var reader = new FileReader();
    reader.onload = (function(reader) {
      return function() {
        var contents = reader.result;
        var loadingTask = pdfjsLib.getDocument(contents);
  
        loadingTask.promise.then(function(pdf) {
          pdf.getPage(1).then(function(page) {
            var scale = 1.5;
            var viewport = page.getViewport({
              scale: scale,
            });
  
            var canvas = document.getElementById('drop-area');
            var context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;
  
            var renderContext = {
              canvasContext: context,
              viewport: viewport
            };
           var renderTask =  page.render(renderContext);
            renderTask.then(function() {
                console.log('Page rendered');
              });
          });
        });
      }
    })(reader);
    reader.readAsDataURL(file);
  }


function uploadFormData(formData) 
{
    var  dropArea = document.querySelector("#drop-area");
    let dragText = document.querySelector("header");
    let fileType = file.type; //getting selected file type
  //let validExtensions = ["image/jpeg", "image/jpg", "image/png"]; //adding some valid image extensions in array
  let validExtensions = ["application/pdf"]; 
  if(validExtensions.includes(fileType)){ //if user selected file is an image file
    this.handlePDFFile(file);

  }else{
    alert("This is not an Image File!");
    dropArea.classList.remove("active");
    dragText.textContent = "Drag & Drop to Upload File";
  }

//  $.ajax({
//  url: "upload_image.php",
//  type: "POST",
//  data: formData,
//  contentType:false,
//  cache: false,
//  processData: false,
//  success: function(data){
//   $('#drop-area').html(data);
//  }});
}