/*some credit to w3schools.com*/



$(document).ready(function(){
    var scrolled;
    $("#panel").slideDown("slow");
    $("#tab1").mouseover(function(){
        $("#img_1").fadeIn();
        $("#img_2").fadeOut();

    });
    $("#tab2").mouseover(function(){
        $("#img_1").fadeOut();
        $("#img_2").fadeIn();
        
    });
    $(function(){
      $("#Navbar").load("Header.html"); 
    });
    
    scrolled = true;
    var showing = false;
    $("#flip").click(function(){
        $("#panel").slideDown("slow");
        $("#menu").fadeOut();
        showing= false;
        if(scrolled == true){
        $("#panel").slideUp("slow");
        scrolled = false;
        return;
}
        scrolled = true;
        
    });

    $('#FadeButton').click(function(){
    	$("#menu").fadeIn();
    	$("#panel").slideUp("slow");
    	scrolled = false;
    	if(showing == true){
    		$("#menu").fadeOut();
    		showing = false
    		return;
    	}
    	showing = true;
    })

    var index = 0;
    
    window.onload = function(){
    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
            xmlhttpProducts = new XMLHttpRequest();
            xmlhttpDates = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            xmlhttpProducts = new ActiveXObject("Microsoft.XMLHTTP");
            xmlhttpDates = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("selections").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttpProducts.onreadystatechange = function() {
            if (xmlhttpProducts.readyState == 4 && xmlhttpProducts.status == 200) {
                document.getElementById("products").innerHTML = xmlhttpProducts.responseText;
            }
        };
        xmlhttpDates.onreadystatechange = function() {
            if (xmlhttpDates.readyState == 4 && xmlhttpDates.status == 200) {
                document.getElementById("WeekTable").innerHTML = xmlhttpDates.responseText;
            }
        };
        xmlhttp.open("GET","../PHP/SelectIndex.php?q="+index,true);
        xmlhttp.send();
        xmlhttpProducts.open("GET","../PHP/PostSelections.php?q="+index,true);
        xmlhttpProducts.send();
        xmlhttpDates.open("GET","../PHP/PostDates.php?q="+index,true);
        xmlhttpDates.send();

}



});


function showTable(str) {
    if (str == "") {
        document.getElementById("productTable").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("productTable").innerHTML = xmlhttp.responseText;

            }
        };
        xmlhttp.open("GET","../PHP/getTable.php?q="+str,true);
        xmlhttp.send();
    }

    var e = document.getElementById("products");
    var product = e.options[e.selectedIndex].value;

    var d = document.getElementById("Pname");
    d.value = product;
} 

