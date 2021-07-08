# Password-Vault - PHP
Hi!

I'll be using `PHP, CSS, HTML` for this project.<br>
We start with creating a `database` for passwords and users.<br>
I'll be using `MySQL`  for my database

Database Code,<br>

```
CREATE DATABASE db;
USE db;

#Table for users and the master password
CREATE TABLE users (
	  pId INT PRIMARY KEY AUTO_INCREMENT,
    mailId VARCHAR(100) NOT NULL,
    user_name VARCHAR(120) NOT NULL,
    pwd TEXT NOT NULL
);

#Table for passwords which use primary id of users table
CREATE TABLE passwords (
	  pId INT PRIMARY KEY AUTO_INCREMENT,
    relId INT,
    name_of_pwd VARCHAR(100) NOT NULL,
    pwd TEXT NOT NULL,
    date_added DATE NOT NULL,
    FOREIGN KEY(relId) REFERENCES users(pId)
);
```

The master password is encrypted with the `md5` function and for encryption and decryption of the passwords stored in `passwords` table I've used `openssl_encrypt` and `openssl_decrypt` respectively which all 3 are *inbuilt in php* which you'll see later in the code files<br>
I've *not* used OOP concepts for this project<br>

`index.php` will have 2 buttons one for login and other for signup<br>
You can *delete* or *add* passwords from `home.php`   
