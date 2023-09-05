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
    <title>PHP Script Popup</title>

<style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Bitter', serif;
}
body{
    background-color: #dee1e2;
    min-height: 100vh;
    overflow-x:hidden;
}

.container {
  display: flex;
}


header{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 48px;
    background: #352F44;
    padding: 20px 40px;
    display: flex;
    justify-content:space-between;
    align-items:center;
    box-shadow: 0 15px 15px rgba(0, 0, 0, 0.05);
	z-index: 2; 
}
.logo{
    color: white;
    text-decoration: none;
    font-size: 1.5em;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
	
}
.group{
   display: flex;
    align-items: center;
}

header ul{
    position: relative;
    display: flex;
    gap:30px;
}
header ul li{
   list-style: none;
}
header ul li a{
    position: relative;
    text-decoration: none;
    font-size: 1em;
    color: white;
    text-transform: uppercase;
    letter-spacing: .2em;
}
header ul li a:before{
    content: '';
    position: absolute;
    bottom: -2px;
    width: 100%;
    height: 2px;
    background: #333;
    transform: scaleX(0);
    -webkit-transform: scaleX(0);
    -moz-transform: scaleX(0);
    -ms-transform: scaleX(0);
    -o-transform: scaleX(0);
    transition: transform .5s ease-in-out;
    -webkit-transition: transform .5s ease-in-out;
    -moz-transition: transform .5s ease-in-out;
    -ms-transition: transform .5s ease-in-out;
    -o-transition: transform .5s ease-in-out;
    transform-origin: right;
}
header ul li a:hover::before{
    transform: scaleX(1);
    -webkit-transform:scaleX(1);
    -moz-transform:scaleX(1);
    -ms-transform:scaleX(1);
    -o-transform:scaleX(1);
    transform-origin:left ;
}
header .search{
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.5em;
    z-index: 10;
    cursor: pointer;
}
#closeBtn{
    opacity: 0;
    visibility: hidden;
    color: rgb(101, 186, 158);
    transition: 0.5s;
    -webkit-transition: 0.5s;
    -moz-transition: 0.5s;
    -ms-transition: 0.5s;
    -o-transition: 0.5s;
    scale: 0;
}
#closeBtn.active{
    opacity: 1;
    visibility: visible;
    transition: 0.5s;
    -webkit-transition: 0.5s;
    -moz-transition: 0.5s;
    -ms-transition: 0.5s;
    -o-transition: 0.5s;
    scale: 1;
}
.menuToggle{
    position: relative;
    display: none;
}

/* media queries */

@media (max-width: 800px){
    #searchBtn{
        left:0;
    }
    .menuToggle{
        position: absolute;
        display: block;
        font-size: 1em;
        cursor: pointer;
        transform: translateX(30px);
        -webkit-transform: translateX(30px);
        -moz-transform: translateX(30px);
        -ms-transform: translateX(30px);
        -o-transform: translateX(30px);
        z-index: 10;
        color: rgb(32, 119, 90);
}
    
    header .navigation{
        position:absolute;
        opacity: 0;
        visibility: hidden;
        left: 100%;
    }
    header.open .navigation{
        top: 80px;
        opacity: 1;
        visibility: visible;
        left: 0;
        display: flex;
        flex-direction: column;
        background: rgb(56, 117, 96);
        width: 100%;
        height: calc(100vh - 80px);
        padding: 40px;
        text-align: left;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        transition:1s;
        -webkit-transition:1s;
        -moz-transition:1s;
        -ms-transition:1s;
        -o-transition:1s;
}
    header.open .navigation li a{
        font-size: clamp(12px, 3em, 3em);
        color: #ffffff; 
    }
    .hide{
        display: none;
    }
}

.sidebar {
  position: fixed;
  top: 45px;
  left: 0;
  width: 55px;
  height: 100%;
  background: #5C5470;
  z-index: 1;
  
}

.sidebar img {
      width: 45px;
      height: 45px;
      cursor: pointer;
	  margin-bottom: 1px;
	  margin-top: 15px;
	  transition: filter 0.3s;
	  z-index: 1;
	  position: relative;
    }
	
