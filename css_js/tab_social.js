//短信息
function setMessageTab ( i )
 {
  selectMessageTab(i);
 }
function selectMessageTab ( i )
 {
  switch(i){
   case 1:
   document.getElementById("messagetab1").style.display="block";
   document.getElementById("messagetab2").style.display="none";
   document.getElementById("option1").style.background="#ffffff";
   document.getElementById("option2").style.background="#eeeeee";
   break;
   case 2:
   document.getElementById("messagetab1").style.display="none";
   document.getElementById("messagetab2").style.display="block";
   document.getElementById("option1").style.background="#eeeeee";
   document.getElementById("option2").style.background="#ffffff";
   break;
  }
 }
 
//好友
function setFriendTab ( i )
 {
  selectFriendTab(i);
 }
function selectFriendTab ( i )
 {
  switch(i){
   case 1:
   document.getElementById("friendtab1").style.display="block";
   document.getElementById("friendtab2").style.display="none";
   document.getElementById("option1").style.background="#ffffff";
   document.getElementById("option2").style.background="#eeeeee";
   break;
   case 2:
   document.getElementById("friendtab1").style.display="none";
   document.getElementById("friendtab2").style.display="block";
   document.getElementById("option1").style.background="#eeeeee";
   document.getElementById("option2").style.background="#ffffff";
   break;
  }
 }
 
//群组
function setGroupTab ( i )
 {
  selectGroupTab(i);
 }
function selectGroupTab ( i )
 {
  switch(i){
   case 1:
   document.getElementById("grouptab1").style.display="block";
   document.getElementById("grouptab2").style.display="none";
   document.getElementById("option1").style.background="#ffffff";
   document.getElementById("option2").style.background="#eeeeee";
   break;
   case 2:
   document.getElementById("grouptab1").style.display="none";
   document.getElementById("grouptab2").style.display="block";
   document.getElementById("option1").style.background="#eeeeee";
   document.getElementById("option2").style.background="#ffffff";
   break;
  }
 }
 
//日记
function setDiaryTab ( i )
 {
  selectDiaryTab(i);
 }
function selectDiaryTab ( i )
 {
  switch(i){
   case 1:
   document.getElementById("diarytab1").style.display="block";
   document.getElementById("diarytab2").style.display="none";
   document.getElementById("option1").style.background="#ffffff";
   document.getElementById("option2").style.background="#eeeeee";
   break;
   case 2:
   document.getElementById("diarytab1").style.display="none";
   document.getElementById("diarytab2").style.display="block";
   document.getElementById("option1").style.background="#eeeeee";
   document.getElementById("option2").style.background="#ffffff";
   break;
  }
 }

//留言板
function setMessageBoardTab ( i )
 {
  selectMessageBoardTab(i);
 }
function selectMessageBoardTab ( i )
 {
  switch(i){
   case 1:
   document.getElementById("messageboardtab1").style.display="block";
   document.getElementById("messageboardtab2").style.display="none";
   document.getElementById("option1").style.background="#ffffff";
   document.getElementById("option2").style.background="#eeeeee";
   break;
   case 2:
   document.getElementById("messageboardtab1").style.display="none";
   document.getElementById("messageboardtab2").style.display="block";
   document.getElementById("option1").style.background="#eeeeee";
   document.getElementById("option2").style.background="#ffffff";
   break;
  }
 }
 
//系统消息
function setSystemMessageTab ( i )
 {
  selectSystemMessageTab(i);
 }
function selectSystemMessageTab ( i )
 {
  switch(i){
   case 1:
   document.getElementById("systemmessagetab1").style.display="block";
   document.getElementById("systemmessagetab2").style.display="none";
   document.getElementById("option1").style.background="#ffffff";
   document.getElementById("option2").style.background="#eeeeee";
   break;
   case 2:
   document.getElementById("systemmessagetab1").style.display="none";
   document.getElementById("systemmessagetab2").style.display="block";
   document.getElementById("option1").style.background="#eeeeee";
   document.getElementById("option2").style.background="#ffffff";
   break;
  }
 }
 
//音乐
function setMusicTab ( i )
 {
  selectMusicTab(i);
 }
function selectMusicTab ( i )
 {
  switch(i){
   case 1:
   document.getElementById("musictab1").style.display="block";
   document.getElementById("musictab2").style.display="none";
   document.getElementById("option1").style.background="#ffffff";
   document.getElementById("option2").style.background="#eeeeee";
   break;
   case 2:
   document.getElementById("musictab1").style.display="none";
   document.getElementById("musictab2").style.display="block";
   document.getElementById("option1").style.background="#eeeeee";
   document.getElementById("option2").style.background="#ffffff";
   break;
  }
 }
 
//照片
function setPictrueTab ( i )
 {
  selectPictrueTab(i);
 }
function selectPictrueTab ( i )
 {
  switch(i){
   case 1:
   document.getElementById("pictruetab1").style.display="block";
   document.getElementById("pictruetab2").style.display="none";
   document.getElementById("option1").style.background="#ffffff";
   document.getElementById("option2").style.background="#eeeeee";
   break;
   case 2:
   document.getElementById("pictruetab1").style.display="none";
   document.getElementById("pictruetab2").style.display="block";
   document.getElementById("option1").style.background="#eeeeee";
   document.getElementById("option2").style.background="#ffffff";
   break;
  }
 }
 
//照片上传
function setImageUploadTab ( i )
 {
  selectImageUploadTab(i);
 }
