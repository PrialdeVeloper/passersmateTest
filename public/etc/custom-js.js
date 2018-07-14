// global
"use strict";




$(function(){
	$('.datepicker').datepicker({
	    uiLibrary: 'bootstrap4'
	});
});

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


// $(function(){
// 	let data;
// 	$("#msform").bind({
// 		submit: function(event){
// 			event.preventDefault();
// 			data = $(this).serialize();
// 			$.ajax({
// 				url:"qweqwe",
// 				type:"POST",
// 				data: data,
// 				success: function(dataret,resultret){
// 					let obj = jQuery.parseJSON(dataret);
// 					console.log(obj.data.email);
// 				}
// 			});	
// 		}
// 	});
// });


var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();

// $(function(){
// 	var nextFirst = $("input[name=next]").first();
// 	nextFirst.hide();
// });

// $(function(){
// 	var nextFirst = $("input[name=next]").first();
// 	var content = $("#username");
// 	$("fieldset input:eq(0)").keyup(function(){
// 		var uname = $(this).val();
// 		var expression = /^[\w\-\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
// 		if(expression.test(uname)){
// 			if(uname.trim() != ''){
// 				delay(function(){
// 					$.post("checkExist",{
// 						dataSend: {table: 'passer',field:'PasserEmail',data: uname}
// 					}, function(data, result){
// 						if(data >= 1){
// 							content.show();
// 							if(content.is("bg-primary")){
// 								content.removeClass("bg-primary");
// 							}
// 							content.addClass("bg-danger");
// 							content.html("Sorry, but "+ uname + " already exist!");
// 							nextFirst.hide();
// 						}
// 						else
// 							if(data ==0){
// 								content.show();
// 								if(content.hasClass("bg-danger")){
// 									content.removeClass("bg-danger");
// 								}
// 								content.addClass("bg-primary");
// 								content.html("Username available");
// 								content.fadeOut(2500);
// 							}
// 					});
// 				}, 500 );
// 			}
// 			else
// 				if(uname.trim() == ''){
// 			}
// 		}
// 		else{
// 			content.show();
// 			if(content.is("bg-primary")){
// 				content.removeClass("bg-primary");
// 			}
// 			content.addClass("bg-danger");
// 			content.html("Please input valid email address");
// 		}
// 	});
// });	


// // password
// $(function(){
// 	var content = $("#password");
// 	var contentre = $("#retypePassword");
// 	content.hide();
// 	contentre.hide();
// 	$("fieldset input:eq(1)").keyup(function(){
// 		var secondPass = $("fieldset input:eq(2)").val();
// 		var secondPassElement = $("fieldset input:eq(2)");
// 		var passField = $(this).val();
// 		var regEx = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
// 		var divPassRetype = $("#retypePassword");
// 		var nextFirst = $("input[name=next]").first();
// 		var unames = $("fieldset input:eq(0)").val();

// 		if(regEx.test(passField)){
// 				if(secondPass != passField){
// 					divPassRetype.show();
// 					if(divPassRetype.is("bg-primary")){
// 						divPassRetype.removeClass("bg-primary");
// 					}
// 					divPassRetype.addClass("bg-danger");
// 					divPassRetype.html("Password must be the same!");
// 					nextFirst.hide();
// 				}
// 				else{
// 					divPassRetype.hide();
// 					nextFirst.show();
// 				}
// 			content.show();
// 			if(content.hasClass("bg-danger")){
// 				content.removeClass("bg-danger");
// 			}
// 			content.addClass("bg-primary");
// 			content.html("Password Accepted");
// 			content.fadeOut(1000);
// 		}
// 		else{
// 			content.show();
// 			if(content.is("bg-primary")){
// 				content.removeClass("bg-primary");
// 			}
// 			content.addClass("bg-danger");
// 			content.html("Please make sure your password is atleast 8 characters with atleast 1 numeric input");
// 			nextFirst.hide();
// 		}
// 	});
// });
// // end of password

