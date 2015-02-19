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


- ####检查用户名是否已存在

    - **必须参数**

            {
                "service"          : "member",
                "method"           : "check_username",

                "username"         : "rming"
            }

    - **返回参考**

        - *成功*

                {
                    "error": "200",
                    "data": {}
                }

        - *失败*

                {
                    "error":"409",
                    "data":{}
                }



- ####注册

    - **必须参数**

            {
                "service"          : "member",
                "method"           : "signup",

                "username"         : "rming",
                "password"         : "123456"
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
                "method"           : "login",

                "username"         : "rming",
                "password"         : "123456"
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
                    "data" :{}
                }


- ####获取七牛文件上传token

    - **必须参数**

            {
                "service"      : "qiniu",
                "method"       : "get_token",

                "qiniu_bucket" :"onemin"
            }


    - **返回参考**

        - *成功*

                {
                    "error": "200",
                    "data": {
                        "qiniu_bucket": "onmin",
                        "qiniu_token": "oZBaMktNsgEJZGVhZiXK1Ex_QOTf23Ui2MjIwOD9ubw=:eWlaI6xeMqptTMW-:fmMdWOjE0k47QD6xpbmWiix8sm7s6O6yJImuIiwiGzY29kJ9wZSITMqptTMW"
                    }
                }

        - *失败*

                {
                    "error":"420",
                    "data":{}
                }


- #### 新biu~

    - **预定义常量**

            //宽高比支持最多 5 位小数
            define('TYPE_IMAGE', 20);
            define('TYPE_VIDEO', 21);

    - **必须参数**

            {
                "service"      : "biu",
                "method"       : "create",
                "token"        : "868F849B0AC795C3CF65E7221EF1FB812D4EB7C8",

                "attachment": [
                    {
                        "url"   : "http://baidu.com",
                        "type"  : "20",
                        "scale" : "1.3333",
                        "tag"   : [
                            {
                                "name"        : "北京",
                                "position_x"  : "12",
                                "position_y"  : "22"
                            }
                        ]
                    },
                    {
                        "url"   : "http://google.com",
                        "type"  : "20",
                        "scale" : "0.1234",
                        "tag"   : [
                            {
                                "name"        : "北京",
                                "position_x"  : "12",
                                "position_y"  : "22"
                            },
                            {
                                "name"        : "上海",
                                "position_x"  : "22",
                                "position_y"  : "9"
                            }
                        ]
                    }
                ],
                "description": "hello biu~"
            }



    - **返回参考**

        - *成功*

                {
                    "error": "200",
                    "data" : {
                        "id"         : "4",
                        "creator_id" : "22",
                        "description": "hello biu~",
                        "created_at" : "1421743321",
                        "status"     : "30",
                        "attachment" : [
                            {
                                "id"        : "7",
                                "type"      : "20",
                                "url"       : "http://baidu.com",
                                "scale"     : "1.3333",
                                "created_at": "1421743321",
                                "status"    : "30",
                                "tag": [
                                    {
                                        "id"            : "7",
                                        "tag_unique_id" : "1",
                                        "position_x"    : "12",
                                        "position_y"    : "22",
                                        "created_at"    : "1421743321",
                                        "status"        : "30",
                                        "name"          : "北京",
                                        "description"   : null,
                                        "slug"          : "abcdef"
                                    }
                                ]
                            },
                            {
                                "id"         : "8",
                                "type"       : "20",
                                "url"        : "http://google.com",
                                "scale"      : "0.1234",
                                "created_at" : "1421743321",
                                "status"     : "30",
                                "tag": [
                                    {
                                        "id"            : "8",
                                        "tag_unique_id" : "1",
                                        "position_x"    : "12",
                                        "position_y"    : "22",
                                        "created_at"    : "1421743321",
                                        "status"        : "30",
                                        "name"          : "北京",
                                        "description"   : null,
                                        "slug"          : "abcdef"
                                    },
                                    {
                                        "id"            : "9",
                                        "tag_unique_id" : "2",
                                        "position_x"    : "22",
                                        "position_y"    : "9",
                                        "created_at"    : "1421743321",
                                        "status"        : "30",
                                        "name"          : "上海",
                                        "description"   : null,
                                        "slug"          : "abcdef"
                                    }
                                ]
                            }
                        ]
                    }
                }




        - *失败*

                {
                    "error":"430",
                    "data":{}
                }



