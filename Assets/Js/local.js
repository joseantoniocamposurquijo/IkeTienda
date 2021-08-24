$(function () {
 	$('[data-toggle="popover"]').popover();
});

function ConfirmarEliminar(url, msg){
  let respConfirm = confirm(msg);
  if(respConfirm){
     window.location.href=url;
  }
}

function appJsAddFile(tag, id){
   if (document.getElementById(tag.id).files.length > 0) {
      var input_file = document.getElementById(tag.id).files[0].name;
      $('#'+id).val(input_file)
   }
}

$(function () {
   $('[data-toggle="popover"]').popover()
});


$(document).ready( function () {
    $('#mainTable').DataTable();
} );