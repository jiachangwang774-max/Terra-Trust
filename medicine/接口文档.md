# PillPal 服药管理系统完整接口文档

## 通用说明

1. 基础请求路径：`/api/v1`

2. 身份认证：所有需要登录接口请求头携带 `Authorization: Bearer {token}`

3. 统一返回格式

```JSON
{
  "code": 状态码,
  "msg": "文字提示",
  "data": 返回数据/对象/数组
}
```

4. 全局状态码

|编码|含义|
|---|---|
|200|操作成功|
|201|新增创建成功|
|400|参数校验失败|
|401|Token失效/未登录|
|403|权限不足|
|404|资源不存在|
|500|服务器异常|

# 1\. 用户认证接口

## 1\.1 用户注册-lx

**接口地址**：`POST /auth/register`
**功能描述**：用户（服药人）注册账号

|参数名|类型|必填|说明|
|---|---|---|---|
|username|string|是|用户名，5\-20 位|
|password|string|是|密码，6\-20 位|
|phone|string|是|手机号|
|real\_name|string|否|真实姓名|
|gender|int|否|性别：0 未知 / 1 男 / 2 女|
|age|int|否|年龄|
|**请求示例**||||

```JSON
{
  "username": "zhangsan",
  "password": "123456",
  "phone": "13800138000",
  "real_name": "张三",
  "gender": 1,
  "age": 60
}
```

**响应成功**

```JSON
{
  "code": 200,
  "msg": "注册成功",
  "data": {
    "user_id": 1,
    "username": "zhangsan",
    "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
  }
}
```

**响应失败**

```JSON
{
  "code": 400,
  "msg": "用户名已存在"
}
```

## 1\.2 用户登录

**接口地址**：`POST /auth/login`
**功能描述**：用户登录获取 Token

|参数名|类型|必填|说明|
|---|---|---|---|
|username|string|是|用户名 / 手机号|
|password|string|是|密码|
|**响应成功**||||

```JSON
{
  "code": 200,
  "msg": "登录成功",
  "data": {
    "user_id": 1,
    "username": "zhangsan",
    "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
    "expire_at": "2026-04-11T23:59:59"
  }
}
```

## 1\.3 退出登录

**接口地址**：`POST /auth/logout`
**功能描述**：销毁当前 Token
**响应成功**

```JSON
{
  "code": 200,
  "msg": "退出成功"
}
```

## 1\.4 修改登录密码

**接口地址**：`PUT /auth/password`
**功能描述**：登录状态下修改账号密码

|参数名|类型|必填|说明|
|---|---|---|---|
|old\_password|string|是|原始密码|
|new\_password|string|是|新密码6\-20位|
|confirm\_password|string|是|确认新密码|
|**响应成功**||||

```JSON
{
  "code": 200,
  "msg": "密码修改成功，请重新登录"
}
```

## 1\.5 刷新Token

**接口地址**：`POST /auth/refresh`
**功能描述**：延长登录有效期，无需重新登录
**响应成功**

```JSON
{
  "code": 200,
  "msg": "刷新成功",
  "data": {
    "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
    "expire_at": "2026-07-10T23:59:59"
  }
}
```

## 1\.6 获取短信验证码

**接口地址**：`POST /auth/sendCode`
**功能描述**：发送重置密码短信验证码

|参数名|类型|必填|
|---|---|---|
|phone|string|是|
|**响应成功**|||

```JSON
{
  "code": 200,
  "msg": "验证码已发送"
}
```

## 1\.7 验证码重置密码

**接口地址**：`POST /auth/resetPwd`
**功能描述**：未登录，通过短信验证码重置密码

|参数名|类型|必填|
|---|---|---|
|phone|string|是|
|code|string|是|
|new\_password|string|是|
|**响应成功**|||

```JSON
{
  "code": 200,
  "msg": "密码重置成功，请登录"
}
```

# 2\. 用户信息接口-lx

