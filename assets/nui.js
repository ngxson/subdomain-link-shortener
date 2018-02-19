var nui_list;

function loadList() {
	$("#list-html").html("<p><center><img src=\"assets/loading.gif\" height=\"50px\" /></center></p>");
	$.ajax({
		type: "POST",
		url: "api.php",
		data: "action=get",
		dataType: "json",
		success: function(data) {
			nui_list = data;
			var html = "";
			data.forEach((obj, i) => {
				html += `<p id=""><b>${escapeHtml(obj.name)}</b> | Số lượt click: ${escapeHtml(obj.count)} | 
								<a href="${escapeLink(obj.link)}" target="_blank">Tới link gốc</a> |
								<a href="javascript:copyLink(${i})">Copy link ngắn</a>
								</p>`;
			});
			$("#list-html").html(html);
		},
		error: function() {}
	});
}

function doAdd() {
	var datastring = $("#form-add").serialize();
	nui_main._show("loading");
	$.ajax({
		type: "POST",
		url: "api.php",
		data: datastring,
		dataType: "json",
		success: function(data) {
			if (data.success) {
				$("#form-add").get(0).reset();
				$("#link-success").val("http://"+data.url);
				nui_main._show("add-success");
				loadList();
			} else {
				if (data.msg.indexOf("Duplicate")) alert("Lỗi: Tên link này đã có rồi");
				else alert(data.msg);
				nui_main._show("add");
			}
		},
		error: function() {
			alert('ERROR CONNECTION');
			nui_main._show("add");
		}
	});
}

function copySuccess() {
	copyTextToClipboard($("#link-success").val());
}

function copyLink(i) {
	copyTextToClipboard("http://"+nui_list[i].name+"."+nui_base_domain);
}

function doLogin() {
	var datastring = $("#form-login").serialize();
	nui_main._show("loading");
	$.ajax({
		type: "POST",
		url: "api.php",
		data: datastring,
		dataType: "json",
		success: function(data) {
			if (data.timestamp) {
				try {
					var date = new Date();
					date.setTime(date.getTime() + (24*60*60*1000));
					expires = "; expires=" + date.toUTCString();
					document.cookie = "token=" + JSON.stringify(data)  + expires + "; path=/";
					location.hash = "";
					window.location.reload();
				} catch (e) {}
			} else {
				alert("Sai password!");
				$("#form-login").get(0).reset();
				nui_main._show("login");
			}
		},
		error: function() {
			alert('ERROR CONNECTION');
			nui_main._show("login");
		}
	});
}

function doLogout() {
	var date = new Date();
	date.setTime(date.getTime() - (24*60*60*1000));
	expires = "; expires=" + date.toUTCString();
	document.cookie = "token=" + expires + "; path=/";
	window.location.reload();
}

var entityMap = {
  '&': '&amp;',
  '<': '&lt;',
  '>': '&gt;',
  '"': '&quot;',
  "'": '&#39;',
  '/': '&#x2F;',
  '`': '&#x60;',
  '=': '&#x3D;'
};

function escapeHtml (string) {
  return String(string).replace(/[&<>"'`=\/]/g, function (s) {
    return entityMap[s];
  });
}

var entityMapLink = {
  '"': '%22',
  "'": '%27',
  '\\': '%5C'
};

function escapeLink (string) {
  return String(string).replace(/["'\\]/g, function (s) {
    return entityMapLink[s];
  });
}

function copyTextToClipboard(text) {
  var textArea = document.createElement("textarea");
  textArea.style.position = 'fixed';
  textArea.style.top = 0;
  textArea.style.left = 0;
  textArea.style.width = '2em';
  textArea.style.height = '2em';
  textArea.style.padding = 0;
  textArea.style.border = 'none';
  textArea.style.outline = 'none';
  textArea.style.boxShadow = 'none';
  textArea.style.background = 'transparent';
  textArea.value = text;
  document.body.appendChild(textArea);
  textArea.select();
  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
    console.log('Copying text command was ' + msg);
  } catch (err) {
    console.log('Oops, unable to copy');
  }
  document.body.removeChild(textArea);
}

loadList();
