// window.onload
// 区别一：$(function  () 比window.onload先执行
// 区别二：如果出现多个 $(function  () 里面的代码都会被执行
// 			如果出现多个 window.onload 里面的代码就执行一块
// $(function  ()

	// $(function  () {
		
	// })
	// $(function  () {
		
	// })

	// window.onload

	// window.onload



$(function  () {
	$('.menu_box .menu_tab').click(function  () {
		if($(this).index()==0){
			$("#type").val("short_content");
		}else if($(this).index()==1){
			$("#type").val("pic_text");
		}else if($(this).index()==2){
			$("#type").val("music");
		}
	})

	// 最外面的ul 盒子
	$(".list_box").click(function  (e) {
		let this_elm = $(e.target);
		// 点击开始评论
		if(this_elm.hasClass("commont_btn")){

			let commont_form_box = this_elm.parent().siblings(".commont_form_box");
			commont_form_box.toggle(500);

			// 获取下，如果当前有评论，你才去请求ajax
			if (this_elm.attr("data-num")>0) {
				let weibo_id = this_elm.attr("data-id");
				$.post("commont_do.php",{weibo_id,type:"select"},function  (rtnData) {
					// json字符串 转换 为json对象
					
					rtnData = JSON.parse(rtnData)

					let li_html="";
					// 遍历出来
					rtnData.forEach(item=>{
						 // 不要遍历一次添加一次
						 li_html+="<li>"+item.commont_content+" <span class='del_commont pull-right' data-id='"+item.id+"'> x </span></li>";
					})
					commont_form_box.find(".commont_list").html(li_html);
				})
			}


		}else if(this_elm.hasClass("send_commont")){
			// 发送评论逻辑
			let commont_content = this_elm.siblings(".commont_texarea").val();
			let weibo_id = this_elm.attr("data-id");

			$.post("commont_do.php",{commont_content,weibo_id,type:"add"},function  (rtnData) {

				 rtnData = JSON.parse(rtnData);

				 let user_name = localStorage.getItem('user_name');

				// 往评论ul盒子.commont_list
				this_elm.siblings(".commont_list").prepend("<li>"+user_name+"说："+commont_content+" <span class='del_commont pull-right' data-id='"+rtnData.id+"'> x </span></li>");

				let cur_num_box = this_elm.parent().siblings(".mananga_box").find('.num_val_box');
			 	let old_val = cur_num_box.html();

			 	cur_num_box.html(++old_val)


			})

		}else if(this_elm.hasClass("del_commont")){
			// 删除评论
			let commont_id =  this_elm.attr('data-id')
			 $.post("commont_do.php",{commont_id,type:"delete"},function  (rtnData) {
			 	let cur_num_box = this_elm.parent().parent().parent().siblings(".mananga_box").find('.num_val_box');
			 	let old_val = cur_num_box.html();

			 	cur_num_box.html(--old_val)

			 	this_elm.parent().remove();
			})
		}else if(this_elm.hasClass("delWeiboBox")){
			$("#modal_weibo_id").val(this_elm.attr("data-id"));
			
		}


	})


	$(".music_list_box").on("click","li",function  () {
	 music_data_info.music_pic = $(this).attr('data-pic') ;
	 music_data_info.music_mp3 = $(this).attr('data-mp3') ;
	 music_data_info.music_singer = $(this).attr('data-artists') ;

		$(".preview_box").html("<img src='"+$(this).attr('data-pic')+"' /> <audio  controls src='"+$(this).attr('data-mp3')+"' />")
	})

	$(".list_box").on("mouseover",".head_photo_box",function  () {
		console.log($(this).offset())
		$(".head_show_box").show().css("top",$(this).offset().top+$(this).height()).css("left",$(this).offset().left);

		$.post("index.php?control=weibo&action=getLastInfo",{uid:$(this).attr('data-uid')},function  (rtnData) {
				rtnData = JSON.parse(rtnData);

				let p_html = ""
				rtnData.forEach(item=>{
					p_html+= "微博内容是"+item.weibo_content
				})

				$(".head_show_box").html(p_html);
		})
	})

	$(".list_box").on("mouseout",".head_photo_box",function  () {
		$(".head_show_box").hide()
	})

	$(".head_show_box").on("mouseover",function  () {
		$(".head_show_box").show()
	})

	$(".head_show_box").on("mouseout",function  () {
		$(".head_show_box").hide()
	})


})
// 两种函数定义方法：
// 自变量定义


