// JavaScript Document

window.onscroll = function (event) {
  var headerImg = document.querySelector(".scrollblur");
    var headerImgOffset = headerImg.getBoundingClientRect();
	var imgTop = headerImgOffset.top;
	var imgBottom = headerImgOffset.bottom;
	var imgHeight = headerImg.offsetHeight;
	var viewportHeight = document.documentElement.clientHeight;
	var blur = document.getElementById("blur");
	var svgblur = blur.getElementsByTagName("feGaussianBlur")[0];
	
	var topEffectStart = Math.abs((viewportHeight - imgHeight)/5);
		if (imgTop < topEffectStart && imgBottom > 0 ) { 
			blurFactor = Math.abs(imgTop / 80);
			headerImg.style.webkitFilter = "blur(" + blurFactor + "px)";
			svgblur.setAttribute("stdDeviation", blurFactor);
						}
}
