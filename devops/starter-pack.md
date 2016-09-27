# DevOps Starter pack

## Server Installation
Install ubuntu
* [Ubuntu installation](https://www.youtube.com/watch?v=8YZDtfLzjS4)
* [Setting static ip](https://www.youtube.com/watch?v=cD_OkhN16rU)

## SSH Setup
Step 1: SSH with password.

Step 2: Add public ssh key to remote server in a single command. Check out this [link](http://www.howtogeek.com/168147/add-public-ssh-key-to-remote-server-in-a-single-command/)!

Step 3: Add server host to ~/.ssh/config on your machine.
```
Host barracuda
HostName 192.168.1.21
User kokel
IdentityFile ~/.ssh/id_rsa.pub
ServerAliveInterval 30
```
