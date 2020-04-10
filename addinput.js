var numOfRows = 0;
var list = {};
var title = "";
var json = "";
var type = "";


function addrow() {

    var lastField = $("#buildyourform div:last"); //find id of buildyourform, and the last div

    var intId = $(".textinput").length; //is the int for unique ID's, no idea how it works - should be amount of inputs on page

    var fRow = $("<div class=\"row\" id=\"row" + numOfRows + "\"/>"); //the overarching row, the row has a id equal to 'row' + intId


    var fCheck = $("<div class=\"col-1 borders\"> <div class=\"checkbox-center\" style=\"  width: 100%;  height: 100%; padding: 20%;\"> <input onchange=\"addchecktoArray(id)\" type=\"checkbox\" value id=\"c" + numOfRows +"\" style=\" width: 100%;  height: 100%;\"> </div></div>");

    var fTextBox = $("<div class=\"col-10 borders\"> <div class=\"container borders\"><div class=\"row\">  <div class=\"col borders textbox\"><input onchange=\"addtoArray(id, value); addrow();\" type=\"text\" class=\"form-control textinput text-center\" id=\"" + numOfRows + "\" placeholder=\"Type Here\" maxlength=\"200\"> </div></div></div></div>");

    if (numOfRows == 0) {
        var removeButton = $("<div class=\"col-1 borders\" id=\"r" + numOfRows + "\"><span> <i class=\"fas fa-trash-alt\"></i></span>");

    } else {
        var removeButton = $("<div class=\"col-1 borders\" id=\"r" + numOfRows + "\"><span> <i class=\"fas fa-trash-alt\"></i></span>");
    }


    removeButton.click(function () {
        $(this).parent().remove(); //thing must have type of button to trigger
        var remove = $(this).attr('id');
        removefromArray(remove);
        

    });

    fRow.append(fRow); //appending row to row?
    fRow.append(fCheck);
    fRow.append(fTextBox);
    fRow.append(removeButton);
    $("#buildyourform").append(fRow);
    numOfRows++;
}



//just in case
//(lastField && lastField.length && //lastField.data("idx") + 1) || 1;

function addchecktoArray(id){

 var id = id.substring(1);
 var textvalue = document.getElementById(id).value;
 addtoArray(id,textvalue);
}

function addtoArray(id, value) {
    
    if (document.getElementById('c'+id).checked)
        {
            type = "checked";
        } else {
            type = "unchecked";
        }
    
    var item = {
        key: id,
        type: type,
        value: value
    };

    list[item.key] = item;
    saveArray(list);

}

function removefromArray(id) {

    id = id.slice(1);
    list[id] = null;
    saveArray(list);
}

function cleanArray(actual) {
    j = 0;
    var newArray = {};
    for (var i = 0; i < Object.keys(actual).length; i++) {
        if (actual[i]) {
            newArray[j] = actual[i];
            newArray[j].key = j;
            j++;
        }
    }
    return newArray;
}

function saveArray(list) {

    var filtered = cleanArray(list);

     json = JSON.stringify(filtered);
    
    
    
    console.log("SAVE ARRAY" + json);

    //Save list to database
    
    

    
    //var obj = JSON.parse('{"0":{"key":0,"type":"checked","value":"fgfgfg"},"1":{"key":1,"type":"checked","value":"bf"}}');

    // console.log(obj);

}

function savetodb(){
    
    
    //var query = $.param(json); //encodes json
    
    var query = encodeURI(json);
    
    var public = "false"; //all lists will be private by default, then made public later
    
    title = document.getElementById("listtitle").innerHTML; //gets the value of listtitle, an editable h1
    
    var querystring = "sendtodb.php?json=" + query + "&public=" + public + "&title=" + title;
    console.log(querystring);
    window.location.replace(querystring);
    
}

function updatelist(listID2){
    
    
    
    var query = encodeURI(json);
    var public = "false";
    title = document.getElementById("listtitle").innerHTML;
    var querystring = "updatelist.php?json=" + query + "&public=" + public + "&title=" + title + "&listID=" +listID2;
    console.log(querystring);
    window.location.replace(querystring);
}

