## 1. users 服药用户表

| 字段名          | 字段说明                | 字段类型        | 是否可为空 | 默认值                                        | 约束/备注        |
| :-------------- | :---------------------- | :-------------- | :--------- | :-------------------------------------------- | :--------------- |
| id              | 用户主键ID              | bigint unsigned | 否         | 自增                                          | 主键 PRIMARY KEY |
| username        | 登录用户名              | varchar(50)     | 否         | 无                                            | 唯一索引         |
| password        | 加密密码                | varchar(255)    | 否         | 无                                            | 存储加密后密文   |
| phone           | 手机号                  | varchar(20)     | 是         | NULL                                          | 唯一索引         |
| email           | 邮箱                    | varchar(100)    | 是         | NULL                                          | -                |
| real_name       | 真实姓名                | varchar(50)     | 是         | NULL                                          | -                |
| gender          | 性别（0未知/1男/2女）   | tinyint         | 否         | 0                                             | 状态枚举         |
| age             | 年龄                    | int             | 是         | NULL                                          | -                |
| avatar          | 头像链接                | varchar(255)    | 是         | NULL                                          | -                |
| status          | 账号状态（0禁用/1正常） | tinyint         | 否         | 1                                             | 状态枚举         |
| last_login_time | 最后登录时间            | datetime        | 是         | NULL                                          | -                |
| create_time     | 创建时间                | datetime        | 否         | CURRENT_TIMESTAMP                             | -                |
| update_time     | 更新时间                | datetime        | 否         | CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | 自动更新         |

## 2. relatives 亲属账号表

| 字段名          | 字段说明                | 字段类型        | 是否可为空 | 默认值                                        | 约束/备注 |
| :-------------- | :---------------------- | :-------------- | :--------- | :-------------------------------------------- | :-------- |
| id              | 亲属账号主键ID          | bigint unsigned | 否         | 自增                                          | 主键      |
| username        | 亲属登录账号            | varchar(50)     | 否         | 无                                            | 唯一索引  |
| password        | 加密密码                | varchar(255)    | 否         | 无                                            | 密文存储  |
| phone           | 亲属手机号              | varchar(20)     | 是         | NULL                                          | 唯一索引  |
| real_name       | 亲属真实姓名            | varchar(50)     | 是         | NULL                                          | -         |
| avatar          | 头像链接                | varchar(255)    | 是         | NULL                                          | -         |
| status          | 账号状态（0禁用/1正常） | tinyint         | 否         | 1                                             | 状态枚举  |
| last_login_time | 最后登录时间            | datetime        | 是         | NULL                                          | -         |
| create_time     | 创建时间                | datetime        | 否         | CURRENT_TIMESTAMP                             | -         |
| update_time     | 更新时间                | datetime        | 否         | CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | 自动更新  |

## 3. user_relatives 用户亲属绑定表

| 字段名        | 字段说明                    | 字段类型        | 是否可为空 | 默认值                                        | 约束/备注                   |
| :------------ | :-------------------------- | :-------------- | :--------- | :-------------------------------------------- | :-------------------------- |
| id            | 绑定关系主键ID              | bigint unsigned | 否         | 自增                                          | 主键                        |
| user_id       | 服药用户ID                  | bigint unsigned | 否         | 无                                            | 外键关联users，级联删除     |
| relative_id   | 亲属账号ID                  | bigint unsigned | 否         | 无                                            | 外键关联relatives，级联删除 |
| relation_text | 亲属关系（子女/配偶/父母）  | varchar(20)     | 否         | 无                                            | -                           |
| permission    | 权限（1仅查看/2可管理）     | tinyint         | 否         | 1                                             | 权限枚举                    |
| bind_status   | 绑定状态（0解绑/1正常绑定） | tinyint         | 否         | 1                                             | 状态枚举                    |
| bind_time     | 绑定时间                    | datetime        | 否         | CURRENT_TIMESTAMP                             | -                           |
| create_time   | 创建时间                    | datetime        | 否         | CURRENT_TIMESTAMP                             | -                           |
| update_time   | 更新时间                    | datetime        | 否         | CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | 自动更新                    |

## 4. drug_library 公共药物知识库

