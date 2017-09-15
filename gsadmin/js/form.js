  $(document).ready(function() {

		//	fLoadData("#listContents","./list.php");

			
			//$('#login_form').ajaxForm({beforeSubmit:validateLogin,success:showResponseLogin});

			var options = {//로그인
				beforeSubmit:validateLogin,
				success:showResponseLogin
			};
			$('#login_form').ajaxForm(options);

			var options2 = {//관리자계정
				beforeSubmit:validateAdmin,
				success:showResponseAdmin
			};
			$('#admin_form').ajaxForm(options2);


        });


function validateLogin(formData, jqForm, options) {//로그인
			var frm = document.login_form;
			if (frm.userid.value==""){
				alert("아이디를 입력해 주세요.");
				frm.admin_userid.focus();
				return false;
			}
				if (frm.pass.value==""){
				alert("비밀번호를 입력해 주세요.");
				frm.pass.focus();
				return false;
			}
		}

		function showResponseLogin(responseText, statusText, xhr, $form)  {//로그인

			if(responseText=='y'){

					location.href="./main.php"

			}else if(responseText=='n'){
					
					$(".container-fluid").append("<div class='alert alert-danger col-md-4 col-md-offset-4 text-center'>아이디 또는 비밀번호가 맞지 않습니다.</div>");
					setTimeout( function(){ $(".alert-danger").remove(); },1500);

			}

}



function validateAdmin(formData, jqForm, options2) {//관리자계정
			var frm = document.admin_form;
			if (frm.admin_userid.value==""){
				alert("아이디를 입력해 주세요.");
				frm.admin_userid.focus();
				return false;
			}
				if (frm.admin_passwd.value==""){
				alert("비밀번호를 입력해 주세요.");
				frm.admin_passwd.focus();
				return false;
			}
		}

		function showResponseAdmin(responseText, statusText, xhr, $form)  {//관리자계정

			if(responseText=='y'){
					
					alert('수정 되었습니다.');
					

			//		fLoadData("#listContents","./list.php");
					/*
					$("#listContents").empty();
					fLoadData("#listContents","./inc_logout.php");
					*/

			}else if(responseText=='n'){
					
					alert("실패");

			}

}




function fLoadData(divID,strUrl){
	$.ajax({
		type: "POST",
		url: strUrl,
		data: "",
		success: function(resultText){
			$(divID).html(resultText);
		},
		error: function() {
			//alert("호출에 실패했습니다.");
		}
	});
}


