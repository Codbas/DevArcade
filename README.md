# About DevArcade
DevArcade is my Software Development Capstone Project for Columbia Basin College in Spring 2024.
&nbsp;
DevArcade is a PHP web application for sharing JavaScript/HTML/CSS games and dev logs. It is meant to show games made without 3rd party libraries and highlight the development and thought process involved in making the games.
&nbsp;
Because Games and Dev Logs are strictly JavaScript, HTML, and CSS, theymust follow a strict file structure. Games are stored on the web server under the /var/www/games directory and devlogs are located in /var/www/devlogs.
&nbsp;
&nbsp;
## Game Structure
Games must contain index.html and image.jpg to be uplaoded to the server. image.jpg serves as the preview of the game. Games may also contain index.css annd index.js, but those are optional files. **No other files or foldersare allowed**.
&nbsp;
&nbsp;
## Dev Log Structure
Dev Logs must contain index.html. They may also contain index.css, index.js and any number of jpg images. As with Games, no other files or folders are allowed.
&nbsp;
&nbsp;
## Uploading a new Game or Dev Log
Compress the files in the root directory a .zip with any name. If the zip file contents are valid, they will be added to the server.
&nbsp;
&nbsp;
&nbsp;
&nbsp;
# Running DevArcade Locally
This project is built to run in a Docker container. It can run on a LAMP server, but additional configuration will be requred. If you already have Docker installed, skip to the [Building the Docker Container](##building-the-docker-container).
&nbsp;
&nbsp;
## Docker Installation
1. Install Docker [here](https://docs.docker.com/desktop/install/windows-install/)
2. Once docker is installed, make sure it is running.


## Building the Docker Container
Open your favorite terminal or command prompt application and navigate to the docker folder under the project directory `/DevArcade/docker`

1. Enter the command `docker build -t devarcade .`
2. Wait for it to finish building.
3. Enter the command `docker-compose up -d`
4. Wait for it to finish composing.

DevArcade is now running in your docker container under localhost port 8080.




# Using DevArcade
Open your a web browser enter `localhost:8080` into the address bar.
Note: If you are receiving **ERROR: 1000**, wait for a few seconds and try again. This error means the database connection failed. This can happen because the database can take a minute to get fully configured and running.


## Preloaded Views and Plays
The pages, Games, and Dev Logs have been preloaded to have views and plays for demonstrative purposes. To disable the preloaded views and plays, open `/DevArcade/src/buildDatabase.sql` and remove or comment the stored procedure. It starts at line 98 and continues to the end of the file.


## Logging into DevArcade
DevArcade comes pre-configured with two users: **cody** and **user**. The password for each user is *password*.


## Included Games and Dev Logs
There are three Games and Dev Logs included for demonstrative purposes. There are additional Games and Dev Logs to test uploading and deleting content to the server under `/DevArcade/upload test content/`.


## Stopping the Docker Container
When you're done using DevArcade, you can stop the docker container with the command `docker-compose down`.