| 字段名         | 字段说明         | 字段类型        | 是否可为空 | 默认值                                        | 约束/备注 |
| :------------- | :--------------- | :-------------- | :--------- | :-------------------------------------------- | :-------- |
| id             | 药品知识库主键ID | bigint unsigned | 否         | 自增                                          | 主键      |
| drug_name      | 药品通用名称     | varchar(100)    | 否         | 无                                            | 检索索引  |
| specification  | 药品规格         | varchar(60)     | 是         | NULL                                          | -         |
| manufacturer   | 生产厂家         | varchar(100)    | 是         | NULL                                          | -         |
| usage          | 服用方式         | text            | 是         | NULL                                          | -         |
| taboo          | 禁忌人群/场景    | text            | 是         | NULL                                          | -         |
| side_effect    | 副作用           | text            | 是         | NULL                                          | -         |
| effect         | 药品功效         | text            | 是         | NULL                                          | -         |
| match_conflict | 配伍冲突说明     | text            | 是         | NULL                                          | -         |
| save_note      | 储存注意事项     | text            | 是         | NULL                                          | -         |
| create_time    | 创建时间         | datetime        | 否         | CURRENT_TIMESTAMP                             | -         |
| update_time    | 更新时间         | datetime        | 否         | CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | 自动更新  |

## 5. drug_conflicts 药物冲突表

| 字段名         | 字段说明          | 字段类型        | 是否可为空 | 默认值                                        | 约束/备注        |
| :------------- | :---------------- | :-------------- | :--------- | :-------------------------------------------- | :--------------- |
| id             | 药物冲突主键ID    | bigint unsigned | 否         | 自增                                          | 主键             |
| medicine_a_id  | 冲突药品A知识库ID | bigint unsigned | 否         | 无                                            | 关联drug_library |
| medicine_b_id  | 冲突药品B知识库ID | bigint unsigned | 否         | 无                                            | 关联drug_library |
| conflict_level | 冲突等级          | tinyint         | 否         | 0                                             | 0低/1中/2高风险  |
| conflict_desc  | 冲突危害描述      | text            | 是         | NULL                                          | -                |
| suggest        | 规避建议          | text            | 是         | NULL                                          | -                |
| create_time    | 创建时间          | datetime        | 否         | CURRENT_TIMESTAMP                             | -                |
| update_time    | 更新时间          | datetime        | 否         | CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | 自动更新         |

## 6. medicines 用户自有药物表

| 字段名        | 字段说明             | 字段类型        | 是否可为空 | 默认值                                        | 约束/备注           |
| :------------ | :------------------- | :-------------- | :--------- | :-------------------------------------------- | :------------------ |
| id            | 用户药品主键ID       | bigint unsigned | 否         | 自增                                          | 主键                |
| user_id       | 所属用户ID           | bigint unsigned | 否         | 无                                            | 关联users，级联删除 |
| name          | 药品名称             | varchar(100)    | 否         | 无                                            | -                   |
| specification | 药品规格             | varchar(60)     | 是         | NULL                                          | -                   |
| manufacturer  | 生产厂家             | varchar(100)    | 是         | NULL                                          | -                   |
| expire_date   | 有效期截止日期       | date            | 是         | NULL                                          | 用于过期预警        |
| stock         | 药品库存数量         | int             | 否         | 0                                             | 库存预警依据        |
| unit          | 数量单位（片/粒/袋） | varchar(20)     | 是         | NULL                                          | -                   |
| usage         | 服用方式             | text            | 是         | NULL                                          | -                   |
| note          | 备注信息             | text            | 是         | NULL                                          | -                   |
| create_time   | 创建时间             | datetime        | 否         | CURRENT_TIMESTAMP                             | -                   |
| update_time   | 更新时间             | datetime        | 否         | CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | 自动更新            |

## 7. prescriptions 医嘱表

