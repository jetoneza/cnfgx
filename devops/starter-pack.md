# DevOps Starter pack

## Server Installation
Install ubuntu
* [Ubuntu installation](https://github.com/jetoneza/cnfgx/blob/master/devops/ububtu-installation.md)
  * [Video](https://www.youtube.com/watch?v=8YZDtfLzjS4)
* [Setting static ip](https://www.youtube.com/watch?v=cD_OkhN16rU)

## SSH Setup
Step 1: SSH with password.

Step 2: Add public ssh key to remote server in a single command. Check out this [link](http://www.howtogeek.com/168147/add-public-ssh-key-to-remote-server-in-a-single-command/)!

Step 3: Enable root user.

```
$ sudo passwd root
```

Step 4: Permit root login.

The default setting in Ubuntu for OpenSSH Server is to deny password-based login for root and allow only key-based login. Change this line in /etc/ssh/sshd_config:

```
PermitRootLogin without-password
```

to

```
PermitRootLogin yes
```

Restart SSH server:

```
sudo service ssh restart
```

Step 5: Add server host to ~/.ssh/config on your machine.

```
Host barracuda
HostName 192.168.1.21
User root
IdentityFile ~/.ssh/id_rsa.pub
ServerAliveInterval 30
```
