

//fonction ajout formateur
function addGuest(tab_formateur)
{
	// var tab_formateur= ['Claude', 'Dominique'];
    if ( typeof this.I == 'undefined' ) this.I = 1;
//Element parent
	    var parent = document.getElementById("guest");
//Formulaire
//Fieldset
    	const guest = document.createElement("div");
//Bouton suppression
		const btnDelete = document.createElement("button");
		      btnDelete.id="problem"+ I.toString();
		      btnDelete.className="btnAddDate unavailable";
		      btnDelete.innerHTML="Supprimer le Formateur";
		      btnDelete.addEventListener("click", function()
          	  {
              	var problemActuel = document.getElementById("div" + I.toString());
              	parent.removeChild(guest);
          		I= I-1;
          		const IemeGuest = document.getElementById('nbGuest');
			  	      IemeGuest.value = I-1;
          	  });
//Légende
	    const spanGuest = document.createElement("span");
    	      spanGuest.innerHTML = "Formateur N° " + I.toString();
//p1
	    const labelGuest = document.createElement("label");
		      labelGuest.for =  "guest"+ I.toString();
			  
//select formateur
	    const selectGuest = document.createElement("select");
			  selectGuest.name = "guest"+ I.toString();
			  selectGuest.className = "selectFormateur";
			  selectGuest.id = "guest"+ I.toString();

//Remplissage select
			  for (var Iteration = 0; Iteration < tab_formateur.length; Iteration++)
			  {
          var option = document.createElement("option");
              option.value = tab_formateur[Iteration];
              option.text = tab_formateur[Iteration];
              selectGuest.appendChild(option);
			  }

//ajout élément
		I += 1;
//parenté
		parent.appendChild(guest);
		guest.appendChild(spanGuest);
		guest.appendChild(btnDelete);
		guest.appendChild(labelGuest);
		guest.appendChild(selectGuest);

//nbformateur
		const IemeGuest = document.getElementById('nbGuest');
		      IemeGuest.value = I-1;
}
