$(document).ready(function() {
  $('.select2').select2();
});



var deleteBtns = document.querySelectorAll('.delete-record');
deleteBtns.forEach((btn, i) => {
    btn.addEventListener('click', function(){
        swal({
            title: "Are you sure to DELETE your Resturant?",
            text: "Once deleted, you will not be able to recover your data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            buttons:{
                cancel: 'Cancel',
                confirm: 'Delete'
            }

          })
          .then((willDelete) => {
            if (willDelete) {
                btn.parentElement.submit();
            } else {
              swal("Data SAVED!");
            }
          });
    });
});


