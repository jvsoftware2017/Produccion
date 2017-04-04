/**
 * Created by developer on 3/03/17.
 */
$("#id_user").change(function (event){
	var ip = $('#id_plant'+event.target.value).val();
    $.get("/us_equipments/"+ip,function(response,plant) {
        $("#id_equipment").empty();
        for(i=0; i<response.length; i++){
            $("#id_equipment").append("<option value='"+response[i].id+"'>"+response[i].name+"</option>");
        }
    });
});

$("#id_client").change(function (event){
    $.get("/clientPlants/"+event.target.value+"",function(response,plant) {
        $("#id_plant").empty();
        for(i=0; i<response.length; i++){
            $("#id_plant").append("<option value='"+response[i].id+"'>"+response[i].name+"</option>");
        }
    });
});

$("#id_client_editModal").change(function (event){
    $.get("/clientPlants/"+event.target.value+"",function(response,plant) {
        $("#id_plant_editModal").empty();
        for(i=0; i<response.length; i++){
            $("#id_plant_editModal").append("<option value='"+response[i].id+"'>"+response[i].name+"</option>");
        }
    });
});