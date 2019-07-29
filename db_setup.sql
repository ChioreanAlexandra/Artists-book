create database artists_book CHARACTER SET utf8 COLLATE utf8_general_ci;
use artists_book;
#drop table if exists `user`;
create table `user` (
	id int(11) auto_increment primary key,
    `name` varchar(50),
    email varchar(255) unique,
    `password` varchar(100)
);

#drop table if exists product;
create table product (
	id int(11) auto_increment primary key,
    title varchar(255),
    description text,
    camera_specs text,
    capture_data datetime,
    thumbnail_path varchar(255),
    user_id int(11),
	foreign key (user_id) REFERENCES `user`(id) on delete set null
);
#drop table if exists tag;
create table tag(
id int(11) auto_increment primary key,
tag_name varchar(100) unique
);
#drop table if exists product_tag;
create table product_tag (
	id int(11) auto_increment primary key,
    product_id int(11),
    tag_id int(11),
	foreign key (product_id) REFERENCES product(id) on delete cascade,
	foreign key (tag_id) REFERENCES tag(id) on delete cascade
);
#drop table if exists tier
create table tier (
	id int(11) auto_increment primary key,
    price decimal(8,2),
    path_with_watermark varchar(255),
    path_without_watermark varchar(255),
    size enum('small','medium','large'),
    product_id int(11),
	foreign key (product_id) REFERENCES product(id) on delete cascade
);
create unique index tier_index on tier(size,product_id);
#drop table if exists order_item;
create table order_item(
id int(11) auto_increment primary key,
user_id int(11),
tier_id int(11),
created_at datetime,
foreign key (user_id) REFERENCES `user`(id) on delete set null,
foreign key (tier_id) REFERENCES tier(id) on delete cascade
);
