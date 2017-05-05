# Hamlog
Hamlog is a simple PHP contact logging utility for ham radio operators. Think of it like a digital logbook.
## Installation Prerequisites
Hamlog is a web application. As such, it requires a functional web server (Apache2, PHP, MySQL) in order to function properly. Apache works as the http server, PHP interacts with the MySQL database, and MySQL stores the operator's contacts. There is no operating system specific requirement, any web server that can utilize these three services will do fine.

The design of Hamlog relies on Bootstrap v3, an HTML/CSS/JS framework for designing responsive webpages. Without Bootstrap, Hamlog will not be styled correctly, rendering it unusable. Later versions of Hamlog will utilize Bootstrap v4, but this current version supports v3 only.

* Web Server with Apache, PHP, MySQL installed
* Bootstrap v3 [can be downloaded here](https://github.com/twbs/bootstrap/releases/download/v3.3.7/bootstrap-3.3.7-dist.zip)

### Bootstrap
Installing Bootstrap is as easy as downloading the zip file and unzipping it. Copy the contents of the folders into the respective Hamlog folders. For example, the contents of the js folder in Bootstrap needs to be in the js folder in Hamlog. The fonts directory can be placed into the main Hamlog directory, but no Glyphicons are used at this time.

Hamlog does not use minified CSS files or JS files at this time.

The contents of the js folder should be as follows:
* bootstrap.js
* collapse.js
* jquery.js
* utctime.js

The contents of the css folder should be as follows:
* style.css
* bootstrap.css

Once the files have been unpacked into their respective locations, rename bootstrap.css to hamlog.css. Any files not copied over can be discarded.

## Installation
### Apache, PHP, and MySQL
Now that all of the required Bootstrap files are in place, we're ready to get the server setup and ready to go. Unfortunately, I won't be able to walk you through a full server install, but I can guide you to some great resources for getting it done.

**Windows Users** | **Mac Users** | **Ubuntu Users**
------------ | ------------- | ------------
Download [WAMP Server](http://www.wampserver.com/en/) | Download [MAMP](https://www.mamp.info/en/) | Refer to this [Digital Ocean Installation Guide](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04)
After installation, the Hamlog folder will need to placed inside of the C:\wamp\www\ folder. | MAMP offers two different versions, you don't need the PRO version. After installation, the Hamlog folder will need to be placed inside of the /Applications/MAMP/htdocs folder. | Hamlog folder will need to be nested inside of the /var/www/html/ directory.

### Setting up MySQL
In order for Hamlog to function as intended, a database called "Hamlog" with a tabled called "logbook" must be created. Inside of the logbook table are the following:
* id - int(11) AUTO_INCREMENT
* callsign - varchar(6) utf8_general_ci
* date - date
* timesent - varchar(5) utf8_general_ci
* frequency - varchar(7) utf8_general_ci
* mode - varchar(20) utf8_general_ci
* notes - varchar(100) utf8_general_ci
```SQL
CREATE TABLE `logbook` (
  `id` int(11) NOT NULL,
  `callsign` varchar(6) NOT NULL,
  `date` date NOT NULL,
  `timesent` varchar(5) NOT NULL,
  `frequency` varchar(7) NOT NULL,
  `mode` varchar(20) NOT NULL,
  `notes` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```
```SQL
ALTER TABLE `logbook`
  ADD PRIMARY KEY (`id`);
```

## Using Hamlog
Once the above installation requesites and installation steps have been taken, simply open your web browser of choice and navigate to http://localhost/hamlog/.
### Issues, Requests, or Complaints
Feel free to email me, themattbook@gmail.com
