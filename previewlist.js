var numOfRows = 0;

function addrow() {

    var lastField = $("#buildyourform div:last"); //find id of buildyourform, and the last div

    var intId = $(".textinput").length; //is the int for unique ID's, no idea how it works - should be amount of inputs on page

    var fRow = $("<div class=\"row\" id=\"row" + numOfRows + "\"/>"); //the overarching row, the row has a id equal to 'row' + intId

    //no idea what this does

    var fCheck = $("<div class=\"col-2 pl-4 borders\"> <div class=\"checkbox-center\" style=\"  width: 100%;  height: 100%; padding: 20%;\"> <input onchange=\"addchecktoArray(id)\" type=\"checkbox\" value id=\"c" + numOfRows +"\" style=\" width: 100%;  height: 100%;\" disabled> </div></div>");

    var fTextBox = $("<div class=\"col-10 pr-4 borders\"> <div class=\"container borders\"><div class=\"row\">  <div class=\"col borders textbox\"><input onchange=\"addtoArray(id, value); addrow();\" type=\"text\" class=\"form-control textinput text-center\" id=\"" + numOfRows + "\" placeholder=\"Type Here\" maxlength=\"200\" readonly> </div></div></div></div>");

    if (numOfRows == 0) {
        var removeButton = $("");

    } else {
        var removeButton = $("");
    }
    
//remove button styling if needed    
//<div class=\"col-1 borders\" id=\"r" + numOfRows + "\"><span> <div class=\"delete-center\" > <img src=\"icons/minus.svg\" alt=\"Delete Row\"></div></div></span>
    
//    removeButton.click(function () {
//        $(this).parent().remove(); //thing must have type of button to trigger
//        var remove = $(this).attr('id');
//        removefromArray(remove);
//    });

    fRow.append(fRow); //appending row to row?
    fRow.append(fCheck);
    fRow.append(fTextBox);
    fRow.append(removeButton);
    $("#buildyourform").append(fRow);
    numOfRows++;
}