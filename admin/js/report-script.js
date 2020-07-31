window.onload = function(){
  let caret = $('ul>li.caret-toggle');
  caret.click(function(){
    $(this).next('ul.sub-list').slideToggle();
    $(this).find('i.caret').toggleClass('fa-caret-down fa-caret-up');
  });

  let reportModal = $('.reply-report');
  let closeReport = $('.close-report');
  let previewReport = $('.show-report');

  // let deleteWarning = $('.delete-report-warning');
 
  closeReport.click(function(){
    reportModal.fadeOut();
  });


  let replyReport = $('.fa-reply');
  let deleteReport = $('.fa-trash');
  replyReport.click(function(){
    let id = this.id
    let sendBtn = $('#send-reply');
    let idReportPreview = $("td#"+id).text();
    previewReport.html(idReportPreview);
    let reportReply = document.getElementById('reply');
    reportModal.fadeIn();

    sendBtn.click(function(){
      if (validateReply(reportReply)) {
        report_reply(id,reportReply.value);
      }
    });
  });

  deleteReport.click(function(){
    let id = this.id;
    $('.delete-report-warning').show();
    $('.no').click(function(){
      $('.delete-report-warning').hide();
    })
    $('.yes').click(function(){
      report_delete(id);
    })
  })

  function validateReply(content){
    if (content.value !== "") {
      return true;
    }else{
      $('.error').text("Please enter a reply");
      reportStatus($('.error'))
    }
    }
  }

    function report_reply(reportID,replyContent){
        $.ajax({ 
          type: 'GET', 
          url: '../classes/AjaxRequests.php', 
          data: {
            replyReport: reportID,
            reply: replyContent
          } , 
          success: function (data) { 
            if (data) {    
              $('.success').text(data);
              reportStatus($('.success'));
              $('.reply-report').fadeOut();
            }
            }
      });
    }
  
    function report_delete(reportID){
      $.ajax({ 
        type: 'GET', 
        url: '../classes/AjaxRequests.php', 
        data: {deleteReport: reportID} , 
        success: function (data) { 
          if (data) {
            $('.success').text(data);
            reportStatus($('.success'));
            $('.delete-report-warning').hide();
            // console.log(data);
          }
        }
    });
  }

  function reportStatus(target) {
    target.slideDown(700);
    setTimeout(() => {
      target.slideUp(3500);
    }, 3500);

  }
    



//CHANGE PASSWORD - ADMIN
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




