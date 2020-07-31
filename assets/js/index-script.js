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


    let submitBtn = document. querySelectorAll('.submit');
    let pwdValue = document.getElementById('password');
    let cPwdValue = document.getElementById('confirm-password');
    let pwdError = $('.pass-error');
    let cPwdError = $('.cPass-error');
    let seccess = $('.success');

    for (let i = 0; i < submitBtn.length; i++) {
        submitBtn[i].addEventListener('click',function(){
            if(validation()){
                sendPwd(submitBtn[i].id, pwdValue.value, cPwdValue.value);
            }
        });
    }

    
    function validation(){
        if(pwdValue.value !== cPwdValue.value){
            cPwdError.html("Passwords do not match");
            cPwdError.slideDown(700);
            setTimeout(() => {
              cPwdError.slideUp(2000);
            }, 3500);

        }else if(pwdValue.value.length <= 5){
            pwdError.html("Enter a lengthy password")
            pwdError.slideDown(700);
            setTimeout(() => {
              pwdError.slideUp(2000);
            }, 3500);

        }else{
            return true;
        }
    }

    function sendPwd(id, pwdVal, cPwdVal){
        $.ajax({ 
          type: 'POST', 
          url: 'classes/AjaxRequests.php', 
          data: {
            changePass: id,
            pwd: pwdVal,
            cPwd: cPwdVal
        }, 
          success: function (data) {   
                if (data) {
                    seccess.html(data);
                    seccess.slideDown(700);
                    setTimeout(() => {
                      seccess.slideUp(2000);
                      changePassModal.fadeOut();
                    }, 3500);
                }
          }
      });
    }



}