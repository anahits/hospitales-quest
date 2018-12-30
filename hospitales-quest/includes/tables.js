
function edit_row(no) {
 document.getElementById("edit_button"+no).style.display="none";
 document.getElementById("save_button"+no).style.display="block";
	
 var name=document.getElementById("name_row"+no);
 var age=document.getElementById("age_row"+no);
	
 var name_data=name.innerHTML;
 var age_data=age.innerHTML;
 name.innerHTML='<p style="color:blue;" id="name_text'+no+'">'+name_data+'</p>';
 age.innerHTML='<p style="color:blue;" id="age_text'+no+'">'+age_data+'</p>';
}

function save_row(no) {
		var selector = document.getElementById('estudios');
 	var name_val = selector[selector.selectedIndex].value;

 var age_val=document.getElementById("new_age").value;
|||
 document.getElementById("name_row"+no).innerHTML=name_val;
 document.getElementById("age_row"+no).innerHTML=age_val;

 document.getElementById("edit_button"+no).style.display="block";
 document.getElementById("save_button"+no).style.display="none";
}

function delete_row(no) {
 document.getElementById("row"+no+"").outerHTML="";
}

function add_row() {
	alert("hoola");
	var selector = document.getElementById('estudios');
 	var new_name = selector[selector.selectedIndex].value;
 	var new_age=document.getElementById("new_age").value;
	
 	var table=document.getElementById("data_table");
 	var table_len=(table.rows.length);
 	var row = table.insertRow(table_len).outerHTML="<tr id='row"+table_len+"'>" +
 "<td id='name_row"+table_len+"'>"+new_name+"</td>"+
 "<td id='age_row"+table_len+"'>"+new_age+"</td>" +
 "<td>"+
 	"<input type='button' id='edit_button"+table_len+"' value='Edit' class='edit' onclick='edit_row("+table_len+")'>" +
  	"<input type='button' id='save_button"+table_len+"' value='Save' class='save' onclick='save_row("+table_len+")' hidden='true'>" +
   	"<input type='button' value='Delete' class='delete' onclick='delete_row("+table_len+")'>"+
 "</td>" +
 "</tr>";
}