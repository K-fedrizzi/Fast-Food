<!DOCTYPE html>
<html lang="en" >
        <head> <meta charset="UTF-8">
            <title> Login </title>
            <link href='https://fonts.googleapis.com/css?family=Russo One' rel='stylesheet'>
            <link href="estilo.css" rel="stylesheet"> 
            <script type="text/javascript" src="login.js" defer></script>
        </head> 
   
            <body>
                <div class="btSair"><a href="inicial.html" > Sair</a> </div>

                  <div> <h1 class="titulo1">
                            Fast Food  </h1>

                    <h1 class="titulo2">
                           Delicious      </h1>    </div> 
                   
                           <div class="container" >
                           
                            
                            <div class="content">      
                              
                              <div id="login">
                                <form method="post" action=""> 
                                  <h3> Bem vindo de volta!</h3> 
                                  <p> 
                                    
                                    <input id="email_login" name="email_login" required="required" type="text" placeholder="E-mail ou telefone"/> </center>
                                  </p>
                                  
                                  <p> 
                                    <input id="senha_login" name="senha_login" required="required" type="password" placeholder= "Senha" /> </center>
                                  </p>
                                  
                                  <p> 
                                    <input type="checkbox" name="manterlogado" id="manterlogado" value="" /> 
                                    <label for="manterlogado">Manter-me logado</label>
                                  </p>
                                  
                                  <p>
                                  <div class="Entrar">
                                   <a  id="link" href="lista.php"> <button class="button" type="submit" onclick="login()">Entrar</button></a>
                                </div>
                                 </p>
                                  
                                 <div class="Link">
                                  <p class="link">
                                    Não possui conta? 
                                    <a href="cadastro.php">Cadastre-se já</a>
                                  </p>
                                </div>
                                </form>
                              </div>
                        
            </body>



</html>