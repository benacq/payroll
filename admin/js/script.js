window.onload = function () {
  let caret = $('ul>li.caret-toggle');
  caret.click(function () {
    $(this).next('ul.sub-list').slideToggle();
    $(this).find('i.caret').toggleClass('fa-caret-down fa-caret-up');
  });

  let carouselControl = document.querySelectorAll('.carousel-control');
  let showForm = document.querySelectorAll('.form-toggle');
  let formTitle = document.querySelectorAll('.form-title');

  for (let i = 0; i < carouselControl.length; i++) {
    carouselControl[i].addEventListener('click', function (e) {
      carouselChange(i);
    });
  }

  function carouselChange(currentClicked) {
    $('.carousel-control').removeClass('carousel-active')
    carouselControl[currentClicked].classList.add('carousel-active')
    $('.form-title').hide();
    $('.form-toggle').hide();
    formTitle[currentClicked].style.display = "block";
    showForm[currentClicked].style.display = "grid"
  }

  let empInfoBtn = $('.fa-info-circle');
  let empInfoModal = $('.modal-wrap');
  let closeEmpModal = $('.modal-head>span')
  empInfoBtn.click(function () {
    empInfoModal.fadeIn();
    alert(empInfoBtn.attr('id'));
  })
  closeEmpModal.click(function () {
    empInfoModal.fadeOut();
  })



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