// // retype
// $(function(){
// 	var content = $("#retypePassword");
// 	var contentre = $("#password");
// 	content.hide();
// 	contentre.hide();
// 	$("fieldset input:eq(2)").keyup(function(){
// 		var passField = $(this).val();
// 		var firstPass = $("fieldset input:eq(1)").val();
// 		var nextFirst = $("input[name=next]").first();
// 		var regEx = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
// 		var unames = $("fieldset input:eq(0)").val();
// 		if(passField != "" && firstPass !=""){
// 			if(passField != firstPass || regEx.test(unames)){
// 				nextFirst.hide();
// 			}
// 			else
// 			{
// 			nextFirst.show();
// 			}
// 				if(passField != firstPass){
// 					content.show();
// 					if(content.is("bg-primary")){
// 						content.removeClass("bg-primary");
// 					}
// 					content.addClass("bg-danger");
// 					content.html("Password must be the same!");
// 					}
// 				else{
// 					content.show();
// 					if(content.hasClass("bg-danger")){
// 						content.removeClass("bg-danger");
// 					}
// 					content.addClass("bg-primary");
// 					content.html("Password Accepted");
// 					content.fadeOut(1000);
// 				}
// 		}
// 		else{
// 			if(passField != firstPass){
// 					content.show();
// 					if(content.is("bg-primary")){
// 						content.removeClass("bg-primary");
// 					}
// 					content.addClass("bg-danger");
// 					content.html("Password must be the same!");
// 					nextFirst.hide();
// 					}
// 		}
// 	});
// });
// // end of retype


// // birthdate
// $(function(){
// 	var nextSecond = $("input[name=next]:eq(1)");
// 	nextSecond.hide();
// 	$("fieldset input:eq(4)").change(function(){
// 		var nextSecond = $("input[name=next]:eq(1)");
// 		nextSecond.hide();
// 		var errorDate = $("#birthdateReg");
// 		var dateReg = $(this).val();
// 		if(isNaN(Date.parse(dateReg))){
// 			errorDate.show();
// 			if(errorDate.is("bg-primary")){
// 				errorDate.removeClass("bg-primary");
// 			}
// 			nextSecond.hide();
// 			errorDate.addClass("bg-danger");
// 			errorDate.html("Please input complete date");
				
// 		}
// 		else{
// 			errorDate.show();
// 			if(errorDate.hasClass("bg-danger")){
// 				errorDate.removeClass("bg-danger");
// 			}
// 			nextSecond.show();
// 			errorDate.addClass("bg-primary");
// 			errorDate.html("Date accepted");
// 			errorDate.fadeOut(1000);
// 		}
// 	});
// });
// // end of birthdate


// // address
// $(function(){
// 	var addressDiv = $("#addressDiv");
// 	addressDiv.hide();
// 	$("fieldset input:eq(7)").keyup(function(){
// 		var city = $("fieldset input:eq(8)")
// 		var address = $(this);
// 		var nextThird = $("input[name=next]:eq(2)");
// 		var addressDiv = $("#addressDiv");
// 		var cityDiv = $("#cityDiv");
// 		var postDiv = $("#pcodeDiv");
// 		addressDiv.hide();
// 		if(address.val() == ""){
// 			addressDiv.show();
// 			if(addressDiv.is("bg-primary")){
// 				addressDiv.removeClass("bg-primary");
// 			}
// 			nextThird.hide();
// 			addressDiv.addClass("bg-danger");
// 			addressDiv.html("Please input valid address");
// 		}
// 		else{
// 			if(checkEmpty(city) == false || checkRegex(/^[0-9]{4}$/,"fieldset input:eq(9)") == false){
// 				if(checkRegex(/^[0-9]{4}$/,"fieldset input:eq(9)") == false){
// 					postDiv.show();
// 					if(postDiv.is("bg-primary")){
// 					postDiv.removeClass("bg-primary");
// 					}
// 					nextThird.hide();
// 					postDiv.addClass("bg-danger");
// 					postDiv.html("Please input valid post code(e.g 6000)");
// 				}

