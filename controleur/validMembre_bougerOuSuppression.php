<?php 

    /* Fonctions */

    function validPseudo($pseudo)
    {
        if (strlen($pseudo) == 0 ) {
            return "Pseudo manquant";
        }
        if (strlen($pseudo)< 4 || strlen($pseudo)>16  ) {
            return "*Pseudo doit avoir min 4 caractères et max 16 caractères et doit contenir une lettre au majuscule";
        }
        if (preg_match("/[A-Z]/", $pseudo) == 0) 
            return "*Pseudo doit avoir min 4 caractères et max 16 caractères et doit contenir une lettre au majuscule";


        // tester si pseudo membre existe deja

        // $utiTest = new Utilisateur($pseudo,"","");
        // if ($utiTest->checkPseudo()) {
        //     return "**Pseudo existe déjà";
        // }

        return "" ;
        
    }

    function validEmail($email){

	    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

	    if(strlen($email) == 0 )
            return "E-mail manquant";

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
	      return "";
	    } else {
            return "L'email incorrect";
        }

	}

    function validMdp($mdp){
		
        if (strlen($mdp) == 0 ) return "Mot de passe manquant";
        //min 8 caracteres 
		if (strlen($mdp) < 8 ) return "*Votre mot de passe  doit avoir min 8 caractères et max 32 caractères et doit contenir une lettre au majuscule et un chiffre";
		//max 32 caracteres 
		if (strlen($mdp) > 32) return "*Votre mot de passe  doit avoir min 8 caractères et max 32 caractères et doit contenir une lettre au majuscule et un chiffre";
		//au moins un Majuscule 
		if (preg_match("/[A-Z]/", $mdp) === 0) return "*Votre mot de passe  doit avoir min 8 caractères et max 32 caractères et doit contenir une lettre au majuscule et un chiffre";
		//au moins un Chiffre
		if (preg_match("/[0-9]/", $mdp) === 0) return "*Votre mot de passe  doit avoir min 8 caractères et max 32 caractères et doit contenir une lettre au majuscule et un chiffre";

		return "";

	}

    function validConMdp($mdp,$mdpCon)
    {
        if ($mdp !== $mdpCon) {
            return "Mot de passe de confirmation incorrect";
        }
        else 
            return "";
    }

    function validConEmail($email,$emailCon) {
        if ($email != $emailCon) {
            return "L'email de confirmation incorrect";
        }
        else 
            return "";
     
    }

    /* Session */
    session_start(); 
    if (isset($_SESSION["id"])) { 
        header("Location: ../Vue/vueUtilisateur.php");
    }


    //flag 

    $flag = false;
        

    //recuperation des inputs 

    $pseudo = "";
    $mdp = "";
    $mdpCon = "";
    $email = "";
    $emailCon = "";
    $envoyer = "";

    if(isset($_POST["login"])) $pseudo=htmlspecialchars($_POST["pseudo"]);
    if(isset($_POST["mdp"])) $mdp=htmlspecialchars($_POST["mdp"]);
    if(isset($_POST["mdpCon"])) $mdpCon=htmlspecialchars($_POST["mdpCon"]);
    if(isset($_POST["email"])) $email=htmlspecialchars($_POST["email"]);
    if(isset($_POST["emailCon"])) $emailCon=htmlspecialchars($_POST["emailCon"]);


    if(isset($_POST["submit"])) $envoyer=$_POST["submit"];

    //erreurs 
    $erreurPseudo = "";
    $erreurMdp = "";
    $erreurMdpCon ="";
    $erreurEmail= "";
    $erreurEmailCon="";

    if ($envoyer != "") {
        $erreurPseudo = validPseudo($pseudo);
        $erreurMdp = validMdp($mdp);
        $erreurMdpCon = validConMdp($mdp,$mdpCon);
        $erreurEmail = validEmail($email);
        $erreurEmailCon = validConEmail($email,$emailCon);
    }
    

    if ($envoyer!="" && !$erreurPseudo && !$erreurMdp && !$erreurEmail && !$erreurMdpCon && !$erreurEmailCon) {
        $nvUtilisateur = new Utilisateur($pseudo,$mdp,$email);
        $nvUtilisateur->ajoutDB();
        $flag = true;
    }




    



























?>