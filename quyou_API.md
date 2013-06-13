Author:  	blacklaw
Date:		2013-05-17
Version:		0.1.2
Email:		blackaw00@gmail.com
LastChange:	2013-05-22
---------------------------------------------

接口列表
* 登录  			[login](#login) 
* 注册  			[register](#register) 
*获取上传图片sign  [uploadimage](#uploadimage) 
4.检查用户名有效性  [checkusername](#checkusername) 
5.人人授权  		  [renren_auth](#renren_auth) 
6.检查授权状态  	[check_auth](#check_auth)
7.系统推荐  		[recommand](#recommand)
8.用户预览		[preview](#preview)
9.获取会话id  		[chatbegin](#chatbegin)
10.储存会话id  		[pushbind](#pushbind)
11.个人中心get		[usercenter(get)](#usercenter_get)
12.个人中心set		[usercenter(set)](#usercente_set)
13.意见反馈		[advice](#advice)    [后台管理,密码帐号均为 advice]("http://kam1638.duapp.com/admin/quyou/advice/")
14.个人信息		[userinfo](#userinfo)

 
  <br>

关闭测试请在setting中打开注释掉中间件 GetToPostMiddleware(默认打开)

  <a id='login'/>接口名：	<b class ='api_title'> login </b>
描述:		登录时提供验证服务
调用方式:	POST
请求地址:	http://kam1638.duapp.com/quyou/login
测试地址:	  ["http://kam1638.duapp.com/quyou/login/?username=happy&password=wsxedc"]http://kam1638.duapp.com/quyou/login/?username=happy&password=wsxedc</a>
请求参数:	
			username	string	登录时的用户名
			password	string 	登录时的密码
返回参数:
			success 	boolean	登录验证是否通过
			msg			string	相关的参考信息(disable/not exist)
			user_id		int 	用户id

  <a id="register"/>接口名:	<b class ='api_title'> register </b>
描述:		提供应用的注册服务
调用方式:	POST
请求地址:	http://kam1638.duapp.com/quyou/register
测试地址:	  <a href="http://kam1638.duapp.com/quyou/register/?username=happyd&password=wsxedc&sex=1">http://kam1638.duapp.com/quyou/register/?username=happyd&password=wsxedc&sex=1</a>
请求参数:	
			username	string	注册使用的用户名，中英文均可，无特殊限制，
			password 	string	注册时提供的密码！最好提供强度检查
			sex 		int		性别，1男0女
返回参数:
			success		boolean	注册是否成功
			user_id		int		如果success为 True 返回的是用户ID


<a id ="uploadimage">接口名:	<b class ='api_title'> uploadimage </b>
描述:		上传图片时调用，注意，需要配合百度云存储的sdk使用
请求方式:	POST
请求地址:	http://kam1638.duapp.com/quyou/uploadimage
测试地址:	<a href="http://kam1638.duapp.com/quyou/uploadimage/?user_id=166">http://kam1638.duapp.com/quyou/uploadimage/?user_id=166</a>
请求参数:	
			user_id 	id	   请求上传的用户id
返回参数:	
			success		boolean	上传是否成功
			msg			string  成功的话msg为sign参数
			*msg		string  失败的话msg为错误信息


  <a id ="checkusername"/>接口名:	<b class ='api_title'> checkusername </b>
描述:		注册时检查用户名是否可注册
请求方式:	POST
请求地址:	http://kam1638.duapp.com/quyou/checkusername
测试地址:	  <a href="http://kam1638.duapp.com/quyou/checkusername/?username=happyasdf">http://kam1638.duapp.com/quyou/checkusername/?username=happyasdf</a>
请求参数:
			username	string		当前用户名
返回参数:
			success 	boolean		用户名可注册(True)/已注册(False)
        

  <a id ="renren_auth"/>接口名:	<b class ='api_title'> renren_auth/&lt;user_id&gt; </b>
描述:		绑定人人时作为回调地址使用,请将register返回的user_id写到地址上去
请求方式:	GET
请求地址:	http://kam1638.duapp.com/quyou/renren_auth/&lt;user_id(int)&gt;
请求参数:	
			*user_id	int			通过register时返回的用户id,直接写作接口的URL
			*code		string		请不要调用，这是认证时，由人人主动调用追加的参数
返回参数:
			success		boolean		是否验证成功，False失败
			msg			string		失败时返回的参考文本
			num			int			失败时的参考 error_num 可以参考相关文档
			*&lt;HTML&gt;		string		当人人回调成功时返回的页面（非json格式）

    
  <a id ="check_auth"/>接口名:	 <b class ='api_title'> check_auth </b>
描述:		检查是否授权成功，在人人授权view退出后调用
请求方式:	POST
请求地址:	http://kam1638.duapp.com/quyou/check_auth
测试地址:	  <a href="http://kam1638.duapp.com/quyou/check_auth/?username=happy">http://kam1638.duapp.com/quyou/check_auth/?username=happy</a>
请求参数:	
			username 	string		需要进行授权检查的用户名
返回参数:
			success		boolean		是否授权成功
			msg			string		失败时相关的参考信息,成功时返回授权信息
			num         int		    相关的参考号
  			access_token 	string     成功返回
			expires_in		string     成功返回
			refresh_token	string     成功返回
			scope 	        string     成功返回
			user_id 	    string     成功返回

		
  <a id ="recommand"/>
接口名:	<b class ='api_title'> recommand </b>
描述:		为用户推荐好友
请求方式:	POST
请求地址:	http://kam1638.duapp.com/quyou/recommand
测试地址:	  <a href="http://kam1638.duapp.com/quyou/recommand/?user_id=143">http://kam1638.duapp.com/quyou/recommand/?user_id=143</a>
请求参数:	
			user_id 	当前用户的ID
返回参数:	
  		success		boolean		是否成功
  		num 		int			参考标识
  		msg	成功:json数组		失败 string 参考信息
				name	string		推荐用户用户名
				age		int			年龄
				sex		int			性别，1男0女
				pic		string(URL)	图片地址 
				school	string		推荐用户学校名
  
  
  <a id ="preview"/>
接口名:	<b class ='api_title'> preview </b>
描述:		登录时提供可供预览的用户
请求方式:	POST
请求地址:	http://kam1638.duapp.com/quyou/preview
测试地址:	  <a href="http://kam1638.duapp.com/quyou/preview">http://kam1638.duapp.com/quyou/preview</a>
请求参数:	NULL
返回参数:	
  		success		boolean		是否成功
  		num 		int			参考标识
  		msg	成功:json数组		失败 string 参考信息
				picURL string	图片地址
  
  
  <a id ="chatbegin"/>
接口名:	<b class ='api_title'> chatbegin </b>
描述:		对话开始时,需要向服务器请求一些基本数据
请求方式: 	POST
请求地址:	http://kam1638.duapp.com/quyou/chatbegin
测试地址:	  <a href="http://kam1638.duapp.com/quyou/chatbegin/?to=happy">http://kam1638.duapp.com/quyou/chatbegin/?to=happy</a>
请求参数:	
			to 		string		需要对话的目的用户名
返回参数:
			success 	boolean 	是否获取成功
			msg			string		失败时返回的参考数据
			channelid	int			成功时返回的channelid
 			userid		int			成功时返回的用户id

  <a id="pushbind"/>
接口名:	<b class ='api_title'> pushbind </b>
描述:		通信时，在Activity断开时依然可以重新建立链接
请求方式:	POST
请求地址:	http://kam1638.duapp.com/quyou/pushbind
测试地址:	  <a href="http://kam1638.duapp.com/quyou/pushbind/?channelid=2143&userid=2341&appid=asff&username=happyh">http://kam1638.duapp.com/quyou/pushbind/?channelid=2143&userid=2341&appid=asff&username=happyh</a>
请求参数:
			username	string		需要保存的用户名
			appid		string		app的标识
			channelid	int			channelid标识
			userid		id			用户id???是目的用户ID吗？
返回参数:
			success		boolean		保存成功，失败是因为用户名不存在 

<a id="usercenter_get"/>
接口名:	<b class ='api_title'> usercenter(get) </b>
描述:		用户中心，action = get
请求方式:	POST
请求地址:	http://kam1638.duapp.com/quyou/usercenter
测试地址:	  <a href="http://kam1638.duapp.com/quyou/usercenter/?action=get&user_id=166">http://kam1638.duapp.com/quyou/usercenter/?action=get&user_id=166</a>
请求参数:
			user_id		int		需要取数据的用户id
			action		string		动作，获取数据时为 get
返回参数:
  			success			boolean		是否设置成功
  			msg				string		失败时参考消息
			signature		string	个性签名
  			relationship	int		感情状态
			declaration		string	恋爱宣言
			interests		string	个人兴趣 
			character		string 	性格色彩

  <a id="usercenter_set"/>
接口名:	<b class ='api_title'> usercenter(set) </b>
描述:		用户中心，action = get
请求方式:	POST
请求地址:	http://kam1638.duapp.com/quyou/usercenter
测试地址:	  <a href="http://kam1638.duapp.com/quyou/usercenter/?action=set&user_id=166&interested=iiii&character=cccc&relationship=5&declaration=dddd&signature=ssss">http://kam1638.duapp.com/quyou/usercenter/?action=set&user_id=166&interested=iiii&character=cccc&relationship=5&declaration=dddd&signature=ssss
</a>
请求参数:
			user_id			int		需要保存的用户id
			action			string		动作，设置数据时为 set
  			signature		string		个性签名(非必须)
  			relationship	int			感情状态(非必须)
			declaration		string		恋爱宣言(非必须)
			interests		string		个人兴趣(非必须)
			character		string 		性格色彩(非必须)
返回参数:
			success			boolean		是否设置成功
  			msg				string		失败时参考消息

  
<a id='advice'/>接口名：	<b class ='api_title'> advice </b>
描述:		 意见反馈
调用方式:	POST
请求地址:	http://kam1638.duapp.com/quyou/advice
测试地址:	<a href="http://kam1638.duapp.com/quyou/advice/?subject=%E5%8A%9F%E8%83%BD&content=%E5%B8%8C%E6%9C%9B%E8%83%BD%E5%A4%9F%E6%9B%B4%E5%8A%A0%E5%AE%8C%E5%96%84&email=blacklaw00@gmail.com">http://kam1638.duapp.com/quyou/advice/?subject=功能&content=希望能够更加完善&email=blacklaw00@gmail.com</a>
请求参数:	
                         user_id     int      用户id(非必须)
                         subject     string   主题
                         content     string   反馈正文
                         email       string   邮箱(请检查邮箱格式，否则失败)
返回参数:
			success 	boolean	是否提交成功
			msg			string	相关的参考信息
  

 
  
<a id='userinfo'/>接口名：	<b class ='api_title'> userinfo </b>
描述:		 获取用户个人信息(部分取自人人)
调用方式:	POST
请求地址:	http://kam1638.duapp.com/quyou/userinfo
测试地址:	<a href="http://kam1638.duapp.com/quyou/userinfo/?user_id=166">http://kam1638.duapp.com/quyou/userinfo/?user_id=166</a>
请求参数:	
			user_id     id     用户id
返回参数:
			success 	boolean	是否成功
			msg			string	相关的参考信息
  			name 		string  姓名
  			sex			int		性别 1男0女
  			university	string  学校
  			birthday    string  生日
  
  
  </body>

</html>
