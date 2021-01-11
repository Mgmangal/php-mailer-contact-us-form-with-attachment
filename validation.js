function validation()                                    
{   

    var services = document.forms["RegForm"]["services"];               
    var name = document.forms["RegForm"]["name"];    


     
   
    if (services.value == "")                                  
    { 
       
        document.getElementById("servicesa").innerHTML = "Please enter services.";
        services.focus(); 
        return false; 
    } else{
        document.getElementById("services").innerHTML="";
    }
   
   
    if (name.value == "")                                   
    { 

        document.getElementById("namea").innerHTML = "Please enter a valid e-mail address.";
        name.focus(); 
        return false; 
    } else{
        document.getElementById("namea").innerHTML="";
    }
 
   
   
    return true; 
}
