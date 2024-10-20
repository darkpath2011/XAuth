# XAuth
XAuth 是一个跨站式登录注册系统，您可以在任何网站上使用它。系统提供了相关接口，包括但不限于：登录（login）、注册（register）、获取用户信息（getUserInfo）等。

## 实现原理
通过 PHP 接口实现用户注册和登录，主要流程如下：
- **登录 (login)**：通过 login 请求进行登录时，服务端会下发一个有效期为 24 小时的 token。
- **注册 (register)**：通过 register 请求向原站进行注册，返回状态码：1（成功）或 2（失败）或 3（用户名或邮箱已存在）。
- **获取用户数据 (getUserInfo)**：您可以通过此接口并附带 token，获取与该 token 关联的用户数据。

## 请求
### 接口：api/login.php
- **请求**：POST
- **传入数据**：username、password
- **传回数据**：
    ```json
    {
        "status": "success",
        "data": {
            "token": "eb888bf385753921f8adbfa03f1eb92189b58bf0e672c6867e8296421e5ca957"
        }
    }
    ```

### 接口：api/register.php
- **请求**：POST
- **传入数据**：username、email、password
- **传回数据**：
    ```json
    {
        "status": "success",
        "data": {
            "message": "注册成功"
        }
    }
    ```

### 接口：api/getUserInfo.php
- **请求**：POST
- **传入数据**：token
- **传回数据**：
    ```json
    {
        "status": "success",
        "data": {
            "username": "myuser",
            "email": "myemail@example.com"
        }
    }
    ```

## 流程图
![流程图](/radimage/image.png "flow chart")

### 注意
<font color=red>本项目为实验性项目，存在多项安全性问题，仅供参考使用。使用本项目的原始代码上线后如发生任何问题，本项目概不负责。</font>
