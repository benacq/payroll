window.onload = function(){
    let submitBtn = document.getElementById('submit');
    let textAreaVal = document.getElementById('report-text-area');
    let reportSuccess = $('.submit-success');
    let reportError = $('.submit-error');
    
    submitBtn.addEventListener('click', function(){
        console.log(textAreaVal.value.length);
        if (textAreaVal.value === "") {

            reportError.html('Please enter your report');
            reportError.slideDown(700);
            setTimeout(() => {
                reportError.slideUp(2000);
            }, 3500);

        }else if(textAreaVal.value.length <= 4){
            reportError.html('Please enter a valid report');
            reportError.slideDown(700);
            setTimeout(() => {
                reportError.slideUp(2000);
            }, 3500);
        }else{
            ajaxReport(submitBtn.id, textAreaVal.value);
        }
    });

    function ajaxReport(btnID, formData){
        $.ajax({ 
            type: 'POST', 
            url: 'classes/AjaxRequests.php', 
            data: {
              submitBtn: btnID,
              reportContent: formData
          }, 
            success: function (data) {   
                if (data) {
                    reportSuccess.html(data);
                    textAreaVal.value = "";
                    reportSuccess.slideDown(700);
                    setTimeout(() => {
                    reportSuccess.slideUp(2000);
                    window.location.replace("index.php");
                    }, 3500);
                }
            }
        });
    }


    function fetchReport(){
        $.ajax({ 
            type: 'GET', 
            url: 'classes/AjaxRequests.php', 
            data: {reports:true}, 
            success: function (data) {   
                if (data) {
                    console.log(data);
                    $('.report-wrapper').html(data);
                    console.log(data);
                }
            }
        });
    }
    fetchReport();


    let newReportActive = true;
    $('.my-reports').click(function(){
        if (newReportActive !== false) {
            $('.report-section').hide();
            $('.new-report').removeClass( "active" )
            $('.my-reports').addClass( "active" )
            $('.report-wrapper').show();
            newReportActive = false;
        }
    })
    $('.new-report').click(function(){
        if (newReportActive !== true) {
            $('.report-wrapper').hide();
            $('.my-reports').removeClass( "active" )
            $('.new-report').addClass( "active" )
            $('.report-section').show();
            newReportActive = true;
        }
    })
    






}