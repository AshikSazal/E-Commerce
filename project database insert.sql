CREATE DATABASE ecommerce;
CREATE TABLE admin_info(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, NAME VARCHAR(100),PASSWORD VARCHAR(100));
INSERT INTO admin_info(NAME,PASSWORD)VALUES('admin','password');
CREATE TABLE customer_biodata(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,fname VARCHAR(100),lname VARCHAR(100),email VARCHAR(100),phone VARCHAR(100),city VARCHAR(100),district VARCHAR(100),country VARCHAR(100),PASSWORD VARCHAR(100));
CREATE TABLE place_order(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,ref_tbl INT,street_address VARCHAR(100),postcode INT,city VARCHAR(100),district VARCHAR(100),country VARCHAR(100),order_product_id VARCHAR(100),table_name VARCHAR(100),email VARCHAR(100),phone VARCHAR(100),STATUS INT,order_date TIMESTAMP);
CREATE TABLE product(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,NAME VARCHAR(100),category VARCHAR(100),sub_category VARCHAR(100),color VARCHAR(100),quantity INT,price DOUBLE,location VARCHAR(100),rating double default 5);


create table product2(id int not null auto_increment primary key,name varchar(50),category varchar(50),
sub_category varchar(50),quantity int,price double,location varchar(50));

CREATE TABLE review(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,product_id INT,rating DOUBLE,`comment` TEXT,
user_gmail VARCHAR(50));

CREATE TABLE temp_review(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,product_id INT,mean_rating DOUBLE);

INSERT INTO product(NAME,category,sub_category,color,quantity,price,location)VALUES
('jacket1','jacket','man','black',45,500,'image/product/m_j1.jpg'),
('jacket2','jacket','man','blue',20,250.45,'image/product/m_j2.jpg'),
('jacket3','jacket','man','white',35,450.34,'image/product/m_j3.jpg'),
('jacket4','jacket','man','red',25,800.45,'image/product/m_j4.jpg'),
('pant1','pant','man','white',20,299,'image/product/m_p1.jpg'),
('pant2','pant','man','blue',33,199.99,'image/product/m_p2.jpg'),
('pant3','pant','man','navy',30,249.99,'image/product/m_p3.jpg'),
('pant4','pant','man','black',25,350,'image/product/m_p4.jpg'),
('pant5','pant','man','white',10,450,'image/product/m_p5.jpg'),
('shirt1','shirt','man','red',23,199.99,'image/product/m_s1.jpg'),
('shirt2','shirt','man','black',30,299.99,'image/product/m_s2.jpg'),
('shirt3','shirt','man','white',15,300,'image/product/m_s3.jpg'),
('shirt4','shirt','man','blue',16,400,'image/product/m_s4.jpg'),
('shoe1','shoe','man','black',15,400,'image/product/m_sh1.jpg'),
('shoe2','shoe','man','white',25,350,'image/product/m_sh2.jpg'),
('shoe3','shoe','man','black',20,299.99,'image/product/m_sh3.jpg'),
('shoe4','shoe','man','ash',32,545,'image/product/m_sh4.jpg'),
('shoe5','shoe','man','sky-blue',15,350,'image/product/m_sh5.jpg'),
('t-shirt1','t-shirt','man','DarkOliveGreen',25,299.99,'image/product/m_ts1.jpg'),
('t-shirt2','t-shirt','man','white',25,399.99,'image/product/m_ts2.jpg'),
('t-shirt3','t-shirt','man','red',20,300,'image/product/m_ts3.jpg'),
('t-shirt4','t-shirt','man','sky-blue',17,200,'image/product/m_ts4.jpg'),
('t-shirt5','t-shirt','man','DarkCyan',23,300,'image/product/m_ts5.jpg'),
('t-shirt6','t-shirt','man','black',25,200,'image/product/m_ts6.jpg'),
('jacket1','jacket','woman','black',15,1299.99,'image/product/w_j1.jpg'),
('jacket2','jacket','woman','green',25,1199.99,'image/product/w_j2.jpg'),
('jacket3','jacket','woman','green',25,999.99,'image/product/w_j3.jpg'),
('jacket4','jacket','woman','black',23,1500,'image/product/w_j4.jpg'),
('jacket5','jacket','woman','blue',22,1600,'image/product/w_j5.jpg'),
('jacket6','jacket','woman','white',10,1099.99,'image/product/w_j6.jpg'),
('jacket7','jacket','woman','red',25,1700,'image/product/w_j7.jpg'),
('pant1','pant','woman','black',15,399.99,'image/product/w_p1.jpg'),
('pant2','pant','woman','blue',25,299.99,'image/product/w_p2.jpg'),
('pant3','pant','woman','blue',10,499.99,'image/product/w_p3.jpg'),
('pant4','pant','woman','sky-blue',35,400,'image/product/w_p4.jpg'),
('pant5','pant','woman','blue',23,500,'image/product/w_p5.jpg'),
('shirt1','shirt','woman','red',14,299.99,'image/product/w_s1.jpg'),
('shirt1','shirt','woman','red',20,399.99,'image/product/w_s2.jpg'),
('shirt2','shirt','woman','white',25,500,'image/product/w_s3.jpg'),
('shirt3','shirt','woman','blue',10,200,'image/product/w_s4.jpg'),
('shirt4','shirt','woman','blue',45,250,'image/product/w_s5.jpg'),
('shirt5','shirt','woman','black',30,199.99,'image/product/w_s6.jpg'),
('shoe1','shoe','woman','yellow',23,599.99,'image/product/w_sh1.jpg'),
('shoe2','shoe','woman','red',15,499.99,'image/product/w_sh2.jpg'),
('shoe3','shoe','woman','blue',23,200,'image/product/w_sh3.jpg'),
('shoe4','shoe','woman','white',23,400,'image/product/w_sh4.jpg'),
('shoe5','shoe','woman','yellow',23,199.99,'image/product/w_sh5.jpg'),
('shoe6','shoe','woman','yellow',23,300,'image/product/w_sh6.jpg'),
('shoe7','shoe','woman','black',23,600,'image/product/w_sh7.jpg'),
('shoe8','shoe','woman','black',23,599.99,'image/product/w_sh8.jpg'),
('Tops & t-shirt1','tops and t-shirt','woman','red',25,100,'image/product/w_tt1.jpg'),
('Tops & t-shirt2','tops and t-shirt','woman','green',10,199.99,'image/product/w_tt2.jpg'),
('Tops & t-shirt3','tops and t-shirt','woman','blue',15,200,'image/product/w_tt3.jpg'),
('Tops & t-shirt4','tops and t-shirt','woman','blue',13,299.99,'image/product/w_tt4.jpg'),
('Tops & t-shirt5','tops and t-shirt','woman','black',35,399.99,'image/product/w_tt5.jpg');

set global event_scheduler=on;

delimiter |
create event event_mean_rating on schedule every 1 minute do
begin
insert into temp_review(product_id,mean_rating)select review.product_id,sum(review.rating)/count(review.product_id)
from review,product where product.id=review.product_id and review.rating!='' group by review.product_id;
update product,temp_review set product.rating=temp_review.mean_rating where product.id=temp_review.product_id;
truncate temp_review;
end |
delimiter;

select * from product
truncate product
select * from admin_info

insert product2 select * from product
select * from product2

SELECT COUNT(*) FROM information_schema.columns WHERE table_name = 'product';  // column count
