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
                "token"        : "42F3027D5C018EFA91E16E07AA4C4A9E22EC1A98",

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
                    "error":"200",
                    "data":{
                        "id"          :"2",
                        "creator_id"  :"1",
                        "description" :"hello biu~",
                        "created_at"  :"1424509023",
                        "status"      :"30",
                        "attachment":[
                            {
                                "id"         :"3",
                                "type"       :"20",
                                "url"        :"http://baidu.com",
                                "scale"      :"1.3333",
                                "created_at" :"1424509023",
                                "status"     :"30",
                                "tag":[
                                    {
                                        "id"            :"4",
                                        "tag_unique_id" :"1",
                                        "position_x"    :"12",
                                        "position_y"    :"22",
                                        "created_at"    :"1424509023",
                                        "status"        :"30",
                                        "name"          :"北京",
                                        "description"   :null,
                                        "background"    :null,
                                        "slug"          :null,
                                        "is_topic"      :"0"
                                    }
                                ]
                            },
                            {
                                "id"         :"4",
                                "type"       :"20",
                                "url"        :"http://google.com",
                                "scale"      :"0.1234",
                                "created_at" :"1424509023",
                                "status"     :"30",
                                "tag":[
                                    {
                                        "id"            :"5",
                                        "tag_unique_id" :"1",
                                        "position_x"    :"12",
                                        "position_y"    :"22",
                                        "created_at"    :"1424509023",
                                        "status"        :"30",
                                        "name"          :"北京",
                                        "description"   :null,
                                        "background"    :null,
                                        "slug"          :null,
                                        "is_topic"      :"0"
                                    },
                                    {
                                        "id"            :"6",
                                        "tag_unique_id" :"2",
                                        "position_x"    :"22",
                                        "position_y"    :"9",
                                        "created_at"    :"1424509023",
                                        "status"        :"30",
                                        "name"          :"上海",
                                        "description"   :null,
                                        "background"    :null,
                                        "slug"          :null,
                                        "is_topic"      :"0"
                                    }
                                ]
                            }
                        ]
                    }
                }





        - *失败*

                {
                    "error" :"430",
                    "data"  :{}
                }




