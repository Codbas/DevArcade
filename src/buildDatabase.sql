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
    foreign key (pageId) references Pages(id) on delete cascade
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
    foreign key (devLogId) references DevLogs(id) on delete cascade
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
    foreign key (gameId) references Games(id) on delete cascade
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
    foreign key (username) references Users(username) on delete cascade
);
create table SiteHits(
    timestamp datetime not null,
    ip varchar(15) not null
);
create table FailedLogin(
    timestamp datetime not null,
    ip varchar(15) not null
);
create table SuccessfulLogin(
    timestamp datetime not null,
    ip varchar(15) not null,
    username varchar(20) not null,
    foreign key (username) references Users(username) on delete cascade
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
          (7, 'Manage Content'),
          (8, 'Game'),
          (9, 'DevLog')
);

# insert preloaded Game and Devlog data.
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

# insert view counts for pages
delimiter //
create procedure DevArcade.addViews()
begin
    DECLARE i int;

    # Homepage views
    set i = 1;
    while i <= 14922 do
        set i = i + 1;
        insert into PageViews(timestamp, ip, pageId)
            values((now() - interval 1 second), '123.255.0.0', 1);
    end while;

    # Games views
    set i = 1;
    while i <= 1149 do
            set i = i + 1;
            insert into PageViews(timestamp, ip, pageId)
            values((now() - interval 1 second), '123.255.0.0', 2);
    end while;

    # DevLog views
    set i = 1;
    while i <= 344 do
            set i = i + 1;
            insert into PageViews(timestamp, ip, pageId)
            values((now() - interval 1 second), '123.255.0.0', 3);
    end while;

    # About views
    set i = 1;
    while i <= 144 do
            set i = i + 1;
            insert into PageViews(timestamp, ip, pageId)
            values((now() - interval 1 second), '123.255.0.0', 4);
    end while;

    # Login views
    set i = 1;
    while i <= 132 do
            set i = i + 1;
            insert into PageViews(timestamp, ip, pageId)
            values((now() - interval 1 second), '123.255.0.0', 5);
    end while;

    # Change Password views
    set i = 1;
    while i <= 45 do
            set i = i + 1;
            insert into PageViews(timestamp, ip, pageId)
            values((now() - interval 1 second), '123.255.0.0', 6);
    end while;

    # Manage Content views
    set i = 1;
    while i <= 132 do
            set i = i + 1;
            insert into PageViews(timestamp, ip, pageId)
            values((now() - interval 1 second), '123.255.0.0', 7);
    end while;

    # Site hits
    set i = 1;
    while i <= 697 do
            set i = i + 1;
            insert into SiteHits(timestamp, ip)
            values((now() - interval 1 second), '123.255.0.0');
    end while;

    # Game 1 plays
    set i = 1;
    while i <= 344 do
            set i = i + 1;
            insert into GamePlays(timestamp, ip, gameId)
            values((now() - interval 1 second), '123.255.0.0', 1);
    end while;

    # Game 1 views
    set i = 1;
    while i <= 27 do
            set i = i + 1;
            insert into DevLogViews(timestamp, ip, devLogId)
            values((now() - interval 1 second), '123.255.0.0', 1);
    end while;

    # Game 2 plays
    set i = 1;
    while i <= 62 do
            set i = i + 1;
            insert into GamePlays(timestamp, ip, gameId)
            values((now() - interval 1 second), '123.255.0.0', 2);
    end while;

    # Game 2 views
    set i = 1;
    while i <= 12 do
            set i = i + 1;
            insert into DevLogViews(timestamp, ip, devLogId)
            values((now() - interval 1 second), '123.255.0.0', 2);
    end while;

    # Game 3 plays
    set i = 1;
    while i <= 5663 do
            set i = i + 1;
            insert into GamePlays(timestamp, ip, gameId)
            values((now() - interval 1 second), '123.255.0.0', 3);
        end while;

    # Game 3 views
    set i = 1;
    while i <= 533 do
            set i = i + 1;
            insert into DevLogViews(timestamp, ip, devLogId)
            values((now() - interval 1 second), '123.255.0.0', 3);
        end while;
end//

delimiter ;

call addViews();
drop procedure DevArcade.addViews;
