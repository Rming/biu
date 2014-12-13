[TOC]



- ####接口地址

		http://app.zaofenxiang.com/api/base

- ####加密

	**密钥:**

		123456789

	**参数:**

	*key* | *value* | *意义*
	- | - | -
	isEncrypt | 0 | 不加密传输
	isEncrypt | 1 | 加密传输


- ####注册

	- **必须参数**

			{
				"service"          : "member",
				"method"           : "signup",

				"username"         : "rming",
				"password"         : "123456",
			}

	- **返回参考**

		- *成功*

				{
					"error": "200",
					"data": {
						"id"         : "12",
						"username"   : "rming",
						"password"   : "60f9371b4c341a5b9409b885ec56d36118bc66e3",
						"nickname"   : null,
						"description": null,
						"gender"     : null,
						"birthday"   : null,
						"phone"      : null,
						"avatar"     : null,
						"background" : null,
						"lat"        : null,
						"lon"        : null,
						"address"    : null,
						"from_where" : null,
						"third_nick" : null,
						"token"      : "031692B891F2DD6A58D2F2F088024274853D5789",
						"token_at"   : "1418468321",
						"created_at" : "1418468321"
					}
				}

		- *失败*

				{
					"error":"407",
					"data":{}
				}


- ####登录

	- **必须参数**

			{
				"service"          : "member",
				"method"           : "signup",

				"username"         : "rming",
				"password"         : "123456",
			}

	- **返回参考**

		- *成功*

				{
					"error": "200",
					"data": {
						"id"         : "12",
						"username"   : "rming",
						"password"   : "60f9371b4c341a5b9409b885ec56d36118bc66e3",
						"nickname"   : null,
						"description": null,
						"gender"     : null,
						"birthday"   : null,
						"phone"      : null,
						"avatar"     : null,
						"background" : null,
						"lat"        : null,
						"lon"        : null,
						"address"    : null,
						"from_where" : null,
						"third_nick" : null,
						"token"      : "031692B891F2DD6A58D2F2F088024274853D5789",
						"token_at"   : "1418468321",
						"created_at" : "1418468321"
					}
				}

		- *失败*

				{
					"error":"408",
					"data":{}
				}

- ####更新

	- **必须参数**

			{
				"service"    : "member",
				"method"     : "update",
				"token"      :"031692B891F2DD6A58D2F2F088024274853D5789",

				//资料参数,可选
				"nickname"   :"阿明",
				"description":"阿明的帐号,欢迎关注.",
				"gender"     :"0",
				"lat"        :"128.214512",
				"lon"        :"2214.514121",
				"address"    :"china beijing chaoyang 望京"
			}


	- **返回参考**

		- *成功*

				{
					"error": "200",
					"data": {
						"id"         : "12",
						"username"   : "rming",
						"password"   : "60f9371b4c341a5b9409b885ec56d36118bc66e3",
						"nickname"   : "阿明",
						"description": "阿明的帐号,欢迎关注.",
						"gender"     : "0",
						"birthday"   : null,
						"phone"      : null,
						"avatar"     : null,
						"background" : null,
						"lat"        : "128.214512",
						"lon"        : "2214.514121",
						"address"    : "china beijing chaoyang 望京",
						"from_where" : null,
						"third_nick" : null,
						"token"      : "031692B891F2DD6A58D2F2F088024274853D5789",
						"token_at"   : "1418468321",
						"created_at" : "1418468321"
					}
				}

		- *失败*

				{
					"error":"403",
					"data":{}
				}


- ####错误代码


	error_code|error_message
	- | -
	400 | service 参数错误
	404 | method  参数错误
	- | -
	401 | Token 参数错误
	402 | Token 过期
	403 | Token 用户没有找到
	- | -
	405 | 缺少参数用户名 username
	406 | 缺少参数密码   password
	407 | 用户名错误
	408 | 密码错误
	- | -
	500 | 服务器错误
