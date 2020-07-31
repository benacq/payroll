window.onload = function(){
  let caret = $('ul>li.caret-toggle');
  caret.click(function(){
    $(this).next('ul.sub-list').slideToggle();
    $(this).find('i.caret').toggleClass('fa-caret-down fa-caret-up');
  });

  let announcementBtn = $('#addAnnouncement');
  let announcementModal = $('.announcement-modal-wrap');
  let closeModal = $('#close-modal');

  announcementBtn.click(function(){
    announcementModal.fadeIn();
  });
  closeModal.click(function(){
    announcementModal.fadeOut();
  });



let announcementContent = document.getElementById('announcement-textArea')
let publishAnnouncement = document.querySelectorAll('.publish-announcement');

for (let i = 0; i < publishAnnouncement.length; i++) {
  publishAnnouncement[i].addEventListener('click',function(){
    if (validateAnnouncement()) {
      submitAnnouncement(publishAnnouncement[i].id, announcementContent.value);
    }
  });
}

function validateAnnouncement(){
  let announceData = announcementContent.value;
  if (announceData === "") {
    $('.announce-error').html("Please enter an announcement");
    announcementStatus($('.announce-error'));
  }else if(announceData.length < 10){
    $('.announce-error').html("Please enter a lengthy announcement");
    announcementStatus($('.announce-error'))
  }else{
    announcementStatus($('.announce-success'))
    return true;
  }
}

function announcementStatus(target){
  target.slideDown(700);
  setTimeout(() => {
    target.slideUp(3500);
  }, 3500);
}

function submitAnnouncement(id, data){
  $.ajax({ 
    type: 'POST', 
    url: '../classes/AjaxRequests.php', 
    data: {
      submitAnnouncement: id,
      announcementData: data
    }, 
    success: function (data) { 
      if (data) {
        announcementContent.value = "";
        $('.announce-success').html(data);
        announcementModal.fadeOut();
      }
    }
});

}

let announcementContainer = $('.content');
function fetchAnnouncement(){
  $.ajax({ 
      type: 'GET', 
      url: '../classes/AjaxRequests.php', 
      data: {fetchAnnoucement: true} , 
      success: function (data) { 
          if (data) {    
            announcementContainer.html(data); 
          }
      }
  });
}

fetchAnnouncement();


//CHANGE PASSWORD - ADMIN
let changePassBtn  = $('li.change-pass');
let changePassModal = $('#change-pass-modal');
let closePassModal = $('#close-modal');

changePassBtn.click(function(){
    changePassModal.fadeIn();
});
closePassModal.click(function(){
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