- #### 获取biu列表

    - **必须参数**



            {
                "service" : "biu",
                "method"  : "list",
                "token"   : "42F3027D5C018EFA91E16E07AA4C4A9E22EC1A98",

                //指定biu_id则列表中仅包含此条信息，需要获取列表时，忽略biu_id
                "biu_id"  : "1",

                //默认offset 0 , limit 0 ,order by created_at DESC
                "section": "40",
                "offset" : "0",
                "limit"  : "2",
                "order"  : "50"

                "comment_limit" : "2",
                "like_limit"    : "2"

            }


    - **`order`常量**

            //order
            //目前仅实现了order by time
            define('ORDER_TIME_DESC',         50);
            define('ORDER_TIME_ASC',          51);

            define('ORDER_LIKE_DESC',         52);
            define('ORDER_LIKE_ASC',          53);
            define('ORDER_COMMENT_DESC',      54);
            define('ORDER_COMMENT_ASC',       55);


    - **`section`常量**

            //section
            //目前仅实现 SECTION_MY
            define('SECTION_MY',             40);
            define('SECTION_FOLLOW',         41);
            define('SECTION_NEAR',           42);
            define('SECTION_RECOMMEND',      43);


    - **返回参考**

        - *成功*



                {
                    "error":"200",
                    "data":[
                        {
                            "id"          :"5",
                            "creator_id"  :"3",
                            "description" :"hello biu~",
                            "created_at"  :"1424510636",
                            "status"      :"30",
                            "attachments":[
                                {
                                    "id"         :"9",
                                    "type"       :"20",
                                    "url"        :"http://baidu.com",
                                    "scale"      :"1.3333",
                                    "created_at" :"1424510636",
                                    "status"     :"30",
                                    "tag":[
                                        {
                                            "id"            :"13",
                                            "tag_unique_id" :"1",
                                            "position_x"    :"12",
                                            "position_y"    :"22",
                                            "created_at"    :"1424510636",
                                            "status"        :"30",
                                            "name"          :"北京",
                                            "description"   :null,
                                            "background"    :null,
                                            "slug"          :null,
                                            "is_topic"      :"0"
                                        }
                                    ]
                                },
                                {
                                    "id"         :"10",
                                    "type"       :"20",
                                    "url"        :"http://google.com",
                                    "scale"      :"0.1234",
                                    "created_at" :"1424510636",
                                    "status"     :"30",
                                    "tag":[
                                        {
                                            "id"            :"14",
                                            "tag_unique_id" :"1",
                                            "position_x"    :"12",
                                            "position_y"    :"22",
                                            "created_at"    :"1424510636",
                                            "status"        :"30",
                                            "name"          :"北京",
                                            "description"   :null,
                                            "background"    :null,
                                            "slug"          :null,
                                            "is_topic"      :"0"
                                        },
                                        {
                                            "id"            :"15",
                                            "tag_unique_id" :"2",
                                            "position_x"    :"22",
                                            "position_y"    :"9",
                                            "created_at"    :"1424510636",
                                            "status"        :"30",
                                            "name"          :"上海",
                                            "description"   :null,
                                            "background"    :null,
                                            "slug"          :null,
                                            "is_topic"      :"0"
                                        }
                                    ]
                                }
                            ],
                            "creator":{
                                "id"          :"3",
                                "username"    :"rming2",
                                "password"    :"7f36b33f2da6fcab66054d03f7ea09e949687025",
                                "nickname"    :null,
                                "description" :null,
                                "gender"      :null,
                                "birthday"    :null,
                                "phone"       :null,
                                "avatar"      :null,
                                "background"  :null,
                                "lat"         :null,
                                "lon"         :null,
                                "address"     :null,
                                "from_where"  :null,
                                "third_nick"  :null,
                                "token"       :"42F3027D5C018EFA91E16E07AA4C4A9E22EC1A98",
                                "token_at"    :"1424508172",
                                "created_at"  :"1424508172",
                                "status"      :"30"
                            },
                            "comments_num":2,
                            "comments":[
                                {
                                    "id"         :"7",
                                    "biu_id"     :"5",
                                    "content"    :"评论内容，在这里，一个不错的评论",
                                    "creator_id" :"1",
                                    "created_at" :"1424519470",
                                    "status"     :"30"
                                },
                                {
                                    "id"         :"6",
                                    "biu_id"     :"5",
                                    "content"    :"评论内容，在这里，一个不错的评论",
                                    "creator_id" :"1",
                                    "created_at" :"1424519342",
                                    "status"     :"30"
                                }
                            ],
                            "like_num":1,
                            "likes":[
                                {
                                    "id"          :"1",
                                    "username"    :"rming",
                                    "password"    :"7f36b33f2da6fcab66054d03f7ea09e949687025",
                                    "nickname"    :null,
                                    "description" :null,
                                    "gender"      :null,
                                    "birthday"    :null,
                                    "phone"       :null,
                                    "avatar"      :null,
                                    "background"  :null,
                                    "lat"         :null,
                                    "lon"         :null,
                                    "address"     :null,
                                    "from_where"  :null,
                                    "third_nick"  :null,
                                    "token"       :"42F3027D5C018EFA91E16E07AA4C4A9E22EC1A98",
                                    "token_at"    :"1424508172",
                                    "created_at"  :"1424508172",
                                    "status"      :"30"
                                }
                            ]
                        },
                        {
                            "id"          :"2",
                            "creator_id"  :"3",
                            "description" :"hello biu~",
                            "created_at"  :"1424509023",
                            "status"      :"30",
                            "attachments":[
                                {
                                    "id"         :"3",
                                    "type"       :"20",
                                    "url"        :"http://baidu.com",
                                    "scale"      :"1.3333",
                                    "created_at" :"1424509023",
                                    "status"     :"30",
                                    "tag":[
                                        {
                                            "id"            :"4",
                                            "tag_unique_id" :"1",
                                            "position_x"    :"12",
                                            "position_y"    :"22",
                                            "created_at"    :"1424509023",
                                            "status"        :"30",
                                            "name"          :"北京",
                                            "description"   :null,
                                            "background"    :null,
                                            "slug"          :null,
                                            "is_topic"      :"0"
                                        }
                                    ]
                                },
                                {
                                    "id"         :"4",
                                    "type"       :"20",
                                    "url"        :"http://google.com",
                                    "scale"      :"0.1234",
                                    "created_at" :"1424509023",
                                    "status"     :"30",
                                    "tag":[
                                        {
                                            "id"            :"5",
                                            "tag_unique_id" :"1",
                                            "position_x"    :"12",
                                            "position_y"    :"22",
                                            "created_at"    :"1424509023",
                                            "status"        :"30",
                                            "name"          :"北京",
                                            "description"   :null,
                                            "background"    :null,
                                            "slug"          :null,
                                            "is_topic"      :"0"
                                        },
                                        {
                                            "id"            :"6",
                                            "tag_unique_id" :"2",
                                            "position_x"    :"22",
                                            "position_y"    :"9",
                                            "created_at"    :"1424509023",
                                            "status"        :"30",
                                            "name"          :"上海",
                                            "description"   :null,
                                            "background"    :null,
                                            "slug"          :null,
                                            "is_topic"      :"0"
                                        }
                                    ]
                                }
                            ],
                            "creator":{
                                "id"          :"3",
                                "username"    :"rming2",
                                "password"    :"7f36b33f2da6fcab66054d03f7ea09e949687025",
                                "nickname"    :null,
                                "description" :null,
                                "gender"      :null,
                                "birthday"    :null,
                                "phone"       :null,
                                "avatar"      :null,
                                "background"  :null,
                                "lat"         :null,
                                "lon"         :null,
                                "address"     :null,
                                "from_where"  :null,
                                "third_nick"  :null,
                                "token"       :"42F3027D5C018EFA91E16E07AA4C4A9E22EC1A98",
                                "token_at"    :"1424508172",
                                "created_at"  :"1424508172",
                                "status"      :"30"
                            },
                            "comments_num":3,
                            "comments":[
                                {
                                    "id"         :"5",
                                    "biu_id"     :"2",
                                    "content"    :"评论内容，在这里，一个不错的评论",
                                    "creator_id" :"1",
                                    "created_at" :"1424519287",
                                    "status"     :"30"
                                },
                                {
                                    "id"         :"3",
                                    "biu_id"     :"2",
                                    "content"    :"\"1=1",
                                    "creator_id" :"1",
                                    "created_at" :"1424519231",
                                    "status"     :"30"
                                }
                            ],
                            "like_num":4,
                            "likes":[
                                {
                                    "id"          :"1",
                                    "username"    :"rming",
                                    "password"    :"7f36b33f2da6fcab66054d03f7ea09e949687025",
                                    "nickname"    :null,
                                    "description" :null,
                                    "gender"      :null,
                                    "birthday"    :null,
                                    "phone"       :null,
                                    "avatar"      :null,
                                    "background"  :null,
                                    "lat"         :null,
                                    "lon"         :null,
                                    "address"     :null,
                                    "from_where"  :null,
                                    "third_nick"  :null,
                                    "token"       :"42F3027D5C018EFA91E16E07AA4C4A9E22EC1A98",
                                    "token_at"    :"1424508172",
                                    "created_at"  :"1424508172",
                                    "status"      :"30"
                                }
                            ]
                        }
                    ]
                }



        - *失败*

                {
                    "error" :"441",
                    "data"  :{}
                }