.sidebar img:hover {
      filter: brightness(1.5); /* Highlight image on hover */
    }

    .tooltip {
      position: relative;
      display: inline-block;
      cursor: pointer;
    }

    .tooltip::before {
      content: attr(data-tooltip); /* Use the data-tooltip attribute for tooltip text */
      position: absolute;
      top: 50%;
      left: calc(100% + 10px); /* Position on the right side of the image */
      transform: translateY(-50%);
      background-color: rgba(0, 0, 0, 0.8);
      color: white;
      padding: 5px 10px;
      border-radius: 5px;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.3s, visibility 0.3s;
	  z-index: 3;
    }

    .tooltip:hover::before {
      opacity: 1;
      visibility: visible;
    }
	
	.content {
      margin-left: 50px;
      margin-top: 45px;
      max-height: calc(100vh - 45px); /* Adjust the max height as needed */
      overflow: auto;
      z-index: 1;
      display: flex;
      flex-direction: column;
    }

    .box-container {
      display: flex; /* Use flex display for horizontal alignment */
    }

    .box {
      flex: 1; /* Distribute available width equally among boxes */
      height: 75px;
      background-color: #fff;
      border: 1px solid #ccc;
      margin: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      font-family: 'Bitter', serif;
    }

    .box-title {
      font-size: 16px;
      margin-bottom: 10px;
    }

    .box-value {
      font-size: 1.2em;
    }

    .value-green {
      font-size: 30px;
      color: #00cc44; /* Green color for the value */
    }

    .value-red {
      font-size: 30px;
      color: #ff4444; /* Red color for the value */
    }

    .value-yellow {
      font-size: 30px;
/*      font-weight: bold   */
      color: #ffbb33; /* Yellow color for the value */
    }
	
	.videos {
	flex-grow: 1;
    display: flex;
    justify-content: center;
    flex-flow: row wrap;
    list-style: none;
    margin: 0;
    padding: 0;
}
.videos li {
  margin:1em;
  display:flex;
  flex-flow:column;
  align-items:center;
}
.videos a {
  margin:.5em 0;
}
	

/* Add this code to your existing CSS */
.popup-overlay {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  align-items: center;
  justify-content: center;
}

.popup {
  background-color: white;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  max-width: 700px;
  text-align: left;
}

#closePopup {
 display: block;
  margin: 20px auto;
  font-size: 20px;
  padding: 5px 10px;
  background-color: rgba(0, 0, 0, 0.2);
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s, color 0.3s;

}

/* Additional styles for the inbox icon */
.inbox-icon {
  position: relative;
  cursor: pointer;
  margin-right: auto;
}


.inboxButton {
  width: 30px; /* Adjust the width as needed */
  height: 30px; /* Adjust the height as needed */
}

.badge {
  position: absolute;
  top: -5px;
  right: -5px;
  background-color: red;
  color: white;
  border-radius: 50%;
  padding: 2px 6px;
  font-size: 12px;
}

/* Add this CSS to your "styles.css" file */

.stylish-button {
    display: inline-block;
    padding: 10px 10px;
    background-color: #3498db;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    transition: background-color 0.3s, transform 0.2s;
    box-sizing: border-box;
}

.stylish-button:hover {
    background-color: #2980b9;
}

.stylish-button:focus {
    outline: none;
    background-color: #2980b9;
}

#output-box {
            border: 1px solid #ccc;
            padding: 10px;
            width: 500px;
            height: 300px;
            overflow: auto;
        }

        #loading {
            display: none;
        }

.loader {
        display: none;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 100px; /* Adjust the width as needed */
        height: 100px; /* Match the width to maintain a circular shape */
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
        position: absolute;
        top: 60%;
        left: 50%;
        transform: translate(-50%, -50%);
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

#output-box {
    border: 1px solid #ccc;
    padding: 5px;
    width: 92vw;
    height: 60vh;
    overflow: auto;
    margin: 15px;
    border-radius: 5px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}



#output-box pre {
   font-family: 'Courier New', monospace;
    color: darkgreen; /* Replace with your desired font color */
    font-size: 15px; /* You can adjust the font size as needed */
}


/* Add this CSS code after your existing styles */

/* Form container */
.form-container {
  width: 96%; /* Adjust the width as needed */
  margin-top: 14px;
  margin-left: 20px;
  padding: 5px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  font-family: 'Bitter', serif;
}

/* Form rows */
.form-row {
  display: flex;
  justify-content: space-between;
  margin-top: 10px;
  margin-bottom: 15px;
  font-family: 'Bitter', serif;
}

/* Form columns (parallel text boxes) */
.form-column {
  flex: 1;
  margin-right: 10px; /* Adjust spacing between columns */
  font-family: 'Bitter', serif;
}

.form-column:last-child {
  margin-right: 10; /* Remove margin for the last column */
  font-family: 'Bitter', serif;
}

/* Label styles */
.form-column label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
  font-family: 'Bitter', serif;
}

/* Input styles */
.form-column input[type="text"],
.form-column select,
.form-column button {
  width: 60%;
  padding: 2px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
  font-family: 'Bitter', serif;
}

/* Dropdown select style */
.form-column select {
  width: 70%;
  padding: 2px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
  appearance: none;
  -webkit-appearance: none;
  background-image: url("arrow-down.png");
  background-position: right center;
  background-repeat: no-repeat;
  padding-right: 30px; /* Adjust as needed */
  cursor: pointer;
  font-family: 'Bitter', serif;
}


