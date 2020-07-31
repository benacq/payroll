window.onload = function () {
  let caret = $('ul>li.caret-toggle');
  caret.click(function () {
    $(this).next('ul.sub-list').slideToggle();
    $(this).find('i.caret').toggleClass('fa-caret-down fa-caret-up');
  });



  let allowanceBtn = $('.addAllowance');
  let allowanceModal = $('.allowance-modal-wrap');
  let closeModal = $('#close-allowance-modal');

  allowanceBtn.click(function () {
    allowanceModal.fadeIn();
  });
  closeModal.click(function () {
    allowanceModal.fadeOut();
  });


  let allowanceValue = document.getElementsByClassName('allowance-input');
  let AddAllowanceBtn = document.getElementById('add-allowance');
  let allowanceError = $('.allowance-error');
  let allowanceSuccess = $('.allowance-success');

  AddAllowanceBtn.addEventListener('click', function () {
    if (validateAllowance()) {
      addAllowance(AddAllowanceBtn.value, allowanceValue[0].value, allowanceValue[1].value, allowanceValue[2].value);
    }
  })

  function allowanceStatus(target) {
    target.slideDown(700);
    setTimeout(() => {
      target.slideUp(3500);
    }, 3500);
  }

  function validateAllowance() {
    let allowanceName = allowanceValue[0].value;
    let allowaPercnt = allowanceValue[1].value;
    let aDesc = allowanceValue[2].value;
    if (allowanceName === "" || allowaPercnt === "" || aDesc === "") {
      allowanceError.html('Please fill in all fields');
      allowanceStatus(allowanceError);
    } else if (allowaPercnt > 50 || allowaPercnt < 0) {
      allowanceError.html('Enter a number from 0 to 50')
      allowanceStatus(allowanceError);
    } else {
      return true;
    }
  }

  function addAllowance(id, aName, aPercentage, aDesc) {
    $.ajax({
      type: 'POST',
      url: '../classes/AjaxRequests.php',
      data: {
        addAllowance: id,
        allowanceName: aName,
        allowancePercentage: aPercentage,
        allowanceDescription: aDesc
      },
      success: function (data) {
        if (data) {
          allowanceSuccess.html(data);
          allowanceStatus(allowanceSuccess);
          allowanceModal.fadeOut();
        } else {
          allowanceError.html(data);
          allowanceStatus(allowanceError);
        }
      }
    });
  }

  function fetchAllowance() {
    $.ajax({
      type: 'GET',
      url: '../classes/AjaxRequests.php',
      data: {
        fetchAllowance: true
      },
      success: function (data) {
        if (data) {
          // $('#data-header').after(data);
        }
      }
    });
  }

  fetchAllowance();


  //UPDATE AND DELETE ALLOWANCE
  let editAllowance = document.querySelectorAll('button.edit');
  let deleteAllowance = document.querySelectorAll('button.delete');
  $('.close-allowance-modal').click(function () {
    $(".edit-allowance-modal").fadeOut();
  });

  let allowance_name = $('.edit-allowance-input')[0];
  let allowance_percentage = $('.edit-allowance-input')[1];
  let allowance_desc = $('.edit-allowance-input')[2];

  for (let i = 0; i < editAllowance.length; i++) {
    editAllowance[i].addEventListener('click', function () {
      $(".edit-allowance-modal").fadeIn();
      fetchEditAllowance(editAllowance[i].id);
      $('.save-edit-allowance').click(function () {
        if (validateEditAllowance()) {
          updateAllowance(editAllowance[i].id, allowance_name.value, allowance_percentage.value, allowance_desc.value);
        }
      });
    });

    deleteAllowance[i].addEventListener('click', function () {
      $('.delete-allowance').show();
      $('.yes').click(function () {
        deleteAllowa(deleteAllowance[i].id);
      });
    });
  }

  function validateEditAllowance() {
    let allowanceName = allowance_name.value;
    let allowaPercnt = allowance_percentage.value;
    let aDesc = allowance_desc.value;
    if (allowanceName === "" || allowaPercnt === "" || aDesc === "") {
      allowanceError.html('Please fill in all fields');
      allowanceStatus(allowanceError);
    } else if (allowaPercnt > 50 || allowaPercnt < 0) {
      allowanceError.html('Enter a number from 0 to 50')
      allowanceStatus(allowanceError);
    } else {
      return true;
    }
  }

  function deleteAllowa(id) {
    $.ajax({
      type: 'GET',
      url: '../classes/AjaxRequests.php',
      data: {
        deleteAllowance: id,
      },
      success: function (data) {
        if (data) {
          allowanceSuccess.html(data);
          allowanceStatus(allowanceSuccess);
          $('.delete-allowance').hide();
        }
      }
    });
  }

  function updateAllowance(id, aName, aPercentage, aDesc) {
    $.ajax({
      type: 'GET',
      url: '../classes/AjaxRequests.php',
      data: {
        updateAllowance: id,
        allowanceName: aName,
        allowancePercentage: aPercentage,
        allowanceDesc: aDesc,
      },
      success: function (data) {
        if (data) {
          allowanceSuccess.html(data);
          allowanceStatus(allowanceSuccess);
          $(".edit-allowance-modal").fadeOut();
        }
      }
    });
  }

  function fetchEditAllowance(id) {
    $.ajax({
      type: 'GET',
      url: '../classes/AjaxRequests.php',
      dataType: 'json',
      data: {
        fetchEditAllowance: id
      },
      success: function (data) {
        if (data) {
          allowance_name.value = data[0].allowance_name;
          allowance_percentage.value = data[0].allowance_amount;
          allowance_desc.value = data[0].allowance_desc;
        }
      }
    });
  }

  $('.no').click(function () {
    $('.delete-allowance').fadeOut();
  });



  //CHANGE PASSWORD - ADMIN
  let changePassBtn = $('#change-pass');
  let changePassModal = $('#change-pass-modal');
  let closePassModal = $('#close-modal');

  changePassBtn.click(function () {
    changePassModal.fadeIn();
  });
  closePassModal.click(function () {
    changePassModal.fadeOut();
  });

  let submitBtn = document.querySelectorAll('.submit');
  let pwd = document.getElementById('password');
  let cPwdValue = document.getElementById('confirm-password');
  let pwdError = $('.pass-error');
  let cPwdError = $('.cPass-error');
  let seccess = $('.success');



  for (let i = 0; i < submitBtn.length; i++) {
    submitBtn[i].addEventListener('click', function () {
      if (validation()) {
        sendPwd(submitBtn[i].id, pwd.value, cPwdValue.value);
      }
    });
  }


  function validation() {
    if (pwd.value !== cPwdValue.value) {
      cPwdError.html("Passwords do not match");
      cPwdError.slideDown(700);
      setTimeout(() => {
        cPwdError.slideUp(2000);
      }, 3500);

    } else if (pwd.value.length <= 5) {
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