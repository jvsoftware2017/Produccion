/**
 * Created by developer on 3/03/17.
 */
$("#id_plant").change(function (event){
    $.get("/us_equipments/"+event.target.value+"",function(response,plant) {
        $("#id_equipment").empty();
        for(i=0; i<response.length; i++){
            $("#id_equipment").append("<option value='"+response[i].id+"'>"+response[i].name+"</option>");
        }
    });
});