function submit_weibo () {

	if (!hasLogin()) {
		alert('请先登录!');
		return;
	}

	// ajax提交到后端api，告诉你是否发布成功
	//第一个参数：url地址
	//第二个参数：要传给后台的值，类型是对象
	//第三个参数：回调函数
	
	// 提交给后台加多一个内容类型
	var type = $("#type").val();
	console.log($("#type"));
	if (type=='short_content') {
			// 获取微博内容
	 	var text = $("#"+type).val();
		$.post("index.php?control=weibo&action=sendWeibo",{weibo_content:text,type},function  (rtnData) {
				// 如果成功，就无页面刷新底部列表（最后加一些动效）
			 	let rtnObject = JSON.parse(rtnData);

			 	console.log(2)
			 	if (rtnObject.status == 1) {
			 		// 样式要js 
			 		$(".list_box").prepend(rtnObject.html);
			 	}else{
			 	    alert(rtnObject.msg);
                }
			 	
			})

	}else if (type=='pic_text' ) {

		// console.log($("#pic_file").get(0).files[0]);
	   var fd = new FormData();
		var text = $("#"+type).val();
	   fd.append("type",type);
	   fd.append("weibo_content",text);
	   fd.append("pic_file",$("#pic_file").get(0).files[0]);

        $.ajax({
        	url:"post_do.php",
        	type:"post",
        	contentType:false,
        	processData:false,//为false则传给后台的不是对象
        	data:fd,
        	success:function  (rtnData) {
        		let rtnObject = JSON.parse(rtnData);
			 	console.log(2)
			 	if (rtnObject.status == 1) {
			 		// 样式要js 
			 		$(".list_box").prepend(rtnObject.html);
			 	}else{
			 	    alert(rtnObject.msg);
                }
        	}
        });

	}
	else if (type=='music') {

		// console.log($("#pic_file").get(0).files[0]);
	   var fd = new FormData();
	   var text = $("#"+type).val();

	   fd.append("music_data_info",JSON.stringify(music_data_info))
	   fd.append("type",type);
	   fd.append("weibo_content",text);
	   fd.append("music_file",$("#music_file").get(0).files[0]);

        $.ajax({
        	url:"post_do.php",
        	type:"post",
        	contentType:false,
        	processData:false,//为false则传给后台的不是对象
        	data:fd,
        	success:function  (rtnData) {
        		let rtnObject = JSON.parse(rtnData);
			 	console.log(2)
			 	if (rtnObject.status == 1) {
			 		// 样式要js 
			 		$(".list_box").prepend(rtnObject.html);
			 	}else{
			 	    alert(rtnObject.msg);
                }
        	}
        });

	}
	
	
	
}

// 判断是有登录
function hasLogin () {
	  let uid = localStorage.getItem("uid");
	  if (uid>0) {
	  	return true
	  }else{
	  	return false;
	  }
}

//登录
function doLogin () {
	// 用户名只支持手机号码
	let user_name = $("#user_log_name").val();
	// 密码必须是6到18位
	let user_pwd = $("#user_log_pwd").val();
	 

	 $.post("index.php?control=user&action=login",{user_name,user_pwd},function  (rtnData) {
				  // 用户信息 ，id、用户名、
				   
				   rtnData = JSON.parse(rtnData);
				   if (rtnData.status == 1) {
					   	$("#loginBox").modal("hide");
					   	 localStorage.setItem("uid",rtnData.info.id);
					   	 localStorage.setItem("user_name",rtnData.info.user_name);

					   	 $(".user_status_box").html(rtnData.info.user_name+" ,欢迎你。 <a onclick='logout()'>退出</a>");
				   }else{
				   		alert(rtnData.msg);
				   }
				  


	 })
}
//注册
function doReg () {
	// 用户名只支持手机号码
	let user_name = $("#user_name").val();
	// 密码必须是6到18位
	let user_pwd = $("#user_pwd").val();
	// 重复密码需和密码一致
	let user_repwd = $("#user_repwd").val();

	 $.post("index.php?control=user&action=add",{user_name,user_pwd},function  (rtnData) {
				  // 用户信息 ，id、用户名、
				   
				   rtnData = JSON.parse(rtnData);

				   localStorage.setItem("uid",rtnData.uid);
				   localStorage.setItem("user_name",user_name);
					$("#registerBox").modal("hide");
				  	 $(".user_status_box").html(user_name+" ,欢迎你。 <a onclick='logout()'>退出</a>");

	 })
}
//退出
function logout () {
	 localStorage.removeItem("uid");
	 localStorage.removeItem("user_name");

	  $.post("index.php?control=user&action=logout",function  (rtnData) {
				  	 $(".user_status_box").html('<a href="#loginBox" data-toggle="modal">登录</a> | <a href="#registerBox" data-toggle="modal">注册</a>');
	  	// 退出显示
	 })
}

// 删除微博
function delWeibo () {
	let weibo_id = $("#modal_weibo_id").val();

	$.post("post_do.php",{weibo_id,type:"delWeibo"},function  (rtnData) {
		$("#modal_box").modal('hide');
		// 隐藏当前微博节点
		 
	})

}

function sendPhoto () {
	// 后面头像，上传视频。带进度条
	
	  var fd = new FormData();
	  fd.append("type","addPhoto");
	  fd.append("headPhoto",$("#headPhoto").get(0).files[0]);

        $.ajax({
        	url:"user_do.php",
        	type:"post",
        	contentType:false,
        	processData:false,//为false则传给后台的不是对象
        	data:fd,
        	success:function  (rtnData) {
        		 	location.reload();
        	}
        });
}

var music_data_info = {};

function searchMusic (this_eml) {



	 let s = $(this_eml).val();

	 music_data_info.music_name = s ;
	 $.getJSON("http://s.music.163.com/search/get/?version=1&src=lofter&type=1&filterDj=false&s="+s+"&limit=8&offset=0&callback=?",function  (rtnData) {
	 	console.log(rtnData)
	 		let li_html = ''
	 		rtnData.result.songs.forEach(item=>{
	 				li_html+="<li data-pic='"+item.album.picUrl+"' data-mp3='"+item.audio+"'  data-artists='"+item.artists[0].name+"'>"+item.name+"-"+item.artists[0].name+"</li>"
	 		})

	 		$(".music_list_box").html(li_html)
	 })
}