window.onload = function () {
  let caret = $('ul>li.caret-toggle');
  caret.click(function () {
    $(this).next('ul.sub-list').slideToggle();
    $(this).find('i.caret').toggleClass('fa-caret-down fa-caret-up');
  });



  let deductionBtn = $('.addDeduction');
  let deductionModal = $('.deduction-modal-wrap');
  let closeModal = $('#close-deduction-modal');

  deductionBtn.click(function () {
    deductionModal.fadeIn();
  });
  closeModal.click(function () {
    deductionModal.fadeOut();
  });



  let deductionValue = document.getElementsByClassName('deduction-input');
  let AddDeductionBtn = document.getElementById('add-deduction');
  let deductionError = $('.deduction-error');
  let deductionSuccess = $('.deduction-success');

  AddDeductionBtn.addEventListener('click', function () {
    if (validateDeduction()) {
      addDeduction(AddDeductionBtn.value, deductionValue[0].value, deductionValue[1].value, deductionValue[2].value);
    }
  })

  function deductionStatus(target) {
    target.slideDown(700);
    setTimeout(() => {
      target.slideUp(3500);
    }, 3500);
  }

  function validateDeduction() {
    let dName = deductionValue[0].value;
    let dPercnt = deductionValue[1].value;
    let dDesc = deductionValue[2].value;
    if (dName === "" || dPercnt === "" || dDesc === "") {
      deductionError.html('fill in all fields');
      deductionStatus(deductionError);
    } else if (dPercnt > 50 || dPercnt < 0) {
      deductionError.html('enter a number from 0 to 50')
      deductionStatus(deductionError);
    } else {
      return true;
    }
  }

  function addDeduction(id, dName, dPercentage, dDesc) {
    $.ajax({
      type: 'POST',
      url: '../classes/AjaxRequests.php',
      data: {
        addDeduction: id,
        deductionName: dName,
        deductionPercentage: dPercentage,
        deductionDescription: dDesc
      },
      success: function (data) {
        if (data) {
          deductionSuccess.html(data);
          deductionStatus(deductionSuccess);
          deductionModal.fadeOut();
        } else {
          deductionError.html(data);
          deductionStatus(deductionError);
        }
      }
    });
  }


  //UPDATE AND DELETE DEDUCTION
  let editDeduction = document.querySelectorAll('button.edit');
  let deleteDeduction = document.querySelectorAll('button.delete');
  $('.close-deduction-modal').click(function () {
    $(".edit-deduction-modal").fadeOut();
  });

  let deduction_name = $('.edit-deduction-input')[0];
  let deduction_percentage = $('.edit-deduction-input')[1];
  let deduction_desc = $('.edit-deduction-input')[2];


  for (let i = 0; i < editDeduction.length; i++) {
    editDeduction[i].addEventListener('click', function () {
      fetchEditDeduction(editDeduction[i].id);
      $(".edit-deduction-modal").fadeIn();
      $('.save-edit-deduction').click(function () {
        if(validateEditDeduction()){
          updateDedution(editDeduction[i].id, deduction_name.value, deduction_percentage.value, deduction_desc.value);
        }
    
      });
    });

    deleteDeduction[i].addEventListener('click', function () {
      $('.delete-deduction').show();
      $('.yes').click(function () {
        deleteDeduc(deleteDeduction[i].id);
      });
    });
  }


  function validateEditDeduction() {
    let dName = deduction_name.value;
    let dPercnt = deduction_percentage.value;
    let dDesc = deduction_desc.value;
    if (dName === "" || dPercnt === "" || dDesc === "") {
      deductionError.html('fill in all fields');
      deductionStatus(deductionError);
    } else if (dPercnt > 50 || dPercnt < 0) {
      deductionError.html('enter a number from 0 to 50')
      deductionStatus(deductionError);
    } else {
      return true;
    }
  }

  function deleteDeduc(id) {
    $.ajax({
      type: 'GET',
      url: '../classes/AjaxRequests.php',
      data: {
        deleteDeduction: id,
      },
      success: function (data) {
        if (data) {
          console.log(data);
          deductionSuccess.html(data);
          deductionStatus(deductionSuccess);
          $('.delete-deduction').hide();
        }
      }
    });
  }

  function updateDedution(id, dName, dPercentage, dDesc) {
    $.ajax({
      type: 'GET',
      url: '../classes/AjaxRequests.php',
      data: {
        updateDeduction: id,
        deductionName: dName,
        deductionPercentage: dPercentage,
        deductionDesc: dDesc,
      },
      success: function (data) {
        if (data) {
          console.log(data);
          deductionSuccess.html(data);
          deductionStatus(deductionSuccess);
          $(".edit-deduction-modal").fadeOut();
        }
      }
    });
  }


  function fetchEditDeduction(id) {
    $.ajax({
      type: 'GET',
      url: '../classes/AjaxRequests.php',
      data: {
        fetchEditDeduction: id
      },
      dataType: 'json',
      success: function (data) {
        if (data) {
          deduction_name.value = data[0].deduction_name;
          deduction_percentage.value = data[0].deduction_amount;
          deduction_desc.value = data[0].deduction_desc;
        }
      }
    });
  }

  $('.no').click(function () {
    $('.delete-deduction').fadeOut();
  });


  // CHANGE PASSWORD - ADMIN
  let changePassBtn = $('li.change-pass');
  let changePassModal = $('#change-pass-modal');
  let closePassModal = $('#close-modal');

  changePassBtn.click(function () {
    changePassModal.fadeIn();
  });
  closePassModal.click(function () {
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