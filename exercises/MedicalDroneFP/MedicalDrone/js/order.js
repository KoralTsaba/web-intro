function initialize() {
$.getJSON("js/drone.json",function(data){
        //var dr = data.drone["<?php echo $_GET['drone']; ?>"].name;
        var drType = document.getElementById('droneType');
        //var drId = drType.dataset.drone;
        drName = data.drone[drType.dataset.drone - 1].name
        drType.appendChild(document.createElement("b")).append("Drone size : " + drName);

        /* items */
        /* item1 */
        var item1 = document.getElementById('item1');
        var itemUnits = item1.dataset.units;
        var itemName = data.item[item1.dataset.type - 1].name;
        item1.append(itemName + '  x  ' + itemUnits );
        /* item2 */
        var item2 = document.getElementById('item2');
        var itemUnits = item2.dataset.units;
        if(itemUnits > 0) {
        var itemName = data.item[item2.dataset.type - 1].name;
        item2.append(itemName + '  x  ' + itemUnits );
        }
        /* item3 */
        var item3 = document.getElementById('item3');
        var itemUnits = item3.dataset.units;
        if(itemUnits > 0) {
        var itemName = data.item[item3.dataset.type - 1].name;
        item3.append(itemName + '  x  ' + itemUnits );
        }
    });
}