| 字段名           | 字段说明                | 字段类型        | 是否可为空 | 默认值                                        | 约束/备注        |
| :--------------- | :---------------------- | :-------------- | :--------- | :-------------------------------------------- | :--------------- |
| id               | 医嘱主键ID              | bigint unsigned | 否         | 自增                                          | 主键             |
| user_id          | 所属用户ID              | bigint unsigned | 否         | 无                                            | 关联users        |
| medicine_id      | 关联药品ID              | bigint unsigned | 否         | 无                                            | 关联medicines    |
| doctor_name      | 开具医生姓名            | varchar(50)     | 是         | NULL                                          | -                |
| hospital         | 就诊医院                | varchar(100)    | 是         | NULL                                          | -                |
| diagnosis        | 诊断病情                | text            | 是         | NULL                                          | -                |
| dosage           | 单次服用剂量            | varchar(50)     | 否         | 无                                            | -                |
| frequency        | 服用频率                | varchar(50)     | 否         | 无                                            | 如：每日2次      |
| start_date       | 医嘱开始日期            | date            | 否         | 无                                            | -                |
| end_date         | 医嘱结束日期            | date            | 是         | NULL                                          | 为空代表长期服用 |
| conflict_warning | 药物冲突预警信息        | text            | 是         | NULL                                          | -                |
| status           | 医嘱状态（0停用/1启用） | tinyint         | 否         | 1                                             | 状态枚举         |
| note             | 医嘱备注                | text            | 是         | NULL                                          | -                |
| create_time      | 创建时间                | datetime        | 否         | CURRENT_TIMESTAMP                             | -                |
| update_time      | 更新时间                | datetime        | 否         | CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | 自动更新         |

## 8. reminders 服药提醒表

| 字段名          | 字段说明                      | 字段类型        | 是否可为空 | 默认值                                        | 约束/备注        |
| :-------------- | :---------------------------- | :-------------- | :--------- | :-------------------------------------------- | :--------------- |
| id              | 提醒主键ID                    | bigint unsigned | 否         | 自增                                          | 主键             |
| user_id         | 所属用户ID                    | bigint unsigned | 否         | 无                                            | 关联users        |
| prescription_id | 关联医嘱ID                    | bigint unsigned | 是         | NULL                                          | 可无医嘱单独提醒 |
| medicine_id     | 关联药品ID                    | bigint unsigned | 否         | 无                                            | 关联medicines    |
| remind_time     | 每日提醒时间                  | time            | 否         | 无                                            | -                |
| dosage          | 本次服用剂量                  | varchar(50)     | 否         | 无                                            | -                |
| repeat_type     | 重复类型（1每日/2周期/3单次） | tinyint         | 否         | 1                                             | 枚举类型         |
| repeat_days     | 周期重复星期                  | varchar(20)     | 是         | NULL                                          | 存储1-7周几      |
| remind_method   | 提醒方式（1APP/2短信/3电话）  | tinyint         | 否         | 1                                             | 枚举类型         |
| is_active       | 提醒开关状态（0关闭/1开启）   | tinyint         | 否         | 1                                             | 状态枚举         |
| create_time     | 创建时间                      | datetime        | 否         | CURRENT_TIMESTAMP                             | -                |
| update_time     | 更新时间                      | datetime        | 否         | CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | 自动更新         |

## 9. medication_records 服药记录表

| 字段名          | 字段说明                      | 字段类型        | 是否可为空 | 默认值 | 约束/备注     |
| :-------------- | :---------------------------- | :-------------- | :--------- | :----- | :------------ |
| id              | 服药记录主键ID                | bigint unsigned | 否         | 自增   | 主键          |
| user_id         | 所属用户ID                    | bigint unsigned | 否         | 无     | 关联users     |
| reminder_id     | 关联提醒ID                    | bigint unsigned | 是         | NULL   | 手动记录可空  |
| prescription_id | 关联医嘱ID                    | bigint unsigned | 是         | NULL   | -             |
| medicine_id     | 关联药品ID                    | bigint unsigned | 否         | 无     | 关联medicines |
| plan_time       | 计划服药时间                  | datetime        | 否         | 无     | -             |
| actual_time     | 实际服药时间                  | datetime        | 是         | NULL   | 漏服则为空    |
| dosage_taken    | 实际服用剂量                  | varchar(50)     | 是         | NULL   | -             |
| status          | 服药状态（1已服/2漏服/3跳过） | tinyint         | 否         | 1      | 状态枚举      |