## 2\.1 获取用户信息

**接口地址**：`GET /user/info`
**功能描述**：获取当前登录用户详情
**响应成功**

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": {
    "user_id": 1,
    "username": "zhangsan",
    "real_name": "张三",
    "phone": "13800138000",
    "gender": 1,
    "age": 60,
    "avatar": "https://xxx.com/avatar.jpg",
    "status": 1
  }
}
```

## 2\.2 修改用户信息

**接口地址**：`PUT /user/info`
**功能描述**：修改个人资料
**请求参数**

|参数名|类型|必填|
|---|---|---|
|real\_name|string|否|
|gender|int|否|
|age|int|否|
|avatar|string|否|
|**响应成功**|||

```JSON
{
  "code": 200,
  "msg": "信息修改成功"
}
```

## 2\.3 上传头像

**接口地址**：`POST /user/uploadAvatar`
**请求类型**：form\-data

|参数名|类型|必填|说明|
|---|---|---|---|
|avatar|file|是|图片文件|
|**响应成功**||||

```JSON
{
  "code": 200,
  "msg": "上传成功",
  "data": {
    "avatar_url": "https://xxx.com/newavatar.jpg"
  }
}
```

## 2\.4 账号注销

**接口地址**：`POST /user/cancel`
**功能描述**：注销账号，清空全部业务数据

|参数名|类型|必填|说明|
|---|---|---|---|
|password|string|是|账号密码校验|
|**响应成功**||||

```JSON
{
  "code": 200,
  "msg": "账号注销成功"
}
```

# 3\. 药物管理接口-lx

## 3\.1 添加药物

**接口地址**：`POST /medicines`
**功能描述**：录入用户药物信息
**请求参数**

|参数名|类型|必填|说明|
|---|---|---|---|
|name|string|是|药物名称|
|specification|string|否|规格（0\.5g / 片）|
|manufacturer|string|否|生产厂家|
|expire\_date|string|否|有效期（YYYY\-MM\-DD）|
|stock|int|是|库存数量|
|unit|string|是|单位（片 / 粒 / 袋）|
|usage|string|否|服用方式|
|note|string|否|备注|
|**响应成功**||||

```JSON
{
  "code": 201,
  "msg": "添加成功",
  "data": {
    "medicine_id": 101
  }
}
```

## 3\.2 药物列表

**接口地址**：`GET /medicines?page=1&size=10`
**功能描述**：分页获取用户药物
**响应成功**

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": {
    "total": 5,
    "list": [
      {
        "medicine_id": 101,
        "name": "阿司匹林",
        "specification": "0.5g/片",
        "stock": 30,
        "unit": "片",
        "expire_date": "2027-12-31",
        "create_time": "2026-04-11 10:00:00"
      }
    ]
  }
}
```

## 3\.3 修改药物

**接口地址**：`PUT /medicines/{id}`
**功能描述**：更新药物信息
请求参数同新增药物，响应成功

```JSON
{
  "code": 200,
  "msg": "修改成功"
}
```

## 3\.4 删除药物

**接口地址**：`DELETE /medicines/{id}`
**功能描述**：删除药物（关联医嘱同步删除）

```JSON
{
  "code": 200,
  "msg": "删除成功"
}
```

## 3\.5 药物详情

**接口地址**：`GET /medicines/{id}`
**响应成功**

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": {
    "medicine_id": 101,
    "name": "阿司匹林",
    "specification": "0.5g/片",
    "manufacturer": "XX制药厂",
    "expire_date": "2027-12-31",
    "stock": 30,
    "unit": "片",
    "usage": "饭后温水送服",
    "note": "高血压常备药",
    "prescription_count": 2
  }
}
```

## 3\.6 库存预警药品

**接口地址**：`GET /medicines/warnStock`
**响应成功**

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": [
    {
      "medicine_id": 102,
      "name": "降压片",
      "stock": 3,
      "unit": "片"
    }
  ]
}
```

