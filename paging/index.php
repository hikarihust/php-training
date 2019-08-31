<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="cache-control" content="no-cache" />
<title>Ajax paging</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/paging.css">
<script src="js/jquery-1.10.0.min.js"></script>
<script src="js/paging.js"></script>
</head>

<body>
	<div id="wrapper">
    	<div id="header">
        	<a href="#" class="logo"></a>
            <span class="webname">Ajax Paging</span>
        </div>
        <div id="content">
        	<h1>Ajax paging example</h1>
            <div id="left">
             <h2>Left content</h2>
             
             <div id="paging">
                 <ul id="rows">
                 </ul>
                 <ul id="pages">
                 	 <li class="pageInfo"></li>
                     <li class="goPrevious">&lsaquo;&lsaquo; Previous</li>
                     <li>
                     	<input type="text" class="currentPage" id="currentPage" value=""/>
                     </li>
                     <li class="goNext">Next &rsaquo;&rsaquo;</li>
                     
                 </ul>
                 <div class="clr"></div>
             </div>
             
            </div>
            <div id="right">
             <h2>Right content</h2>
            <p>
            	Lorem ipsum dolor sit amet <a>consectetur adipisicing</a> elit sed do 
                eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                text-based tooltip laboris nisi ut aliquip consequat. 
             </p>
             <p>
            	Duis aute irure dolor in reprehenderit in voluptate velit esse cillum 
                dolore eu <a href="#">fugiat nulla</a> pariatur. Excepteur sint occaecat cupidatat non 
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 
             </p>
            </div>
            <div class="clr"></div>
        </div>
        <div id="footer"></div>
    </div>
</body>
</html>
