drop database if exists DevArcade;
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
    username varchar(20) not null,
    lastActive datetime not null,
    primary key (sessionId),
    foreign key (username) references Users(username)
);
create table SiteHits(
    timestamp datetime not null,
    ip varchar(15) not null,
    primary key (timestamp, ip)
);
create table FailedLogin(
    timestamp datetime not null,
    ip varchar(15) not null,
    primary key (timestamp, ip)
);
create table SuccessfulLogin(
    timestamp datetime not null,
    ip varchar(15) not null,
    username varchar(20) not null,
    foreign key (username) references Users(username),
    primary key (username, ip, timestamp)
);

# insert username and password hash of password 'password'
insert into Users (username, password) (
    values('cody', '$2y$10$YS6RTyB6l2VjCp8h2q9Ffuc49iYKIsHP/c9gsqj5TSBTyst7UyH6K'),
        ('user', '$2y$10$YS6RTyB6l2VjCp8h2q9Ffuc49iYKIsHP/c9gsqj5TSBTyst7UyH6K')
);

insert into Pages (id, name) (
    values(1, 'Home'),
          (2, 'Games'),
          (3, 'Dev Logs'),
          (4, 'About'),
          (5, 'Log In'),
          (6, 'Change Password'),
          (7, 'Manage Content')
);

insert into Games (id, title, description) (
    values(1, 'Game One', 'This is the first game, appropriately named "Game One". It is a simple game where you try to click the button, but it has plans of its own. :)'),
          (2, 'Game Two', 'The second game made for DevArcade. It\'s exactly the same as Game One!'),
          (3, 'Game Three', 'The third, and possible final game. This one is no different than the others.')
);
insert into DevLogs (id, title, description) (
    values(1, 'Dev Log - Game One', 'This is the first Dev Log, appropriately named "Dev Log - Game One". Learn how I made this simple, but addicting game!'),
          (2, 'Dev Log - Game Two', 'The second Dev Log made for DevArcade. This one should be a doozy! Get strapped in, because you\'re in for a ride.'),
          (3, 'Dev Log - Game Three', 'The third, and possible final Dev Log. This one is no different than the others... or is it?')
);