## 3\.7 过期药品列表

## 3\.7 过期药品列表

**接口地址**：`GET /medicines/expired`

**功能描述**：查询用户所有已过期药物（有效期早于当前日期）
**响应成功**

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": [
    {
      "medicine_id": 103,
      "name": "维生素C片",
      "specification": "0.1g/片",
      "stock": 10,
      "unit": "片",
      "expire_date": "2025-12-30",
      "create_time": "2026-03-01 14:20:00"
    }
  ]
}
```

## 3\.8 批量删除药物

**接口地址**：`DELETE /medicines/batch`

**功能描述**：批量删除多条药物数据，同步删除关联医嘱、提醒数据

|参数名|类型|必填|说明|
|---|---|---|---|
|ids|array|是|药物ID数组 \[101,102,103\]|

**响应成功**

```JSON
{
  "code": 200,
  "msg": "批量删除成功"
}
```

|参数名|类型|必填|说明|
|---|---|---|---|
|ids|array|是|\[101,102,103\]|

# 4\. 医嘱管理接口-lx

## 4\.1 添加医嘱

**接口地址**：`POST /prescriptions`
**功能描述**：创建服药医嘱
**请求参数**

|参数名|类型|必填|说明|
|---|---|---|---|
|medicine\_id|int|是|药物 ID|
|doctor\_name|string|否|医生姓名|
|hospital|string|否|医院|
|diagnosis|string|否|诊断|
|dosage|string|是|单次剂量（1 片）|
|frequency|string|是|频率（每日 2 次）|
|start\_date|string|是|开始日期|
|end\_date|string|否|结束日期|
|note|string|否|备注|
|**响应成功**||||

```JSON
{
  "code": 201,
  "msg": "医嘱创建成功",
  "data": {
    "prescription_id": 2001
  }
}
```

## 4\.2 医嘱列表

**接口地址**：`GET /prescriptions?page=1&size=10`

**功能描述**：分页获取用户所有服药医嘱，关联药物基础信息
**请求参数**

|参数名|类型|必填|说明|
|---|---|---|---|
|page|int|否|页码，默认1|
|size|int|否|每页条数，默认10|
|status|int|否|状态 0停用 1启用|

**响应成功**

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": {
    "total": 3,
    "list": [
      {
        "prescription_id": 2001,
        "medicine_id": 101,
        "medicine_name": "阿司匹林",
        "doctor_name": "李医生",
        "hospital": "社区医院",
        "diagnosis": "高血压辅助治疗",
        "dosage": "1片",
        "frequency": "每日1次",
        "start_date": "2026-01-01",
        "end_date": "2026-12-31",
        "status": 1,
        "create_time": "2026-04-11 11:00:00"
      }
    ]
  }
}
```

## 4\.3 医嘱详情

**接口地址**：`GET /prescriptions/{id}`

