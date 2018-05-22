$(document).ready(function(){
	$("img.lazy").unveil(200, function() {
		$(this).load(function() {
    		this.style.opacity = 1;
		});
	});
});
