window.onload = function(){
    let changePassBtn  = $('li.change-pass');
    let changePassModal = $('#change-pass-modal');
    let closeModal = $('#close-modal');

    changePassBtn.click(function(){
        changePassModal.fadeIn();
    });
    closeModal.click(function(){
        changePassModal.fadeOut();
    });


    let editSuccess = $('#edit-success');
    function changePic(targetFile) {
      let fileSize = targetFile.files[0].size;
      if (fileSize > 2000000) {
        $('.file-error').text('File too large')
        $('.file-error').slideDown(700);
        setTimeout(() => {
          $('.file-error').slideUp(3500);
        }, 3500);
        return false;
      }else{
        editProfileStatus(editSuccess)
      }
    }

    let file = document.getElementById('file')
    $('#submit-edit').click(function(){
      changePic(file)
    })

    function editProfileStatus(target){
        target.html("Saved")
        target.slideDown(700);
        setTimeout(() => {
          target.slideUp(3500);
        }, 3500);
      
      }
      

///////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
      let idError = $('.id_error');
      let pwdError = $('.pwd_error');
      
      function loginErrorStatus(target){
        target.slideDown(700);
        setTimeout(() => {
          target.slideUp(3500);
        }, 3500);
      }
      loginErrorStatus(idError);
      loginErrorStatus(pwdError);

}