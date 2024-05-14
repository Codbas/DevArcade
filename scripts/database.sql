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
    username varchar(20) not null,
    password varchar(255) not null,
    primary key (username)
);
create table Sessions(
    sessionId varchar(255) not null,
    userName varchar(20) not null,
    lastActive datetime not null,
    primary key (sessionId),
    foreign key (username) references Users(username)
);
create table SiteHits(
    timestamp datetime not null,
    ip varchar(15) not null,
    primary key (timestamp, ip)
);

insert into Users (username, password) (
    values('cody', '$2y$10$YS6RTyB6l2VjCp8h2q9Ffuc49iYKIsHP/c9gsqj5TSBTyst7UyH6K')
);

insert into Pages (id, name) (
    values(1, 'Home'),
          (2, 'Games'),
          (3, 'Dev Logs'),
          (4, 'About'),
          (5, 'Log In')
);

insert into Sessions(sessionId, lastActive, userName) (
    values('abcde', NOW(), 'cody')
);


select sessionId, lastActive
from Sessions join Users on Sessions.username = Users.username
where Users.username = 'cody'
order by Sessions.lastActive desc limit 1