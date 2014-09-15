function getStep() {
	var forms = $('.applications section');
	var nextBtn = $('.nextForm');  //get the 'next' button
	var prevBtn = $('.prevForm');
	var index=0;
	var submitBtn = $('#confirm ');
	var tabList = $('ul#application_tablist li'); 

	nextBtn.on('click', function() {
		for(i=0; i<forms.length; i++) {
			var className= $(forms[i]).attr('class');
			if (className.indexOf('active')!= -1) {
				index =i;
			}
		}
		var form = $(forms[index]).find('form');
		/* swicht tabs and forms */
		$(forms[index]).removeClass('active');
		$(forms[index+1]).addClass('active');
		$(tabList[index]).removeClass('active');
		$(tabList[index+1]).addClass('active');

	});

	/* sned loan application information to back end through Ajax*/
	submitBtn.on('click', function() {
		var info = $('#form1,#form2,#form3').serialize();
		console.log(info);
		$.ajax({
			type:'POST',
			url:"/submitLoan",
			datatype:'json',
			data:info,
			success:function(json) {
				window.location.href="http://deco3801-05.uqcloud.net/profile";
			}
		})
	});


}

function enableBtns() {
	
	/*search mathcing application*/
	$('#Search').on('click', function() {
		$('#pref_pop').submit();
	});
	/*save profile */
	$('#saveProfileBtn').on('click', function() {
		$('#ProfileForm').submit();
	});
	/*enable logain btn*/
	$('#loginBtn').on('click',function() {
		$('#loginForm').submit();
	});
	/*enable register btn*/
	$('#regBtn').on('click',function() {
		$('#regForm').submit();
	});
}

