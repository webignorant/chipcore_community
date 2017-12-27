/*
调用kindeditor编辑器
<script src="/kindeditor/kindeditor.js"></script>
<script src="/kindeditor/lang/zh_CN.js"></script>
<script>
	var editor;
	KindEditor.ready(function(K) {
		editor = K.create('textarea[name="content"]', {
			allowFileManager : true
		});
	});
   html = editor.html();

   // 同步数据后可以直接取得textarea的value
   editor.sync();
   html = document.getElementById('content').value; // 原生API
   html = K('#editor_id').val(); // KindEditor Node API
   html = $('#editor_id').val(); // jQuery

   // 设置HTML内容
   editor.html('HTML内容');
</script>

onSubmit="editor.sync();"
*/
	var editor;
	
	  KindEditor.ready(function(K) {
					Editor = K.create('textarea[name="content"]', {
						resizeType : 1,
						allowPreviewEmoticons : false,
						allowImageUpload : false,
						items : [
							'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
							'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
							'insertunorderedlist', '|', 'emoticons', 'image', 'link']
					});
		});

   html = editor.html();

   // 同步数据后可以直接取得textarea的value
   editor.sync();
   html = document.getElementById('content').value; // 原生API
   html = K('#editor_id').val(); // KindEditor Node API
   html = $('#editor_id').val(); // jQuery

   // 设置HTML内容
   editor.html('HTML内容');

