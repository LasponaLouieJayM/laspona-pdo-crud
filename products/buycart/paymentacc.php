<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
<div class="container">
    <form action="">
        <h1>Payment Address</h1>
        <p>Required fileds are followed by *</p>
        <h2>Address Information</h2>
        <p>First Name: *<input type="text" placeholder="" name="First Name"required></p>
        <p>Last Name: <input type="text" placeholder="" name="Last Name"></p>
        <p>Email: * <input type="email" placeholder="" name="email" id="email"required></p>
        <p>Address: * <input type="email" placeholder="" name="email" id="email"required></p>
          
            
            <p>Phone No:  *<input type="number" placeholder="+1 2409721857" name="number" id="number"required></p>

        <fieldset>
            <legend> <b>Gender  *</b> </legend>
             <p> 
              Male: <input type="radio" name="gender" id="gender"required> Female: <input type="radio" name="gender" id="gender"required>  
             </p>
        </fieldset>  
        <input type="Submit" value="Proceed">
      </form>
    </div>
     
</body>
</html>
<style>
  *{
    box-sizing: border-box;
}

h1{
    text-transform: uppercase;
    background-color: blueviolet;
    text-shadow: 5px 3px 4px white;
    text-align: center;
    border: 7px solid black;
    border-radius: 3px;
    
    
}

h2{
    text-decoration: underline;
}

body{
    font-family:Georgia, 'Times New Roman', Times, serif, sans-serif;
    margin: 15px 30px;
    font-size: 20px;
    padding: 8px;
    
}
.container{
    background-color: #f2f2f2;
    padding: 5px 20px 15px 20px;
    border: 2px solid lightgray;
    border-radius: 6px;
}

input[type="text"],
input[type="email"],
input[type="number"],
input[type="password"],
input[type="date"],
select,textarea{
    width: 100%;
    padding: 12px;
    border: 1px solid #cfcfcf;
    border-radius: 4px;
    margin: 6px;
}

select{
    cursor: pointer;
}

fieldset{
    background-color: #fff;
    border: 1px solid #cfcfcf;
    border-radius: 4px;

}

input[type="submit"]{
    background-color: skyblue;
    color: rgb(255, 242, 242);
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
}

input[type="submit"]:hover{
    background-color: rgb(59, 172, 172);
}

</style>