**功能描述**：获取单条医嘱完整详情，包含关联药物、提醒配置、服药记录统计
**响应成功**

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": {
    "prescription_id": 2001,
    "medicine_id": 101,
    "medicine_name": "阿司匹林",
    "specification": "0.5g/片",
    "doctor_name": "李医生",
    "hospital": "社区医院",
    "diagnosis": "高血压辅助治疗",
    "dosage": "1片",
    "frequency": "每日1次",
    "start_date": "2026-01-01",
    "end_date": "2026-12-31",
    "status": 1,
    "note": "饭后服用",
    "remind_count": 1,
    "finish_rate": "85%",
    "create_time": "2026-04-11 11:00:00"
  }
}
```

## 4\.4 修改医嘱

**接口地址**：`PUT /prescriptions/{id}`

**功能描述**：编辑已创建的医嘱信息，参数同新增医嘱接口
**请求参数**：同4\.1 添加医嘱
**响应成功**

```JSON
{
  "code": 200,
  "msg": "医嘱修改成功"
}
```

## 4\.5 删除医嘱

**接口地址**：`DELETE /prescriptions/{id}`

**功能描述**：删除指定医嘱，同步删除关联的服药提醒配置

**响应成功**

```JSON
{
  "code": 200,
  "msg": "医嘱删除成功"
}
```

## 4\.6 启用/停用医嘱

**接口地址**：`PUT /prescriptions/{id}/status`**功能描述**：快速启用或停用医嘱，停用后对应提醒不再生效

|参数名|类型|必填|说明|
|---|---|---|---|
|status|int|是|0停用 1启用|

**响应成功**

```JSON
{
  "code": 200,
  "msg": "状态修改成功"
}
```

|参数名|类型|必填|说明|
|---|---|---|---|
|status|int|是|0停用 1启用|

## 4\.7 药物冲突检测

**接口地址**：`POST /prescriptions/checkConflict`

|参数名|类型|必填|
|---|---|---|
|medicine\_ids|array|是|

**响应示例**

```JSON
{
  "code": 200,
  "msg": "检测完成",
  "data": [
    {
      "medicine_a": "阿司匹林",
      "medicine_b": "布洛芬",
      "conflict_level": 2,
      "desc": "两种药物同服易刺激肠胃，建议间隔2小时以上"
    }
  ]
}
```

# 5\. 服药提醒接口-wjc

## 5\.1 添加提醒

**接口地址**：`POST /reminders`
**功能描述**：设置服药提醒（支持一天多次）
**请求参数**

|参数名|类型|必填|说明|
|---|---|---|---|
|prescription\_id|int|是|医嘱 ID|
|medicine\_id|int|是|药物 ID|
|remind\_time|string|是|提醒时间（HH:mm:ss）|
|dosage|string|是|剂量|
|repeat\_type|int|是|1 每日 / 2 周期 / 3 单次|
|repeat\_days|string|否|周几（1,3,5）|
|remind\_method|int|是|1APP/2 短信 / 3 电话|

**响应成功**

```JSON
{
  "code": 201,
  "msg": "提醒创建成功",
  "data": {
    "remind_id": 201
  }
}
```

## 5\.2 今日提醒

**接口地址**：`GET /reminders/today`
**功能描述**：获取今日待服提醒
**响应成功**

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": [
    {
      "remind_id": 201,
      "medicine_name": "阿司匹林",
      "remind_time": "08:00:00",
      "dosage": "1片",
      "status": 0
    }
  ]
}
```

## 5\.3 标记服药

**接口地址**：`POST /reminders/{id}/take`
**功能描述**：记录已服 / 漏服
**请求参数**

|参数名|类型|必填|说明|
|---|---|---|---|
|status|int|是|1 已服 / 2 漏服 / 3 跳过|
|note|string|否|备注|

**响应成功**

```JSON
{
  "code": 200,
  "msg": "记录保存成功"
}
```

## 5\.4 提醒详情

## 5\.4 提醒详情

**接口地址**：`GET /reminders/{id}`

