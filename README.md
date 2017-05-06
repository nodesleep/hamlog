# Hamlog
A PHP web-based logbook utility for Amateur Radio operators. Hamlog allows operators the ability to keep record of their contacts without the need for special programs or paper.

![Hamlog Homepage](https://raw.githubusercontent.com/themattbook/hamlog/master/examples/hamlog.png)

## Installation Prerequisites
Hamlog is a web application. As such, it requires a functional web server (Apache2, PHP, MySQL) in order to function properly. Apache works as the http server, PHP interacts with the MySQL database, and MySQL stores the operator's contacts. There is no operating system specific requirement, any web server that can utilize these three services will do fine.

The design of Hamlog relies on Bootstrap v3, an HTML/CSS/JS framework for designing responsive webpages. Without Bootstrap, Hamlog will not be styled correctly, rendering it unusable. Later versions of Hamlog will utilize Bootstrap v4, but this current version supports v3 only.

* Web Server with Apache, PHP, MySQL installed
* Bootstrap v3 [can be downloaded here](https://github.com/twbs/bootstrap/releases/download/v3.3.7/bootstrap-3.3.7-dist.zip)

## Setting up Bootstrap

Installing Bootstrap is as easy as downloading the zip file and unzipping it. Copy the contents of the folders into the respective Hamlog folders. For example, the contents of the js folder in Bootstrap needs to be in the js folder in Hamlog. The fonts directory can be placed into the main Hamlog directory, but no Glyphicons are used at this time.

Hamlog does not use minified CSS files or JS files at this time.

The contents of the js folder should be as follows:
* bootstrap.js
* collapse.js
* jquery.js
* utctime.js

The contents of the css folder should be as follows:
* hamlog.css
* bootstrap.css

Once the files have been unpacked into their respective locations, rename bootstrap.css to style.css. Any files not copied over can be discarded.

## Installation
### Server-side: Apache, PHP, and MySQL
Now that all of the required Bootstrap files are in place, we're ready to get the server setup and ready to go. Unfortunately, I won't be able to walk you through a full server install, but I can guide you to some great resources for getting it done.

![Windows Users](http://www.fluxbytes.com/wp-content/uploads/2014/10/windows-logo.png) |![Mac Users](http://getmyle.com/wp-content/uploads/2015/09/Apple-Icon.png)|![Ubuntu Users](https://i.downloadatoz.com/download/icon2/d/b/a/d9e404950c6c5a598eea2b69bc4f4abd.jpg)
-------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------
Download [WAMP Server](http://www.wampserver.com/en/) | Download [MAMP](https://www.mamp.info/en/) | Refer to this [Digital Ocean Installation Guide](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04)
After installation, the Hamlog folder will need to placed inside of the C:\wamp\www\ folder. | MAMP offers two different versions, you don't need the PRO version. After installation, the Hamlog folder will need to be placed inside of the /Applications/MAMP/htdocs folder. | Hamlog folder will need to be nested inside of the /var/www/html/ directory or whichever directory is specified as the DocumentRoot in Apache's configuration.

### Setting up MySQL Database (optional, see note)
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
```SQL
ALTER TABLE `logbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
```
PHPMyAdmin is a great tool for managing MySQL Databases if you're not comfortable with the MySQL command line. 

**NOTE:** Alternatively, you can import the included database file, located [here](https://github.com/themattbook/hamlog/blob/master/examples/hamlog.sql).

## Using Hamlog
Once the above installation requisites and installation steps have been taken, simply open your web browser of choice and navigate to http://localhost/hamlog/. If you installed Hamlog on a personal website, you're probably savvy enough to figure out the URL. To see a working demo, please visit [the hamlog sandbox](http://meetmattsweet.com/sandbox/hamlog/).
### Contributing
You are free to modify Hamlog in any way, shape, or form. My desire is to keep Hamlog free and open to the Amateur Radio community, while continually publishing updates and improvements to the framework. If you wish to discuss this further, please send an email to the address below or look up KE0IMD on QRZ. 
### Issues, Requests, or Complaints
Feel free to email me, themattbook@gmail.com. I cannot guarantee a timely reply, as I have several projects on my table.
