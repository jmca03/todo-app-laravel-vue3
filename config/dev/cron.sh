#! /bin/sh

ssh-keygen -qA
/usr/sbin/sshd -D

crond -b