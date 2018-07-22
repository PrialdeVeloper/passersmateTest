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
	if(isNaN(Date.parse(+variable))){
		return true;
	}
	else{
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


let cocNumber;
let passerFirstname;
let passerLastname;
let passerMiddlename;
let cocTitle;
let passerLink;
let passerPassword;
let email;
let typeofCertificatePasser;



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
	$(".inputImage").change(function(){
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

// end of previewImage


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

function checkEmpty(variable){
	if(variable == ""){
		return true;
	}
	else{
		return false;
	}
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
				$("#passerEmailRegister").removeAttr("disabled");
				$("#passerPasswordRegister").removeAttr("disabled");
				$("#passerRegError").hide();
			}
			else{
				$("#passerRegError").empty();
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
	$("input[name=passerCOC]").change(function(){
		let cocField = $(this);
		let regex = /^[0-9]{14}$/
		let reminder = $("#passerRegReminded");
		reminder.hide();
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

// verifyPasserModal
$(function(){
	$("#verifyModal").submit(function(event){
		event.preventDefault();
		let responseUser = confirm("Are you sure you want to save changes?");
	if(responseUser == true){
		let inputImageProfile = $("input[name=frontID]").get[0];
		let inputImageProfile = $("input[name=backID]").get[0];
		let inputImageProfile = $("input[name=selfieID]").get[0];
		let inputImageProfile = $("input[name=competencyCertificate]").get[0];
		let startDate = $("input[name=idType]").val();
		let startDate = $("input[name=idNumber]").val();
		let startDate = $("input[name=expirationDate]").val();

		if ( checkEmpty(idType.val()) || checkEmpty(idNumber.val()) ||
		 	 checkEmpty(expirationDate.val()) || checkDate(expirationDate.val()) == false ){
			$("#verifyModalError").empty();

				if(checkEmpty(idType.val())){
					showDivError("#verifyModalError","Please input valid ID Type");
				}
				if(checkEmpty(idNumber.val())){
					showDivError("#verifyModalError","Please input valid ID Number");
				}
				if(checkEmpty(expirationDate.val()) || checkDate(expirationDate.val()) == false){
					showDivError("#verifyModalError","Please input valid Expiration Date");
				}
			}else{
				$("#verifyModalError").hide();
				if($("input[name=frontID]" && "input[name=backID]" && "input[name=selfieID]" && "input[name=competencyCertificate]").attr("data-integrity") === undefined){
					$.ajax({
						url: "verifyPasser",
						method: "POST",
						data: {
							"verifyPasserDataNoImage": "", "######": idType.val(), "######": idNumber.val(), "######": expirationDate.val()
						},
						success: function(returnData){
							let obj = JSON.parse(returnData);
							if(obj.error =="none"){
								window.location = "dashboard";	
							}else{
								showDivError("#verifyModalError","Sorry, Something went wrong. Please try again later.");
							}
						},
						fail: function(){
							showDivError("#verifyModalError","Cannot connect to server. Please try again");	
						}
					});
				}
				else{
					let imageCheck1 = checkValidImage("input[name=frontID]");
					let imageCheck2 = checkValidImage("input[name=backID]");
					let imageCheck3 = checkValidImage("input[name=selfieID]");
					let imageCheck4 = checkValidImage("input[name=competencyCertificate]");

					if(imageCheck1 && imageCheck2 && imageCheck3 && imageCheck4 ){
						let formData = new FormData(this);
						formData.append("verifyPasserDataWithImage","");
						formData.append("######",idType.val());
						formData.append("######",idNumber.val());
						formData.append("######",expirationDate.val());
						$.ajax({
							url: "verifyPasser",
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
									showDivError("#verifyModalError","Sorry, Something went wrong. Please try again later.");
								}
							},
						});
					}
					else{
						showDivError("#verifyModalError","Please choose valid image");
					}
				}	
			}
		}
	});
});
// end of verifyPasserModal
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
					console.log(dataRet);
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

// end of dashboard passer
