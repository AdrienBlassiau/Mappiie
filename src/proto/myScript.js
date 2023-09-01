

/**
 * [changeFont description]
 * @param  {[type]} p1 [description]
 * @param  {[type]} p2 [description]
 * @return {[type]}    [description]
 */
 function personne(id) {

	var personne = {
		firstname : 'John',
		lastname : "Doe" ,
	};

	document.getElementById(id).innerHTML = personne.firstname + " " + personne.lastname +" " + typeof "";
}
