<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon formulaire de contact</title>



    <script type="text/javascript">
        function validationFormulaire() {
            var x = document.forms["formContact"]["messageContact"].value;

            if (x == null || x==""){
                
                alert("Vous  avez oublié d'insérer un message");
                
                return false;
            }
        }

    </script>

    <style>
        body {

            font-family: "Georgia", "Arial", sans-serif;
        }

        fieldset {
            padding-left: 20px;
            width: 500px;
            background-color: darkgrey;
        }



        input[type="submit"] {

            padding: 10px;
            font-size: 16px;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            background-color: #fe6921;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            box-shadow: 0px 0px 3px #555;
            background-color: #e8ab2e;
        }
        
        .to{
            float: right;
            border: 3px solid darkgrey;
            width: 100px;
            text-align: center;
            background-color: cornflowerblue;
        }

    </style>
</head>

<body>
    
     <?php
	
	////////////////////////////////////////////////////////////////
	// NE PAS OUBLIER DE METTRE L'ATTRIBUT NAME AU BOUTON ENVOIE  //
	////////////////////////////////////////////////////////////////
	
       
        
	if (isset($_POST['envoyer'])) {
		//vérifie que le formulaire a été envoyé
		
		if (!isset($_POST['messageContact']) || $_POST['messageContact']=='') {
		//vérifie l'absence d'écriture dans l'élément appelé "messageContact
			
			echo('Vous avez oublié d\'insérer un message<br>');
			//si les deux conditions sont remplies (envoie et absence d'écriture), écrire le message.
		}
        
        else{ 
            
            // initialise la variable email
            if(!isset($_POST["email"]) || $_POST["email"]==''){
                $_POST['email']='';
        }
            
            // si la cause autorisation est cochée///
        elseif(isset($_POST['autorisation'])){
            //je récupère l'adresse mail
            $adressMail= $_POST["email"];
            //je me connecte à mysql pour accéder à la base de donnée
            $db=new PDO('mysql:host=localhost; dbname=CV; charset=utf8', 'root', 'root');
            
            //je demande d'inserrer l'adresse à la base de donnée avec INSERT INTO
            
            $result=$db->prepare('INSERT INTO AGuillaumeS (Email) VALUES(:adressMail)');
				$result->execute(array('adressMail' => $adressMail));
        }    
        
        
       
        $message = 'Vous avez recu un message via votre site internet, le voici:'."\r\n".$_POST['messageContact'];

        
            
/////////////////////////////////////////////////
//////  PERMIET D'EVITER QUE LE MAIL AILLE DANS LES SPAMS   /////////////
////////////////////////////////////////////////////////////
    
//        $headers  = 'MIME-Version: 1.0' . "\r\n";
//			$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
//			$headers .= 'From: '.$_POST['email']."\r\n".'Reply-To: '.$_POST['email']."\r\n".'X-Mailer: PHP/' . phpversion();
//	
   ////////////////////////////////////////////////////////
            
            
            mail ('guillaume1972@yahoo.fr','Formulaire de contact',$message);
        
            // confirmation
			echo('Votre message a &eacute;t&eacute; envoy&eacute;<br>');
    }
    }
    

        

			
		
        
			
	?>
    
<!--    <form name="formContact" onsubmit="return validationFormulaire()" method="post" >   l'attribut on submit permet de tester le javascript-->
       
        <form name="formContact"  method="post" >
        <!-- type texte -->
        <fieldset>
            <legend>Informations personnelles :</legend>
            <label for="nom">Nom : <br></label><input class="un" type="text" id="nom" placeholder="Nom"><br>
            <label for="prenom">Prénom :<br></label><input class="un" type="text" id="prenom" placeholder="Prénom"><br>
            <label for="mail" >Mail :<br></label><input class="un" type="text" id="mail" placeholder="ton adresse Mail ?" name="email"><br>

            <label for="telephone">Téléphone :<br></label><input class="un" type="tel" placeholder="Donne moi ton 06"><br><br>
            <textarea id="form-textarea" name="messageContact" cols="50" rows="10"></textarea><br>
            
            <input type="checkbox" name="autorisation"> Je vous autorise &agrave; conserver ces coordonn&eacute;es<br>

        </fieldset>


        <!-- on peut gérer l'ordre de selection des cases avec tabindex -->


        <input type="submit" value=" envoyer " name="envoyer" >
    </form>
    <div class="to">

        
        
   
        
        



    </div>
</body>


</html>