- #### 对`biu`发表评论

    - **必须参数**


            {
                "service" : "comment",
                "method"  : "create",
                "token"   : "42F3027D5C018EFA91E16E07AA4C4A9E22EC1A98",

                "biu_id"  : "1",
                "content" : "评论内容，在这里，一个不错的评论",
            }




    - **返回参考**

        - *成功*

                {
                    "error":"200",
                    "data":{
                        "id"         :"7",
                        "biu_id"     :"1",
                        "content"    :"评论内容，在这里，一个不错的评论",
                        "creator_id" :"1",
                        "created_at" :"1424519470",
                        "status"     :"30"
                    }
                }





        - *失败*

                {
                    "error" :"440",
                    "data"  :{}
                }

- #### 获取指定`biu_id`的评论列表

    - **必须参数**


            {
                "service" : "comment",
                "method"  : "list",
                "token"   : "42F3027D5C018EFA91E16E07AA4C4A9E22EC1A98",

                "biu_id" : "1",
                "limit"  : "10",
                "offset" : "0",
                "order"  : "50"
            }

    - **`order`常量**

            define('ORDER_TIME_DESC',         50);
            define('ORDER_TIME_ASC',          51);



    - **返回参考**

        - *成功*

                {
                    "error":"200",
                    "data":[
                        {
                            "id"         :"7",
                            "biu_id"     :"1",
                            "content"    :"评论内容，在这里，一个不错的评论",
                            "creator_id" :"1",
                            "created_at" :"1424519470",
                            "status"     :"30"
                        },
                        {
                            "id"         :"6",
                            "biu_id"     :"1",
                            "content"    :"评论内容，在这里，一个不错的评论",
                            "creator_id" :"1",
                            "created_at" :"1424519342",
                            "status"     :"30"
                        },
                        {
                            "id"         :"5",
                            "biu_id"     :"1",
                            "content"    :"评论内容，在这里，一个不错的评论",
                            "creator_id" :"1",
                            "created_at" :"1424519287",
                            "status"     :"30"
                        },
                        {
                            "id"         :"4",
                            "biu_id"     :"1",
                            "content"    :"评论内容，在这里，一个不错的评论",
                            "creator_id" :"1",
                            "created_at" :"1424519245",
                            "status"     :"30"
                        }
                    ]
                }



        - *失败*

                {
                    "error" :"441",
                    "data"  :{}
                }


