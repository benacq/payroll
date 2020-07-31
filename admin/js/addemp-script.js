 window.onload = function () {





   //SIDE BAR SLIDERS
   let caret = $('ul>li.caret-toggle');
   caret.click(function () {
     $(this).next('ul.sub-list').slideToggle();
     $(this).find('i.caret').toggleClass('fa-caret-down fa-caret-up');
   });

   //FORM CAROUSEL NAVIGATION
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


   //PROFILE PIC
   let fileBrowseBtn = document.getElementById('profile-pic');
   let profilePicHolder = document.getElementById('profile-pic-holder');
   let profilePicError = document.getElementById('pass-pic-info');


   fileBrowseBtn.addEventListener('change', function () {
     changePic(fileBrowseBtn, profilePicHolder);
   });

   function changePic(targetFile, displayElement) {
     let fileName = targetFile.files[0].name;
     let fileSize = targetFile.files[0].size;
     let fileExt = fileName.split('.').pop().toLowerCase();
     if ($.inArray(fileExt, ['png', 'jpg', 'jpeg']) === -1) {
       $(profilePicError).attr('placeholder', "INVALID FILE TYPE");
       profilePicError.style.color = "red";
     } else if (fileSize > 2000000) {
       $(profilePicError).attr('placeholder', "FILE TOO LARGE");
       profilePicError.style.color = "red";
     } else {
       let reader = new FileReader();
       reader.onload = function (e) {
         $(displayElement).attr('src', e.target.result);
       }
       reader.readAsDataURL(targetFile.files[0]);
     }
   }

   //POSITION SALARY FETCH
   let position = document.getElementById('position');
   let salaryField = document.getElementById('positionSalary');
   for (let i = 0; i < position.length; i++) {
     position[i].addEventListener('click', function () {
       getSalary(i + 2);
     })
   };

   function getSalary(id) {

     $.ajax({
       type: 'GET',
       url: '../classes/AjaxRequests.php',
       data: {
         positionID: id
       },
       success: function (data) {
         if (data) {
           salaryField.value = data;
         }
       }
     });

   }

   let pwdHidden = document.getElementById('passHidden');
   let idHidden = document.getElementById('idHidden');
   let pwdDisplay = $('#dispPass');
   let idDisplay = $('#dispID');

   let countDownDiv = document.getElementById('countDown');
   let body = document.getElementById('body');
   let pwdWrapper = document.getElementById('passWrap');

   let lastID = "";
   let pwdValue = "";

   if (pwdHidden !== null && idHidden !== null) {
     pwdValue = pwdHidden.textContent;
     lastID = idHidden.textContent;
   }

   let timer;
   if (pwdValue !== "" && lastID !== "") {
     timer = setInterval(myTimer, 1000);
     pwdDisplay.html("Password :- " + pwdValue);
     idDisplay.html("ID Number :- " + lastID);
   } else {
     pwdDisplay.html("Your login details will be displayed here and disappear after 60 seconds")
   }

   let startTime = 60;

   function myTimer() {
     if (startTime <= 0) {
       clearInterval(timer);
       countDownDiv.style.display = "none";
       body.removeChild(pwdHidden);
       body.removeChild(idHidden);
       pwdWrapper.removeChild(document.getElementById('dispPass'));
       pwdWrapper.removeChild(document.getElementById('dispID')); //DELETES ID AND PASSWORD FROM THE DOM
       pwdDisplay.fadeOut();
       idDisplay.fadeOut();
       window.location.replace("empMasterlist.php");
     }
     countDownDiv.textContent = "disappears in.." + startTime--;
   }


   let regSuccess = $('#registration-success');
   let regError = $('#registration-error');

   function registrationStatus(target) {
     target.slideDown(700);
     setTimeout(() => {
       target.slideUp(3500);
     }, 3500);

   }

   registrationStatus(regError);
   registrationStatus(regSuccess);


//CHANGE PASSWORD - ADMIN
   let changePassBtn = $('#change-pass');
   let changePassModal = $('#change-pass-modal');
   let closeModal = $('#close-modal');

   changePassBtn.click(function () {
     changePassModal.fadeIn();
   });
   closeModal.click(function () {
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