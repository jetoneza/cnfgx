# Ubuntu Installation (VirtualBox)

## Creating the Box

1. New Linux Ubuntu 64-bit.
2. Choose memory size.
3. Create a virtual hard disk.
  * VHD (Virtual Hard Disk)
  * Dynamically allocated
  * Set size to 5GB
  
## Box Settings

1. Remove floppy option on system.
2. Add OS image to storage.
3. Disable audio.
4. Set network adapter to Bridged Adapter.

## OS Installation

1. Set hostname. (e.g. Barracuda)
2. Setup user account.
3. Use entire disk and setup LVM.
4. Leave HTTP proxy to blank.
5. Set no automatic updates.
6. Select standard system utils and open ssh server in software selection.
7. Install GRUB boot loader.

## Server Login

1. Run server system updates.

```
$ sudo apt-get update
$ sudo apt-get upgrade
```

2. Set root password

```
$ sudo passwd root
```