/* Button style */
.stylish-button {
  display: inline-block;
  padding: 10px 200px;
  margin-top: 0px;
  margin-bottom: 0px;
  width: 100%;
  background-color: #3498db;
  color: #ffffff;
  border: none;
  border-radius: 5px;
  font-size: 20px;
  cursor: pointer;
  transition: background-color 0.3s, transform 0.2s;
  box-sizing: border-box;
  font-family: 'Bitter', serif;
}

.stylish-button:hover {
  background-color: #2980b9;
}

.stylish-button:focus {
  outline: none;
  background-color: #2980b9;
}



</style>
</head>
<body>
<div class="sidebar">

  <div class="tooltip" data-tooltip="Main Page">
        <a href="logs.php" target="_blank">
          <img src="main.png" alt="Main Page" class="sidebarButton">
        </a>
      </div>
	  
      <div class="tooltip" data-tooltip="Home Page">
        <img src="inventory.jpg" alt="Inventory" class="sidebarButton">
      </div> 



</div>
  
<header>
        <a href="" class="logo">Linux</a> 
<p style="margin-top: 10px;color: white; text-decoration: none; font-size: 1em;  text-transform: capitalize; letter-spacing: 0.1em;">Welcome,   <?php echo $_SESSION["username"]; ?></p>
        <div class="group">
            <ul class="navigation">
			<div class="inbox-icon tooltip" data-tooltip="Inbox">
</div>
<a href="?logout" style="display: inline-block; padding: 8px 8px; background-color: #007bff; color: #fff; text-decoration: none; border: none; border-radius: 5px;">Logout</a>


            </ul>
            <div class="search">
                <span class="icon">
                    <ion-icon name="search-outline" id="searchBtn"></ion-icon>
                    <ion-icon name="close-outline" id="closeBtn"></ion-icon>
                </span>
                <ion-icon name="grid-outline" class="menuToggle"></ion-icon>
            </div>
        </div>
    </header>
	
	<div class="searchBox" id="searchBoxBtn">
    <!-- ... -->
  </div>

<div class="content">

<div class="form-container">
  <form id="script-form" action="#" method="post">
    <div class="form-row">
      <div class="form-column">
        <label for="servername">Cycle Name</label>
        <input type="text" id="" name="cycle_name" required>
      </div>
      <div class="form-column">
        <label for="failedreason">Change Number</label>
        <input type="text" id="change_number" name="change_number" required>
      </div>

      <div class="form-column">
        <label for="action">Select Action</label>
        <select id="action" name="action" class="dropdown-select">
         <option>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-- No Slection --</option>
          <option value="add">Add</option>
          <option value="update">Update</option>
          <option value="new">New</option>
        </select>
      </div>


    </div>
    <div class="form-row">
      <div class="form-column">
        <label for="startdate">Patching State Date</label>
	<input style="width: 240px;" type="date" name="startdate" id="startdate">
      </div>
      <div class="form-column">
         <label for="enddate">Patching End Date</label>
	 <input style="width: 240px;" type="date" name="enddate" id="enddate">
      </div>

      <div class="form-column">
        <label for="csvFile">Upload CSV File</label>
        <input type="file" id="csvFile" name="csvFile">
      </div>
    </div>
    <div class="form-row">
      <button class="stylish-button" id="startButton"><b>Launch</b></button>
    </div>
  </form>
</div>



        <div id="output-box">
            <div id="loading"></div>
            <div class="loader"></div>
            <pre id="output"></pre>
        </div>
    </div>

<script>

const form = document.getElementById('script-form');
const outputElement = document.getElementById('output');
const loadingElement = document.getElementById('loading');
const loader = document.querySelector('.loader');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    loadingElement.style.display = 'block';
    loader.style.display = 'block';
    outputElement.textContent = '';

    const action = document.getElementById('action').value;
    const url = `execute_${action}.php`;

    const formData = new FormData(form);
    formData.append('csvFile', document.getElementById('csvFile').files[0]); // Append the file

    const response = await fetch(url, {
        method: 'POST',
        body: formData
    });

    const output = await response.text();
    loadingElement.style.display = 'none';
    loader.style.display = 'none';
    outputElement.textContent = output;
    console.log(output);
});

 // JavaScript code for automatic logout after inactivity
        var timeout = setTimeout(function() {
            window.location.href = 'welcome.php?logout';
        }, <?php echo ($inactive_timeout * 600000); ?>); // Convert seconds to milliseconds

        // Function to clear the automatic logout timeout on user interaction
        function resetTimeout() {
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                window.location.href = 'index..php?logout';
            }, <?php echo ($inactive_timeout * 600000); ?>); // Convert seconds to milliseconds
        }

        // Attach the resetTimeout function to user interactions
        window.addEventListener("mousemove", resetTimeout);
        window.addEventListener("keydown", resetTimeout);



</script>

</body>
</html>
