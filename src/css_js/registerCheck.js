window.onload=function checkValue()
{
	//检查电子邮件
	if(form_register.email.value=="")
	{
		document.getElementById('checkemail').style.display='block';
		form_register.email.select();
		return(false);
	}
	else
	{
		document.getElementById('checkemail').style.display='none';
	}
	
	if(!checkemail(form_register.email.value))
	{
		alert("邮箱地址格式不正确!");
		form_register.email.select();
		return(false);
	}else
	{
		return(true);	
	}
	
	//检查密码
	if(form_register.password.value=="")
	{
		document.getElementById('checkpassword').style.display='block';
		form_register.password.select();
		return(false);
	}
	else
	{
		document.getElementById('checkpassword').style.display='none';
	}
	
	//检查检测密码
	if(form_register.otherpassword.value=="")
	{
		document.getElementById('checkotherpassword').style.display='block';
		form_register.otherpassword.select();
		return(false);
	}
	else
	{
		document.getElementById('checkotherpassword').style.display='none';
	}
	
	//检查真实姓名
	if(form_register.realname.value=="")
	{
		document.getElementById('checkrealname').style.display='block';
		form_register.realname.select();
		return(false);
	}
	else
	{
		document.getElementById('checkrealname').style.display='none';
	}
	
	//检查居住地点
	if(form_register.location.value=="")
	{
		document.getElementById('checklocation').style.display='block';
		form_register.realname.select();
		return(false);
	}
	else
	{
		document.getElementById('checklocation').style.display='none';
	}
	
	if(form_register.password.value!=form_register.otherpassword.value)
	{
		alert("两次的密码不一样!");
		form_register.otherpassword.select();
		return(false);
	}	
	else
	{
		document.getElementById('checkotherpassword').style.display='none';
	}
	
	function checkEmail(email)
	{
		var strs=email;
		var Expression=/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
		var objExp=new RegExp(Expression);
		if(objExp.test(strs)==true)
		{
			return true;
		}else
		{
			return false;
		}
	}
	
	function checkphone(tel)
	{
		var str=tel;
		var Expression=/^(\d{3}-)(\d{8})$|^(\d{4}-)(\d{7})$|^(\d{4}-)(\d{8})$|^(\d{11})$/;  
		var objExp=new RegExp(Expression);
		if(objExp.test(str)==true)
		{
			return true;
		}else
		{
			return false;
		}
	}

}