function selectImageUploadTab ( i )
 {
  switch(i){
   case 1:
   document.getElementById("imageuploadtab1").style.display="block";
   document.getElementById("imageuploadtab2").style.display="none";
   document.getElementById("option1").style.background="#ffffff";
   document.getElementById("option2").style.background="#eeeeee";
   break;
   case 2:
   document.getElementById("imageuploadtab1").style.display="none";
   document.getElementById("imageuploadtab2").style.display="block";
   document.getElementById("option1").style.background="#eeeeee";
   document.getElementById("option2").style.background="#ffffff";
   break;
  }
 }
 

//空间-写贴板块
function setHomeWriteTab ( i )
 {
  selectHomeWriteTab(i);
 }
 
 function selectHomeWriteTab ( i )
 {
  switch(i){
   case 1:
   document.getElementById("homewritetab1").style.display="block";
   document.getElementById("homewritetab2").style.display="none";
   document.getElementById("writeoption1").style.background="#ffffff";
   document.getElementById("writeoption2").style.background="#eeeeee";
   break;
   case 2:
   document.getElementById("homewritetab1").style.display="none";
   document.getElementById("homewritetab2").style.display="block";
   document.getElementById("writeoption1").style.background="#eeeeee";
   document.getElementById("writeoption2").style.background="#ffffff";
   break;
  }
 }
 
//空间-动态板块
function setHomeViewArticleTab ( i )
 {
  selectHomeViewArticleTab(i);
 }
 
 function selectHomeViewArticleTab ( i )
 {
  switch(i){
   case 1:
   document.getElementById("homeviewarticletab1").style.display="block";
   document.getElementById("homeviewarticletab2").style.display="none";
   document.getElementById("viewoption1").style.background="#ffffff";
   document.getElementById("viewoption2").style.background="#eeeeee";
   break;
   case 2:
   document.getElementById("homeviewarticletab1").style.display="none";
   document.getElementById("homeviewarticletab2").style.display="block";
   document.getElementById("viewoption1").style.background="#eeeeee";
   document.getElementById("viewoption2").style.background="#ffffff";
   break;
  }
 }

//用户设置页面
function setAccountSettingTab ( i )
 {
  selectAccountSettingTab(i);
 }
function selectAccountSettingTab ( i )
 {
  switch(i){
   case 1:
   document.getElementById("accountsettingtab1").style.display="block";
   document.getElementById("accountsettingtab2").style.display="none";
   document.getElementById("accountsettingtab3").style.display="none";
   document.getElementById("accountsettingtab4").style.display="none";
   document.getElementById("accountsettingtab5").style.display="none";
   document.getElementById("option1").style.background="#ffffff";
   document.getElementById("option2").style.background="#eeeeee";
   document.getElementById("option3").style.background="#eeeeee";
   document.getElementById("option4").style.background="#eeeeee";
   document.getElementById("option5").style.background="#eeeeee";
   break;
   case 2:
   document.getElementById("accountsettingtab1").style.display="none";
   document.getElementById("accountsettingtab2").style.display="block";
   document.getElementById("accountsettingtab3").style.display="none";
   document.getElementById("accountsettingtab4").style.display="none";
   document.getElementById("accountsettingtab5").style.display="none";
   document.getElementById("option1").style.background="#eeeeee";
   document.getElementById("option2").style.background="#ffffff";
   document.getElementById("option3").style.background="#eeeeee";
   document.getElementById("option4").style.background="#eeeeee";
   document.getElementById("option5").style.background="#eeeeee";
   break;
   case 3:
   document.getElementById("accountsettingtab1").style.display="none";
   document.getElementById("accountsettingtab2").style.display="none";
   document.getElementById("accountsettingtab3").style.display="block";
   document.getElementById("accountsettingtab4").style.display="none";
   document.getElementById("accountsettingtab5").style.display="none";
   document.getElementById("option1").style.background="#eeeeee";
   document.getElementById("option2").style.background="#eeeeee";
   document.getElementById("option3").style.background="#ffffff";
   document.getElementById("option4").style.background="#eeeeee";
   document.getElementById("option5").style.background="#eeeeee";
   break;
   case 4:
   document.getElementById("accountsettingtab1").style.display="none";
   document.getElementById("accountsettingtab2").style.display="none";
   document.getElementById("accountsettingtab3").style.display="none";
   document.getElementById("accountsettingtab4").style.display="block";
   document.getElementById("accountsettingtab5").style.display="none";
   document.getElementById("option1").style.background="#eeeeee";
   document.getElementById("option2").style.background="#eeeeee";
   document.getElementById("option3").style.background="#eeeeee";
   document.getElementById("option4").style.background="#ffffff";
   document.getElementById("option5").style.background="#eeeeee";
   break;
   case 5:
   document.getElementById("accountsettingtab1").style.display="none";
   document.getElementById("accountsettingtab2").style.display="none";
   document.getElementById("accountsettingtab3").style.display="none";
   document.getElementById("accountsettingtab4").style.display="none";
   document.getElementById("accountsettingtab5").style.display="block";
   document.getElementById("option1").style.background="#eeeeee";
   document.getElementById("option2").style.background="#eeeeee";
   document.getElementById("option3").style.background="#eeeeee";
   document.getElementById("option4").style.background="#eeeeee";
   document.getElementById("option5").style.background="#ffffff";
   break;
  }
 }