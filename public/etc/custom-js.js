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




$(function(){
	$('fieldset input[type=submit]').on("keypress", function(e) {
         var keycode = (e.keyCode ? e.keyCode : e.which);
	     if (keycode == '13') {
	       alert('You pressed enter! - keypress');
	     }
    });
});




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


// password
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
		var nextFirst = $("input[name=next]").first();
		var unames = $("fieldset input:eq(0)").val();

		if(regEx.test(passField)){
				if(secondPass != passField){
					divPassRetype.show();
					if(divPassRetype.is("bg-primary")){
						divPassRetype.removeClass("bg-primary");
					}
					divPassRetype.addClass("bg-danger");
					divPassRetype.html("Password must be the same!");
					nextFirst.hide();
				}
				else{
					divPassRetype.hide();
					nextFirst.show();
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
			nextFirst.hide();
		}
	});
});
// end of password

// retype
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
		if(passField != "" && firstPass !=""){
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
		}
		else{
			if(passField != firstPass){
					content.show();
					if(content.is("bg-primary")){
						content.removeClass("bg-primary");
					}
					content.addClass("bg-danger");
					content.html("Password must be the same!");
					nextFirst.hide();
					}
		}
	});
});
// end of retype


// birthdate
$(function(){
	var nextSecond = $("input[name=next]:eq(1)");
	nextSecond.hide();
	$("fieldset input:eq(4)").keyup(function(){
		var nextSecond = $("input[name=next]:eq(1)");
		nextSecond.hide();
		var errorDate = $("#birthdateReg");
		var dateReg = $(this).val();
		if(isNaN(Date.parse(dateReg))){
			errorDate.show();
			if(errorDate.is("bg-primary")){
				errorDate.removeClass("bg-primary");
			}
			nextSecond.hide();
			errorDate.addClass("bg-danger");
			errorDate.html("Please input complete date");
				
		}
		else{
			errorDate.show();
			if(errorDate.hasClass("bg-danger")){
				errorDate.removeClass("bg-danger");
			}
			nextSecond.show();
			errorDate.addClass("bg-primary");
			errorDate.html("Date accepted");
			errorDate.fadeOut(1000);
		}
	});
});
// end of birthdate

// address
$(function(){
	var nextThird = $("input[name=next]:eq(2)");
	nextThird.hide();
	var content = $("#pcodeDiv");
	content.hide();
	$("fieldset input:eq(9)").keyup(function(){
		var nextThird = $("input[name=next]:eq(2)");
		var postCode = $(this);
		var content = $("#pcodeDiv");
		var regex = /^[0-9]{4}$/
		// var address = $("fieldset input:eq(7)");
		// var city = $("fieldset input:eq(8)");
		content.hide();
		if(regex.test(postCode.val())){
			content.show();
			if(content.hasClass("bg-danger")){
				content.removeClass("bg-danger");
			}
			nextThird.show();
			content.addClass("bg-primary");
			content.html("Postal Code accepted");
			content.fadeOut(1000);
		}
		else{
			content.show();
			if(content.is("bg-primary")){
				content.removeClass("bg-primary");
			}
			nextThird.hide();
			content.addClass("bg-danger");
			content.html("Please input valid post code(e.g 6000)");
		}
		
	});
});
//end of address 


// idno
	$(function(){
	var nextFourth = $("input[name=next]:eq(3)");
	nextFourth.hide();
	var content = $("#idno");
	content.hide();
	$("fieldset input:eq(13)").keyup(function(){
		var nextFourth = $("input[name=next]:eq(3)");
		var postCode = $(this);
		var content = $("#idno");
		var regex = /^[0-9]*$/
		// var address = $("fieldset input:eq(7)");
		// var city = $("fieldset input:eq(8)");
		nextFourth.hide();
		content.hide();
		if(postCode.val() != ""){
			if(regex.test(postCode.val())){
				content.show();
				if(content.hasClass("bg-danger")){
					content.removeClass("bg-danger");
				}
				nextFourth.show();
				content.addClass("bg-primary");
				content.html("ID number accepted");
				content.fadeOut(1000);
			}
			else{
				content.show();
				if(content.is("bg-primary")){
					content.removeClass("bg-primary");
				}
				nextFourth.hide();
				content.addClass("bg-danger");
				content.html("Please input valid ID number");
			}
		}
		
	});
});
// end of idno


// cocno
$(function(){
	var content = $("#COCno");
	content.hide();
	var submitButton = $("input:eq(19)");
	submitButton.hide();
	$("fieldset input:eq(16)").keyup(function(){
		var submitButton = $("input:eq(19)");
		var postCode = $(this);
		var content = $("#COCno");
		var regex = /^[0-9]{14}$/
		// var address = $("fieldset input:eq(7)");
		// var city = $("fieldset input:eq(8)");
		content.hide();
		submitButton.hide();
		if(postCode.val() != ""){
			if(regex.test(postCode.val())){
				content.show();
				if(content.hasClass("bg-danger")){
					content.removeClass("bg-danger");
				}
				submitButton.show();
				content.addClass("bg-primary");
				content.html("COC number accepted");
				content.fadeOut(1000);
			}
			else{
				content.show();
				if(content.is("bg-primary")){
					content.removeClass("bg-primary");
				}
				submitButton.hide();
				content.addClass("bg-danger");
				content.html("Please input 14 digit COC number");
			}
		}
		
	});
});
// end of cocno
