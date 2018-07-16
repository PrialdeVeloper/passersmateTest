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

// registerPasser

var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();

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

function checkExistAny(table,field,data){
	let returnValue;
	$.ajax({
		url: "checkExist",
		method: "POST",
		data: {dataSend: "marveegwapa",table: table, field:field, data: data},
		async: false,
		success: function(dataRet){
			if(dataRet >= 1){
				returnValue = true;
			}
			else{
				returnValue = false;
			}
		},
		fail: function(){
			alert("cannot connect to server!");
		}
	});

	return returnValue;
}


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
			event.preventDefault();
			if(cocNumber == "" || passerFirstname == "" || passerLastname == "" || passerMiddlename == "" || cocTitle == "" 
				|| passerLink == "" ||  passerPassword == "" || email == "" || typeofCertificatePasser == ""){
				showDivError("#passerRegError","Please fill up forms with valid and true data!");
			}
			else{
				$("#passerRegError").hide();
				$.ajax({
					url: "registerPasser",
					method: "POST",
					data: {
						registerPasser: "", cocNumber: cocNumber, passerFirstname: passerFirstname, 
						passerLastname: passerLastname, passerMiddlename: passerMiddlename,
						cocTitle: cocTitle, passerLink: passerLink, passerPassword: passerPassword, 
						email: email, typeofCertificatePasser: typeofCertificatePasser
					},
					success: function(returnData){
						let obj = JSON.parse(returnData);
						if(obj.error == "none"){
							window.location="index";
						}else{
							showDivError("#passerRegError",obj.error);
						}
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
				typeofCertificatePasser = obj.certType;
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
				typeofCertificatePasser = "";
				passerLink= "";
			}
		}
	});
}

$(function(){
	$("input[name=passerEmail]").keyup(function(){
		let expression = /^[\w\-\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		let passerEmail = $(this).val();
		let emailDiv = $(this);
		if(passerEmail != ""){
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
			$("#passwordHelpBlock").css("display","block");
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
				if(checkExistAny('passer','PasserCOCNo',cocField.val())){
					showDivError("#passerRegError","Sorry, COC already Exist! Please check again");
				}else{
					$("#passerRegError").hide();
					$(".loading").show();
					crawl(cocField.val());
				}
			}
		}
	});	
});
// end of resize

// end of register passer

// login

// loginTab
$(function(){
	$(".passerTab").click(function(){
		if($("#passerLogin").is(":hidden")){
			$("#seekerLogin").fadeOut("fast");
			$("#passerLogin").fadeIn("fast");
		}
	});
})

$(function(){
	$(".seekerTab").click(function(){
		if($("#seekerLogin").is(":hidden")){
			$("#passerLogin").fadeOut("fast");
			$("#seekerLogin").fadeIn("fast");
		}
	});
})
// end of loginTab

// end of login