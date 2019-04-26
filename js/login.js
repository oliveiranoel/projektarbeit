(function () {
	var items = document.getElementsByClassName( "form-control" );
	for ( let item of items )
	{
		item.classList.add( "is-invalid" );
	}
})();
