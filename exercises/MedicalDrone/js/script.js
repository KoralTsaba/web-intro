
var i = 0;
var droneTypes;

function initialize1() {
    var buttonNavLeft = document.getElementById("buttonNavLeft");
    var buttonNavRight = document.getElementById("buttonNavRight");
    buttonNavLeft.addEventListener("click", displayPrevDrone);
    buttonNavRight.addEventListener("click", displayNextDrone);

    /* We tried different kind of loop and nothing worked except this */
    var dr = document.getElementById("droneLink1");
    dr.addEventListener("click", function(){
        localStorage.droneNum = 1;
    });
    var dr = document.getElementById("droneLink2");
    dr.addEventListener("click", function(){
        localStorage.droneNum = 2;
    });
    var dr = document.getElementById("droneLink3");
    dr.addEventListener("click", function(){
        localStorage.droneNum = 3;
    });
    var dr = document.getElementById("droneLink4");
    dr.addEventListener("click", function(){
        localStorage.droneNum = 4;
    });
    var dr = document.getElementById("droneLink5");
    dr.addEventListener("click", function(){
        localStorage.droneNum = 5;
    });
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
    var parent = $("#droneTypesContainer");
    droneTypes.detach();
    if (mediaQuery.matches) {
        parent.append(droneTypes[i%5]);
        parent.append(droneTypes[(i+1)%5]);
        parent.append(droneTypes[(i+2)%5]); 
    }
    else
    {
        parent.append(droneTypes[i%5]);
    //     parent.append(droneTypes[(i+1)%5]);
     }
    
}



/*newDelivery.html*/

function initialize2() {
    var submitBtn = document.getElementById("submitBtn");
    //submitBtn.addEventListener("click", confirmIt,{once : true});
    submitBtn.addEventListener("click", validateForm);
    window.addEventListener("resize", formHide);

    /*------*/ 
    var chooseDrone = document.getElementById("chooseDrone");
    
    chooseDrone.selectedIndex = localStorage.droneNum;

    /* add items after item one has been filed and then after item two */
    document.getElementById("items2Container").style.display = "none";
    document.getElementById("items3Container").style.display = "none";
    var item = document.getElementById("chooseItem1");
    var units = document.getElementById("itemNumber1");
    item.addEventListener("change", addItem);
    units.addEventListener("change", addItem);
    /*item.addEventListener("change", removeItem);
    units.addEventListener("change", removeItem);*/
    var item = document.getElementById("chooseItem2");
    var units = document.getElementById("itemNumber2");
    item.addEventListener("change", addItem);
    units.addEventListener("change", addItem);

}

function confirmIt() {
    
    
    var confirm = document.createElement('div');
    confirm.id = "confirmation";
    
    confirm.appendChild(document.createElement("h2")).appendChild(document.createElement("b")).append("Your order:");
    /* create ul */
    var ul = document.createElement("ul");
    /* from li */
    var li = document.createElement("li");
    li.appendChild(document.createElement("h5")).appendChild(document.createElement("b")).append("From :");
    li.appendChild(document.createElement("h6")).append(document.querySelector('input[name=from]').value); //need input name??
    ul.appendChild(li).appendChild(document.createElement("br"));

    /* to li */
    li = document.createElement("li");
    li.appendChild(document.createElement("h5")).appendChild(document.createElement("b")).append("To :");
    li.appendChild(document.createElement("h6")).append(document.querySelector('input[name=to]').value); //need input name??
    ul.appendChild(li).appendChild(document.createElement("br"));

    /*  drone li */
    li = document.createElement("li");
    li.appendChild(document.createElement("h5")).appendChild(document.createElement("b")).append("Drone type :");
    li.appendChild(document.createElement("h6")).append(document.getElementById("chooseDrone").value); //need input name??
    ul.appendChild(li).appendChild(document.createElement("br"));

    /*  items + number li */
    li = document.createElement("li");
    li.appendChild(document.createElement("h5")).appendChild(document.createElement("b")).append("Items :");
    var item = document.getElementById("itemNumber1").value + "     " + document.getElementById("chooseItem1").value;
    li.appendChild(document.createElement("h6")).append(item);
    var item = document.getElementById("itemNumber2").value + "     " + document.getElementById("chooseItem2").value;
    li.appendChild(document.createElement("h6")).append(item);
    var item = document.getElementById("itemNumber3").value + "     " + document.getElementById("chooseItem3").value;
    li.appendChild(document.createElement("h6")).append(item);
    ul.appendChild(li).appendChild(document.createElement("br"));
    
     /*  notes li */
     li = document.createElement("li");
     li.appendChild(document.createElement("h5")).appendChild(document.createElement("b")).append("Notes :");
     li.appendChild(document.createElement("h6")).append(document.getElementById("notes").value);
     ul.appendChild(li).appendChild(document.createElement("br"));

     confirm.appendChild(ul);

     /* confirm button */
     var confBtn = document.createElement("div");
     confBtn.id = "ConfirmationBtn";
     var btn = document.createElement('button');
     btn.className = "btn btn-primary";
     btn.setAttribute("type", "submit");
     btn.append("Confirmation");
     confBtn.appendChild(btn);
     confirm.appendChild(confBtn);

    /* cancel button */
    var confBtn = document.createElement("div");
     confBtn.id = "CanceleBtn";
     var btn = document.createElement('button');
     btn.className = "btn btn-primary";
     btn.setAttribute("type", "button");
     btn.append("Cancel");
     confBtn.appendChild(btn);
     confBtn.addEventListener("click", goback,{once : true});
     confirm.appendChild(confBtn);


     var wrap = document.getElementById("orderWrapper");
     var form = document.getElementsByTagName("form")[0];
     form.insertAdjacentElement("afterend", confirm);

     /*make form disapear on phone*/
     var mediaQuery = window.matchMedia('(max-width: 900px)');
     if (mediaQuery.matches)
        form.style.display = "none";


    /*NEW */
    document.getElementById("submitBtn").style.display = "none";
    /*document.getElementById("submitBtn").removeEventListener("click", validateForm);*/
}

