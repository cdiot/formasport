//fonction création formulaire creneaux
function addTimeSlot()
{
    if ( typeof this.A == 'undefined' ) this.A = 1;
//Element parent timeSlot
	    var parent = document.getElementById("timeSlot");
//Formulaire
//Fieldset
    	const timeslot = document.createElement("div");
//Bouton suppression
		const btnDelete = document.createElement("button");
		      btnDelete.id="creneaux"+ A.toString();
		      btnDelete.className="btnAddDate unavailable";
		      btnDelete.innerHTML="Supprimer le créneau";
		      btnDelete.addEventListener("click", function()
          	  {
              	var problemActuel = document.getElementById("div" + A.toString());
              	parent.removeChild(timeslot);
          		A= A-1;
          		const IemeDate = document.getElementById('nbDate');
			  	IemeDate.value = A-1;
          	  });
// légende
	    const spanTimeSlot = document.createElement("span");
    	      spanTimeSlot.innerHTML = "Creneaux N° " + A.toString();

// label date de depart
		const lblStartDate = document.createElement("label");
			  lblStartDate.for = "startDate"+A.toString();
			  lblStartDate.className = ".label-js";
			  lblStartDate.innerHTML = "Date de début:";

// input date de depart
	    const inputStartDate = document.createElement("input");
	    	  inputStartDate.type="date";
		      inputStartDate.name = "startDate"+A.toString();
		      inputStartDate.className = ".input-js";
		      inputStartDate.id = "startDate"+A.toString();

			  
// label heure de depart
        const lblStartTime = document.createElement("p");
			  lblStartTime.for =  "startTime"+A.toString();
			  lblStartTime.className = ".label-js";
              lblStartTime.innerHTML = "Heure de début:";			  

// input heure de depart
	    const inputStartTime = document.createElement("input");
	          inputStartTime.type="time";
			  inputStartTime.name = "startTime"+A.toString();
			  inputStartTime.className = ".input-js";
			  inputStartTime.id = "startTime"+A.toString();

// label date de fin
        const lblEndDate = document.createElement("label");
			  lblEndDate.for = "endDate"+A.toString();
			  lblEndDate.className = "..label-js";
              lblEndDate.innerHTML = "Date de fin:";

// input date de fin
	    const inputEndDate = document.createElement("input");
		      inputEndDate.type="date";
		      inputEndDate.name = "endDate"+A.toString();
	          inputEndDate.className = ".input-js";
	          inputEndDate.id = "endDate"+A.toString();

// label heure de fin
        const lblEndTime = document.createElement("label");
			  lblEndTime.for =  "endTime"+A.toString();
			  lblEndTime.className = ".label-js";
              lblEndTime.innerHTML = "Heure de fin:";

// input heure de fin
	    const inputEndTime = document.createElement("input");
			  inputEndTime.type="time";
			  inputEndTime.name = "endTime"+A.toString();
			  inputEndTime.className = ".input-js";
			  inputEndTime.id = "endTime"+A.toString();


//ajout élément
		A += 1;
//parentDateé
        parent.appendChild(timeslot);
		timeslot.appendChild(spanTimeSlot);
		timeslot.appendChild(btnDelete);
		timeslot.appendChild(lblStartDate);	
		timeslot.appendChild(inputStartDate);
		timeslot.appendChild(lblEndDate);
		timeslot.appendChild(inputEndDate);
		timeslot.appendChild(lblStartTime);
		timeslot.appendChild(inputStartTime);
		timeslot.appendChild(lblEndTime);
		timeslot.appendChild(inputEndTime);


//nbproblèmes
		const IemeDate = document.getElementById('nbDate');
			  IemeDate.value = A-1;
}


