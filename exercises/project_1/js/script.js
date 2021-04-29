
var i = 0;
var droneTypes;

$(function() {
    var buttonNavLeft = document.getElementById("buttonNavLeft");
    var buttonNavRight = document.getElementById("buttonNavRight");
    buttonNavLeft.addEventListener("click", displayPrevDrone);
    buttonNavRight.addEventListener("click", displayNextDrone);

    droneTypes = $(".droneType");
    refreshDroneTypes();
});

// when the client press on the right click this function will show the next drone from arr
function displayNextDrone() {
    i++;
    
    refreshDroneTypes();
}

// when the client press on the right click this function will show the privius drone from arr
function displayPrevDrone() {
    i--;
    if (i < 0)
        i += 5;
    
    refreshDroneTypes();
}

//takes all the drone type and "delete" (not the data) from html, then append function put them in the right location 
function refreshDroneTypes() {
    var parent = $("#droneTypesContainer");
    droneTypes.detach();
    parent.append(droneTypes[i%5]);
    parent.append(droneTypes[(i+1)%5]);
    parent.append(droneTypes[(i+2)%5]);
}
