#About DevArcade
Software Development Capstone Project for Columbia Basin College.

#Running DevArcade Locally
If you already have Docker installed, skip to the next section.

Install Docker https://docs.docker.com/desktop/install/windows-install/
Start docker


##Build Docker Container
Open your favorite terminal or command prompt and navigate to the docker folder /DevArcade/docker

Enter the command docker build -t devarcade .
Wait for it to finish
Enter the command docker-compose up -d
Wait for it to finish

DevArcade is now running in your docker container under localhost port 8080.

Open your favorite browser and go to the address localhost:8080/src/public/Home.php
Note: If you are receiving ERROR: 1000, wait for a few seconds and try again. It can take a minute for everything to start up and run.

Enjoy!

When you're done, you can stop the docker container with the command docker-compose down