 


create table users(
fname varchar(100),
lname varchar(100),
email varchar(100),
password varchar(100),
status int,
primary key(email)
);





create table friends(
user varchar(100),
friend varchar(100)
);

create table newmessage(
messaging varchar(100),
isnew int,
primary key(messaging)
);



insert into users values('Ragini','Gundreddi','rgundreddi@scu.edu','qwerty',0);

insert into users values('Sravani','Gundreddi','sgundreddi@scu.edu','qwerty',0);

insert into users values('Harshini','Mamidala','hmamidala@scu.edu','qwerty',0);




insert into friends values('rgundreddi@scu.edu','sgundreddi@scu.edu');
insert into friends values('sgundreddi@scu.edu','rgundreddi@scu.edu');
insert into friends values('hmamidala@scu.edu','rgundreddi@scu.edu');
insert into friends values('rgundreddi@scu.edu','hmamidala@scu.edu');
insert into friends values('sgundreddi@scu.edu','hmamidala@scu.edu');
insert into friends values('hmamidala@scu.edu','sgundreddi@scu.edu');
