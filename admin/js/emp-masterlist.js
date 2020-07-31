window.onload = function () {
  let caret = $('ul>li.caret-toggle');
  caret.click(function () {
    $(this).next('ul.sub-list').slideToggle();
    $(this).find('i.caret').toggleClass('fa-caret-down fa-caret-up');
  });

  let empInfoBtn = document.querySelectorAll('.fa-info-circle');
  let empInfoModal = $('.modal-wrap');
  let closeEmpModal = $('.emp-info-close');

  for (let i = 0; i < empInfoBtn.length; i++) {
    empInfoBtn[i].addEventListener('click', function () {
      fetchEmpData(empInfoBtn[i].id);
      empInfoModal.fadeIn();
    });
  }

  closeEmpModal.click(function(){
    empInfoModal.fadeOut();
  })

  

  function fetchEmpData(id) {
    $.get(
      '../classes/AjaxRequests.php', {
        empID: id
      },
      function (data) {
        $('#emp-master').html("<?php echo <h1>HELLO WORLD</h1> ?>");
        $('.modal-table').html(data);
      }
    );
  }




//CHANGE PASSWORD - ADMIN
  let changePassBtn = $('li.change-pass');
  let changePassModal = $('#change-pass-modal');
  let closeModal = $('#close-modal');

  changePassBtn.click(function () {
    changePassModal.fadeIn();
  });
  closeModal.click(function () {
    changePassModal.fadeOut();
  });


  let submitBtn = document.querySelectorAll('.submit');
  let pwdValue = document.getElementById('password');
  let cPwdValue = document.getElementById('confirm-password');
  let pwdError = $('.pass-error');
  let cPwdError = $('.cPass-error');
  let seccess = $('.success');

  for (let i = 0; i < submitBtn.length; i++) {
    submitBtn[i].addEventListener('click', function () {
      if (validation()) {
        sendPwd(submitBtn[i].id, pwdValue.value, cPwdValue.value);
      }
    });
  }


  function validation() {
    if (pwdValue.value !== cPwdValue.value) {
      cPwdError.html("Passwords do not match");
      cPwdError.slideDown(700);
      setTimeout(() => {
        cPwdError.slideUp(2000);
      }, 3500);

    } else if (pwdValue.value.length <= 5) {
      pwdError.html("Enter a lengthy password")
      pwdError.slideDown(700);
      setTimeout(() => {
        pwdError.slideUp(2000);
      }, 3500);

    } else {
      return true;
    }
  }

  function sendPwd(id, pwdVal, cPwdVal) {
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
          pwd.value = "";
          cPwdValue.value = "";
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