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

for (j = 1; j < 20; j++) { // buscar cantidad de usuarios

	$("#id_client_editModal-"+j).change(function (event){
		var arrVar = event.target.id.split("-");
	    $.get("/clientPlants/"+event.target.value+"",function(response,plant) {
	        $("#id_plant_editModal" + arrVar[1]).empty();
	        for(i=0; i<response.length; i++){
	            $("#id_plant_editModal" + arrVar[1]).append("<option value='"+response[i].id+"'>"+response[i].name+"</option>");
	        }
	    });
});
}

$("#id_equipoRep").change(function (event){
    window.location.href = "/report/"+event.target.value+"";
});


$('#datatable').dataTable( {
    "paging": true
} );

function getPlant (id) {
	$.get("/plants/" + id + "", function(data, status){
        $("#edit-item").html(data);
    });
}

function habilitar(){
        $("#id_equipoRep").disabled = false;
    }
    
window.onload = habilitar();