**功能描述**：获取单条服药提醒完整配置信息，关联医嘱、药物数据
**响应成功**

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": {
    "remind_id": 201,
    "prescription_id": 2001,
    "medicine_id": 101,
    "medicine_name": "阿司匹林",
    "remind_time": "08:00:00",
    "dosage": "1片",
    "repeat_type": 1,
    "repeat_type_text": "每日重复",
    "repeat_days": "",
    "remind_method": 1,
    "remind_method_text": "APP提醒",
    "is_active": 1,
    "create_time": "2026-04-11 11:30:00"
  }
}
```

## 5\.5 修改提醒

**接口地址**：`PUT /reminders/{id}`

**功能描述**：编辑已存在的服药提醒配置，参数同新增提醒接口
**请求参数**：同5\.1 添加提醒
**响应成功**

```JSON
{
  "code": 200,
  "msg": "提醒修改成功"
}
```

## 5\.6 删除提醒

**接口地址**：`DELETE /reminders/{id}`

**功能描述**：删除指定服药提醒配置
**响应成功**

```JSON
{
  "code": 200,
  "msg": "提醒删除成功"
}
```

## 5\.7 批量开关提醒

**接口地址**：`PUT /reminders/batchStatus`

**功能描述**：批量启用或关闭多条服药提醒

|参数名|类型|必填|
|---|---|---|
|ids|array|是|
|is\_active|int|是|

**参数说明**：ids为提醒ID数组，is\_active 0=关闭、1=启用
**响应成功**

```JSON
{
  "code": 200,
  "msg": "批量操作成功"
}
```

|参数名|类型|必填|
|---|---|---|
|ids|array|是|
|is\_active|int|是|

## 5\.8 全部提醒列表

**接口地址**：`GET /reminders/all?page=1&size=10`

**功能描述**：分页查询用户所有历史/当前服药提醒配置，不含今日记录，用于管理所有提醒
**请求参数**

|参数名|类型|必填|说明|
|---|---|---|---|
|page|int|否|页码|
|size|int|否|每页条数|

**响应成功**

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": {
    "total": 4,
    "list": [
      {
        "remind_id": 201,
        "medicine_name": "阿司匹林",
        "remind_time": "08:00:00",
        "dosage": "1片",
        "is_active": 1,
        "create_time": "2026-04-11 11:30:00"
      }
    ]
  }
}
```

# 6\. 服药记录接口-wjc

## 6\.1 按日期查询服药记录

**接口地址**：`GET /records?date=2026-04-11`
**功能描述**：按日期查询服药历史
**响应成功**

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": [
    {
      "record_id": 301,
      "medicine_name": "阿司匹林",
      "plan_time": "2026-04-11 08:00:00",
      "actual_time": "2026-04-11 08:05:00",
      "status": 1,
      "status_text": "已服用"
    }
  ]
}
```

## 6\.2 单条记录详情

**接口地址**：`GET /records/{id}`

**功能描述**：获取单条服药记录详细信息，包含计划时间、实际服用时间、备注、对应药物医嘱信息
**响应成功**

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": {
    "record_id": 301,
    "medicine_id": 101,
    "medicine_name": "阿司匹林",
    "prescription_id": 2001,
    "plan_time": "2026-04-11 08:00:00",
    "actual_time": "2026-04-11 08:05:00",
    "dosage": "1片",
    "status": 1,
    "status_text": "已服用",
    "note": "正常按时服药",
    "create_time": "2026-04-11 08:05:00"
  }
}
```

## 6\.3 月度服药统计

**接口地址**：`GET /records/monthStat?year=2026&month=7`

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": {
    "total_plan": 62,
    "taken": 50,
    "miss": 10,
    "skip": 2,
    "complete_rate": "80.6%"
  }
}
```

## 6\.4 漏服记录

**接口地址**：`GET /records/miss?page=1&size=10`

**功能描述**：分页查询所有漏服的服药记录，用于用户复盘与亲属查看
**请求参数**

|参数名|类型|必填|说明|
|---|---|---|---|
|page|int|否|页码|
|size|int|否|每页条数|

**响应成功**

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": {
    "total": 10,
    "list": [
      {
        "record_id": 305,
        "medicine_name": "阿司匹林",
        "plan_time": "2026-04-15 08:00:00",
        "status": 2,
        "status_text": "漏服",
        "note": "忘记服药"
      }
    ]
  }
}
```

## 6\.5 导出服药记录

**接口地址**：`GET /records/export?startDate=2026-07-01&endDate=2026-07-09`

**功能描述**：按时间范围导出Excel格式服药记录文件，支持存档、就医出示
**请求参数**

|参数名|类型|必填|说明|
|---|---|---|---|
|startDate|string|是|开始日期 YYYY\-MM\-DD|
|endDate|string|是|结束日期 YYYY\-MM\-DD|

**响应说明**：直接返回Excel文件流，浏览器自动下载

