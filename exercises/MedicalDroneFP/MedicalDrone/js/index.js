var i = 0;
var droneTypes;

function initialize() {
    var buttonNavLeft = document.getElementById("buttonNavLeft");
    var buttonNavRight = document.getElementById("buttonNavRight");
    buttonNavLeft.addEventListener("click", displayPrevDrone);
    buttonNavRight.addEventListener("click", displayNextDrone);


    $.getJSON("js/drone.json",function(data){
        for(var j = 1; j <=5; j++ ) {
            var dr = document.getElementById("droneLink" + j);
            console.log(dr);
            dr.appendChild(document.createElement("p")).append(data.drone[j - 1].name);
            dr.appendChild(document.createElement("div")).append("Up to " + data.drone[j - 1].weight);
        }
    });

    for(var j = 1; j <=5; j++ ) {
        var dr = document.getElementById("droneLink" + j);
        dr.addEventListener("click", function(){
            //localStorage.droneNum = j;
            localStorage.setItem('droneNum', j);
        });
    }
    



    droneTypes = $(".droneType");
    refreshDroneTypes();

    window.addEventListener("resize", refreshDroneTypes);
    
}

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
    /*NEW*/
    var mediaQuery = window.matchMedia('(min-width: 900px)');
    
     //var parent = $("#droneTypesContainer");
    //droneTypes.detach();
    for(var j = 1; j <= 5; j++) {
        document.getElementById("dron" + j).style.display = "none";
    }
    if (mediaQuery.matches) {
        //var k = "dron" + i%5;
        document.getElementById("dron" + (i%5 + 1)).style.display = "";
        document.getElementById("dron" + ((i+1)%5 + 1)).style.display = "";
        document.getElementById("dron" + ((i+2)%5 + 1)).style.display = "";
        // parent.append(droneTypes[i%5]);
        // parent.append(droneTypes[(i+1)%5]);
        // parent.append(droneTypes[(i+2)%5]); 
    }
    else
    {
        document.getElementById("dron" + (i%5 + 1)).style.display = "";
        //parent.append(droneTypes[i%5]);
    //     parent.append(droneTypes[(i+1)%5]);
     }
    
}
