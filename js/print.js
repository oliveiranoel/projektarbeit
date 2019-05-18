(function() {
	window.onbeforeprint = function() {
		var collapsibles = document.getElementsByClassName("collapse");
		for(let item of collapsibles) {
			item.classList.add("show");
		}
		
		var glyphi = document.getElementsByClassName("tool");
		for(let item of glyphi) {
			item.style.display = "none";
		}
	}
	
	window.onafterprint = function() {
		var collapsibles = document.getElementsByClassName("collapse");
		for(let item of collapsibles) {
			item.classList.remove("show");
		}
		
		var glyphi = document.getElementsByClassName("tool");
		for(let item of glyphi) {
			item.style.display = "inline-block";
		}
	}
})();