// 				if(checkEmpty(city) == false){
// 					cityDiv.show();
// 					if(cityDiv.is("bg-primary")){
// 						cityDiv.removeClass("bg-primary");
// 					}
// 					nextThird.hide();
// 					cityDiv.addClass("bg-danger");
// 					cityDiv.html("Please input valid city");
// 				}
// 			}
// 			else{
// 				nextThird.show();
// 			}
// 			addressDiv.show();
// 			if(addressDiv.hasClass("bg-danger")){
// 				addressDiv.removeClass("bg-danger");
// 			}
// 			addressDiv.addClass("bg-primary");
// 			addressDiv.html("Address accepted");
// 			addressDiv.fadeOut(1000);
// 		}
// 	})
// });
// // end of address

// function checkEmpty(element){
// 	var checker = $(element);
// 	if(checker.val() == ""){
// 		return false;
// 	}
// 	else{
// 		return true;
// 	}
// }

// function checkRegex(regex,element){
// 	var checker = $(element);
// 	if(regex.test(checker.val())){
// 		return true;
// 	}
// 	else{
// 		return false;
// 	}
// }

// function checkNumber(element){
// 	var checker = $(element);
// 	if(isNaN(checker.val())){
// 		return true;
// 	}
// 	else{
// 		return false;
// 	}
// }

// function checkDate(element){
// 	var checker = $(element);
// 	if(isNaN(Date.parse(checker.val()))){
// 		return true;
// 	}
// 	else{
// 		return false;
// 	}
// }



// // city
// $(function(){
// 	var cityDiv = $("#cityDiv");
// 	cityDiv.hide();
// 	$("fieldset input:eq(8)").keyup(function(){
// 		var city = $(this);
// 		var nextThird = $("input[name=next]:eq(2)");
// 		var cityDiv = $("#cityDiv");
// 		var addressDiv = $("#addressDiv");
// 		var address = $("fieldset input:eq(7)");
// 		var postDiv = $("#pcodeDiv");
// 		cityDiv.hide();
// 		if(city.val() == ""){
// 			cityDiv.show();
// 			if(cityDiv.is("bg-primary")){
// 				cityDiv.removeClass("bg-primary");
// 			}
// 			nextThird.hide();
// 			cityDiv.addClass("bg-danger");
// 			cityDiv.html("Please input valid city");
// 		}
// 		else{
// 			if(checkEmpty(address) == false || checkRegex(/^[0-9]{4}$/,"fieldset input:eq(9)") == false){
// 				if(checkRegex(/^[0-9]{4}$/,"fieldset input:eq(9)") == false){
// 					postDiv.show();
// 					if(postDiv.is("bg-primary")){
// 					postDiv.removeClass("bg-primary");
// 					}
// 					nextThird.hide();
// 					postDiv.addClass("bg-danger");
// 					postDiv.html("Please input valid post code(e.g 6000)");
// 				}

// 				if(checkEmpty(address) == false){
// 					addressDiv.show();
// 					if(addressDiv.is("bg-primary")){
// 						addressDiv.removeClass("bg-primary");
// 					}
// 					nextThird.hide();
// 					addressDiv.addClass("bg-danger");
// 					addressDiv.html("Please input valid address");
// 				}
// 			}
// 			else{
// 				nextThird.show();
// 			}
// 			cityDiv.show();
// 			if(cityDiv.hasClass("bg-danger")){
// 				cityDiv.removeClass("bg-danger");
// 			}
// 			cityDiv.addClass("bg-primary");
// 			cityDiv.html("City accepted");
// 			cityDiv.fadeOut(1000);
// 		}
// 	})
// });
// // end of city



