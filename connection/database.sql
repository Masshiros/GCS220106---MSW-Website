create database MSW_GCS220106;
use MSW_GCS220106;

-- product,store,category,staff,bill,billdetail,customer
create table category(
categoryID int auto_increment primary key,
categoryName varchar(30) not null unique,
descriptions text
); 
create table product(
productID int,
productName varchar(50) not null,
productPrice int not null default(1),
productImage varchar(255) null,
productDetail varchar(255) null,
categoryID int not null,
primary key (productID),
constraint FK_ProductCategory foreign key(categoryID) 
references category(categoryID)

);
-- insert data
insert into category (categoryName) values
('LG'),('Samsung'),('Apple'),('HTC'),('Motorola'),('Sony'),('Nexus');

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

