window.onload = function(){
///////////////////////////////////////PRINTING SHORTCUT/////////////////////////////////////////////////////////
// if (e.ctrlKey && e.keyCode == 'p') {
//     // call your function to do the thing
//     alert();
// }


let empID = document.getElementById('emp-id');
let empFullName = document.getElementById('emp-full-name');
let empPosition = document.getElementById('emp-position');
let grossAmnt = document.getElementById('gross-amount')


$.ajax({ 
    type: 'GET', 
    url: 'classes/AjaxRequests.php', 
    data: {fetchSalary: empID.textContent} , 
    dataType: 'json',
    success: function (data) { 
        if (data) {    
        empFullName.textContent= data[0].firstName.toUpperCase()+" "+data[0].lastName.toUpperCase()+" "+data[0].otherName.toUpperCase();
        empPosition.textContent= data[0].position.toUpperCase();
        }
    }
});



let deduction = document.getElementById('deductions-div')
$.ajax({ 
    type: 'GET', 
    url: 'classes/AjaxRequests.php', 
    data: {fetchDeductionData: true} , 
    success: function (data) { 
        if (data) {    
        deduction.innerHTML = data;
        }
    }
});

let allowance = document.getElementById('allowances-div')
$.ajax({ 
    type: 'GET', 
    url: 'classes/AjaxRequests.php', 
    data: {fetchAllowanceData: true} , 
    success: function (data) { 
        if (data) {    
            allowance.innerHTML = data;
        }
    }
});

let id = empID.textContent;
$.ajax({ 
    type: 'GET', 
    url: 'classes/AjaxRequests.php', 
    data: {getOvertime: id} , 
    success: function (data) { 
        if (data) {    
            $('#overtimeTotal').html(data);
        }
    }
});

$.ajax({ 
    type: 'GET', 
    url: 'classes/AjaxRequests.php', 
    data: {computeGross: id} , 
    success: function (data) { 
        if (data) {    
            grossAmnt.textContent= data;
        }
    }
});

$.ajax({ 
    type: 'GET', 
    url: 'classes/AjaxRequests.php', 
    data: {computeNetIncome: id} , 
    success: function (data) { 
        if (data) {    
            console.log(data);
            $('#net-income>.net-value').html(data);
        }
    }
});

}