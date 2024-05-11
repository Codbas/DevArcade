create database DevArcade;
use DevArcade;

create table Pages(
    id int not null auto_increment,
    name varchar(25) not null,
    primary key (id)
);
create table PageViews(
    timestamp datetime not null,
    ip varchar(15) not null,
    pageId int not null,
    foreign key (pageId) references Pages(id)
);
create table DevLogs(
    id int not null auto_increment,
    title varchar(50) not null,
    description varchar(255) not null,
    primary key (id)
);
create table DevLogViews(
    timestamp datetime not null,
    ip varchar(15) not null,
    devLogId int not null,
    foreign key (devLogId) references DevLogs(id)
);
create table Games(
    id int not null auto_increment,
    title varchar(50) not null,
    description varchar(255) not null,
    primary key (id)
);
create table GamePlays(
    timestamp datetime not null,
    ip varchar(15) not null,
    gameId int not null,
    foreign key (gameId) references  Games(id)
);
create table Users(
    userName varchar(20) not null,
    password char(32) not null,
    salt char(32) not null,
    primary key (userName)
);
create table Sessions(
    sessionId char(32) not null,
    userName varchar(20) not null,
    lastActive datetime not null,
    primary key (sessionId),
    foreign key (userName) references Users(userName)
);
create table SiteHits(
    timestamp datetime not null,
    ip varchar(15) not null,
    primary key (timestamp, ip)
);