- #### 为指定`biu_id`的点赞

    - **必须参数**


            {
                "service" : "like",
                "method"  : "create",
                "token"   : "42F3027D5C018EFA91E16E07AA4C4A9E22EC1A98",

                "biu_id" : "1",
            }


    - **返回参考**

        - *成功*


                {
                    "error":"200",
                    "data":{
                        "id":"24",
                        "biu_id":"1",
                        "creator_id":"1",
                        "created_at":"1424527144",
                        "status":"30"
                    }
                }



        - *失败*

                {
                    "error" :"441",
                    "data"  :{}
                }



- #### 获取指定`biu_id`的点赞的人信息列表

    - **必须参数**

            //顺序按照时间从旧到新（ORDER_TIME_ASC）
            {
                "service" : "like",
                "method"  : "list",
                "token"   : "42F3027D5C018EFA91E16E07AA4C4A9E22EC1A98",

                "biu_id" : "1",
                "offset" : "0",
                "limit"  : "5"
            }


    - **返回参考**

        - *成功*


                {
                    "error":"200",
                    "data":[
                        {
                            "id"          :"2",
                            "username"    :"rming1",
                            "password"    :"7f36b33f2da6fcab66054d03f7ea09e949687025",
                            "nickname"    :null,
                            "description" :null,
                            "gender"      :null,
                            "birthday"    :null,
                            "phone"       :null,
                            "avatar"      :null,
                            "background"  :null,
                            "lat"         :null,
                            "lon"         :null,
                            "address"     :null,
                            "from_where"  :null,
                            "third_nick"  :null,
                            "token"       :"42F3027D5C018EFA91E16E07AA4C4A9E22EC1A98",
                            "token_at"    :"1424508172",
                            "created_at"  :"1424508172",
                            "status"      :"30"
                        },
                        {
                            "id"          :"3",
                            "username"    :"rming2",
                            "password"    :"7f36b33f2da6fcab66054d03f7ea09e949687025",
                            "nickname"    :null,
                            "description" :null,
                            "gender"      :null,
                            "birthday"    :null,
                            "phone"       :null,
                            "avatar"      :null,
                            "background"  :null,
                            "lat"         :null,
                            "lon"         :null,
                            "address"     :null,
                            "from_where"  :null,
                            "third_nick"  :null,
                            "token"       :"42F3027D5C018EFA91E16E07AA4C4A9E22EC1A98",
                            "token_at"    :"1424508172",
                            "created_at"  :"1424508172",
                            "status"      :"30"
                        },
                        {
                            "id"          :"1",
                            "username"    :"rming",
                            "password"    :"7f36b33f2da6fcab66054d03f7ea09e949687025",
                            "nickname"    :null,
                            "description" :null,
                            "gender"      :null,
                            "birthday"    :null,
                            "phone"       :null,
                            "avatar"      :null,
                            "background"  :null,
                            "lat"         :null,
                            "lon"         :null,
                            "address"     :null,
                            "from_where"  :null,
                            "third_nick"  :null,
                            "token"       :"42F3027D5C018EFA91E16E07AA4C4A9E22EC1A98",
                            "token_at"    :"1424508172",
                            "created_at"  :"1424508172",
                            "status"      :"30"
                        }
                    ]
                }



        - *失败*

                {
                    "error" :"441",
                    "data"  :{}
                }






- #### 全局预定义


        //Token 10年有效期
        define('TOKEN_EXPIRED_AFTER',  10*365*24*60*60);

        //标记位使用的true / false
        define('STATUS_TRUE',               1);
        define('STATUS_FALSE',              0);

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

        //section
        //目前仅实现 SECTION_MY
        define('SECTION_MY',             40);
        define('SECTION_FOLLOW',         41);
        define('SECTION_NEAR',           42);
        define('SECTION_RECOMMEND',      43);

        //order
        //目前仅实现了order by time
        define('ORDER_TIME_DESC',         50);
        define('ORDER_TIME_ASC',          51);

        define('ORDER_LIKE_DESC',         52);
        define('ORDER_LIKE_ASC',          53);
        define('ORDER_COMMENT_DESC',      54);
        define('ORDER_COMMENT_ASC',       55);


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
    440 | 评论内容为空
    441 | 不存在该条说说
    442 | 说说列表类型错误
    - | -
    500 | 服务器错误