function goback() {
    var confirm = document.getElementById("confirmation");
    confirm.remove();
    var submitBtn = document.getElementById("submitBtn");
    submitBtn.style.display = "";
    var form = document.getElementsByTagName("form")[0];
    form.style.display = "block";
    submitBtn.addEventListener("click", validateForm);
}

/* responsive - hide and show form */
function formHide() {
    var element = document.getElementById("confirmation");
    var form = document.getElementsByTagName("form")[0];
    var mediaQuery = window.matchMedia('(max-width: 900px)');
     if (mediaQuery.matches && typeof(element) != 'undefined' && element != null)
        form.style.display = "none";
    else
        form.style.display = "block";
}


function validateForm() {
    var form = document.getElementById("deliveryForm");
    var msg = "";
         msg = !form.from.validity.valid  ? msg + "From where ?\n" : msg;
         msg = !form.to.validity.valid ? msg + "To where ?\n" : msg;
         msg = form.chooseDrone.value == "" ? msg + "Choose Drone type ?\n" : msg;
         if ((form.chooseItem1.value == "" && form.itemNumber1.value == "") || 
                    (form.chooseItem1.value == "" && form.itemNumber1.value != "") || 
                            (form.chooseItem1.value != "" && form.itemNumber1.value == ""))
            msg =  msg + "Choose Item one type and Item one units\n" ;
         if ((form.chooseItem2.value == "" && form.itemNumber2.value != "") || 
                    (form.chooseItem2.value != "" && form.itemNumber2.value == ""))
            msg =  msg + "Choose Item two type and Item two units\n" ;
         if ((form.chooseItem3.value == "" && form.itemNumber3.value != "") || 
                    (form.chooseItem3.value != "" && form.itemNumber3.value == ""))
            msg =  msg + "Choose Item three type and Item three units\n" ;

    if( msg == "") {
        confirmIt();
        document.getElementById("submitBtn").removeEventListener("click", validateForm);
     }
     else {
        alert( "Please fill correct the following: \n" + msg);
        //document.myForm.Name.focus() ;
     }
  }

  function addItem() {
    var form = document.getElementById("deliveryForm");
    if(form.chooseItem1.value != "" && form.itemNumber1.value != "")
    {
        document.getElementById("items2Container").style.display = "";

    }
    if(form.chooseItem2.value != "" && form.itemNumber2.value != "")
    {
        document.getElementById("items3Container").style.display = "";

    }    
  }

  /*function removeItem() {
    var form = document.getElementById("deliveryForm");
    if(form.chooseItem2.value == "" && form.itemNumber2.value == "0")
    {
        document.getElementById("items2Container").style.display = "none";

    }
    if(form.chooseItem3.value == "" && form.itemNumber3.value == "")
    {
        document.getElementById("items3Container").style.display = "none";

    }    
  }*/