/*newDelivery.html*/


function initialize() {
    var submitBtn = document.getElementById("submitBtn");
    //submitBtn.addEventListener("click", confirmIt,{once : true});
    submitBtn.addEventListener("click", validateForm);
    window.addEventListener("resize", formHide);

    /*---local storage give problem---*/ 
    var chooseDrone = document.getElementById("chooseDrone");
    droneNum = localStorage.getItem("droneNum"); 
    /*---local storage give problem---*/ 

    //chooseDrone.selectedIndex = localStorage.droneNum;

    /*---local storage give problem---*/ 
    //chooseDrone.selectedIndex = droneNum;
    /*---local storage give problem---*/ 


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

    /* INSERT - incase of edit where its already fill */
    addItem();
    makeSelected(document.getElementById("chooseDrone"));
    makeSelected(document.getElementById("chooseItem1"));
    makeSelected(document.getElementById("chooseItem2"));
    makeSelected(document.getElementById("chooseItem3"));
    addItem();

    $.getJSON("js/drone.json",function(data){
        for(var j = 1; j <=5; j++ ) {
            var dr = document.getElementById("droneOp" + j).append(data.drone[j - 1].name + ' - Up to ' + data.drone[j - 1].weight);
        }

        for (var i = 1; i <= 3; i++) {  
            var item = document.getElementById('chooseItem' + i);
            for ( var j = 1, len = item.options.length; j < len; j++ ) {
                item.options[j].append(data.item[j-1].name);
            }
        }

    });  
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
    var sel = document.getElementById("chooseDrone");
    li.appendChild(document.createElement("h6")).append(sel.options[sel.selectedIndex].text); //need input name??
    ul.appendChild(li).appendChild(document.createElement("br"));

    /* Date li */
    li = document.createElement("li");
    li.appendChild(document.createElement("h5")).appendChild(document.createElement("b")).append("Delivery time :");
    li.appendChild(document.createElement("h6")).append(document.querySelector('input[name=date]').value);
    ul.appendChild(li).appendChild(document.createElement("br"));

    /*  items + number li */
    li = document.createElement("li");
    li.appendChild(document.createElement("h5")).appendChild(document.createElement("b")).append("Items :");
    var sel = document.getElementById("chooseItem1");
    var item = document.getElementById("itemNumber1").value + "     " + sel.options[sel.selectedIndex].text;
    li.appendChild(document.createElement("h6")).append(item);
    var sel = document.getElementById("chooseItem2");
    var item = document.getElementById("itemNumber2").value + "     " + sel.options[sel.selectedIndex].text;
    li.appendChild(document.createElement("h6")).append(item);
    var sel = document.getElementById("chooseItem3");
    var item = document.getElementById("itemNumber3").value + "     " + sel.options[sel.selectedIndex].text;
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
     btn.setAttribute("form", "deliveryForm");
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

     /* float clear */
     var clear = document.createElement("div");
     clear.id = "clear";
     confirm.appendChild(clear);


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
         msg = !form.date.validity.valid ? msg + "Delivery time ?\n" : msg;
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

  function makeSelected (selectObj) {
    //const selectObj = document.querySelector('#cat');
    ind = selectObj.dataset.selected;
    console.log(ind);
    //selectObj.options[ind].selected = true;
    selectObj.value = ind;
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