- #### 获取biu列表

    - **必须参数**

            {
                "service"      : "biu",
                "method"       : "list",
                "token"        : "868F849B0AC795C3CF65E7221EF1FB812D4EB7C8",

                "attachment": [
                    {
                        "url"   : "http://baidu.com",
                        "type"  : "20",
                        "scale" : "1.3333",
                        "tag"   : [
                            {
                                "name"        : "北京",
                                "position_x"  : "12",
                                "position_y"  : "22"
                            }
                        ]
                    },
                    {
                        "url"   : "http://google.com",
                        "type"  : "20",
                        "scale" : "0.1234",
                        "tag"   : [
                            {
                                "name"        : "北京",
                                "position_x"  : "12",
                                "position_y"  : "22"
                            },
                            {
                                "name"        : "上海",
                                "position_x"  : "22",
                                "position_y"  : "9"
                            }
                        ]
                    }
                ],
                "description": "hello biu~"
            }



    - **返回参考**

        - *成功*

                {
                    "error": "200",
                    "data" : {
                        "id"         : "4",
                        "creator_id" : "22",
                        "description": "hello biu~",
                        "created_at" : "1421743321",
                        "status"     : "30",
                        "attachment" : [
                            {
                                "id"        : "7",
                                "type"      : "20",
                                "url"       : "http://baidu.com",
                                "scale"     : "1.3333",
                                "created_at": "1421743321",
                                "status"    : "30",
                                "tag": [
                                    {
                                        "id"            : "7",
                                        "tag_unique_id" : "1",
                                        "position_x"    : "12",
                                        "position_y"    : "22",
                                        "created_at"    : "1421743321",
                                        "status"        : "30",
                                        "name"          : "北京",
                                        "description"   : null,
                                        "background"    : null,
                                        "slug"          : null,
                                        "is_topic"      : "0"
                                    }
                                ]
                            },
                            {
                                "id"         : "8",
                                "type"       : "20",
                                "url"        : "http://google.com",
                                "scale"      : "0.1234",
                                "created_at" : "1421743321",
                                "status"     : "30",
                                "tag": [
                                    {
                                        "id"            : "8",
                                        "tag_unique_id" : "1",
                                        "position_x"    : "12",
                                        "position_y"    : "22",
                                        "created_at"    : "1421743321",
                                        "status"        : "30",
                                        "name"          : "北京",
                                        "description"   : null,
                                        "background"    : null,
                                        "slug"          : null,
                                        "is_topic"      : "0"
                                    },
                                    {
                                        "id"            : "9",
                                        "tag_unique_id" : "2",
                                        "position_x"    : "22",
                                        "position_y"    : "9",
                                        "created_at"    : "1421743321",
                                        "status"        : "30",
                                        "name"          : "上海",
                                        "description"   : null,
                                        "background"    : null,
                                        "slug"          : null,
                                        "is_topic"      : "0"
                                    }
                                ]
                            }
                        ]
                    }
                }




        - *失败*

                {
                    "error":"430",
                    "data":{}
                }





- #### 全局预定义


        //Token 10年有效期
        define('TOKEN_EXPIRED_AFTER',  10*365*24*60*60);

        //性别
        define('MALE',                      10);
        define('FEMALE',                    11);

        //biu文类型
        define('TYPE_IMAGE',                20);
        define('TYPE_VIDEO',                21);

        //状态
        define('STATUS_NORMAL',             30);
        define('STATUS_DELETED',            31);
        define('STATUS_DISABLED',           32);


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
    409 | 用户名已存在
    - | -
    420 | bucket 参数错误
    - | -
    430 | 发布消息内容为空（无附件且无描述）
    - | -
    500 | 服务器错误
