<?php
$form = true;
require_once "autoload.php";

$formname = $_POST["formname"];

switch ( $formname )
{
    //Uses UserService for the logic, UserService uses databaseService , Formhandler and UploadService
    case "profiel_form":
        if ( isset($_POST["submit"]) == "Opladen" )
        {
            $userService = $container->getUserService();
            $userService->procesProfileForm();
        }

        break;

    case "file_upload":

        //uses UploadService for the logic, uploadService uses formhandler
        if ( isset($_POST["submit"]) AND $_POST["submit"] == "Opladen" )
        {
            $uploadService = $container->getUploadService();
            $uploadService->procesUploadForm();


        }
        header("location:".$_application_folder."/file_upload.php");
    break;

    case "registration_form":

        if ( $formname == "registration_form" AND $_POST['registerbutton'] == "Register" )
        {


            // if the form and user data is valid

            $formHandler = $container->getFormHandler();


            if ($formHandler->ValidatePostedUserData())
            {
                if ($UserService->CheckRegistrationSuccess())
                {
                    header("Location:../steden.php");
                }
            }else
            {
                header("Location:../register.php");

            }

        }
        break;

    case "stad_form":
        if ( $_POST["savebutton"] == "Save" ) {
            $formHandler = $container->getFormHandler();
            $formHandler->SaveCity();
        }
        break;

    case "login_form":
        if ($_POST['loginbutton'] == "Log in" )
        {



            if ( $UserService->checkLoginUser($_POST['usr_login']) )
            {
                $user = $UserService->loadUserFromId($_SESSION['usr_id']);
                $MS->addMessage( "Welkom, " . $user->getVoornaam() . "!" );
                header("Location: " . $_application_folder . "/steden.php");
            }
            else
            {
                $MS->addMessage( "Sorry! Verkeerde login of wachtwoord!", "error" );
                header("Location: " . $_application_folder . "/login.php");
            }
        }
        else
        {
            $MS->addMessage( "Foute formname of buttonvalue", "error" );
        }
        break;
    default:
//        error message if no form is adressed
}