// // postal
// $(function(){
// 	var nextThird = $("input[name=next]:eq(2)");
// 	nextThird.hide();
// 	var content = $("#pcodeDiv");
// 	var addressDiv = $("#addressDiv");
// 	var cityDiv = $("#cityDiv");
// 	content.hide();
// 	cityDiv.hide();
// 	addressDiv.hide();
// 	$("fieldset input:eq(9)").keyup(function(){
// 		var nextThird = $("input[name=next]:eq(2)");
// 		var postCode = $(this);
// 		var content = $("#pcodeDiv");
// 		var regex = /^[0-9]{4}$/;
// 		var cityDiv = $("#cityDiv");
// 		var addressDiv = $("#addressDiv");
// 		var address = $("fieldset input:eq(7)");
// 		var city = $("fieldset input:eq(8)");
// 		content.hide();
// 		if(postCode.val() != ""){
// 			if(regex.test(postCode.val())){
// 				content.show();
// 				if(content.hasClass("bg-danger")){
// 					content.removeClass("bg-danger");
// 				}
// 				content.addClass("bg-primary");
// 				content.html("Postal Code accepted");
// 				content.fadeOut(1000);
// 				if(address.val() == "" || city.val() == ""){
// 					if(address.val() == ""){
// 						addressDiv.show()
// 						if(addressDiv.is("bg-primary")){
// 							addressDiv.removeClass("bg-primary");
// 						}
// 						nextThird.hide();
// 						addressDiv.addClass("bg-danger");
// 						addressDiv.html("Please input valid address");
// 					}
// 					if(city.val() == ""){
// 						cityDiv.show();
// 						if(cityDiv.is("bg-primary")){
// 							cityDiv.removeClass("bg-primary");
// 						}
// 						nextThird.hide();
// 						cityDiv.addClass("bg-danger");
// 						cityDiv.html("Please input valid city");
// 					}
// 				}
// 				else{
// 					cityDiv.hide();
// 					addressDiv.hide();
// 					nextThird.show();
// 				}
// 			}
// 			else{
// 				content.show();
// 				if(content.is("bg-primary")){
// 					content.removeClass("bg-primary");
// 				}
// 				nextThird.hide();
// 				content.addClass("bg-danger");
// 				content.html("Please input valid post code(e.g 6000)");
// 				nextThird.hide();
// 			}
// 		}
// 		else{
// 			nextThird.hide();
// 		}
		
// 	});
// });
// //end of postal 


// // expiry dates
// 	$(function(){
// 	var nextFourth = $("input[name=next]:eq(3)");
// 	nextFourth.hide();
// 	var content = $("#expirationDate");
// 	content.hide();
// 	$("fieldset input:eq(12)").change(function(){
// 		var dateReg = $(this).val();
// 		var nextFourth = $("input[name=next]:eq(3)");
// 		var errorDate = $("#expirationDate");
// 		var idno = $("fieldset input:eq(13)");
// 		var idnoDiv = $("#idno");
// 		nextFourth.hide();
// 		content.hide();
// 		if(isNaN(Date.parse(dateReg))){
// 			errorDate.show();
// 			if(errorDate.is("bg-primary")){
// 				errorDate.removeClass("bg-primary");
// 			}
// 			nextFourth.hide();
// 			errorDate.addClass("bg-danger");
// 			errorDate.html("Please input complete date");
				
// 		}
// 		else{
// 			if(checkEmpty("fieldset input:eq(13)") == true){
// 				if(checkRegex(/^[0-9]*$/,"fieldset input:eq(13)") == false){
// 					idnoDiv.show();
// 					if(idnoDiv.is("bg-primary")){
// 					idnoDiv.removeClass("bg-primary");
// 					}
// 					nextFourth.hide();
// 					idnoDiv.addClass("bg-danger");
// 					idnoDiv.html("Please input valid ID number");
// 				}
// 				else{
// 					idnoDiv.hide();
// 					nextFourth.show();
// 				}
// 			}
// 			else{
// 				idnoDiv.show();
// 				if(idnoDiv.is("bg-primary")){
// 				idnoDiv.removeClass("bg-primary");
// 				}
// 				nextFourth.hide();
// 				idnoDiv.addClass("bg-danger");
// 				idnoDiv.html("Please input valid ID number");
// 			}
// 		errorDate.show();
// 		if(errorDate.hasClass("bg-danger")){
// 			errorDate.removeClass("bg-danger");
// 		}
// 		errorDate.addClass("bg-primary");
// 		errorDate.html("Date accepted");
// 		errorDate.fadeOut(1000);
// 		}
// 	});
// });
// // expiry date



