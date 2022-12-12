create database MSW_GCS220106;
use MSW_GCS220106;

-- product,store,category,staff,bill,billdetail,customer
create table category(
categoryID int auto_increment primary key,
categoryName varchar(30) not null unique,
descriptions text
); 
use msw_gcs220106;
select * from product order by productID ASC;
create table product(
productID varchar(30),
productName varchar(50) not null,
productPrice int not null default(1),
productImage varchar(255) null,
productDetail varchar(255) null,
categoryID int not null,
primary key (productID),
constraint FK_ProductCategory foreign key(categoryID) 
references category(categoryID)
on delete cascade 
on update cascade

);

use msw_gcs220106;

-- customerAccount -- 

create table customerAccount(
accountID varchar(30),
email varchar(50) not null unique ,
userPassword varchar(50) not null,
primary key (accountID)
);
-- value --
select * from customerAccount;
select * from customerProfile;
insert into customerAccount values
('ACC1','annhien123@gmail.com','123456789annhien'),
('ACC2','nhathoa123@gmail.com','123456789nhathoa');
-- customerProfile
create table customerProfile(
profileID varchar(50),
profileImage varchar(255),
fullname nvarchar(60) not null,
address text null,
phone varchar(30) null,
accountID varchar(30) not null unique,
primary key (profileID),
constraint FK_Profile_customer foreign key(accountID)
references customerAccount(accountID)
on update cascade 
on delete cascade
);
insert into customerProfile values
('CUS1','profile_1.jpg','Nguyễn An Nhiên','Hoàn Kiếm Hà Nội','0932890675','ACC1'),
('CUS2','profile_2.jpg','Trần Minh Nhật Hòa','Quận 1 HCM','0987231232','ACC2');

select * 
    from customerAccount as a, customerProfile as p
    where a.accountID = p.accountID
    and a.accountID = 'ACC1';

create table orderInfo(
orderID varchar(30),
orderDate date,
accountID varchar(30),
primary key (orderID),
constraint FK_order_customer foreign key (accountID)
references customerAccount(accountID)
on update cascade
on delete cascade
);
insert into orderInfo values
('OR1','2022-05-30','ACC1'),
('OR2','2022-06-26','ACC2'),
('OR3','2022-07-26','ACC1'),
('OR4','2022-08-01','ACC2');
select * from orderDetail;
-- orderDetail

create table orderDetail(
orderID varchar(30),
productID varchar(30),
quantity int not null default(1),
primary key (orderID,productID),
constraint FK_orderDetail_product foreign key(productID)
references product(productID)
on update cascade
on delete cascade,
constraint FK_orderDetail_order foreign key(orderID)
references orderInfo(orderID)
on update cascade
on delete cascade
);

insert into orderDetail value
('OR1','P001',1),
('OR1','P005',2),
('OR2','P004',1),
('OR2','P005',3),
('OR3','P002',5),
('OR3','P006',4),
('OR4','P007',2),
('OR4','P010',1);

-- staff

create table staff(
staffID varchar(30),
staffImage varchar(255),
staffName nvarchar(60) not null,
staffPhone varchar(30) null,
staffEmail varchar(50) unique,
staffRole varchar(30),
primary key (staffID)
);  


insert into staff values
('ST1','staff_1.jpg','Trần Thiên','0987654321','staff01@gmail.msw.com','Front-End Developer'),
('ST2','staff_2.jpg','Adolf Hilter','0912340912','staff02@gmail.msw.com','Operators'),
('ST3','staff_3.jpg','Tom Halland','0876123450','staff03@gmail.msw.com','Finance'),
('ST4','staff_4.jpg','Phạm Lê Minh','0398012345','staff04@gmail.msw.com','IT Support'),
('ST5','staff_5.jpg','Vladimir Putin','0987612345','staff05@gmail.msw.com','Owners'),
('ST6','staff_6.jpg','Lý Tuân','0326978541','staff06@gmail.msw.com','Back-End Developer');

-- admin 

create table adminAccount(
adminID varchar(30),
username varchar(50) not null unique,
adminPassword varchar(50) not null,
staffID varchar(30) unique,
primary key (adminID),
constraint FK_admin_staff foreign key (staffID)
references staff(staffID)
on update cascade
on delete cascade
); 

insert into adminAccount values
('AD1','admin01','msw__admin01','ST1'),
('AD2','admin02','msw__admin02','ST4'),
('AD3','admin03','msw__admin03','ST6');
use msw_gcs220106;

select * from adminAccount as a , staff as s 
where a.staffID = s.staffID
and a.adminID = "AD1";
select * from staff 
where staffID not in (
select s.staffID
from staff as s, admin as a
where s.staffID = a.staffID);
select * from admin;
select p.*, c.categoryName
    from product as p , category as c
    where p.categoryID = c.categoryID
    order by p.productID ASC;
-- insert data
insert into category (categoryName) values
('LG'),('Samsung'),('Apple'),('HTC'),('Motorola'),('Sony'),('Nexus');
update  category
set descriptions = "This is Nexus"
where categoryID = 7;

insert into product values
('P001','Checkered Floral Frame',80,'product1.jpg',
'Our best-selling Impact cases—the ones you love—have gotten a whole new protection upgrade thanks to our innovative EcoShock™ technology. Plant-inspired, patent-pending twister design lines the inner surfaces of our cases, allowing it to withstand drops from up to 8.2 feet and 4x military standard. It’s super tough yet no less cute.',3),
('P002','Butterfly Aurora',80,'product2.jpg','Don’t underestimate the small form factor of the Impact Case. It has been rigorously tested to withstand multiple drop angles and up to 109 times to ensure your phone is protected at every angle.',3),
('P003','Aqua Smiley Transparent',70,'product3.jpg','Don’t underestimate the small form factor of the Impact Case. It has been rigorously tested to withstand multiple drop angles and up to 109 times to ensure your phone is protected at every angle.',3),
('P004','Black Kingsnake',70,'product4.jpg','Don’t underestimate the small form factor of the Impact Case. It has been rigorously tested to withstand multiple drop angles and up to 109 times to ensure your phone is protected at every angle.',2),
('P005','Color Cloud',65,'product5.jpg','Don’t underestimate the small form factor of the Impact Case. It has been rigorously tested to withstand multiple drop angles and up to 109 times to ensure your phone is protected at every angle.',2),
('P006','Spring Botanicals 2',65,'product6.jpg','Don’t underestimate the small form factor of the Impact Case. It has been rigorously tested to withstand multiple drop angles and up to 109 times to ensure your phone is protected at every angle.',1),
('P007','You are exactly where you need to be',65,'product7.jpg','Don’t underestimate the small form factor of the Impact Case. It has been rigorously tested to withstand multiple drop angles and up to 109 times to ensure your phone is protected at every angle.',4),
('P008','Moon Camping',65,'product8.jpg','Don’t underestimate the small form factor of the Impact Case. It has been rigorously tested to withstand multiple drop angles and up to 109 times to ensure your phone is protected at every angle.',5),
('P009','Natural Flower',75,'product9.jpg','Don’t underestimate the small form factor of the Impact Case. It has been rigorously tested to withstand multiple drop angles and up to 109 times to ensure your phone is protected at every angle.',6),
('P010','ONE PIECE Motif Case',65,'product10.jpg','Don’t underestimate the small form factor of the Impact Case. It has been rigorously tested to withstand multiple drop angles and up to 109 times to ensure your phone is protected at every angle.',7);


