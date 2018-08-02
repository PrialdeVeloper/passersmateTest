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
	$(".passwordShowHide").click(function(){
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


// notification
$.fn.exists = function(callback) {
  if (this.length) {
    var args = [].slice.call(arguments, 1);
    callback.call(this, args);
  }
  return this;
};


$(function(){
    $("#notification").exists(function(){
        setInterval(function(){getNotification()},5000);
    })
});

function getNotification(){
	let notifBody = $("#notification");
	let notifCount = $(".notificationCount");
	$.ajax({
		url: "getNotification",
		data: {"notificationGet":""},
		method: "POST",
		success: function(a){
			let obj = JSON.parse(a);
			notifCount.html(obj.count);
			notifBody.html(obj.dom);
		},
		fail: function(){
			alert("cannot connect to server");
		}
	});
}

$(function(){
	$("#notifClick").click(function(){
		if(!$("#modalToggle").hasClass("show")){
			$.ajax({
				url: "readAllNotification",
				method: "POST",
				data: {"notifChange":""}
			});
		}
	});
})

// end of notification


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

function checkDate(variable){
	if(isNaN(Date.parse("+variable"))){
		return true;
	}
	else{
		return false;
	}
}

function checkValidEmail(variable){
	let expression = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	if(checkRegex(variable,expression)){
		return true;
	}else{
		return false;
	}
}

function showDivError(div,message){
	$(div).append("<div class='col'>"+message+"</div>");
	$(div).show();
}

function checkValidImage(input){
	var validImageTypes = ["image/jpeg", "image/png"];
	var imageType = $(input).get(0).files[0].type;
	if(jQuery.inArray(imageType, validImageTypes) < 0){
		return false;
	}
	else{
		return true;
	}
}

// previewImage
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#previewImage').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}



$(function(){
	$("input[name=profileUploadPasser]").change(function(){
		$(this).attr("data-integrity","allow");
		let imageCheck = checkValidImage("input[name=profileUploadPasser]");
			if(imageCheck){
				$("#personalDetailsModalError").hide();
				readURL(this);
			}else{
				$('#previewImage').attr('src', "../../public/etc/images/system/calendar.png");
				showDivError("#personalDetailsModalError","Please choose valid image");
			}
	});
});

$(function(){
	$("input[name=profileUploadSeeker]").change(function(){
		$(this).attr("data-integrity","allow");
		let imageCheck = checkValidImage("input[name=profileUploadSeeker]");
			if(imageCheck){
				$("#personalDetailsModalError").hide();
				readURL(this);
			}else{
				$('#previewImage').attr('src', "../../public/etc/images/system/calendar.png");
				showDivError("#personalDetailsModalError","Please choose valid image");
			}
	});
});

// end of previewImage

// trigger input
$(function(){
	$("#substituteButtonSeeker").click(function(){
		$("#addDetailsSeeker").trigger("click");
	});
});
// end of trigger input

// search Passer
$(function(){
	let field = [];
	field = ["PasserFN","PasserLN","PasserMname"];
	$.ajax({
		url: "paginationScriptOwnQuery",
		method: "POST",
		data: {"fields":field},
		success: function(a){
			console.log(a);
		}
	});
});

// $(function(){
// 	$("#passerListContent").exists(function(){
// 		let pagination = $("#paginationSearchPasser");
// 		let page = $("#currentPagePasser");
// 		let resultCount = $("#resultCountPasser");
// 		$.ajax({
// 			url: "paginationScriptOwnQuery",
// 			method: "POST",
// 			data: {"getResult":"","fields":{"qwe","qwe"}},
// 			success: function(a){
// 				let obj = JSON.parse(a);
// 				pagination.html(obj.pagination);
// 				page.html(obj.page);
// 				resultCount.html(obj.resultCount);
// 				console.log(a);
// 			}
// 		});
// 	});
// });
// end of search passer



let cocNumber;
let passerFirstname;
let passerLastname;
let passerMiddlename;
let cocTitle;
let passerLink;
let passerPassword;
let typeofCertificatePasser;
let cocExpiration;
let email;


$(function(){
	$("#passerRegister").submit(function(event){
		event.preventDefault();
		$("#passerRegError").empty();
		let cnumField = $("input[name=passerCOC]");
		let fnameField = $("input[name=passerFN]");
		let lnameField = $("input[name=passerLN]");
		let passerTitleField = $("input[name=passerTitle]");
		let expdateField = $("input[name=expdate]");
		let passerEmailField = $("input[name=passerEmail]");
		let passerPasswordField = $("input[name=passerPassword]");
		if(cocNumber === undefined){
			showDivError("#passerRegError","Please make sure your details has been listed on the fields before continuing the process. Enter your COC number first");
		}else{
			if(checkEmpty(expdateField.val()) || checkEmpty(passerEmailField.val()) || checkEmpty(passerPasswordField.val())){
				if(checkEmpty(expdateField.val())){
					showDivError("#passerRegError","Please indicate expiration date of your COC ");
				}
				if(checkEmpty(passerEmailField.val())){
					showDivError("#passerRegError","Please enter your valid email address");
				}
				if(checkEmpty(passerPasswordField.val())){
					showDivError("#passerRegError","Please input password which should have atleast 8 characters (atleast 1 number, 7 letters)");
				}
			}else{
				let expression = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				let regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
				if(checkRegex(passerEmailField.val(),expression) == false || checkDate(expdateField.val()) == false 
					|| checkRegex(passerPasswordField.val(),regex) == false || checkExistAny("passer","PasserEmail",passerEmailField.val())){
					if(checkRegex(passerEmailField.val(),expression) == false){
						showDivError("#passerRegError","Please make sure your email address is valid");
					}
					if(checkDate(expdateField.val()) == false){
						showDivError("#passerRegError","Please make sure to input valid date of COC expiration");
					}
					if(checkRegex(passerPasswordField.val(),regex) == false){
						showDivError("#passerRegError","Error! Password must contain minimum of 8 characters in total and minimum of 1 numeric");
					}
					if(checkExistAny("passer","PasserEmail",passerEmailField.val())){
						showDivError("#passerRegError","Email already exist. Please try another valid email addrress");
					}
				}else{
					$("#passerRegError").hide();
					$.ajax({
						url: "registerPasser",
						method: "POST",
						data: {
							"registerPasser": "", "cocNumber": cocNumber, "passerFirstname": passerFirstname, 
							"passerLastname": passerLastname, "passerMiddlename": passerMiddlename,
							"cocTitle": cocTitle, "passerLink": passerLink, "passerPassword": passerPassword, 
							"email": email, "typeofCertificatePasser": typeofCertificatePasser, "expdateField": expdateField.val()
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
		}



	});
})

function checkRegex(data,regex){
	if(regex.test(data)){
		return true;
	}else{
		return false;
	}
}

function toastError(message){
	toastr.error(message);
}

function toastSuccess(message){
	toastr.success(message);
}

function toastWarning(message){
	toastr.warning(message);
}

function checkEmpty(variable){
	if(variable == ""){
		return true;
	}
	else{
		return false;
	}
}

function delayRedirect(link){
	window.setTimeout(function(){window.location=link},1000)
}


function checkNumberOnlyCount(countData,data){
	let regex = new RegExp(/^[0-9]{10}$/);
	if(regex.test(data)){
		return true;
	}
	else{
		return false;
	}
}

function checkArraySame(arrayData,dataSent){
	if(jQuery.inArray(dataSent,arrayData) != -1){
		return true;
	}
	else{
		return false;
	}
}

function crawl(dataToSend){
	$.ajax({
		url: "crawler",
		method: "POST",
		data: {dataSent: "",data: dataToSend},
		success: function(returnData,statusReturn){
			let obj = jQuery.parseJSON(returnData);
			$(".loading").hide();
			$("div[name=passerFN]").empty();
			$("div[name=passerLN]").empty();
			$("div[name=passerTitle]").empty();
			if(obj.error == false){
				$("div[name=passerFN]").append(obj.fname);
				$("div[name=passerLN]").append(obj.lname);
				$("div[name=passerTitle]").append(obj.cert);
				cocNumber = obj.cnum;
				passerFirstname = obj.fname;
				passerLastname = obj.lname;
				passerMiddlename = obj.mname;
				cocTitle = obj.cert;
				typeofCertificatePasser = obj.certType;
				passerLink = obj[1];
				$("input[name=passerCOC]").attr("disabled","true");
				$("#passerEmailRegister").removeAttr("disabled");
				$("#passerEmailRegister").focus();
				$("#passerPasswordRegister").removeAttr("disabled");
				$("#passerRegError").hide();
			}
			else{
				$("#passerRegError").empty();
				$("input[name=passerCOC]").focus();
				$("input[name=passerCOC]").removeAttr("disabled","true");
				showDivError("#passerRegError","Sorry, we did not found any records of your COC number. Please try again.");
				$("div[name=passerFN]").html("First Name");
				$("div[name=passerLN]").html("Last Name");
				$("div[name=passerTitle]").html("Qualification Title");
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
		let expression = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
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
					$("#passerRegError").empty();
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
			$("#passerRegError").empty();
			showDivError("#passerRegError","Error! Password must contain minimum of 8 characters in total and minimum of 1 numeric");
			passerPassword = "";
		}
	});
});

$(function(){
	$("input[name=expdate]").change(function(){
		let expDate = $(this);

		if(checkDate(expDate.val()) == false){
			showDivError("#passerRegError","Please make sure you have entered a valid date");
			cocExpiration = "";
		}else{
			$("#passerRegError").hide();
			cocExpiration = expDate.val();
		}
	});
})

$(function(){
	$("input[name=passerCOC]").keyup(function(){
		let cocField = $(this);
		let regex = /^[0-9]{14}$/
		let reminder = $("#passerRegReminded");
		reminder.hide();
		if(cocField.val() != ""){
			$("#passerRegError").empty();
			if(regex.test(cocField.val())){
				let responseUser = confirm("Are you sure your COC number is "+cocField.val() + " ?");
				if(checkExistAny('passer','PasserCOCNo',cocField.val())){
					showDivError("#passerRegError","Sorry, COC already Exist! Please check your coc number and try again");
				}else{
					if(responseUser == true){
						$(this).blur();
						$("#passerRegError").hide();
						$(".loading").show();
						crawl(cocField.val());
					}else{
						showDivError("#passerRegError","Please try again");
					}
				}
			}else{
				showDivError("#passerRegError","Please make sure to input only 14 digit COC number");
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

// dashboard passer

// verifyModal previewImage

// 1st image
	$(function(){
		$("#substituteButton1").click(function(){
			$("#addDetailsPasser1").trigger("click");
		});
	});

	function readURL1(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
			$('#previewImage1').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$(function(){
		$(".inputImage1").change(function(){
			$(this).attr("data-integrity","allow");
				let imageCheck = checkValidImage("input[name=frontID]");
			if(imageCheck){
				$("#verifyModalError").hide();
				readURL1(this);
			}else{
				$('#previewImage1').attr('src', "../../public/etc/images/system/calendar.png");
				showDivError("#verifyModalError","Please choose valid image");
			}
		});
	});

// 2nd image
	$(function(){
		$("#substituteButton2").click(function(){
			$("#addDetailsPasser2").trigger("click");
		});
	});

	function readURL2(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
			$('#previewImage2').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$(function(){
		$(".inputImage2").change(function(){
			$(this).attr("data-integrity","allow");
				let imageCheck = checkValidImage("input[name=backID]");
			if(imageCheck){
				$("#verifyModalError").hide();
				readURL2(this);
			}else{
				$('#previewImage2').attr('src', "../../public/etc/images/system/calendar.png");
				showDivError("#verifyModalError","Please choose valid image");
			}
		});
	});

// 3rd image
	$(function(){
		$("#substituteButton3").click(function(){
			$("#addDetailsPasser3").trigger("click");
		});
	});

	function readURL3(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
			$('#previewImage3').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$(function(){
		$(".inputImage3").change(function(){
			$(this).attr("data-integrity","allow");
				let imageCheck = checkValidImage("input[name=selfieID]");
			if(imageCheck){
				$("#verifyModalError").hide();
				readURL3(this);
			}else{
				$('#previewImage3').attr('src', "../../public/etc/images/system/calendar.png");
				showDivError("#verifyModalError","Please choose valid image");
			}
		});
	});

// 4th image
	$(function(){
		$("#substituteButton4").click(function(){
			$("#addDetailsPasser4").trigger("click");
		});
	});

	function readURL4(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
			$('#previewImage4').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$(function(){
		$(".inputImage4").change(function(){
			$(this).attr("data-integrity","allow");
				let imageCheck = checkValidImage("input[name=competencyCertificate]");
			if(imageCheck){
				$("#verifyModalError").hide();
				readURL4(this);
			}else{
				$('#previewImage4').attr('src', "../../public/etc/images/system/calendar.png");
				showDivError("#verifyModalError","Please choose valid image");
			}
		});
	});
// end of verifyModal previewImage


// personal details
$(function(){
	$("#passerDetailsForm").submit(function(event){
		event.preventDefault();
	let responseUser = confirm("Are you sure you want to save changes?");
		if(responseUser == true){
			let address = $("input[name=passerAddress]");
			let streetField = $("input[name=passerStreet]");
			let cityField = $("input[name=passerCity]");
			let birthdate = $("input[name=passerBirthdate]");
			let gender = $("#gender");
			let genderData = ["Male","Female"];
			let cpNo = $("#passerNumber");
			let img = $("#previewImage");
			let inputImageProfile = $("input[name=profileUploadPasser]").get[0];

			if(checkEmpty(address.val()) || checkEmpty(streetField.val()) || checkEmpty(cityField.val()) || checkEmpty(birthdate.val()) || 
				checkDate(birthdate.val()) == false || gender.val() == "notSelected" 
				|| checkArraySame(genderData,gender.val()) == false || checkEmpty(cpNo.val()) || checkNumberOnlyCount(10,cpNo.val()) == false){
				$("#personalDetailsModalError").empty();
				if(checkEmpty(cpNo.val()) || checkNumberOnlyCount(10,cpNo.val()) == false){
					showDivError("#personalDetailsModalError","Please input valid cellphone number");
				}
				if(gender.val() == "notSelected" || checkArraySame(genderData,gender.val()) == false){
					showDivError("#personalDetailsModalError","Please select a gender");	
				}
				if(checkEmpty(address.val())){
					showDivError("#personalDetailsModalError","Please input valid Address");
				}
				if(checkEmpty(streetField.val())){
					showDivError("#personalDetailsModalError","Please input valid Street Address");
				}
				if(checkEmpty(cityField.val())){
					showDivError("#personalDetailsModalError","Please input valid City");
				}
				if(checkEmpty(birthdate.val()) || checkDate(birthdate.val()) == false){
					showDivError("#personalDetailsModalError","Please input valid Birthdate");
				}
			}else{
				$("#personalDetailsModalError").hide();
				if($("input[name=profileUploadPasser]").attr("data-integrity") === undefined){
					$.ajax({
						url: "updatePasserPersonalDetails",
						method: "POST",
						data: {"passerUpdateDataNoImage": "", "passerAddress": address.val(), "passerStreet": streetField.val(), 
						"passerCity": cityField.val(), "passerGender": gender.val(), "PasserCPNo":cpNo.val(), "passerBirthdate": birthdate.val()},
						success: function(returnData){
							let obj = JSON.parse(returnData);
							if(obj.error =="none"){
								window.location = "dashboard";	
							}else{
								showDivError("#personalDetailsModalError","Sorry, Something went wrong. Please try again later.");
							}
						},
						fail: function(){
							showDivError("#personalDetailsModalError","Cannot connect to server. Please try again");	
						}
					});
				}
				else{
					let imageCheck = checkValidImage("input[name=profileUploadPasser]");
					if(imageCheck){
						let formData = new FormData(this);
						formData.append("passerUpdateDataWithImage","");
						formData.append("passerAddress",address.val());
						formData.append("passerStreet",streetField.val());
						formData.append("passerCity",cityField.val());
						formData.append("passerGender",gender.val());
						formData.append("PasserCPNo",cpNo.val());
						formData.append("passerBirthdate",birthdate.val());
						$.ajax({
							url: "updatePasserPersonalDetails",
							method: "POST",
							data: formData,
							contentType: false,
							cache: false,
							processData:false,
							success: function(returnStatus){
								let obj = JSON.parse(returnStatus);
								if(obj.error == "none"){
									window.location = "dashboard";	
								}else{
									showDivError("#personalDetailsModalError","Sorry, Something went wrong. Please try again later.");
								}
							},
						});
					}
					else{
						showDivError("#personalDetailsModalError","Please choose valid image");
					}
				}	
			}
		}
	});
});

// end of personal details

// add work experience
$(function(){
	$("#jobExperienceModal").submit(function(event){
		event.preventDefault();
		let jobTitle = $("input[name=jTitle]").val();
		let company = $("input[name=company").val();
		let description = $("input[name=workDescription]").val();
		let startDate = $("input[name=startDate]").val();
		let endDate = $("input[name=endDate]").val();
		if(checkEmpty(jobTitle) || checkEmpty(company) || checkEmpty(startDate) || checkEmpty(endDate)
			|| Date.parse(endDate) < Date.parse(startDate)){
				$("#jobExperienceModalError").empty();
				if(checkEmpty(jobTitle)){
					showDivError("#jobExperienceModalError","Please enter job Title");
				}
				if(checkEmpty(company)){
					showDivError("#jobExperienceModalError","Please enter Company Name");
				}
				if(checkEmpty(startDate)){
					showDivError("#jobExperienceModalError","Please enter Start Date of Job");
				}
				if(checkEmpty(endDate)){
					showDivError("#jobExperienceModalError","Please enter End Date of Job");
				}
				if(Date.parse(endDate) < Date.parse(startDate)){
					showDivError("#jobExperienceModalError","Please make sure your dates are valid");
				}
		}else{
			let formData = new FormData(this);
			formData.append("passerJobExperienceData","");
			formData.append("startDate",startDate);
			formData.append("endDate",endDate);
			$.ajax({
				url: "addJobExperience",
				method: "POST",
				data: formData,
				processData: false,
    			contentType: false,
				success: function(dataRet){
					let obj = JSON.parse(dataRet);
					if(obj.error == "none"){
						window.location='dashboard';
					}
					else{
						showDivError("#jobExperienceModalError","There was an error inserting your data. Please try again later");
					}
				},
				fail: function(){
					alert("cannot connect to server");
				}
			});
		}
	});
});

// end add work experience
$(function(){
	$("#educationModal").submit(function(event){
		event.preventDefault();
		let eduLevel = $("select[name=educationalLevel]").val();
		let school = $("input[name=school").val();
		let validSchool = ["College","HighSchool","Elementary","Kindergarten","Nursery"];
		if(checkEmpty(eduLevel) || checkEmpty(school) || checkArraySame(validSchool,eduLevel) == false){
				$("#educationModalError").empty();
				if(checkArraySame(validSchool,eduLevel) == false){
					showDivError("#educationModalError","Please select only from the listed Items");
				}
				if(checkEmpty(eduLevel)){
					showDivError("#educationModalError","Please add your educational Attainment");
				}
				if(checkEmpty(school)){
					showDivError("#educationModalError","Please enter School Name");
				}
		}else{
			let formData = new FormData(this);
			formData.append("passerEducation","");
			$.ajax({
				url: "addEducation",
				method: "POST",
				data: formData,
				processData: false,
    			contentType: false,
				success: function(dataRet){
					let obj = JSON.parse(dataRet);
					if(obj.error == "none"){
						window.location='dashboard';
					}
					else{
						showDivError("#educationModalError","There was an error inserting your data. Please try again later");
					}
				},
				fail: function(){
					alert("cannot connect to server");
				}
			});
		}
	});
});

// passer Fee

$(function(){
	$("input[name=fee]").mousemove(function(){
		let fee = $(this).val();
		$("#fee").html(fee);
	});
});

// end of passer Fee


// verify passer

$(function(){
	$("#verifyPasser").submit(function(event){
		event.preventDefault();
		let frontID = $("input[name=frontID]");
		let backID = $("input[name=backID]");
		let selfieID = $("input[name=selfieID]");
		let competencyCertificate = $("input[name=competencyCertificate]");
		let idNumber = $("input[name=idNumber]");
		let expirationDate = $("input[name=expirationDate]");
		let acceptID = $("select[name=acceptedId]");
		let acceptedId = ["Philippine Passport","Driver’s License","SSS UMID Card","PhilHealth ID","TIN Card","Voter’s ID","PRC ID",
		"Senior Citizen ID","OFW ID","NBI Clearance","Police Clearance","Barangay Clearance","Student ID"];
		$("#verifyError").empty();

		if(checkEmpty(frontID.val())|| checkEmpty(backID.val())|| checkEmpty(selfieID.val())
			|| checkEmpty(competencyCertificate.val()) || checkEmpty(idNumber.val()) || checkEmpty(expirationDate.val())){

			if(checkEmpty(frontID.val())){
				showDivError("#verifyError","Please make sure frontID image field is not empty");
			}
			if(checkEmpty(backID.val())){
				showDivError("#verifyError","Please make sure backID image field is not empty");
			}
			if(checkEmpty(selfieID.val())){
				showDivError("#verifyError","Please make sure selfie with ID image field is not empty");
			}
			if(checkEmpty(competencyCertificate.val())){
				showDivError("#verifyError","Please make sure competency Certificate image field is not empty");
			}
			if(checkEmpty(idNumber.val())){
				showDivError("#verifyError","Please don't forget to input id number");
			}
			if(checkEmpty(expirationDate.val())){
				showDivError("#verifyError","Please don't forget to expiration date");
			}
		}else{
			if(checkValidImage(frontID) == false || checkValidImage(backID) == false 
				|| checkValidImage(selfieID) == false || checkValidImage(competencyCertificate) == false 
				|| checkArraySame(acceptedId,acceptID.val()) == false || isNaN(idNumber.val()) 
				|| checkDate(expirationDate.val()) == false){
				if(checkValidImage(frontID) == false){
					showDivError("#verifyError","Please make sure frontID image is valid image file");
				}
				if(checkValidImage(backID) == false){
					showDivError("#verifyError","Please make sure backID image is valid image file");
				}
				if(checkValidImage(selfieID) == false){
					showDivError("#verifyError","Please make sure selfie with ID image is valid image file");
				}
				if(checkValidImage(competencyCertificate) == false){
					showDivError("#verifyError","Please make sure competency Certificate image is valid image file");
				}
				if(checkArraySame(acceptedId,acceptID.val()) == false){
					showDivError("#verifyError","Please make sure you only choose from the list of valid government ID");
				}
				if(isNaN(idNumber.val())){
					showDivError("#verifyError","Please make sure you input valid ID number");
				}
				if(checkDate(expirationDate.val()) == false){
					showDivError("#verifyError","Please make sure expiration date is valid");
				}
			}else{
				$("#verifyError").hide();
				let dataValidate = new FormData(this);
				dataValidate.append("passerValidate","");
				dataValidate.append("expiryDate",expirationDate.val());
				$.ajax({
					url: "validatePasser",
					method: "POST",
					processData: false,
   					contentType: false,
					data: dataValidate,
					success: function(a,b){
						let obj = JSON.parse(a);
						if(obj.error == "none"){
							window.location = "dashboard";
						}else{
							alert(a);
						}
					},
					fail : function(){
						showDivError("#verifyError","Cannnot connect to server. Please try again later.");
					}
				});
			}
		}
	});
});

// end of verify passer

// end of dashboard passer



// dashboard seeker

// register seeker
$(function(){
	$("#seekerRegister").submit(function(event){
		event.preventDefault();
		let fname = $("input[name=seekerFN]");
		let lname = $("input[name=seekerLN]");
		let birthdate = $("input[name=seekerBdate]");
		let gender = $("select[name=passerGender]");
		let genderData = ["Male","Female"];
		let email = $("input[name=seekerEmail]");
		let address = $("input[name=seekerAddress]");
		let street = $("input[name=seekerStreet]");
		let city = $("input[name=seekerCity]");
		let cpno = $("input[name=seekerCPNo]");
		let username = $("input[name=seekerUsername]");
		let password = $("input[name=seekerPassword]");
		let regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

		$("#seekerError").empty();
		if(checkEmpty(fname.val()) || checkEmpty(lname.val()) || checkEmpty(birthdate.val()) || checkEmpty(gender.val())  
			|| checkEmpty(email.val()) || checkEmpty(address.val()) || checkEmpty(street.val()) || checkEmpty(city.val())
			 || checkEmpty(cpno.val()) || checkEmpty(username.val()) || checkEmpty(password.val())){
			if(checkEmpty(fname.val())){
				showDivError("#seekerError","Please enter your firstname");
			}
			if(checkEmpty(lname.val())){
				showDivError("#seekerError","Please enter your lastname");
			}
			if(checkEmpty(birthdate.val())){
				showDivError("#seekerError","Please enter your birthdate");
			}
			if(checkEmpty(gender.val())){
				showDivError("#seekerError","Please enter your gender");
			}
			if(checkEmpty(email.val())){
				showDivError("#seekerError","Please enter your email");
			}
			if(checkEmpty(address.val())){
				showDivError("#seekerError","Please enter your address");
			}
			if(checkEmpty(street.val())){
				showDivError("#seekerError","Please enter your street address");
			}
			if(checkEmpty(city.val())){
				showDivError("#seekerError","Please enter your city");
			}
			if(checkEmpty(cpno.val())){
				showDivError("#seekerError","Please enter your Cellphone number");
			}
			if(checkEmpty(username.val())){
				showDivError("#seekerError","Please enter your username");
			}
			if(checkEmpty(password.val())){
				showDivError("#seekerError","Please enter your password");
			}
		}else{
			let checkNumber = /\d/;
			if(checkRegex(fname.val(),checkNumber) == true || checkRegex(lname.val(),checkNumber) == true || checkDate(birthdate.val()) == false
				|| checkArraySame(genderData,gender.val()== false) ||  checkValidEmail(email.val()) == false 
				|| checkExistAny("seeker","SeekerEmail",email.val()) || checkNumberOnlyCount(10,cpno.val()) == false 
				|| checkExistAny("seeker","SeekerUname",username.val()) || checkRegex(password.val(),regex) == false || isNaN(cpno.val())){
				if(checkRegex(fname.val(),checkNumber) == true){
					showDivError("#seekerError","Please make sure there is no unnecessary characters on your firstname");
				}
				if(checkRegex(lname.val(),checkNumber) == true){
					showDivError("#seekerError","Please make sure there is no unnecessary characters on your lastname");
				}
				if(checkDate(birthdate.val()) == false){
					showDivError("#seekerError","Please input valid birthdate");
				}
				if(checkArraySame(genderData,gender.val()== false)){
					showDivError("#seekerError","Please select only from the listed gender");
				}
				if(checkValidEmail(email.val()) == false){
					showDivError("#seekerError","Please input valid email");
				}
				if(checkExistAny("seeker","SeekerEmail",email.val())){
					showDivError("#seekerError","Email is alreay taken. Please try another email");
				}
				if(checkNumberOnlyCount(10,cpno.val()) == false){
					showDivError("#seekerError","Please input 10 digits only (excluding 0 on first number)");
				}
				if(checkExistAny("seeker","SeekerUname",username.val())){
					showDivError("#seekerError","Username is alreay taken. Please try another email");
				}
				if(checkRegex(password.val(),regex) == false){
					showDivError("#seekerError","Please make sure your password has 8 characters and atleast 1 digit and 7 letters");
				}
				if(isNaN(cpno.val())){
					showDivError("#seekerError","Please make sure your cellphone number has no unnecessary characters");
				}
			}else{
				$.ajax({
					url: "registerSeeker",
					method: "POST",
					data: {"registerSeeker":"","SeekerFN":fname.val(),"SeekerLN":lname.val(),"SeekerBirthdate":birthdate.val(),"SeekerGender":gender.val(),
					"SeekerStreet":street.val(),"SeekerCity":city.val(),"SeekerAddress":address.val(),"SeekerCPNo":cpno.val(),"SeekerEmail":email.val(),
					"SeekerUname":username.val(),"SeekerPass":password.val()},
					success: function(a){
						let obj = JSON.parse(a);
						if(obj.error == "none"){
							$("#seekerError").hide();
							window.location = 'dashboard';
						}else{
							console.log(a);
						}
					},
					fail: function(){

					}
				});
			}
		}
	});
});
// end of register seeker

// personal details seeeker
$(function(){
	$("#seekerDetailsForm").submit(function(event){
		event.preventDefault();
	let responseUser = confirm("Are you sure you want to save changes?");
		if(responseUser == true){
			let address = $("input[name=seekerAddress]");
			let streetField = $("input[name=seekerStreet]");
			let cityField = $("input[name=seekerCity]");
			let birthdate = $("input[name=seekerBirthdate]");
			let gender = $("#gender");
			let genderData = ["Male","Female"];
			let cpNo = $("#seekerNumber");
			let img = $("#previewImage");
			let inputImageProfile = $("input[name=profileUploadSeeker]").get[0];
			if(checkEmpty(address.val()) || checkEmpty(streetField.val()) || checkEmpty(cityField.val()) || checkEmpty(birthdate.val()) || 
				checkDate(birthdate.val()) == false || gender.val() == "notSelected" 
				|| checkArraySame(genderData,gender.val()) == false || checkEmpty(cpNo.val()) || checkNumberOnlyCount(10,cpNo.val()) == false){
				$("#personalDetailsModalError").empty();
				if(checkEmpty(cpNo.val()) || checkNumberOnlyCount(10,cpNo.val()) == false){
					showDivError("#personalDetailsModalError","Please input valid cellphone number");
				}
				if(gender.val() == "notSelected" || checkArraySame(genderData,gender.val()) == false){
					showDivError("#personalDetailsModalError","Please select a gender");	
				}
				if(checkEmpty(address.val())){
					showDivError("#personalDetailsModalError","Please input valid Address");
				}
				if(checkEmpty(streetField.val())){
					showDivError("#personalDetailsModalError","Please input valid Street Address");
				}
				if(checkEmpty(cityField.val())){
					showDivError("#personalDetailsModalError","Please input valid City");
				}
				if(checkEmpty(birthdate.val()) || checkDate(birthdate.val()) == false){
					showDivError("#personalDetailsModalError","Please input valid Birthdate");
				}
			}else{
				$("#personalDetailsModalError").hide();
				if($("input[name=profileUploadSeeker]").attr("data-integrity") === undefined){
					$.ajax({
						url: "updateSeekerPersonalDetails",
						method: "POST",
						data: {"seekerUpdateDataNoImage": "", "seekerAddress": address.val(), "seekerStreet": streetField.val(), 
						"seekerCity": cityField.val(), "seekerGender": gender.val(), "SeekerCPNo":cpNo.val(), "seekerBirthdate": birthdate.val()},
						success: function(returnData){
							let obj = JSON.parse(returnData);
							if(obj.error =="none"){
								window.location = "dashboard";	
							}else{
								showDivError("#personalDetailsModalError","Sorry, Something went wrong. Please try again later.");
							}
						},
						fail: function(){
							showDivError("#personalDetailsModalError","Cannot connect to server. Please try again");	
						}
					});
				}
				else{
					let imageCheck = checkValidImage("input[name=profileUploadSeeker]");
					if(imageCheck){
						let formData = new FormData(this);
						formData.append("seekerUpdateDataWithImage","");
						formData.append("seekerAddress",address.val());
						formData.append("seekerStreet",streetField.val());
						formData.append("seekerCity",cityField.val());
						formData.append("seekerGender",gender.val());
						formData.append("SeekerCPNo",cpNo.val());
						formData.append("seekerBirthdate",birthdate.val());
						$.ajax({
							url: "updateSeekerPersonalDetails",
							method: "POST",
							data: formData,
							contentType: false,
							cache: false,
							processData:false,
							success: function(returnStatus){
								let obj = JSON.parse(returnStatus);
								if(obj.error == "none"){
									window.location = "dashboard";	
								}else{
									showDivError("#personalDetailsModalError","Sorry, Something went wrong. Please try again later.");
								}
							},
						});
					}
					else{
						showDivError("#personalDetailsModalError","Please choose valid image");
					}
				}	
			}
		}
	});
});

// end of personal details seeker

// offerjobCreate
$(function(){
	$("#joFormCreate").submit(function(event){
		event.preventDefault();
		let workAddress = $("#workAddressCreate");
		let workStart = $("#workCreateDateStart");
		let workEnd = $("#workCreateDateEnd");
		let salary = $("#salaryCreate");
		let paymentMethod = $("#paymentMethod");
		let accomodationType = $("#accomodationType");
		let validPaymentMethod = ["Online","Onsite"];
		let validAccomodationType = ["In-House","Offsite"];
		
		if(checkEmpty(workAddress.val()) || checkEmpty(workStart.val()) || checkEmpty(workEnd.val())
			 || checkEmpty(salary.val()) || checkEmpty(paymentMethod.val()) || checkEmpty(accomodationType.val())){
			if(checkEmpty(workAddress.val())){
				toastError("Please input your Address which needs work");
			}
			if(checkEmpty(workStart.val())){
				toastError("Please indicate your work starting date");
			}
			if(checkEmpty(workEnd.val())){
				toastError("Please indicate your work estimated end date");
			}
			if(checkEmpty(salary.val())){
				toastError("Please indicate your salary offer");
			}
			if(checkEmpty(paymentMethod.val())){
				toastError("Please indicate your payment method");
			}
			if(checkEmpty(accomodationType.val())){
				toastError("Please indicate your work accomodation type");
			}
		}else{
			if(Date.parse(workEnd.val()) < Date.parse(workStart.val()) || isNaN(salary.val()) 
				|| checkArraySame(validPaymentMethod,paymentMethod.val()) == false 
				|| checkArraySame(validAccomodationType,accomodationType.val()) == false){
				if(Date.parse(workEnd.val()) < Date.parse(workStart.val())){
					toastError("Please make sure your start date is not greater than end date");
				}
				if(isNaN(salary.val())){
					toastError("Please make sure your salary input is valid");
				}
				if(checkArraySame(validPaymentMethod,paymentMethod.val()) == false){
					toastError("Please choose only from valid payment types");
				}
				if(checkArraySame(validAccomodationType,accomodationType.val()) == false){
					toastError("Please choose only from valid accomodation types");
				}
			}else{
				$.ajax({
					url: "addJobForm",
					method: "POST",
					data: {"createJobForm":"","workAddress":workAddress.val(),"workStart":workStart.val(),"workEnd":workEnd.val(),"salary":salary.val(),
					"paymentMethod":paymentMethod.val(),"accomodationType":accomodationType.val()},
					success :function(a){
						let obj = JSON.parse(a);
						if(obj.error == "none"){
							toastSuccess("Form Added!");
							window.setTimeout(function(){window.location='joboffer'},1000)
						}
					},
					fail: function(){
						alert("cannot connect to server");
					}
				});
			}
		}

	});
})
// end of offerjobCreate


// verifyModal previewImage

// 1st image
	$(function(){
		$("#substituteButton1").click(function(){
			$("#addDetailsSeeker1").trigger("click");
		});
	});

	function readURL1(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
			$('#previewImage1').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$(function(){
		$(".inputImage1").change(function(){
			$(this).attr("data-integrity","allow");
				let imageCheck = checkValidImage("input[name=frontID]");
			if(imageCheck){
				$("#verifyModalError").hide();
				readURL1(this);
			}else{
				$('#previewImage1').attr('src', "../../public/etc/images/system/calendar.png");
				showDivError("#verifyModalError","Please choose valid image");
			}
		});
	});

// 2nd image
	$(function(){
		$("#substituteButton2").click(function(){
			$("#addDetailsSeeker2").trigger("click");
		});
	});

	function readURL2(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
			$('#previewImage2').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$(function(){
		$(".inputImage2").change(function(){
			$(this).attr("data-integrity","allow");
				let imageCheck = checkValidImage("input[name=backID]");
			if(imageCheck){
				$("#verifyModalError").hide();
				readURL2(this);
			}else{
				$('#previewImage2').attr('src', "../../public/etc/images/system/calendar.png");
				showDivError("#verifyModalError","Please choose valid image");
			}
		});
	});

// 3rd image
	$(function(){
		$("#substituteButton3").click(function(){
			$("#addDetailsSeeker3").trigger("click");
		});
	});

	function readURL3(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
			$('#previewImage3').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$(function(){
		$(".inputImage3").change(function(){
			$(this).attr("data-integrity","allow");
				let imageCheck = checkValidImage("input[name=selfieID]");
			if(imageCheck){
				$("#verifyModalError").hide();
				readURL3(this);
			}else{
				$('#previewImage3').attr('src', "../../public/etc/images/system/calendar.png");
				showDivError("#verifyModalError","Please choose valid image");
			}
		});
	});
// end of verifyModal previewImage


// verify seeker

$(function(){
	$("#verifySeeker").submit(function(event){
		event.preventDefault();
		let frontID = $("input[name=frontID]");
		let backID = $("input[name=backID]");
		let selfieID = $("input[name=selfieID]");
		let idNumber = $("input[name=idNumber]");
		let expirationDate = $("input[name=expirationDate]");
		let acceptID = $("select[name=acceptedId]");
		let acceptedId = ["Philippine Passport","Driver’s License","SSS UMID Card","PhilHealth ID","TIN Card","Voter’s ID","PRC ID",
		"Senior Citizen ID","OFW ID","NBI Clearance","Police Clearance","Barangay Clearance","Student ID"];
		$("#verifyError").empty();

		if(checkEmpty(frontID.val())|| checkEmpty(backID.val())|| checkEmpty(selfieID.val()) 
			|| checkEmpty(idNumber.val()) || checkEmpty(expirationDate.val())){

			if(checkEmpty(frontID.val())){
				showDivError("#verifyError","Please make sure frontID image field is not empty");
			}
			if(checkEmpty(backID.val())){
				showDivError("#verifyError","Please make sure backID image field is not empty");
			}
			if(checkEmpty(selfieID.val())){
				showDivError("#verifyError","Please make sure selfie with ID image field is not empty");
			}
			if(checkEmpty(idNumber.val())){
				showDivError("#verifyError","Please don't forget to input id number");
			}
			if(checkEmpty(expirationDate.val())){
				showDivError("#verifyError","Please don't forget to expiration date");
			}
		}else{
			if(checkValidImage(frontID) == false || checkValidImage(backID) == false 
				|| checkValidImage(selfieID) == false || checkArraySame(acceptedId,acceptID.val()) == false 
				|| isNaN(idNumber.val()) 
				|| checkDate(expirationDate.val()) == false){
				if(checkValidImage(frontID) == false){
					showDivError("#verifyError","Please make sure frontID image is valid image file");
				}
				if(checkValidImage(backID) == false){
					showDivError("#verifyError","Please make sure backID image is valid image file");
				}
				if(checkValidImage(selfieID) == false){
					showDivError("#verifyError","Please make sure selfie with ID image is valid image file");
				}
				if(checkArraySame(acceptedId,acceptID.val()) == false){
					showDivError("#verifyError","Please make sure you only choose from the list of valid government ID");
				}
				if(isNaN(idNumber.val())){
					showDivError("#verifyError","Please make sure you input valid ID number");
				}
				if(checkDate(expirationDate.val()) == false){
					showDivError("#verifyError","Please make sure expiration date is valid");
				}
			}else{
				$("#verifyError").hide();
				let dataValidate = new FormData(this);
				dataValidate.append("seekerValidate","");
				dataValidate.append("expiryDate",expirationDate.val());
				$.ajax({
					url: "validateSeeker",
					method: "POST",
					processData: false,
   					contentType: false,
					data: dataValidate,
					success: function(a,b){
						let obj = JSON.parse(a);
						if(obj.error == "none"){
							window.location = "dashboard";
						}else{
							alert(a);
						}
					},
					fail : function(){
						showDivError("#verifyError","Cannnot connect to server. Please try again later.");
					}
				});
			}
		}
	});
});

// end of verify seeker


let idJobOffer;

// display jobofferForm
$(function(){
	$("a[name='updateJobOfferForm']").click(function(){
		let id = $(this).parent().find("input[name=sleepingAway]").val();
		$.ajax({
			url: "selectAndAuthenticate",
			method: "POST",
			data: {"select":"","user":"SeekerID","table":"offerjobform","field":"OfferJobFormID","data":id},
			async: false,
			success: function(a){
				let obj = JSON.parse(a);
				if(obj.error == "none"){
					idJobOffer = id;
					let workAddressUpdate = $("#workAddressUpdate");
					let startDateUpdate = $("#startDateUpdate");
					let endDateUpdate = $("#endDateUpdate");
					let salaryUpdate = $("#salaryUpdate");
					let paymentMethodUpdate = $("select[name=paymentMethodUpdate]");
					let accomodationTypeUpdate = $("#accomodationTypeUpdate");
					workAddressUpdate.val(obj.data[0].WorkingAddress);
					startDateUpdate.val(obj.data[0].StartDate);
					endDateUpdate.val(obj.data[0].EndDate);
					salaryUpdate.val(obj.data[0].Salary);
					paymentMethodUpdate.val(obj.data[0].PaymentMethod).change();
					accomodationTypeUpdate.val(obj.data[0].AccomodationType).change();
				}else{
					if(obj.error = "wrongUser"){
						window.location = 'joboffer';
					}
				}
			},
		});
	});
});
// end of display jobOfferForm


// offerjobCreate
$(function(){
	$("#updateOfferJob").submit(function(event){
		event.preventDefault();
		let workAddress = $("#workAddressUpdate");
		let workStart = $("#startDateUpdate");
		let workEnd = $("#endDateUpdate");
		let salary = $("#salaryUpdate");
		let paymentMethod = $("#paymentMethodUpdate");
		let accomodationType = $("#accomodationTypeUpdate");
		let validPaymentMethod = ["Online","Onsite"];
		let validAccomodationType = ["In-House","Offsite"];
		
		if(checkEmpty(workAddress.val()) || checkEmpty(workStart.val()) || checkEmpty(workEnd.val())
			 || checkEmpty(salary.val()) || checkEmpty(paymentMethod.val()) || checkEmpty(accomodationType.val())){
			if(checkEmpty(workAddress.val())){
				toastError("Please input your Address which needs work");
			}
			if(checkEmpty(workStart.val())){
				toastError("Please indicate your work starting date");
			}
			if(checkEmpty(workEnd.val())){
				toastError("Please indicate your work estimated end date");
			}
			if(checkEmpty(salary.val())){
				toastError("Please indicate your salary offer");
			}
			if(checkEmpty(paymentMethod.val())){
				toastError("Please indicate your payment method");
			}
			if(checkEmpty(accomodationType.val())){
				toastError("Please indicate your work accomodation type");
			}
		}else{
			if(Date.parse(workEnd.val()) < Date.parse(workStart.val()) || isNaN(salary.val()) 
				|| checkArraySame(validPaymentMethod,paymentMethod.val()) == false 
				|| checkArraySame(validAccomodationType,accomodationType.val()) == false){
				if(Date.parse(workEnd.val()) < Date.parse(workStart.val())){
					toastError("Please make sure your start date is not greater than end date");
				}
				if(isNaN(salary.val())){
					toastError("Please make sure your salary input is valid");
				}
				if(checkArraySame(validPaymentMethod,paymentMethod.val()) == false){
					toastError("Please choose only from valid payment types");
				}
				if(checkArraySame(validAccomodationType,accomodationType.val()) == false){
					toastError("Please choose only from valid accomodation types");
				}
			}else{
				$.ajax({
					url: "editJobForm",
					method: "POST",
					data: {"updateJobForm":"","jobFormID":idJobOffer,"workAddress":workAddress.val(),"workStart":workStart.val(),"workEnd":workEnd.val(),"salary":salary.val(),
					"paymentMethod":paymentMethod.val(),"accomodationType":accomodationType.val()},
					success :function(a){
						let obj = JSON.parse(a);
						if(obj.error == "none"){
							idJobOffer = "";
							toastSuccess("Form Edited!");
							window.setTimeout(function(){window.location='joboffer'},1000)
						}
					},
					fail: function(){
						alert("cannot connect to server");
					}
				});
			}
		}

	});
})
// end of offerjobCreate

// setDefault
$(function(){
	$(".setDefault").click(function(){
		let id = $(this).parent().find("input[name=sleepingAway]").val();
		let responseUser = confirm("Are you sure you want this Job offer form to be default?");
		if(responseUser == true){
			$.ajax({
				url: "setDefaultJobForm",
				method: "POST",
				data: {"setDefaultJobForm":"","id":id},
				success: function(a){
					let obj = JSON.parse(a);
					if(obj.error == "none"){
						toastSuccess("Successfully set to default");
						delayRedirect("joboffer")
					}else if(obj.error == "wrongUser"){
						toastError("You have no authority over the Job offer you choosed. Please try again");
					}else{
						console.log(a);
					}
				}
			});
		}

	});
});
// end of setDefault

// delete offerjobForm

$(function(){
	$("a[name=deleteJobOfferForm]").click(function(){
		let id = $(this).parent().find("input[name=sleepingAway]").val();
		$("button[name=yesDeleteOfferJobForm]").click(function(){
			$.ajax({
				url: "deleteJobForm",
				method: "POST",
				data: {"deleteJobForm":"","id":id},
				success: function(a){
					let obj = JSON.parse(a);
					if(obj.error == "none"){
						toastSuccess("Successfully Deleted");
						delayRedirect("joboffer");
					}else if(obj.error == "wrongUser"){
						toastError("You have no authority over the Job offer you choosed. Please try again");
					}else{
						console.log(a);
					}
				}
			});
		});
	});
});
// end of delete offerjobForm

// end of dashboard seeker