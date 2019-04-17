<?php
return array (
		//应用ID,您的APPID。
		'app_id' => "2016092500595723",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEpQIBAAKCAQEAv9YNrTHkviOfKg7man8u6JgydE9ZmC45ZBVOK8gmQDLlL/tjbrwvG1HK1uxIztDOFnmKkUzAMABLDpuxSRbeaF/dz33cN2VK+rVqLZ9yDGuVlXGjMsjVSQbJy6Ge+x8CTPLUv0VaiG3oFnXhxu+1M8QgVHbLlCpOjflbDBdc0ZVt80YYhM89YoWAYST9EhE5AxGw2Rq9cZ6L24AYL75CcW+hvTAfPPZ+uuxnTC6yan3RY+kWRF7+HmqDlEyq+j7zLR2pcWMQPZxYYjWf89qmUwD88OJbdLKRyexTvyRcchBAQ4uPA0tkk77DxUsMd1ShULG6IqkgrvypH1PUJ7tJCwIDAQABAoIBAQCCN4SVGhcRUhDKdc7GX4qx7A3jkbFZcZcXbrbfVT9RuLqF9XirRCYdv0mW1lEdwfMCooIC2zxh2PEZ+2k+Gb3iz6A7Jk4DdEiPIfHvAhpif+zLwpVq9ZSBu4/jH9RQ1d2z6emr5CHuFdzC0kXtye0QNINVkkXiT01/ZdH9xSYGRN9QvocLT7qJYbVIMQL/9oS4otCQf+XxvgRrVHDlnosQRpbiqhP9OewPMaDBu+B5Qp/SQcTZz6aN8cp/G1A/rTgjwxRgEju7P82B0/YfOwJkfDkS6CVuMlgOXyjPFle6tNl2RBngn/T1x3QJDBZN4yBzO1lqUu77hq959xb9Z7dBAoGBAPupdx5hlu8Qr/JbqgNCAFbrN0JXeNkI8e6Qx1ciMiHmevZ01geTw+Mwl0MQG+KdxSmFuA2+cizxB2MfBZqtsw2eKESq6U8FEG15yOVjd0NKKy2JBrnM+sFcv9vM97BV5nSOxCuRDdYP/n9RGSMl0sOWv0BPfJ49rHycQx1lUsKxAoGBAMMklqnic/iAGZUCEmtG2BTF8dWlBUiQeTOkDSxOoqWSyLVnTmUw8Cs6DrSNfHcgP8GnspkR8Y6Kh40N205ug2dpWdKOKEsjmjggIetDpk3BwCb++o4Km1Dam6n8m1Q1OiBZpraBFpygYjcH/vPE2DrA42345i46FQ6A7s1cVx57AoGBAO8+ULa6McG9zHaLe9mzAh2faR4RiBpT7aNNUaRdJumhcZ4gvmPfruaph/NCOjA6qnfp3mp6dZKR5OLvV+WPYdv9UezNyhTMDKz2jOy9nWCD/v4/+PvjiTMPmHk9pu6lCvwdyRJdyJiLBfdFQq9uQqqcAd8CcccBfJvN9ePZMk9RAoGAb6wAjDeLJiooeZ017S4decXNHvXQkDYdJfA7mZ9mdFoLgcQcmMvopNQUlj5he8p4sdnF2tLp6ShdadsEJV4Y1JT1UgkIBffZyUSaJIgSI209CRPhTmfDegGgEyb7vLS5Dso/HTHCPt+JVPS+ccGz++tmOwi0sL+MTUB7aAnv0QECgYEAviEE3QHK/9j6hfW1GUIEOOBiOZgkAGTVHUzjiWIMhs76VK5nItG7lUELrnHsAEcxxrFzjrKxZow32pWq23wCxmWnmCZ3I4/zkpTi/EWkBOA2yBRgzHNJjXQ1qkyXdOf3ehQKuteYmQEeG/WS2uZTrJgnv6AC8XO4tszUcSUKJh8=",
		
		//异步通知地址
		'notify_url' => "https://www.shops.com/alipay/yibu",
		
		//同步跳转
		'return_url' => "https://www.shops.com/alipay/dongbu",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmyBy6fSXR4Xa98+6PyagqyxjZOxY6GXnMlwPTVH1adXZK3/1ExD8PMwe+gMzQ/4tNXLiRmKJrSQ8ToOxWbk4PLV+A09T7FmieLiMl0rdlpSayDtA9belluWC6URMeApL8o8oJ5rz2W8oFPx3u5PTtmvVjbU72LyF5QHoxeDV7PJXlZ9IAkfj+NE2DWic3ITb8+w3HXKvhyFKMLbFeOr1ijA5vtk4cDk6gBB1ddcCUWx86I7cyjgg2DKKUMVMdjVAtmrlgbQQG99HTQv9a4vkqfh5Pi2aeyvTbtrwroXqhKst4KfYlVxch+LChHgddzRowoY8wUpI0WdB3/oqIdWkRwIDAQAB",
		
	
);