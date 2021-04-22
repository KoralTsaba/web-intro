var colors = ["#00ffff","#7fffd4","#F0F8FF","#6495ED","#008B8B","#8FBC8F","#D2691E","#FFF8DC"];
var lastName = "tsaba";
var squares = [];


function start() {
    for (i = 0; i < lastName.length * 2; i++) {
        addSquareToPage();
    }

    var plusButton = document.createElement("a");
    plusButton.innerText = "+";
    plusButton.addEventListener("click", addSquareToPage);

    plusButton.className = "plus_button";

    squares[0].appendChild(plusButton);
    squares[0].style.textAlign = "center";
}

function getRandomColor() {
    var index = Math.round(Math.random() * colors.length);
    return colors[index];
}

function addSquareToPage() {
    var addStar = (squares.length + 1) % 3 == 0;
    var isFirst = squares.length == 0;
    var isClickable = !isFirst;
    var newSquare = createSquare(addStar, isClickable);
    var parent = document.getElementById("main3");
    parent.appendChild(newSquare);

    squares.push(newSquare);
}

function createSquare(addStar, isClickable) {
    var newSquare = document.createElement("div");

    newSquare.className = "square_main3_unclicked";
    newSquare.style.backgroundColor = getRandomColor();

    if (addStar){
        var starElement = document.createElement("div");
        starElement.className = "star";
        newSquare.appendChild(starElement);
    }

    if (isClickable) {
        newSquare.addEventListener("click", function (){
            var isClicked = newSquare.className == "square_main3_clicked";
            if (isClicked)
                newSquare.className = "square_main3_unclicked";
            else
                newSquare.className = "square_main3_clicked";
        });
    }

    return newSquare;
}