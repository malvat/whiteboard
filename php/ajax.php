<html>
    <head>
        <title>
            AJAX - Example
        </title>
        <script type="text/javascript" src="jquery-3.3.1.js">
        </script>
        
        <script type="text/javascript">
            var anim = "anim";
            function checking(){
                $.ajax({
                    url: "example.php",
                    data: ({"anim":anim}), 
                    dataType: "text", 
                    success: function(d) {
                        $('#eg').html(d);
                        
                    }
                })
                console.log("it is working bro");
            }
            checking();
        </script>
    </head>
    <body>
        
        
        
        <div id="eg">  
            
        </div>
    </body>
    
    
</html>