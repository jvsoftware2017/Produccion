/**
 * Created by developer on 3/03/17.
 */
$("#us_plant").change(function (event){
    $.get("/us_equipments/"+event.target.value+"",function(response,plant) {
        $("#us_equipment").empty();
        for(i=0; i<response.length; i++){
            $("#us_equipment").append("<option value='"+response[i].id+"'>"+response[i].name+"</option>");
        }
    });
});