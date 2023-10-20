var ary = [];
var jsonval = '';
var ajaxResult = null;

function addData(ids, method, url) {
    var myarr = ids.split(",");

    //console.log(document.getElementById(myarr[1]).value);
    var obj = {};
    for (let index = 0; index < myarr.length; index++) {
        var key = myarr[index];
        element = document.getElementById(key).value;
        obj[key] = element;
    }
    //console.log(obj);
    ary.push(obj);

    jsonval = JSON.parse(JSON.stringify(ary[0]));

    //console.log(jsonval);
    $.ajax({
        type: method,
        url: url,
        data: jsonval,
        success: function(result) {
            ary = [];
            jsonval = null;
            console.log(result);
            //toastr.success(result.message);
            if (result.success) {

                Swal.fire({
                    title: result.message,
                    icon: 'success',
                }).then(function(result) {
                    if (result.isConfirmed) {
                        window.location.reload(true);
                    }
                });
                //console.log(result);
                for (let index = 0; index < myarr.length; index++) {
                    var key = myarr[index];
                    document.getElementById(key).value = '';
                }

                //result.data
            } else {

                let text = "<ul>";
                //alert(result.data);
                const error_log = json2array(JSON.parse(result.data)); //JSON.parse(result.data); //result.data;
                // console.log(error_log);
                error_log.forEach((activity) => {
                    activity.forEach((data) => {
                        text += '<li>' + data + '</li>';
                        //console.log(data);
                    });
                });
                text += "</ul>";

                Swal.fire({
                    html: text,
                    icon: 'error',
                });
            }

        }
    });
}


function json2array(json) {
    var result = [];
    var keys = Object.keys(json);
    keys.forEach(function(key) {
        result.push(json[key]);
    });
    return result;
}
async function getTableData(url, method, id, callback) {
    //var result;
    //var arys = [];
    return await $.ajax({
        type: method,
        url: url,
        data: { id: id },
        success: callback,
    });

}

function updateRow(ids, method, url, id) {
    var myarr = ids.split(",");

    //console.log(myarr.length);
    var obj = {};
    for (let index = 0; index < myarr.length; index++) {
        var key = myarr[index];
        element = document.getElementById(key).value;
        obj[key] = element;
    }
    obj['id'] = id;
    //console.log(obj);
    ary.push(obj);

    jsonval = JSON.parse(JSON.stringify(ary[0]));

    //console.log(jsonval);
    $.ajax({
        type: method,
        url: url,
        data: jsonval,
        success: function(result) {
            ary = [];
            jsonval = null;
            //console.log(result);
            //toastr.success(result.message);
            if (result.success) {

                Swal.fire({
                    title: result.message,
                    icon: 'success',
                }).then(function(result) {
                    if (result.isConfirmed) {
                        window.location.reload(true);
                    }
                });
                //console.log(result);
                for (let index = 0; index < myarr.length; index++) {
                    var key = myarr[index];
                    document.getElementById(key).value = '';
                }

                //result.data
            } else {

                let text = "<ul>";
                //alert(result.data);
                const error_log = json2array(JSON.parse(result.data)); //JSON.parse(result.data); //result.data;
                // console.log(error_log);
                error_log.forEach((activity) => {
                    activity.forEach((data) => {
                        text += '<li>' + data + '</li>';
                        //console.log(data);
                    });
                });
                text += "</ul>";

                Swal.fire({
                    html: text,
                    icon: 'error',
                });
            }

        }
    });
}