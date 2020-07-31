window.onload = function () {
  let caret = $('ul>li.caret-toggle');
  caret.click(function () {
    $(this).next('ul.sub-list').slideToggle();
    $(this).find('i.caret').toggleClass('fa-caret-down fa-caret-up');
  });


  let empID = document.getElementById('emp-id');
  empID.addEventListener('change', function () {
    if (empID.value.length === 6) {
      let empIDvalue = empID.value;
      fetchEmpName(empIDvalue);
    }
  });


  let empName = document.getElementById('emp-name');
  console.log(empName.value);

  function fetchEmpName(id) {
    $.ajax({
      type: 'GET',
      url: '../classes/AjaxRequests.php',
      data: {
        nameID: id
      },
      dataType: 'json',
      success: function (data) {
        if (data) {
          empName.value = data[0].firstName + " " + data[0].lastName;
        } else {
          console.log(data);
        }
      }
    });
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
      url: '../classes/AjaxRequests.php',
      data: {
        changePass: id,
        pwd: pwdVal,
        cPwd: cPwdVal
      },
      success: function (data) {
        if (data) {
          seccess.html(data);
          seccess.slideDown(700);
          pwd.value = "";
          cPwdValue.value = "";
          setTimeout(() => {
            seccess.slideUp(2000);
            changePassModal.fadeOut();
          }, 3500);
        }
      }
    });
  }






}