// // idno
// 	$(function(){
// 	var nextFourth = $("input[name=next]:eq(3)");
// 	nextFourth.hide();
// 	var content = $("#idno");
// 	content.hide();
// 	$("fieldset input:eq(13)").keyup(function(){
// 		var nextFourth = $("input[name=next]:eq(3)");
// 		var idno = $(this);
// 		var content = $("#idno");
// 		var dateReg = $("fieldset input:eq(12)");
// 		var regex = /^[0-9]*$/
// 		var errorDate = $("#expirationDate");
// 		// var address = $("fieldset input:eq(7)");
// 		// var city = $("fieldset input:eq(8)");
// 		nextFourth.hide();
// 		content.hide();
// 		if(idno.val() != ""){
// 			if(regex.test(idno.val())){
// 					if(checkDate(dateReg) == true){
// 						errorDate.show();
// 						if(errorDate.is("bg-primary")){
// 						errorDate.removeClass("bg-primary");
// 						}
// 						nextFourth.hide();
// 						errorDate.addClass("bg-danger");
// 						errorDate.html("Please input complete date");
// 					}
// 					else{
// 						nextFourth.show();
// 					}
// 				content.show();
// 				if(content.hasClass("bg-danger")){
// 					content.removeClass("bg-danger");
// 				}
// 				content.addClass("bg-primary");
// 				content.html("ID number accepted");
// 				content.fadeOut(1000);
// 			}
// 			else{
// 				content.show();
// 				if(content.is("bg-primary")){
// 					content.removeClass("bg-primary");
// 				}
// 				nextFourth.hide();
// 				content.addClass("bg-danger");
// 				content.html("Please input valid ID number");
// 			}
// 		}
		
// 	});
// });
// // end of idno


// // cocno
// $(function(){
// 	var content = $("#COCno");
// 	content.hide();
// 	var submitButton = $("input:eq(18)");
// 	submitButton.hide();
// 	$("fieldset input:eq(16)").keyup(function(){
// 		var submitButton = $("input:eq(18)");
// 		var cocNo = $(this);
// 		var content = $("#COCno");
// 		var regex = /^[0-9]{14}$/
// 		// var address = $("fieldset input:eq(7)");
// 		// var city = $("fieldset input:eq(8)");
// 		content.hide();
// 		submitButton.hide();
// 		if(cocNo.val() != ""){
// 			if(regex.test(cocNo.val())){
// 				content.show();
// 				if(content.hasClass("bg-danger")){
// 					content.removeClass("bg-danger");
// 				}
// 				submitButton.show();
// 				content.addClass("bg-primary");
// 				content.html("COC number accepted");
// 				content.fadeOut(1000);
// 			}
// 			else{
// 				content.show();
// 				if(content.is("bg-primary")){
// 					content.removeClass("bg-primary");
// 				}
// 				submitButton.hide();
// 				content.addClass("bg-danger");
// 				content.html("Please input 14 digit COC number");
// 			}
// 		}
		
// 	});
// });
// // end of cocno


$(function(){
	$("#passwordShowHide").click(function(){
		let eye = $(this).children();
		let field = $(".passwordField");
		if(eye.hasClass("fa-eye")){
			eye.removeClass("text-primary fa-eye").addClass("text-danger fa-eye-slash");
			field.removeAttr("type","password").attr("type","text");
		}
		else{
			eye.removeClass("text-danger fa-eye-slash").addClass("text-primary fa-eye");
			field.removeAttr("type","text").attr("type","password");
		}
	});
});


// trigger input
$(function(){
	$("#substituteButton").click(function(){
		$("#addDetailsPasser").trigger("click");
	});
});
// end of trigger input

// resize
$(function(){
    $(window).resize(function(){
        let screenSize = $(window).width();
        let myDiv = $("#uploadPhotoDiv");
        if(screenSize <= 575){
        	myDiv.addClass("d-flex justify-content-center");

        }
        else{
        	myDiv.removeClass("d-flex justify-content-center")
        }
    });
});


function showDivError(div,message){
	$(div).html(message);
	$(div).show();
}


let cocNumber;
let passerFirstname;
let passerLastname;
let passerMiddlename;
let cocTitle;
let passerLink;
let passerPassword;
let email;
let typeofCertificatePasser;

