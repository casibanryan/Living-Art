<?php

    session_start();
    require_once('functions.php');
    $method = $_POST['method'];

    switch($method) {
        case 'post_art':
            post_art();
            break;

        case 'show_artwork':
            show_artwork();
            break;

        case 'on_search':
            $id = $_POST['id'];
            on_search($id);
            break;
        
        case 'contact_us':
            contact_us();
            break;

        case 'fnSignUp':
            fnSignUp();
            break;

        case 'login':
            login();
            break;

        case 'forgot_password':
            forgot_password();
            break;

        case 'reset_password':
            reset_password();
            break;

        case 'add_toCart':
            add_toCart();
            break;

        case 'view_cart':
            view_cart();
            break;
        
        case 'delete_cart':
            delete_cart();
            break;

        case 'clear_cart':
            clear_cart();
            break;
        
        case 'not_show':
            not_show();
            break;
        
        case 'view_address':
            view_address();
            break;

        case 'update_address':
            update_address();
            break;
            
        case 'checkout':
            checkout();
            break;

        case 'upload_profile':
            upload_profile();
            break;
        
        case 'newsletter':
            newsletter();
            break;

    }

?>