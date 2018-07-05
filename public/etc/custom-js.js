// global
"use strict";
$(function(){
	$(".hoverRating").mouseover(function () {
    	if($(this).hasClass("text-warning")){
    		$(this).removeClass("text-warning");
    	}
    });
});
// end of global


// navbar
$(function(){
    $("ul.nav li a").on("mouseover mouseout", function(){
        if($(this).hasClass("text-dark")){
        	$(this).removeClass("text-dark").addClass("text-primary");
        }
        else{
        	$(this).removeClass("text-primary").addClass("text-dark");
        }
    });
});
// end of navbar

// dashboard
$(function(){
	$("div.hoverAccountSeeker").bind({
		mouseover: function(){
			$(this).css({
				"background-color" : "#ccc",
				"border-radius" : "3px 3px 5px 5px"
			});
			$(this).find("label").removeClass("text-white");
			$(this).find("i.fas").removeClass("text-white");
		},
		mouseout :function(){
			$(this).css("background-color","#6C757D");
			$(this).find("label").addClass("text-white");
			$(this).find("i.fas").addClass("text-white");
		},
	});
});
// end of dashboard

// search

	$(function(){
		$("#otherOptions").click(function(event){
			event.preventDefault();
			$("#moreOptionSearches").animate({
            	height: 'toggle'
        	},function(){
        		if($("#moreOptionSearches").css("display") == "none"){
        			$("#otherOptions").html("Show Advanced Options");
        		}
        		else{
        			$("#otherOptions").html("Hide Advanced Options");
        		}
        	});	
		});
	});

// end of search


// login
var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();

$(function(){
	var nextFirst = $("input[name=next]").first();
	nextFirst.hide();
});


$(function(){
	var nextFirst = $("input[name=next]").first();
	var content = $("#username");
	$("fieldset input:eq(0)").keyup(function(){
		var uname = $(this).val();
		var expression = /^[\w\-\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		if(expression.test(uname)){
			if(uname.trim() != ''){
				delay(function(){
					$.post("checkExist",{
						dataSend: {table: 'passer',field:'PasserEmail',data: uname}
					}, function(data, result){
						if(data >= 1){
							content.show();
							if(content.is("bg-primary")){
								content.removeClass("bg-primary");
							}
							content.addClass("bg-danger");
							content.html("Sorry, but "+ uname + " already exist!");
							nextFirst.hide();
						}
						else
							if(data ==0){
								content.show();
								if(content.hasClass("bg-danger")){
									content.removeClass("bg-danger");
								}
								content.addClass("bg-primary");
								content.html("Username available");
								content.fadeOut(2500);
							}
					});
				}, 500 );
			}
			else
				if(uname.trim() == ''){
			}
		}
		else{
			content.show();
			if(content.is("bg-primary")){
				content.removeClass("bg-primary");
			}
			content.addClass("bg-danger");
			content.html("Please input valid email address");
		}
	});
});	

$(function(){
	var content = $("#password");
	var contentre = $("#retypePassword");
	content.hide();
	contentre.hide();
	$("fieldset input:eq(1)").keyup(function(){
		var secondPass = $("fieldset input:eq(2)").val();
		var secondPassElement = $("fieldset input:eq(2)");
		var passField = $(this).val();
		var regEx = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
		var divPassRetype = $("#retypePassword");

		if(regEx.test(passField)){
				if(secondPass != passField){
					divPassRetype.show();
					if(divPassRetype.is("bg-primary")){
						divPassRetype.removeClass("bg-primary");
					}
					divPassRetype.addClass("bg-danger");
					divPassRetype.html("Password must be the sameyes!");
				}
				else{
					divPassRetype.hide();
				}
			content.show();
			if(content.hasClass("bg-danger")){
				content.removeClass("bg-danger");
			}
			content.addClass("bg-primary");
			content.html("Password Accepted");
			content.fadeOut(1000);
		}
		else{
			content.show();
			if(content.is("bg-primary")){
				content.removeClass("bg-primary");
			}
			content.addClass("bg-danger");
			content.html("Please make sure your password is atleast 8 characters with atleast 1 numeric input");
		}
	});
});


$(function(){
	var content = $("#retypePassword");
	var contentre = $("#password");
	content.hide();
	contentre.hide();
	$("fieldset input:eq(2)").keyup(function(){
		var passField = $(this).val();
		var firstPass = $("fieldset input:eq(1)").val();
		var nextFirst = $("input[name=next]").first();
		var regEx = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
		var unames = $("fieldset input:eq(0)").val();

		if(passField != firstPass || regEx.test(unames)){
			nextFirst.hide();
		}
		else
		{
		nextFirst.show();
		}
			if(passField != firstPass){
				content.show();
				if(content.is("bg-primary")){
					content.removeClass("bg-primary");
				}
				content.addClass("bg-danger");
				content.html("Password must be the same!");
				}
			else{
				content.show();
				if(content.hasClass("bg-danger")){
					content.removeClass("bg-danger");
				}
				content.addClass("bg-primary");
				content.html("Password Accepted");
				content.fadeOut(1000);
			}
	});
});

$(function(){
	$("fieldset input:eq(4)").keyup(function(){
		var dateReg = $(this).val();
		$(this).hide();

	});
});


