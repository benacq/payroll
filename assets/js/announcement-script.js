window.onload = function (){
    let announcementContainer = $('.content');
    
function fetchAnnouncement(){
    $.ajax({ 
        type: 'GET', 
        url: 'classes/AjaxRequests.php', 
        data: {fetchAnnoucement: true} , 
        success: function (data) { 
            if (data) {    
            announcementContainer.html(data); 
            }
        }
    });
}

fetchAnnouncement();
}