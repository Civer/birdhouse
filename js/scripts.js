function toggleSubcategory(id) {
    var subCat = "#subCat"+id;
    $(subCat).slideToggle("slow");
}

function toggleCategory(id) {
    var cat = "#cat"+id;
    $(cat).slideToggle("slow");
}

function toggleInactive() {
    $("#inactive").slideToggle("slow");
}

function toggleInactiveSubcategories() {
    $("#inactiveSubcategories").slideToggle("slow");
}

function toggleMenu() {
    $("#mobileNavigation").slideToggle();
}

function toggleSearch() {
    $("#searchDiv").slideToggle();
}

function pushDown(row) {
    var rowId = "#"+row;
    jQuery(rowId).next().after(jQuery(rowId));
}

function pushUp(row) {
    var rowId = "#"+row;
    console.log(rowId);
    jQuery(rowId).prev().before(jQuery(rowId));
}

function activateNotification(user, admin) {

    Pusher.logToConsole = true;

    var pusher = new Pusher('5328c62d9a4b338f7c70', {
      cluster: 'eu',
      encrypted: true
    });

    if(admin) {
        var channelAdmin = pusher.subscribe('adminInformation');

        channelAdmin.bind('newCocktail', function(data) {
            swal({
                title: data.title,
                text: data.message,
                confirmButtonColor: "#4A4944"
            });
        });
    }

    var channel = pusher.subscribe('user_'+user);

    channel.bind('cocktailReady', function(data) {
      swal({
          title: data.title,
          text: data.message,
          confirmButtonColor: "#4A4944"
      });
    });
}

function cocktailInformation(array, notes) {

    var html = createCocktailHTML(array, notes);

    //console.log("Test: "+" - "+ array.name +" - "+JSON.stringify(array));

    swal({
        title: array.name,
        text: html,
        html: true,
        confirmButtonColor: "#4A4944",
        //showCancelButton: true,
        //confirmButtonColor: "#DD6B55",
        //confirmButtonText: "Yes, delete it!",
        //closeOnConfirm: false
      //},
      //function(){
      //window.location = 'index.php?page=myOrders&'
      });

}

function createCocktailHTML(array) {
    var string = "";

    if(array.notes) {
        string = "<p style='color: black'>Anmerkungen: <b>"+array.notes+"</b></p><br />";
    }
    else {
        string = "Keine Anmerkungen<br /><br />"
    }

    string+= "<table class='baseTable'>";
    string+= "<tr class='header'><td>Zutat</td><td>Anmerkung</td></tr>";

    if(array.ingr1) {
        string = string + "<tr class='center'><td>" + array.ingr1 + "</td>";
        string = string + "<td>" + array.ingr1_admin + "</td></tr>";
    }
    if(array.ingr2) {
        string = string + "<tr class='center'><td>" + array.ingr2 + "</td>";
        string = string + "<td>" + array.ingr2_admin + "</td></tr>";
    }
    if(array.ingr3) {
        string = string + "<tr class='center'><td>" + array.ingr3 + "</td>";
        string = string + "<td>" + array.ingr3_admin + "</td></tr>";
    }
    if(array.ingr4) {
        string = string + "<tr class='center'><td>" + array.ingr4 + "</td>";
        string = string + "<td>" + array.ingr4_admin + "</td></tr>";
    }
    if(array.ingr5) {
        string = string + "<tr class='center'><td>" + array.ingr5 + "</td>";
        string = string + "<td>" + array.ingr5_admin + "</td></tr>";
    }
    if(array.ingr6) {
        string = string + "<tr class='center'><td>" + array.ingr6 + "</td>";
        string = string + "<td>" + array.ingr6_admin + "</td></tr>";
    }
    if(array.ingr7) {
        string = string + "<tr class='center'><td>" + array.ingr7 + "</td>";
        string = string + "<td>" + array.ingr7_admin + "</td></tr>";
    }
    if(array.ingr8) {
        string = string + "<tr class='center'><td>" + array.ingr8 + "</td>";
        string = string + "<td>" + array.ingr8_admin + "</td></tr>";
    }

    string+= "</table>";

    return string;
}
