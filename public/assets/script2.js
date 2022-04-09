
function candown (targetNode, type) {
  // (B1) GET CANVAS
  let canvas = targetNode;
 
   // (B2) CREATE LINK
  let anchor = document.createElement("a");

  anchor.download = new Date().toISOString().substr(0,10) + " Tiket Reservasi" + "." + type;
  anchor.href = canvas.toDataURL("image/" + type);
 
  // (B3) "FORCE DOWNLOAD"
  anchor.click();
  anchor.remove();
 
  // (B4) SAFER ALTERNATIVE - LET USER CLICK ON LINK
  // anchor.innerHTML = "Download";
  // document.body.appendChild(anchor);
}


$("#btnSave").click(function() {
  html2canvas(document.getElementById('widget')).then(function(canvas) {

    document.body.appendChild(canvas);

  }).then( () => {

    canvasNode = document.body.querySelector('canvas');

    candown(canvasNode, 'png');

    canvasNode.remove();


  });


});