# 7\. 亲属管理接口-wjc

## 7\.1 绑定亲属

**接口地址**：`POST /relatives/bind`
**功能描述**：用户绑定亲属
**请求参数**

|参数名|类型|必填|说明|
|---|---|---|---|
|phone|string|是|亲属手机号|
|relation|string|是|关系（子女 / 配偶）|
|permission|int|是|1 仅查看 / 2 可管理|
|**响应成功**||||

```JSON
{
  "code": 200,
  "msg": "绑定申请已发送"
}
```

## 7\.2 亲属列表

**接口地址**：`GET /relatives`

**功能描述**：获取当前用户所有已绑定的亲属列表，包含关系、权限、绑定状态
**响应成功**

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": [
    {
      "bind_id": 501,
      "phone": "13900139000",
      "real_name": "张小明",
      "relation": "子女",
      "permission": 2,
      "permission_text": "可管理",
      "bind_status": 1,
      "bind_time": "2026-04-12 09:20:00"
    }
  ]
}
```

## 7\.3 解绑亲属

**接口地址**：`DELETE /relatives/{bind_id}`

**功能描述**：解除与指定亲属的绑定关系，亲属将无法查看、管理用户数据
**响应成功**

```JSON
{
  "code": 200,
  "msg": "亲属解绑成功"
}
```

## 7\.4 修改亲属权限

**接口地址**：`PUT /relatives/{bind_id}/permission`

**功能描述**：修改绑定亲属的操作权限，区分查看和管理权限

|参数名|类型|必填|
|---|---|---|
|permission|int|是|

**参数说明**：1=仅查看，2=可管理（新增/修改提醒、查看记录）
**响应成功**

```JSON
{
  "code": 200,
  "msg": "权限修改成功"
}
```

|参数名|类型|必填|
|---|---|---|
|permission|int|是|

## 7\.5 亲属登录

**接口地址**：`POST /relatives/login`

**功能描述**：亲属账号独立登录，登录后可查看/管理绑定用户的服药数据
**请求参数**

|参数名|类型|必填|说明|
|---|---|---|---|
|username|string|是|亲属用户名/手机号|
|password|string|是|登录密码|

**响应成功**

```JSON
{
  "code": 200,
  "msg": "登录成功",
  "data": {
    "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
    "expire_at": "2026-07-10T23:59:59",
    "bind_user_count": 1
  }
}
```

## 7\.6 亲属查看监护用户今日提醒

**接口地址**：`GET /relatives/user/{user_id}/todayRemind`

**功能描述**：亲属登录后，查看绑定用户当日所有服药提醒及完成情况
**响应成功**

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": [
    {
      "remind_id": 201,
      "medicine_name": "阿司匹林",
      "remind_time": "08:00:00",
      "dosage": "1片",
      "status": 0,
      "status_text": "未服用"
    }
  ]
}
```

# 8\. 消息通知模块-wjc

## 8\.1 获取消息列表



**接口地址**：`GET /notice/list?page=1&size=10`

**功能描述**：分页获取用户系统消息，包含服药提醒、库存预警、过期提醒、亲属绑定通知等
**请求参数**

|参数名|类型|必填|说明|
|---|---|---|---|
|page|int|否|页码|
|size|int|否|每页条数|

