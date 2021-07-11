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
    
    
    

    /* We tried different kind of loop and nothing worked except this */
    /* check why its not working for drone 4 and 5 */
    
    
    

    /*var dr = document.getElementById("droneLink1");
    //dr.appendChild(document.createElement("p")).append(data.drone[0].name);
    //dr.appendChild(document.createElement("div")).append("Up to " + data.drone[0].weight);
    dr.addEventListener("click", function(){
        localStorage.droneNum = 1;
    });
    var dr = document.getElementById("droneLink2");
    //dr.appendChild(document.createElement("p")).append(data.drone[1].name);
    //dr.appendChild(document.createElement("div")).append("Up to " + data.drone[1].weight);
    dr.addEventListener("click", function(){
        localStorage.droneNum = 2;
    });
    var dr = document.getElementById("droneLink3");
    //dr.appendChild(document.createElement("p")).append(data.drone[2].name);
    //dr.appendChild(document.createElement("div")).append("Up to " + data.drone[2].weight);
    dr.addEventListener("click", function(){
        localStorage.droneNum = 3;
    });
    var dr = document.getElementById("droneLink4");
    //dr.appendChild(document.createElement("p")).append(data.drone[3].name);
    //dr.appendChild(document.createElement("div")).append("Up to " + data.drone[3].weight);
    dr.addEventListener("click", function(){
        localStorage.droneNum = 4;
    });
    var dr = document.getElementById("droneLink5");
    //dr.appendChild(document.createElement("p")).append(data.drone[4].name);
    //dr.appendChild(document.createElement("div")).append("Up to " + data.drone[4].weight);
    dr.addEventListener("click", function(){
        localStorage.droneNum = 5;
    });*/
    
    /* ---------------------------------------------------------------------*/

    /* not working!!! 
    var dr = document.getElementsByClassName("droneLink");
    for (var j = 0; j < dr.length; j++) {
        dr[j].addEventListener("click", function(){
            localStorage.droneNum = j;
        });
        
    }*/

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
