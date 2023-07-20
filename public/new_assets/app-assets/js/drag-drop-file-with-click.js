$(document).ready(function() {
  document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
    const dropZoneElement = inputElement.closest(".drop-zone");
  dropZoneElement.addEventListener("click", (e) => {
      inputElement.click();
    });
  inputElement.addEventListener("change", (e) => {
      if (inputElement.files.length) {
        updateThumbnail(dropZoneElement, inputElement.files[0]);
      }
    });
  dropZoneElement.addEventListener("dragover", (e) => {
      e.preventDefault();
      dropZoneElement.classList.add("drop-zone--over");
    });
  ["dragleave", "dragend"].forEach((type) => {
      dropZoneElement.addEventListener(type, (e) => {
        dropZoneElement.classList.remove("drop-zone--over");
      });
    });
  dropZoneElement.addEventListener("drop", (e) => {
      e.preventDefault();
  if (e.dataTransfer.files.length) {
        inputElement.files = e.dataTransfer.files;
        updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
      }
  dropZoneElement.classList.remove("drop-zone--over");
    });
  });
  function updateThumbnail(dropZoneElement, file) {
    let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");
  // First time - remove the prompt
    if (dropZoneElement.querySelector(".drop-zone__prompt")) {
      dropZoneElement.querySelector(".drop-zone__prompt").remove();
    }
  // First time - there is no thumbnail element, so lets create it
    if (!thumbnailElement) {
      thumbnailElement = document.createElement('canvas');
      thumbnailElement.classList.add("drop-zone__thumb");
      thumbnailElement.id ='canvasId';
      dropZoneElement.appendChild(thumbnailElement);
    }
  thumbnailElement.dataset.label = file.name;
  handlePDFFile(file) 

  // Show thumbnail for image files
  //   if (file.type.startsWith("application/")) {
  //     const reader = new FileReader();
  // reader.readAsDataURL(file);
  //     reader.onload = () => {
  //       this.handlePDFFile(reader);

  //      // thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
  //     };
  //   } else {
  //     alert("This is not an Image File!");
  //     thumbnailElement.style.backgroundImage = null;
  //   }
  }
})   
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
      let fileType = file.type; 
      let validExtensions = ["application/pdf"]; 
      if(validExtensions.includes(fileType)){ //if user selected file is an image file
        var contents = reader.result;
        var loadingTask = pdfjsLib.getDocument(contents);
  
        loadingTask.promise.then(function(pdf) {
          pdf.getPage(1).then(function(page) {
            var scale = 1.5;
            var viewport = page.getViewport({
              scale: scale,
            });
  
           var canvas = document.getElementById('canvasId');
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
    
      }else{
        alert("This is not an Image File!");
        dropArea.classList.remove("active");
        dragText.textContent = "Drag & Drop to Upload File";
      }

      
    }
  })(reader);
  reader.readAsDataURL(file);
}
        