**响应成功**

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": {
    "total": 8,
    "list": [
      {
        "notice_id": 401,
        "title": "药品库存预警",
        "content": "降压片库存仅剩3片，请及时补充",
        "type": "stock_warn",
        "is_read": 0,
        "create_time": "2026-07-09 10:00:00"
      }
    ]
  }
}
```

## 8\.2 单条消息已读

**接口地址**：`PUT /notice/{id}/read`

**功能描述**：将指定单条消息标记为已读
**响应成功**

```JSON
{
  "code": 200,
  "msg": "操作成功"
}
```

## 8\.3 全部消息已读

**接口地址**：`PUT /notice/readAll`

**功能描述**：一键将所有未读消息标记为已读
**响应成功**

```JSON
{
  "code": 200,
  "msg": "全部已读成功"
}
```

## 8\.4 删除消息

**接口地址**：`DELETE /notice/{id}`

**功能描述**：删除指定单条系统消息
**响应成功**

```JSON
{
  "code": 200,
  "msg": "消息删除成功"
}
```

# 9\. 公共药物知识库-wjc

## 9\.1 药物模糊搜索

**接口地址**：`GET /drugLib/search?keyword=阿司匹林&page=1&size=10`

**功能描述**：公共药物库模糊搜索，新增药物时快速匹配药品信息，自动填充规格、厂家、禁忌等数据
**请求参数**

|参数名|类型|必填|说明|
|---|---|---|---|
|keyword|string|是|药品名称关键词|
|page|int|否|页码|
|size|int|否|每页条数|

**响应成功**

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": {
    "total": 1,
    "list": [
      {
        "lib_id": 10001,
        "drug_name": "阿司匹林",
        "specification": "0.5g/片",
        "manufacturer": "XX制药有限公司",
        "usage": "饭后温水送服",
        "taboo": "胃溃疡患者禁用",
        "side_effect": "偶见肠胃不适"
      }
    ]
  }
}
```

## 9\.2 药物知识库详情

**接口地址**：`GET /drugLib/{lib_id}`

**功能描述**：查询药品完整知识库详情，包含功效、禁忌、副作用、配伍禁忌、适用症状
**响应成功**

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": {
    "lib_id": 10001,
    "drug_name": "阿司匹林",
    "specification": "0.5g/片",
    "manufacturer": "XX制药有限公司",
    "effect": "抑制血小板聚集，用于心脑血管疾病辅助治疗",
    "taboo": "活动性溃疡病、血友病患者禁用",
    "side_effect": "恶心、呕吐、肠胃刺激、轻微出血倾向",
    "match_conflict": "不可与布洛芬、抗凝药物同服",
    "usage": "每日一次，饭后服用",
    "save_note": "密封阴凉处保存"
  }
}
```

# 10\. 健康档案模块-wjc

## 10\.1 新增健康记录

**接口地址**：`POST /health`

**功能描述**：新增用户日常健康数据记录（血压、血糖、体重等）
**请求参数**

|参数名|类型|必填|说明|
|---|---|---|---|
|blood\_pressure\_high|string|否|收缩压|
|blood\_pressure\_low|string|否|舒张压|
|blood\_sugar|string|否|血糖值|
|weight|string|否|体重|

## 10\.2 健康记录列表

**接口地址**：`GET /health?page=1&size=10`

**功能描述**：分页查询用户所有日常健康数据记录，支持按时间排序，展示血压、血糖、体重等历史健康数据
**请求参数**

|参数名|类型|必填|说明|
|---|---|---|---|
|page|int|否|页码，默认1|
|size|int|否|每页条数，默认10|

**响应成功**

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": {
    "total": 12,
    "list": [
      {
        "health_id": 601,
        "blood_pressure_high": "125",
        "blood_pressure_low": "80",
        "blood_sugar": "5.6",
        "weight": "62.5",
        "create_time": "2026-07-08 09:30:00"
      }
    ]
  }
}
```

## 10\.3 删除健康记录

**接口地址**：`DELETE /health/{id}`

**功能描述**：删除指定单条用户健康数据记录
**路径参数**

|参数名|类型|必填|说明|
|---|---|---|---|
|id|int|是|健康记录ID|

**响应成功**

```JSON
{
  "code": 200,
  "msg": "健康记录删除成功"
}
```

# 11\. 通用公共接口-wjc

## 11\.1 文件上传

**接口地址**：`POST /common/upload`

**功能描述**：通用文件上传接口，支持图片、文档等文件上传，返回文件在线访问链接
**请求类型**：form\-data
**请求参数**

