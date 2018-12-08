
 create database book;
 
 
 
 use book;
 
 
 create table publisher(
 pname varchar(50),
 address varchar(100),
 phone int(10),
 constraint pk_name primary key(pname));
 
 create table book(
 `book_id` int,
 sem int,
 title varchar(100),
 pname varchar(50),
 pubyear int(10),
 amount int(10),
 availability varchar(10),
 
 constraint pk_b_id primary key(`book_id`),
 constraint fk_pn foreign key(pname) references publisher(pname) on delete cascade);
 
 drop table bookauthor;
 
 create table bookauthor(
 `book_id` int,
 `author_name` varchar(100),
 constraint pk_id primary key(`book_id`,`author_name`),
 constraint fk_i foreign key(`book_id`) references book(`book_id`) on delete cascade);
 
 create table librarybranch(
 `branch_id`int,
 branchname varchar(10),
 constraint pk_s primary key(`branch_id`));
 
 create table bookcopies(
 `book_id` int,
 `branch_id` int,
 noofcopies int,
 constraint pk_n primary key(`book_id`,`branch_id`),
 constraint fk_c foreign key(`book_id`) references book(`book_id`) on delete cascade,
 constraint fk_ck foreign key(`branch_id`) references librarybranch(`branch_id`) on delete cascade);
 
 create table booklending(
 `book_id` int,
 `branch_id` int,
 cardno int,
 DateOut date,
 DueDate date,
 constraint pk_nm primary key(`book_id`,`branch_id`,cardno),
 constraint fk_bidi foreign key(`book_id`) references book(`book_id`) on delete cascade,
 constraint fk_b_id foreign key(`branch_id`) references librarybranch(`branch_id`) on delete cascade);
 
 
 
create database studentdb;

use studentdb;


create table bookborrowed(
id int,usn varchar(50),cardno varchar(50),title varchar(200),authorname varchar(50),Dateout DATE,
constraint pk_k primary key(cardno));




create database Request;

use Request;

drop table RequestedBooks;


create table RequestedBooks(
usn varchar(50),cardno varchar(10),book_id int,Date DATE ,
constraint pk_i primary key(cardno));



create table ReturnedBooks(
usn varchar(50),cardno varchar(50),book_id int,Date DATE,DateOut Date,Returned varchar(10),
constraint pk_id primary key(cardno,book_id),

constraint fk_j foreign key(book_id) references RequestedBooks(book_id),
constraint fk_l foreign key(cardno) references RequestedBooks(cardno));




create table finelist(
usn varchar(50),cardno varchar(50),book_id int,amount int,finepaid varchar(10),
constraint pk_d primary key(cardno,book_id));




create database authentication;

use  authentication;

create table studentlist(usn varchar(10),sname varchar(50),sem int,branch varchar(10),feepaid varchar(10));
drop table studentlist;


create table admin(usrname varchar(50),pass varchar(50));


create table student(usn varchar(10),sname varchar(50),sem int,branch varchar(10),feepaid varchar(10));