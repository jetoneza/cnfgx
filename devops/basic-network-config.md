# Setup Basic Network Config (Ubuntu - VirtualBox)

## Setup static IP

* Login to server and run command:

```
$ sudo nano /etc/network/interfaces
```

* On primary network interface change `dhcp` to `static`.

```
iface enp0s3 inet dhcp >> iface enp0s3 inet static
```

* Set server address, netmask, network, broadcast, dns-nameserver, dns-search.

```
iface enp0s3 inet static
        address 192.168.0.2
        netmask 255.255.255.0
        network 192.168.0.0
        broadcast 192.168.0.255
        gateway 192.168.0.1
        dns-nameserver 192.168.0.1
        dns-search kadequart.com
```

* Disable ipv6.

```
$ sudo nano /etc/sysctl.conf
```

Add this to .conf file:

```
net.ipv6.conf.all.disable_ipv6=1
net.ipv6.conf.default.disable_ipv6=1
net.ipv6.conf.lo.disable_ipv6=1
```

* Setup hostname.

```
$ sudo nano /etc/hosts
```

Add this to file:

```
127.0.0.1     barracuda.kadequart.com barracuda
192.168.0.2   barracuda.kadequart.com barracuda
```

* Check hostname

```
$ hostname
$ hostname -f
```

* Setup UMW.

```
$ sudo ufw status
$ sudo ufw enable
```

If ssh is not allow run:

```
$ sudo ufw allow ssh
```

* Restart server

```
$ sudo reboot
```