|参数名|类型|必填|说明|
|---|---|---|---|
|file|file|是|上传文件，支持jpg、png、pdf等格式|

**响应成功**

```JSON
{
  "code": 200,
  "msg": "上传成功",
  "data": {
    "file_url": "https://xxx.com/upload/20260709/xxx.png"
  }
}
```

`POST /common/upload`

## 11\.2 系统公告与配置

**接口地址**：`GET /common/config`

**功能描述**：获取系统全局配置、最新公告、版本信息等公共数据
**响应成功**

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": {
    "version": "V1.2.0",
    "notice": "系统将于2026-07-15进行版本迭代升级，届时暂停服务2小时",
    "customer_phone": "400-123-4567",
    "max_upload_size": 10485760
  }
}
```

# 12\. 管理员后台接口-lx

## 12\.1 管理员登录

**接口地址**：`POST /admin/login`

**功能描述**：后台管理员账号登录，获取后台操作Token
**请求参数**

|参数名|类型|必填|说明|
|---|---|---|---|
|username|string|是|管理员账号|
|password|string|是|管理员密码|

**响应成功**

```JSON
{
  "code": 200,
  "msg": "登录成功",
  "data": {
    "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
    "admin_name": "超级管理员",
    "expire_at": "2026-07-10T23:59:59"
  }
}
```

## 12\.2 用户管理列表

**接口地址**：`GET /admin/users?page=1&size=10`

**功能描述**：后台分页查询所有普通用户账号，支持账号状态筛选
**请求参数**

|参数名|类型|必填|说明|
|---|---|---|---|
|page|int|否|页码，默认1|
|size|int|否|每页条数，默认10|
|status|int|否|账号状态 0禁用 1正常|

**响应成功**

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": {
    "total": 56,
    "list": [
      {
        "user_id": 1,
        "username": "zhangsan",
        "phone": "13800138000",
        "status": 1,
        "register_time": "2026-04-10 15:20:00",
        "last_login_time": "2026-07-09 08:10:00"
      }
    ]
  }
}
```

## 12\.3 启用/禁用用户

**接口地址**：`PUT /admin/user/{id}/status`

**功能描述**：后台管理员修改普通用户账号状态，启用或禁用账号
**路径参数**

|参数名|类型|必填|说明|
|---|---|---|---|
|id|int|是|用户ID|

**请求参数**

|参数名|类型|必填|说明|
|---|---|---|---|
|status|int|是|0=禁用，1=启用|

**响应成功**

```JSON
{
  "code": 200,
  "msg": "用户状态修改成功"
}
```

## 12\.4 全局服药统计

**接口地址**：`GET /admin/stat/record`

**功能描述**：后台获取平台全局服药数据统计，包含总服药次数、整体完成率、活跃用户数等数据
**请求参数**

|参数名|类型|必填|说明|
|---|---|---|---|
|startDate|string|否|统计开始日期 YYYY\-MM\-DD|
|endDate|string|否|统计结束日期 YYYY\-MM\-DD|

**响应成功**

```JSON
{
  "code": 200,
  "msg": "成功",
  "data": {
    "total_user": 1280,
    "active_user": 860,
    "total_taken_num": 52680,
    "total_miss_num": 4210,
    "average_complete_rate": "92.1%"
  }
}
```

## 12\.5 维护药物冲突知识库

**接口地址**：`POST /admin/drugConflict`

**功能描述**：后台新增/编辑药物配伍冲突数据，维护公共药物知识库的冲突规则
**请求参数**

|参数名|类型|必填|说明|
|---|---|---|---|
|drug\_id1|int|是|冲突药物1知识库ID|
|drug\_id2|int|是|冲突药物2知识库ID|
|conflict\_desc|string|是|冲突危害描述|
|suggest|string|否|规避建议|

**响应成功**

```JSON
{
  "code": 200,
  "msg": "药物冲突知识库维护成功"
}
```
