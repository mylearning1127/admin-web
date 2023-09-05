<?php
session_start();

if (!isset($_SESSION["authenticated"]) || !$_SESSION["authenticated"]) {
    header("Location: login.php"); // Redirect to login if not authenticated
    exit();
}

// Logout functionality
if (isset($_GET["logout"])) {
    session_unset();    // Unset all session variables
    session_destroy();  // Destroy the session
    header("Location: login.php"); // Redirect to login page after logout
    exit();
}

// Check for inactivity timeout
$inactive_timeout = 900; // 15 minutes
if (isset($_SESSION["last_activity"]) && (time() - $_SESSION["last_activity"] > $inactive_timeout)) {
    session_unset();    // Unset all session variables
    session_destroy();  // Destroy the session
    header("Location: login.php"); // Redirect to login page due to inactivity
    exit();
}

$_SESSION["last_activity"] = time(); // Update last activity timestamp

?>

<!DOCTYPE html>
<html>
<head>
<title>Patch Report</title>

<link rel="stylesheet" type="text/css" href="mystyle.css">
<style>
h1
{
text-align: center;
}

body {
background-color: lemonchiffon;
}

.myTable {
  width: 100%;
  text-align: left;
  background-color: lemonchiffon;
  }
.myTable th {
  background-color: goldenrod;
  width: 10px;
  color: white;
  }
.myTable td,
.myTable th {
  padding: 10px;
  width: 400px;
  border: 1px solid goldenrod;
  }
.scroll-left {
 height: 20px;	
 overflow: hidden;
 position: relative;
 background: lemonchiffon;
 border: 1px solid orange;
}
.scroll-left p {
 position: absolute;
 width: 100%;
 height: 100%;
 margin: 0;
 line-height: 20px;
 text-align: center;
 transform:translateX(100%);
 animation: scroll-left 50s linear infinite;
}
@keyframes scroll-left {
 0%   {
 transform: translateX(100%); 		
 }
 100% {
 transform: translateX(-100%); 
 }
}
input {
  float: right;
  clear: both;
}

.title{
font-weight: bold;
text-align: right;
float: right;
}
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
.center {
  margin: 0;
  position: absolute;
  top: -2%;
  left: 95%;
  -ms-transform: translate(90%, 90%);
  transform: translate(90%, 90%);
}

</style>
</head>
<body>
<div class="myTable">
<table class=customers-list>
<h1>Linux Server Patching Details</h1>
<div class="center"><button id="myBtn"><img src="img_snow.jpg" width="30" height="30" style="float: left;"/></button></div>
<div id="myModal" class="modal">
<div class="modal-content">
<span class="close">&times;</span>
<p>Some text in the Modal..</p>
</div>
</div>

<h4><div class="title">
<label class="search">Search Here &nbsp;</label>
<input type="search" placeholder="Search..." class="form-control search-input" data-table="customers-list" align="right"/>
</div> </h4><br><br>
<div class="scroll-left">
<p>NOTE: If patch_successful column is empty that means server not patched in last 30 days . . .</p>
</div>
<tr>
<th>Hostname</th>
<th>patch_successful</th>
<th>patch_failed</th>
<th>bapscheduledtime</th>
<th>kernelrelease</th>
<th>targetkernel</th>
<th>acversion</th>
<th>environment</th>
</tr>


<tr>
<td>host1</td>
<td>success</td>
<td>NA</td>
<td>15-05-2023</td>
<td>3.10.5.el6.x86_64</td>
<td>3.10.5.el6.x86_64</td>
<td>10.0.5</td>
<td>DEV</td>
</tr> 

<tr>
<td>host1</td>
<td>success</td>
<td>NA</td>
<td>15-05-2023</td>
<td>3.10.5.el6.x86_64</td>
<td>3.10.5.el6.x86_64</td>
<td>10.0.5</td>
<td>DEV</td>
</tr>

<tr>
<td>host1</td>
<td>success</td>
<td>NA</td>
<td>15-05-2023</td>
<td>3.10.5.el6.x86_64</td>
<td>3.10.5.el6.x86_64</td>
<td>10.0.5</td>
<td>DEV</td>
</tr>

<tr>
<td>host1</td>
<td>success</td>
<td>NA</td>
<td>15-05-2023</td>
<td>3.10.5.el6.x86_64</td>
<td>3.10.5.el6.x86_64</td>
<td>10.0.5</td>
<td>DEV</td>
</tr>

<tr>
<td>host1</td>
<td>success</td>
<td>NA</td>
<td>15-05-2023</td>
<td>3.10.5.el6.x86_64</td>
<td>3.10.5.el6.x86_64</td>
<td>10.0.5</td>
<td>DEV</td>
</tr>

<tr>
<td>host1</td>
<td>success</td>
<td>NA</td>
<td>15-05-2023</td>
<td>3.10.5.el6.x86_64</td>
<td>3.10.5.el6.x86_64</td>
<td>10.0.5</td>
<td>prod</td>
</tr>

</table>
</div>
<script>
(function(document) {
'use strict';
var TableFilter = (function(myArray) {
var search_input; 
function _onInputSearch(e) {
search_input = e.target;
var tables = document.getElementsByClassName(search_input.getAttribute('data-table'));
myArray.forEach.call(tables, function(table) {
myArray.forEach.call(table.tBodies, function(tbody) {
myArray.forEach.call(tbody.rows, function(row) {
var text_content = row.textContent.toLowerCase();
var search_val = search_input.value.toLowerCase();
row.style.display = text_content.indexOf(search_val) > -1 ? '' : 'none';
});
});
});
}
return {
init: function() {
var inputs = document.getElementsByClassName('search-input');
myArray.forEach.call(inputs, function(input) {
input.oninput = _onInputSearch;
});
}
};
})(Array.prototype);
document.addEventListener('readystatechange', function() {
if (document.readyState === 'complete') {
TableFilter.init();
}
});
})(document);
</script>
<script>
var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
  modal.style.display = "block";
}
span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
</body>
</html>