$(function(){
	$("#passerRegister").bind({
		submit: function(event){
			console.log("click");
			event.preventDefault();
			if(cocNumber == "" || passerFirstname == "" || passerLastname == "" || passerMiddlename == "" || cocTitle == "" 
				|| passerLink == "" ||  passerPassword == "" || email == "" || typeofCertificatePasser == ""){
				showDivError("#passerRegError","Please fill up forms with valid and true data!");
			}
			else{
				$("#passerRegError").hide();
				$.ajax({
					url: "",
					method: "POST",
					data: {
						registerPasser: "", cocNumber: cocNumber, passerFirstname: passerFirstname, passerLastname: passerLastname, passerMiddlename: passerMiddlename,
						cocTitle: cocTitle, passerLink: passerLink, passerPassword: passerPassword, email: email, typeofCertificatePasser: typeofCertificatePasser
					},
					success: function(){
						window.location="index";
					},
					error: function(){
						showDivError("#passerRegError","Unable to connect to server! Please try again later");
					}
				});
			}
		}
	});
});

function crawl(dataToSend){
	$.ajax({
		url: "crawler",
		method: "POST",
		data: {dataSent: "",data: dataToSend},
		success: function(returnData,statusReturn){
			let obj = jQuery.parseJSON(returnData);
			$(".loading").hide();
			if(obj.error == false){
				$("input[name=passerFN]").val(obj.fname);
				$("input[name=passerLN]").val(obj.lname);
				$("input[name=passerTitle]").val(obj.cert);
				cocNumber = obj.cnum;
				passerFirstname = obj.fname;
				passerLastname = obj.lname;
				passerMiddlename = obj.mname;
				cocTitle = obj.cert;
				passerLink = obj[1];
				$("#passerRegError").hide();
			}
			else{
				showDivError("#passerRegError","Sorry, we did not found any records of your COC number. Please try again.");
				$("input[name=passerFN]").val("");
				$("input[name=passerLN]").val("");
				$("input[name=passerTitle]").val("");
				cocNumber= "";
				passerFirstname= "";
				passerLastname= "";
				passerMiddlename= "";
				cocTitle= "";
				passerLink= "";
			}
		}
	});
}


$(function(){
	$("select[name=passerCertification]").change(function(){
		let selectValue = $(this).val();
		if(selectValue != "NC I" && selectValue != "NC II" && selectValue != "NC III" && selectValue != "COC"){
			showDivError("#passerRegError","Please select proper Certificate type!");
			typeofCertificatePasser = "";
		}
		else{
			$("#passerRegError").hide();
			typeofCertificatePasser = selectValue;
		}
	});
});

$(function(){
	$("input[name=passerEmail]").keyup(function(){
		let expression = /^[\w\-\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		let passerEmail = $(this).val();
		let emailDiv = $(this);
		if(email != ""){
			delay(function(){
				if(expression.test(passerEmail)){
					$("#passerRegError").hide();
					$.ajax({
						url: "checkExist",
						type: "POST",
						data: {dataSend: "marveegwapa",table: 'passer',field:'PasserEmail',data: passerEmail},
						success: function(returnData,dataStatus){
							if(returnData >= 1){
								$("#emailError").hide();
								showDivError("#passerRegError","Sorry, email already exist!");
								email = "";
							}
							else{
								$("#passerRegError").hide();
								$("#emailError").show().append("<i class='green pl-1 pt-2 fas fa-check-circle'></i>").fadeOut("slow");
								email = passerEmail;
							}
						}
					});
				}
				else{
					showDivError("#passerRegError","Please input proper email address!");
				}
			}, 500 );
		}
	});
});

$(function(){
	$("input[name=passerPassword]").keyup(function(){
		let regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
		let passwordReg = $(this).val();

		if(regex.test(passwordReg)){
			$("#passwordHelpBlock").hide();
			$("#passerRegError").hide();
			passerPassword = passwordReg;	
		}
		else{
			$("#passwordHelpBlock").show();
			showDivError("#passerRegError","Error! Password must contain minimum of 8 characters in total and minimum of 1 numeric");
			passerPassword = "";
		}
	});
});

$(function(){
	$("input[name=passerCOC]").change(function(){
		let cocField = $(this);
		let regex = /^[0-9]{14}$/
		if(cocField.val() != ""){
			if(regex.test(cocField.val())){
				$(".loading").show();
				crawl(cocField.val());
			}
		}
	});	
});
// end of resize