create database bbs default character set=utf8;

use bbs;

create table user(
	user_id int unsigned primary key auto_increment comment "逻辑主键ID",
	user_name varchar(20) not null unique key comment "唯一的用户名",
	user_pwd char(32) not null comment "用户密码"
);

create table post(
	post_id int unsigned primary key auto_increment comment "逻辑主键ID",
	post_title varchar(50) not null comment "帖子的标题",
	post_owner varchar(20) not null comment "帖子作者",
	post_time int unsigned not null comment "发帖时间戳",
	post_content text not null comment "内容",
	post_hits int unsigned not null default 0 comment "帖子点击率"
);

create table reply(
	rpl_id int unsigned primary key auto_increment comment "逻辑主键ID",
	rpl_post_id int unsigned not null comment "外键，指向原帖的ID",
	rpl_user varchar(20) not null comment "跟帖用户名",
	rpl_content text not null comment "跟帖内容",
	rpl_time int unsigned not null comment "回帖时间戳"
);