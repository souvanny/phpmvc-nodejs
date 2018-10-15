clear
sudo kill $(sudo lsof -t -i:9000)
node app.js

