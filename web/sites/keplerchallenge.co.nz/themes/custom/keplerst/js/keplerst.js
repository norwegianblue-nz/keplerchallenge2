(function ($) {

  "use strict";
  
  Drupal.behaviors.customBehavior = {
    // perform jQuery as normal in here
  };
  
})(jQuery);
var $jq = jQuery.noConflict();
/*
 * Add class when scrolled
*/
$jq(document).on("scroll", function(){
	if($jq(document).scrollTop() > 100){
	  $jq("#page").addClass("scrolled");
	}
	else
	{
		$jq("#page").removeClass("scrolled");
	}
});
/*
 * Toggle 'expand' when a button clicked
 */
$jq('.tool-bar-icon-login').click(function(){
    if($jq('#block-keplerst-search').hasClass("expand")){
        $jq('#block-keplerst-search').toggleClass("expand");
        $jq('.tool-bar-icon-search').toggleClass("clicked");
    }
    if($jq('#block-toolbarinfo').hasClass("expand")){
        $jq('#block-toolbarinfo').toggleClass("expand");
        $jq('.tool-bar-icon-info').toggleClass("clicked");
    }
    $jq('#block-userlogin').toggleClass("expand");
    $jq(this).toggleClass("clicked");
});
$jq('.tool-bar-icon-search').click(function(){
    if($jq('#block-userlogin').hasClass("expand")){
        $jq('#block-userlogin').toggleClass("expand");
        $jq('.tool-bar-icon-login').toggleClass("clicked");
    }
    if($jq('#block-toolbarinfo').hasClass("expand")){
        $jq('#block-toolbarinfo').toggleClass("expand");
        $jq('.tool-bar-icon-info').toggleClass("clicked");
    }
    $jq('#block-keplerst-search').toggleClass("expand");
    $jq(this).toggleClass("clicked");
});
$jq('.tool-bar-icon-info').click(function(){
    if($jq('#block-keplerst-search').hasClass("expand")){
        $jq('#block-keplerst-search').toggleClass("expand");
        $jq('.tool-bar-icon-search').toggleClass("clicked");
    }
    if($jq('#block-userlogin').hasClass("expand")){
        $jq('#block-userlogin').toggleClass("expand");
        $jq('.tool-bar-icon-login').toggleClass("clicked");
    }
    $jq('#block-toolbarinfo').toggleClass("expand");
    $jq(this).toggleClass("clicked");
});
/*
 * Switch the background image for the div with class .background-slider
 * dependant on the image list passed in via HTML5 data attribute.
 * 
 */
(function($) {

    $(document).ready(function () {

        //** Background Image Slider **//
        //Set Variables
        var backgroundImageSlider = $('.background-slider');
                    
        //Create image URL array and variables
        var backgroundImageData = backgroundImageSlider.attr('data-background-image-list');
        var backgroundImageList = backgroundImageData.split(',');
        var backgroundImageCount = backgroundImageList.length -1;
        var backgroundImageLast = backgroundImageCount -1;
        
        var i = 2; // Use 2 image first, as first is displayed before Javascript
                   // changes anything
        
        //Loop through the image URL's array and Background color array
        var delayTime = 8000; // This is the delay before the loop is started
        
        (function theLoop (i) {
            setTimeout(function () {
                backgroundImageSlider.fadeTo(2000, 0 , function()
                {
                    $(this).attr('style', 'background-image: url(' + backgroundImageList[i - 1] + ') ; opacity: 0');
                    $(this).fadeTo(2000, 1);
                });

                delayTime = 10000;

                if (--i) {
                    theLoop(i);
                }
                if (i === 0) {
                    i = backgroundImageCount;
                    theLoop(i);
                }
            }, delayTime);
        })(backgroundImageCount);
        
    });

}($jq));