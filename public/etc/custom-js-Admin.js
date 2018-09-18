"use strict";

function formatDate(date){
	var formattedDate = new Date(date);
	var d = formattedDate.getDate();
	var m =  formattedDate.getMonth();
	m += 1;
	var y = formattedDate.getFullYear();
	return m + " / " + d + " / " + y;
}

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

function checkDate(variable){
	if(isNaN(Date.parse("+variable"))){
		return true;
	}
	else{
		return false;
	}
}

function checkEmpty(variable){
	if(variable == ""){
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

function checkArraySame(arrayData,dataSent){
	if(jQuery.inArray(dataSent,arrayData) != -1){
		return true;
	}
	else{
		return false;
	}
}

function checkRegex(data,regex){
	if(regex.test(data)){
		return true;
	}else{
		return false;
	}
}

let emailRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;



$(function(){
	$("#adminRegister").submit(function(event){
		$("#adminRegisterError").empty();
		event.preventDefault();
		let username = $("input[name=adminUsername]");
		let email = $("input[name=adminEmail]");
		let password = $("input[name=adminPassword]");
		let retype = $("input[name=adminRetype]");

		if(checkEmpty(username.val()) || checkEmpty(email.val()) || checkEmpty(password.val()) 
			|| checkEmpty(retype.val())){
			if(checkEmpty(username.val())){
				showDivError("#adminRegisterError","Please don't forget to input your username");
			}
			if(checkEmpty(email.val())){
				showDivError("#adminRegisterError","Please don't forget to input your email");
			}
			if(checkEmpty(password.val())){
				showDivError("#adminRegisterError","Please don't forget to input your password");
			}
			if(checkEmpty(retype.val())){
				showDivError("#adminRegisterError","Please make sure your password matched!");
			}
		}else{
			if(checkExistAny("admin","username",username.val()) || checkExistAny("admin","email",email.val()) 
				|| checkRegex(email.val(),emailRegex) == false){
				if(checkExistAny("admin","username",username.val())){
					showDivError("#adminRegisterError","Looks like your username already exist. Please choose other username");
				}
				if(checkExistAny("admin","email",email.val())){
					showDivError("#adminRegisterError","Looks like your email already exist. Please choose other email");
				}
				if(checkRegex(email.val(),emailRegex) == false){
					showDivError("#adminRegisterError","Please make sure your email is valid!");
				}
			}else{
				$("#adminRegisterError").empty().hide();
				let form = new FormData(this);
				form.append("registerAdmin","");
				$.ajax({
					url: "registerAdmin",
					method: "POST",
					data: form,
					contentType: false,
					cache: false,
					processData:false,
					success: function(a){
						let obj = JSON.parse(a);
						if(obj.error == "none"){
							window.location="index";
						}else{
							alert(a);
						}
					},
					fail: function(){
						showDivError("#adminRegisterError","Cannot connect to server");
					}

				});
			}
		}
	});
});

let passerID;

$(function(){
	$(".passerUnverify").click(function(){
		let dataID = $(this).attr("data-passer");
		passerID = dataID;
		if($("#Modal3").has(":visible")){
			$.ajax({
				url: "selectConditionPasser",
				method: "POST",
				async: false,
				data: {"getData":"","data":dataID},
				success: function(a){
					let obj = JSON.parse(a)["passerDetails"][0];
					if(obj.PasserStatus != 2){
						window.location= "confirmation";
					}else{
						let headName = $("#exampleModalLabel");
						let image = $("img[name=passerProfile]");
						let fname = $("#fname");
						let mname = $("#mname");
						let lname = $("#lname");
						let address = $("#address");
						let gender = $("#gender");
						let birthday = $("#birthday");
						let age = $("#age");
						let cpnum = $("#cnum");
						let cocPic = $("img[name=cocPic]");
						let cocnumber = $("#cocnumber");
						let certificateType = $("#certificateType");
						let expirationDate = $("#expirationDate");
						let jobTitle = $("#jobTitle");
						let governmentFront = $("img[name=governmentFront]");
						let governmentBack = $("img[name=governmentBack]");
						let governmentSelfie = $("img[name=governmentSelfie]");
						let idnum = $("#idNumber");
						let idType = $("#idType");
						let expirationDateGovernmentID = $("#expirationDateGovernmentID");
						headName.empty().html(obj.PasserFN + " " + obj.PasserMname + ". " + obj.PasserLN);
						image.empty().attr("src",obj.PasserProfile);
						fname.empty().val(obj.PasserFN);
						mname.empty().val(obj.PasserMname);
						lname.empty().val(obj.PasserLN);
						address.empty().val(obj.PasserAddress);
						gender.empty().val(obj.PasserGender);
						birthday.empty().val(obj.PasserBirthdate);
						age.empty().val(obj.PasserAge);
						cpnum.empty().val(obj.PasserCPNo);
						cocPic.empty().attr("src",obj.COC);
						cocnumber.empty().val(obj.PasserCOCNo);
						certificateType.empty().val(obj.PasserCertificateType);
						expirationDate.empty().val(obj.PasserCOCExpiryDate);
						jobTitle.empty().append(obj.PasserCertificate);
						governmentFront.empty().attr("src",obj.frontID);
						governmentBack.empty().attr("src",obj.backID);
						governmentSelfie.empty().attr("src",obj.selfie);
						idnum.empty().val(obj.idNumber);
						idType.empty().val(obj.idType);
						expirationDateGovernmentID.empty().val(obj.expirationDate);
					}	
				},
				fail: function(){
					alert("failed to connect to server");
				}
			});
		}
		dataID = "";
	});
});


$(function(){
	$(".verifyPasser").click(function(){
		let responseUser = confirm("Are you sure you want to Approve this user?");
		let myPasserID = passerID;
		passerID = "";
		if(responseUser == true){
			$.ajax({
				url: "updateStatus",
				method: "POST",
				data: {"userStatus":"","table":"passer","field":"PasserStatus","id":myPasserID,"status":"1","userUnique":"PasserID"},
				success: function(a){
					let obj = JSON.parse(a);
					if(obj.error == "none"){
						window.location = "confirmPasser";
					}else{
						alert(a);
					}
				},
				fail: function(){
					alert("Error connecting to server")
				}
			})
			myPasserID = "";
		}
	});
});

$(function(){
	$(".denyPasser").click(function(){
		let responseUser = confirm("Are you sure you want to Deny this user?");
		let myPasserID = passerID;
		passerID = "";
		if(responseUser == true){
			$.ajax({
				url: "updateStatus",
				method: "POST",
				data: {"userStatus":"","table":"passer","field":"PasserStatus","id":myPasserID,"status":"3","userUnique":"PasserID"},
				success: function(a){
					let obj = JSON.parse(a);
					if(obj.error == "none"){
						window.location = "confirmPasser";
					}else{
						alert(a);
					}
				},
				fail: function(){
					alert("Error connecting to server")
				}
			})
			myPasserID = "";
		}
	});
});


let seekerID;

$(function(){
	$(".seekerUnverify").click(function(){
		let dataID = $(this).attr("data-seeker");
		seekerID = dataID;
		if($("#Modal3").has(":visible")){
			$.ajax({
				url: "selectConditionSeeker",
				method: "POST",
				async: false,
				data: {"getData":"","data":dataID},
				success: function(a){
					let obj = JSON.parse(a)["seekerDetails"][0];
					if(obj.SeekerStatus != 2){
						window.location= "confirmation";
					}else{
						let headName = $("#exampleModalLabel");
						let image = $("img[name=seekerProfile]");
						let fname = $("#fname");
						let lname = $("#lname");
						let address = $("#address");
						let gender = $("#gender");
						let birthday = $("#birthday");
						let age = $("#age");
						let cpnum = $("#cnum");
						let cocPic = $("img[name=cocPic]");
						let cocnumber = $("#cocnumber");
						let certificateType = $("#certificateType");
						// let expirationDate = $("#expirationDate");
						let jobTitle = $("#jobTitle");
						let governmentFront = $("img[name=governmentFront]");
						let governmentBack = $("img[name=governmentBack]");
						let governmentSelfie = $("img[name=governmentSelfie]");
						let idnum = $("#idNumber");
						let idType = $("#idType");
						let expirationDateGovernmentID = $("#expirationDateGovernmentID");
						headName.empty().html(obj.SeekerFN + " " + obj.SeekerLN);
						image.empty().attr("src",obj.SeekerProfile);
						fname.empty().val(obj.SeekerFN);
						lname.empty().val(obj.SeekerLN);
						address.empty().val(obj.SeekerAddress);
						gender.empty().val(obj.SeekerGender);
						birthday.empty().val(obj.SeekerBirthdate);
						age.empty().val(obj.SeekerAge);
						cpnum.empty().val(obj.SeekerCPNo);
						cocPic.empty().attr("src",obj.COC);
						cocnumber.empty().val(obj.SeekerCOCNo);
						certificateType.empty().val(obj.SeekerCertificateType);
						// expirationDate.empty().val(obj.)
						jobTitle.empty().val(obj.SeekerCertificate);
						governmentFront.empty().attr("src",obj.frontID);
						governmentBack.empty().attr("src",obj.backID);
						governmentSelfie.empty().attr("src",obj.selfie);
						idnum.empty().val(obj.idNumber);
						idType.empty().val(obj.idType);
						expirationDateGovernmentID.empty().val(obj.expirationDate);
					}	
				},
				fail: function(){
					alert("failed to connect to server");
				}
			});
		}
		dataID = "";
	});
});


$(function(){
	$(".verifySeeker").click(function(){
		let responseUser = confirm("Are you sure you want to Approve this user?");
		let mySeekerID = seekerID;
		seekerID = "";
		if(responseUser == true){
			$.ajax({
				url: "updateStatus",
				method: "POST",
				data: {"userStatus":"","table":"seeker","field":"seekerStatus","id":mySeekerID,"status":"1","userUnique":"SeekerID"},
				success: function(a){
					let obj = JSON.parse(a);
					if(obj.error == "none"){
						window.location = "confirmSeeker";
					}else{
						alert(a);
					}
				},
				fail: function(){
					alert("Error connecting to server")
				}
			})
			mySeekerID = "";
		}
	});
});

$(function(){
	$(".denySeeker").click(function(){
		let responseUser = confirm("Are you sure you want to Deny this user?");
		let mySeekerID = seekerID;
		seekerID = "";
		if(responseUser == true){
			$.ajax({
				url: "updateStatus",
				method: "POST",
				data: {"userStatus":"","table":"seeker","field":"SeekerStatus","id":mySeekerID,"status":"3","userUnique":"SeekerID"},
				success: function(a){
					let obj = JSON.parse(a);
					if(obj.error == "none"){
						window.location = "confirmSeeker";
					}else{
						alert(a);
					}
				},
				fail: function(){
					alert("Error connecting to server")
				}
			})
			mySeekerID = "";
		}
	});
});

$(function(){
	$("a.showMoreDetailPasser").click(function(){
		let id = $(this).attr("data-user");
		let image = $(".userImage");
		let name = $(".userName");
		let createDate = $(".accountCreated");
		let status = $(".userStatus");
		let userStatus;
		$.ajax({
			url: "getDetailsAjaxDynamic",
			method: "POST",
			async: false,
			data: {"user":id,"table":"Passer"},
			success: function(a){
				let obj = JSON.parse(a);
				switch(obj['PasserStatus']){
					case "0":
						userStatus = "Unverified";
					break;

					case "1":
						userStatus = "Verified";
					break;

					case "2":
						userStatus = "Pending";
					break;

					case "3":
						userStatus = "Denied";
					break;

					case "4":
						userStatus = "Deactivated(User Triggered)";
					break;

					case "5":
						userStatus = "Deactivated(Admin Triggered)";
					break;
				}
				image.empty().attr("src",obj['PasserProfile']);
				name.empty().html(obj['PasserFN']+" "+obj['PasserLN']);
				createDate.empty().html(formatDate(obj['passerRegisterTimeDate']));
				status.empty().html(userStatus);
			}
		});
	});

	$("a.showMoreDetailSeeker").click(function(){
		let id = $(this).attr("data-user");
		let image = $(".userImage");
		let name = $(".userName");
		let createDate = $(".accountCreated");
		let status = $(".userStatus");
		let userStatus;
		$.ajax({
			url: "getDetailsAjaxDynamic",
			method: "POST",
			async: false,
			data: {"user":id,"table":"Seeker"},
			success: function(a){
				let obj = JSON.parse(a);
				switch(obj['SeekerStatus']){
					case "0":
						userStatus = "Unverified";
					break;

					case "1":
						userStatus = "Verified";
					break;

					case "2":
						userStatus = "Pending";
					break;

					case "3":
						userStatus = "Denied";
					break;

					case "4":
						userStatus = "Deactivated(User Triggered)";
					break;

					case "5":
						userStatus = "Deactivated(Admin Triggered)";
					break;
				}
				image.empty().attr("src",obj['SeekerProfile']);
				name.empty().html(obj['SeekerFN']+" "+obj['SeekerLN']);
				createDate.empty().html(formatDate(obj['SeekerRegisterDateTime']));
				status.empty().html(userStatus);
			}
		});
	});

});